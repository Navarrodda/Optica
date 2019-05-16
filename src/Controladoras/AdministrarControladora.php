<?php

namespace Controladoras;

//Modelo
use Modelo\Mensaje as Mensaje;
use Modelo\Cliente as Cliente;


//Dao
use Dao\ClienteBdDao as ClienteBdDao;

class AdministrarControladora
{
	protected $daoCliente;

	private $cliente;



	public function __construct()
	{
		$this->daoCliente = ClienteBdDao::getInstancia();
	}

	function eliminarcliente($id_cliente){
		try{
			
			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				if(isset($id_cliente)){
					$cliente= $this->daoCliente->traerPorId($id_cliente);
					$nombre = $cliente->getNombre();
					$apellido = $cliente->getApellido();
					$this->daoCliente->eliminarPorId($id_cliente);
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje('success', 'Ha borrado satisfactoriamente al cliente
						! El CLiente eliminado fue:' .' '.'<i><strong>' .  $nombre
						. '</strong></i>');
				}


				switch ($regCompleted){
					case TRUE:
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
					break;

					case FALSE:
					$cliente = $this->daoCliente->traerTodo();
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "cliente.php");
					include URL_VISTA . 'footer.php';
					break;
				}
			}
			else{
				$this->mensaje = new Mensaje( "success", "Deve iniciar sesion" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "inicio.php");
				include URL_VISTA . 'footer.php';
			}

		}catch(\PDOException $pdo_error){
			$this->mensaje = new \Modelo\Mensaje("danger","Ocurrio un error con la Base de Datos: " . $pdo_error);
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'error.php');
			include URL_VISTA . 'footer.php';
		}catch(\Exception $error){
			echo $error->getMessage();
		}
	}

	function modificarcliente($id_cliente, $nombre, $apellido, $telefono){
		try{

			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				

				$nombre = ucwords($nombre); 
				$apellido = ucwords($apellido); 

				$verificacion = 0;


				if( ! $this->daoCliente->verificarNombre($nombre)){
					if( ! $this->daoCliente->verificarApellido($apellido))
					{
						$verificacion = 0;
					}
				}
				else{
					if( ! $this->daoCliente->verificarApellido($apellido))
					{
						$verificacion = 0;
					}
					else{
						$verificacion = 1;
					}
				}
				if(  ! $this->daoCliente->verificarApellido($apellido)){
					if( ! $this->daoCliente->verificarNombre($nombre))
					{
						$verificacion = 0;
					}

				}
				else{
					if( ! $this->daoCliente->verificarNombre($nombre))
					{
						$verificacion = 0;
					}
					else{
						$verificacion = 1;
					}
				}

				$cliente = $this->daoCliente->traerPorId($id_cliente);

				if(empty($nombre))
				{
					$nombre = $cliente->getNombre();
				}
				if(empty($apellido))
				{
					$apellido =  $cliente->getApellido();
				}
				if(empty($telefono))
				{
					$telefono =  $cliente->getTelefono();
				}

				if($verificacion === 0){

					$clientInstance = new Cliente($nombre, $apellido, $telefono);
					$idClie = $this->daoCliente->actualizar( $clientInstance, $id_cliente );
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", "El Cliente fue Modificaco con exito!" );
				}

				switch ($regCompleted){
					case TRUE:
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
					break;

					case FALSE:
					$this->mensaje = new Mensaje( "success", "Ya hay Cliente registrado con ese Nombre y Apellido!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "modificarcliente.php");
					include URL_VISTA . 'footer.php';
					break;
				}
			}
			else{
				$this->mensaje = new Mensaje( "success", "Deve iniciar sesion" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "inicio.php");
				include URL_VISTA . 'footer.php';
			}

		}catch(\PDOException $pdo_error){
			$this->mensaje = new \Modelo\Mensaje("danger","Ocurrio un error con la Base de Datos: " . $pdo_error);
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'error.php');
			include URL_VISTA . 'footer.php';
		}catch(\Exception $error){
			echo $error->getMessage();
		}
	}
}