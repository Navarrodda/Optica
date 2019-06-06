<?php

namespace Controladoras;

use Modelo\Rol as Rol;
use Modelo\Usuario as Usuario;
use Modelo\Cliente as Cliente;
use Modelo\Lente as Lente;
use Modelo\Factura as Factura;
use Modelo\Cuenta_saldos as Cuenta_saldos;
use Modelo\Lente_x_cliente as Lente_x_cliente;
use Modelo\Mensaje as Mensaje;
use Modelo\Senias_x_cliente_lente as Senias_x_cliente_lente;

use Dao\RolBdDao as RolBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\ClienteBdDao as ClienteBdDao;
use Dao\LenteBdDao as LenteBdDao;
use Dao\LentexclienteBdDao as LentexclienteBdDao;
use Dao\FacturaBdDao as FacturaBdDao;
use Dao\CuentasaldosBdDao as CuentasaldosBdDao;
use Dao\SeniasxclientelenteBdDao as SeniasxclientelenteBdDao;

class RegistrarControladora
{
	protected $daoRol;
	protected $daoUsuario;
	protected $daoCliente;
	protected $daoLente;
	protected $daoLentexcliente;
	protected $daoCuentasaldos;
	protected $daoFactura;
	protected $daoSenia;

	public function __construct() {

		$this->daoRol = RolBdDao::getInstancia();
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoCliente = ClienteBdDao::getInstancia();
		$this->daoLente = LenteBdDao::getInstancia();
		$this->daoLentexcliente = LentexclienteBdDao::getInstancia();
		$this->daoFactura = FacturaBdDao::getInstancia();
		$this->daoCuentasaldos = CuentasaldosBdDao::getInstancia();
		$this->daoSenia = SeniasxclientelenteBdDao::getInstancia();
	}

