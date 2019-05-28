<?php

namespace Controladoras;

//Modelo
use Modelo\Mensaje as Mensaje;
use Modelo\Cliente as Cliente;
use Modelo\Usuario as Usuario;
use Modelo\Lente as Lente;
use Modelo\Lente_x_cliente as Lente_x_cliente;


//Dao
use Dao\ClienteBdDao as ClienteBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\LenteBdDao as LenteBdDao;
use Dao\LentexclienteBdDao as LentexclienteBdDao;

class AdministrarControladora
{
	protected $daoCliente;
	protected $daoUsuario;
	protected $daoLente;
	protected $daoLentexcliente;

	private $cliente;
	private $usuario;
	private $lente;
	private $lentexcliente;



	public function __construct()
	{
		$this->daoCliente = ClienteBdDao::getInstancia();
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoLente = LenteBdDao::getInstancia();
		$this->daoLentexcliente = LentexclienteBdDao::getInstancia();
	}

	function eliminarcliente($id_cliente){
		try{
			
			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				if(isset($id_cliente)){
					$cliente= $this->daoCliente->traerPorId($id_cliente);
					$nombre = $cliente->getNombre();
					$apellido = $cliente->getApellido();
					$lentexcliente = $this->daoLentexcliente->traerPorIdCliente($id_cliente);
					$this->daoLentexcliente->eliminarPorIdCliente($id_cliente);
					if(!empty($lentexcliente))
					{
						$longitud = count($lentexcliente);

						for ($contador = 0; $contador <= $longitud; $contador++) 
						{
							if(!empty($lentexcliente[$contador]))
							{
								$lente[$contador] = $lentexcliente[$contador]->getIdLente();
								$id_lente = $lente[$contador]->getId();
								$this->daoLente->eliminarPorId($id_lente);
							}
						}
					}
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
				$this->mensaje = new Mensaje( "success", "Debe iniciar sesion" );
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
				$this->mensaje = new Mensaje( "success", "Debe iniciar sesion" );
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

		function modificarusuario($id_usuario, $nombre, $apellido, $calle, $telefono, $email, $pass){
		try{

			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				

				$nombre = ucwords($nombre); 
				$apellido = ucwords($apellido); 
				$calle = ucwords($calle);

				$usuario = $this->daoUsuario->traerPorId($id_usuario);

				$id_rol = $usuario->getIdRol();

				if(empty($nombre))
				{
					$nombre = $usuario->getNombre();
				}
				if(empty($apellido))
				{
					$apellido =  $usuario->getApellido();
				}
				if(empty($email))
				{
					$email =  $usuario->getEmail();
				}
				if(empty($pass))
				{
					$pass =  $usuario->getPassword();
				}
				if(empty($calle))
				{
					$calle =  $usuario->getCalle();
				}
				if(empty($telefono))
				{
					$telefono =  $usuario->getTelefono();
				}

				if(!empty($id_usuario)){
					$usuarioInstance = new Usuario($nombre, $apellido, $email, $calle, $telefono, $pass, $id_rol);
					$idUse = $this->daoUsuario->actualizar( $usuarioInstance, $id_usuario);
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", "La cuenta fue modificada con exito!" );
				}

				switch ($regCompleted){
					case TRUE:
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
					break;

					case FALSE:
					$this->mensaje = new Mensaje( "success", "Error!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "modificarusuario.php");
					include URL_VISTA . 'footer.php';
					break;
				}
			}
			else{
				$this->mensaje = new Mensaje( "success", "Debe iniciar sesion" );
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
	function modificarlente($id_lente, $medico, $fecha, $armazon_lejos, $armazon_cerca, $lejos_od, $cerca_od, $lejos_oi, $cerca_oi, $cilindrico, $en_grados, $color, $distancia, $calibre, $puente){

		try{
			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				
				$lente = $this->daoLente->traerPorId($id_lente);

				if(empty($medico))
				{
					$medico = $lente->getMedico();
				}
				else
				{
					$medico = ucwords($medico); 
				}
				if(empty($fecha))
				{
					$fecha =  $lente->getFecha();
				}
				if(empty($armazon_lejos))
				{
					$armazon_lejos =  $lente->getArmazonLejos();
				}
				if(empty($armazon_cerca))
				{
					$armazon_cerca =  $lente->getArmazonCerca();
				}
				if(empty($lejos_od))
				{
					$lejos_od =  $lente->getLejosOd();
				}
				if(empty($cerca_od))
				{
					$cerca_od =  $lente->getCercaOd();
				}
				if(empty($lejos_oi))
				{
					$lejos_oi =  $lente->getLejosOi();
				}
				if(empty($cerca_oi))
				{
					$cerca_oi =  $lente->getCercaOi();
				}
				if(empty($cilindrico))
				{
					$cilindrico =  $lente->getCilindrico();
				}
				if(empty($en_grados))
				{
					$en_grados =  $lente->getEnGrados();
				}
				if(empty($color))
				{
					$color =  $lente->getColor();
				}
				else
				{
					$color = ucwords($color); 
				}
				if(empty($distancia))
				{
					$distancia =  $lente->getDistancia();
				}
				if(empty($calibre))
				{
					$calibre =  $lente->getCalibre();
				}
				if(empty($puente))
				{
					$puente =  $lente->getPuente();
				}

				if(!empty($id_lente)){
					$lenteInstance = new Lente($medico, $armazon_cerca, $armazon_lejos, $lejos_od, $lejos_oi, $cerca_od, $cerca_oi, $cilindrico, $en_grados, $distancia, $calibre, $puente, $color, $fecha);
					$idLent = $this->daoLente->actualizar( $lenteInstance, $id_lente );
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", "El Lente fue Modificaco con exito!" );
				}

				switch ($regCompleted){
					case TRUE:
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
					break;

					case FALSE:
					$this->mensaje = new Mensaje( "success", "Ocurrio un Problema" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "modificarlente.php");
					include URL_VISTA . 'footer.php';
					break;
				}
			}
			else{
				$this->mensaje = new Mensaje( "success", "Debe iniciar sesion" );
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

	function eliminarlente($id_lente, $id_cliente){
		try{
			
			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				if(isset($id_lente)){
					$cliente= $this->daoCliente->traerPorId($id_cliente);
					$nombre = $cliente->getNombre();
					$this->daoLentexcliente->eliminarPorIdLente($id_lente);
					$this->daoLente->eliminarPorId($id_lente);
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje('success', 'Ha borrado satisfactoriamente el lente del cliente
						! El Cliente es:' .' '.'<i><strong>' .  $nombre
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
				$this->mensaje = new Mensaje( "success", "Debe iniciar sesion" );
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