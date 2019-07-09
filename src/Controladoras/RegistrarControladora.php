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

	public function ucwordsValores($variable, $regCompleted){
		if (!empty($variable)) 
		{
			$regCompleted = TRUE;
			$variable = ucwords($variable);
		}
	}

	public function validarVacio($variable, $regCompleted){
		if (!empty($variable)) {
			$regCompleted = TRUE;
		}
	}

	public function validarColores($lente1, $lende2, $regCompleted){
		
		if (!empty($lente1)) {
			$regCompleted = TRUE;
			$lente1 = ucwords($lente1);
			$lende2 = $lente1;
		}
	}

	public function registrarclientelente($nombre, $apellido, $telefono, $doctor, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $complit, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color, $subtotal, $senia){
		try{
			if(!empty($_SESSION)){

				$regCompleted = FALSE;

				$nombre = ucwords($nombre); 
				$apellido = ucwords($apellido);

				$nombreapellido = $nombre .' '. $apellido;

				$fecha = date('Y-m-d');
				$userInstance = new Cliente($nombre, $apellido, $telefono);
				$idClie = $this->daoCliente->agregar( $userInstance );
				$userInstance->setId( $idClie );

				if($complit=='SI')
				{
					$cerca_od_cilindrico = $lejos_od_cilindrico;
					$cerca_od_grados = $lejos_od_grados;
					$cerca_oi_cilindrico =	$lejos_oi_cilindrico;
					$cerca_oi_grados =	$lejos_oi_grados;
				}
				ucwordsValores($observacion);
				validarVacio($armazon_lejos);
				validarVacio($armazon_cerca);
				validarVacio($lejos_od_esferico);
				validarVacio($lejos_od_cilindrico);
				validarVacio($lejos_od_grados);
				validarVacio($armazonlejos_oi_esferico_lejos);
				validarVacio($lejos_oi_cilindrico);
				validarVacio($lejos_oi_grados);
				validarColores($lejos_color, $cerca_color, $regCompleted);
				validarColores($cerca_color, $lejos_color, $regCompleted);
				validarVacio($cerca_od_esferico);
				validarVacio($cerca_od_cilindrico);
				validarVacio($cerca_od_grados);
				validarVacio($cerca_oi_esferico);
				validarVacio($cerca_oi_cilindrico);
				validarVacio($cerca_oi_grados);

				if($regCompleted == TRUE)
				{
					$lentInstance = new Lente($doctor, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color, $fecha);
					$idLent= $this->daoLente->agregar( $lentInstance );
					$lentInstance->setId( $idLent );
					$id_cliente = $this->daoCliente->traerPorId($idClie);
					$id_lente = $this->daoLente->traerPorId($idLent);
					$lentxclientInstance = new Lente_x_cliente($id_cliente, $id_lente);
					$idLentxclient = $this->daoLentexcliente->agregar( $lentxclientInstance );
					$lentxclientInstance->setIdLenteXCliente($idLentxclient);
					$lente = $this->daoLente->traerPorId($idLent);
				}
				else
				{
					$lente = null;
				}
				if(!empty($subtotal)){
					if(!empty($senia)){
						$saldo_total = $subtotal - $senia;
						if ($saldo_total < 0) {
							$saldo_total = 0;
						}
					}
					else{
						$saldo_total = $subtotal;
					}
					$sub_total = $subtotal;
					$factInstance = new Factura($sub_total, $senia, $saldo_total, $this->daoLente->traerPorId($idLent));
					$idfact = $this->daoFactura->agregar( $factInstance );
					$factInstance->setId( $idfact );

					$a_cuenta = $senia; 
					$saldo = $saldo_total;
					$salInstance = new Cuenta_saldos($a_cuenta, $saldo, $fecha);
					$idsaldo = $this->daoCuentasaldos->agregar( $salInstance );
					$salInstance->setId( $idsaldo );

					$id_cliente = $this->daoCliente->traerPorId($idClie);

					$id_cuentasaldos = $this->daoCuentasaldos->traerPorId($idsaldo);

					$id_lente = $this->daoLente->traerPorId($idLent);
					$clisald = new Senias_x_cliente_lente($id_cuentasaldos, $id_cliente, $id_lente);
					$idclsald = $this->daoSenia->agregar( $clisald );
					$clisald->setIdSeniaXCliente( $idclsald );

					$factura =$this->daoFactura->traerPorId($idfact);
					$cuenta_saldos = $this->daoCuentasaldos->traerPorId($idsaldo);

				}
				else
				{
					$factura = null;
					$cuenta_saldos = null;
				}
				
				$cliente = $this->daoCliente->traerPorId($idClie);
				
				$this->mensaje = new Mensaje( "success", 'El Cliente:' .' '.'<i><strong>' .  $nombreapellido
					. '</strong></i> fue registrado con exito!' );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "pdf.php");
				include URL_VISTA . 'footer.php';
				
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

	public function registrarlente($id_cliente, $doctor, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $complit, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color){
		try{
			if(!empty($_SESSION)){
				$doctor = ucwords($doctor);
				$lejos_color = ucwords($lejos_color);
				$cerca_color = ucwords($cerca_color);
				$observacion = ucwords($observacion);


				if($complit=='SI')
				{
					$cerca_od_cilindrico = $lejos_od_cilindrico;
					$cerca_od_grados = $lejos_od_grados;
					$cerca_oi_cilindrico =	$lejos_oi_cilindrico;
					$cerca_oi_grados =	$lejos_oi_grados;
				}
				if(empty($cerca_color))
				{
					$cerca_color = $lejos_color;
				}
				$fecha = date('Y-m-d');
				if(!empty($id_cliente)){
					$cliente = $this->daoCliente->traerPorId($id_cliente);
					$nombreapellido = $cliente->getNombre(). ' ' . $cliente->getApellido();
					$lentInstance = new Lente($doctor, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color, $fecha);
					$idLent= $this->daoLente->agregar( $lentInstance );
					$lentInstance->setId( $idLent );
					$id_lente = $this->daoLente->traerPorId($idLent);
					$id_cliente = $this->daoCliente->traerPorId($id_cliente);
					$lentxclientInstance = new Lente_x_cliente($id_cliente, $id_lente);
					$idLentxclient = $this->daoLentexcliente->agregar( $lentxclientInstance );
					$lentxclientInstance->setIdLenteXCliente($idLentxclient);
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", 'El Lente del Cliente: ' .' '.'<i><strong>' .  $nombreapellido
						. '</strong></i> fue registrado con exito!' );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
				}
				else
				{
					$this->mensaje = new Mensaje( "success", "Hubo un error pruebe mas tarde cargar los datos!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "registrarlente.php");
					include URL_VISTA . 'footer.php';
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

	public function registrarfactura($id_lente, $id_cliente, $sub_total, $senia){
		try{
			$regCompleted = FALSE;

			if(!empty($_SESSION)){
				$cliente = $this->daoCliente->traerPorId($id_cliente);
				$nombreapellido = $cliente->getNombre(). ' ' . $cliente->getApellido();

				if(!empty($id_lente)){

					if(!empty($senia)){
						$saldo_total = $sub_total - $senia;
						if ($saldo_total < 0) {
							$saldo_total = 0;
						}
					}
					else{
						$saldo_total = $sub_total;
					}

					$regla = $this->daoFactura->traerPorIdLente($id_lente);
					if ($regla == null) {
						$factInstance = new Factura($sub_total, $senia, $saldo_total, $this->daoLente->traerPorId($id_lente));
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

						$lente = $this->daoLente->traerPorId($id_lente);
						$clisald = new Senias_x_cliente_lente($id_cuentasaldos, $id_cliente, $lente);
						$idclsald = $this->daoSenia->agregar( $clisald );
						$clisald->setIdSeniaXCliente( $idclsald );
						$this->mensaje = new Mensaje( "success", 'El costo del lente con ID: ' .' '.'<i><strong>' .  $id_lente 
							. '</strong></i>.  fue registrado con exito! 
							Pertenece al Cliente: ' .' '.'<i><strong>' .  $nombreapellido
							. '</strong></i>  ' );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . "inicio.php");
						include URL_VISTA . 'footer.php';
					}
					else
					{
						$this->mensaje = new Mensaje( "success", 'El costo del lente con ID: ' .' '.'<i><strong>' .  $id_lente 
							. '</strong></i>. Ya esta registrado! 
							Pertenece al Cliente: ' .' '.'<i><strong>' .  $nombreapellido
							. '</strong></i>  ' );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . "inicio.php");
						include URL_VISTA . 'footer.php';
					}
				}
			}
			else
			{

				$this->mensaje = new Mensaje( "success", "Debe iniciar Sesion!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "registrarfactura.php");
				include URL_VISTA . 'footer.php';
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