	public function registrarse($nombre, $apellido, $calle, $telefono, $email, $pass, $id_rol){
		try{
			$regCompleted = FALSE;

			$nombre = ucwords($nombre); 
			$apellido = ucwords($apellido);
			$calle = ucwords($calle);

			if( ! $this->daoUsuario->verificarEmail( $email ) ) {
				$userInstance = new Usuario($nombre, $apellido, $email, $calle, $telefono, $pass, $this->daoRol->traerPorId( $id_rol ));
				$idUser = $this->daoUsuario->agregar( $userInstance );
				$userInstance->setId( $idUser );
				$regCompleted = TRUE;
				$this->mensaje = new Mensaje( "success", "El Usuario fue registrado con exito!" );
			}

			switch ($regCompleted) {
				case TRUE:
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "inicio.php");
				include URL_VISTA . 'footer.php';
				break;

				case FALSE:
				$this->mensaje = new Mensaje( "success", "El Usuario Ya existe con ese Email!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "registrarusuario.php");
				include URL_VISTA . 'footer.php';
				break;
			}

		}catch(\PDOException $pdo_error){
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'error.php');
			include URL_VISTA . 'footer.php';
		}catch(\Exception $error){
			echo $error->getMessage();
		}
	}

	public function registrarcliente($nombre, $apellido,$calle, $telefono){
		try{
			if(!empty($_SESSION)){
				$regCompleted = FALSE;

				$nombre = ucwords($nombre); 
				$apellido = ucwords($apellido);
				$calle = ucwords($calle);  

				$verificacion = 0;

				if( ! $this->daoCliente->verificarNombre($nombre)){
					if(  $this->daoCliente->verificarApellido($apellido))
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
					if(  $this->daoCliente->verificarNombre($nombre))
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


				if($verificacion === 0){
					$userInstance = new Cliente($nombre, $apellido, $calle, $telefono);
					$idClie = $this->daoCliente->agregar( $userInstance );
					$userInstance->setId( $idClie );
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", "El Cliente fue registrado con exito!" );
				}

				switch ($regCompleted){
					case TRUE:
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
					break;

					case FALSE:
					$this->mensaje = new Mensaje( "success", "El Cliente ya esta registrado con ese Nombre y Apellido!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "registrarcliente.php");
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

	public function registrarlente($id_cliente, $medico, $fecha, $armazon_lejos, $armazon_cerca, $lejos_od, $cerca_od, $lejos_oi, $cerca_oi, $cilindrico, $en_grados, $color, $distancia, $calibre, $puente){
		try{
			if(!empty($_SESSION)){
				$regCompleted = FALSE;
				$medico = ucwords($medico);
				$color = ucwords($color);
				if(!empty($id_cliente)){
					$lentInstance = new Lente($medico, $armazon_cerca, $armazon_lejos, $lejos_od, $lejos_oi, $cerca_od, $cerca_oi, $cilindrico, $en_grados, $distancia, $calibre, $puente, $color, $fecha);
					$idLent= $this->daoLente->agregar( $lentInstance );
					$lentInstance->setId( $idLent );
					$id_cliente = $this->daoCliente->traerPorId($id_cliente);
					$id_lente = $this->daoLente->traerPorId($idLent);
					$lentxclientInstance = new Lente_x_cliente($id_cliente, $id_lente);
					$idLentxclient = $this->daoLentexcliente->agregar( $lentxclientInstance );
					$lentxclientInstance->setIdLenteXCliente($idLentxclient);
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", "El Lente del Cliente fue registrado con exito!" );
				}

				switch ($regCompleted){
					case TRUE:
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
					break;

					case FALSE:
					$this->mensaje = new Mensaje( "success", "Hubo un error pruebe mas tarde cargar los datos!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "registrarlente.php");
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

	public function registrarfactura($id_lente, $id_cliente, $armasonl, $armazonc, $lejos_od, $lejos_oi, $cerca_od, $cerca_oi, $senia){
		try{
			$regCompleted = FALSE;

			if(!empty($_SESSION)){

				if(!empty($id_lente)){

					$sub_total = $armasonl + $armazonc + $lejos_od + $lejos_oi + $cerca_od + $cerca_oi;

					if(!empty($senia)){
						$saldo_total = $sub_total - $senia;
						if ($saldo_total < 0) {
							$saldo_total = 0;
						}
					}
					else{
						$saldo_total = $sub_total;
					}
					$factInstance = new Factura($armasonl, $armazonc, $lejos_od, $lejos_oi, $cerca_od, $cerca_oi, $sub_total, $senia, $saldo_total, $this->daoLente->traerPorId($id_lente));
					$idfact = $this->daoFactura->agregar( $factInstance );
					$factInstance->setId( $idfact );

					$fecha = date('Y-m-d');

					$a_cuenta = $senia; 
					$saldo = $saldo_total;
					$salInstance = new Cuenta_saldos($a_cuenta, $saldo, $fecha);
					$idsaldo = $this->daoCuentasaldos->agregar( $salInstance );
					$salInstance->setId( $idsaldo );

					$id_cliente = $this->daoCliente->traerPorId($id_cliente);

					$id_cuentasaldos = $this->daoCuentasaldos->traerPorId($idsaldo);

					$id_lente = $this->daoLente->traerPorId($id_lente);
					$clisald = new Senias_x_cliente_lente($id_cuentasaldos, $id_cliente, $id_lente);
					$idclsald = $this->daoSenia->agregar( $clisald );
					$clisald->setIdSeniaXCliente( $idclsald );
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", "El costo del lente fue registrado con exito!" );
				}
			}

			switch ($regCompleted) {
				case TRUE:
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "inicio.php");
				include URL_VISTA . 'footer.php';
				break;

				case FALSE:
				$this->mensaje = new Mensaje( "success", "error!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "registrarfactura.php");
				include URL_VISTA . 'footer.php';
				break;
			}

		}catch(\PDOException $pdo_error){
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'error.php');
			include URL_VISTA . 'footer.php';
		}catch(\Exception $error){
			echo $error->getMessage();
		}
	}	


}