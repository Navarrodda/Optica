<?php

namespace Controladoras;

//Modelo
use Modelo\Mensaje as Mensaje;
use Modelo\Rol as Rol;
use Modelo\Cliente as Cliente;
use Modelo\Usuario as Usuario;
use Modelo\Lente as Lente;
use Modelo\Lente_x_cliente as Lente_x_cliente;
use Modelo\Senias_x_cliente_lente as Senias_x_cliente_lente;
use Modelo\Cuenta_saldos as Cuenta_saldos;
use Modelo\Factura as Factura;

//Dao
use Dao\RolBdDao as RolBdDao;
use Dao\ClienteBdDao as ClienteBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\LenteBdDao as LenteBdDao;
use Dao\LentexclienteBdDao as LentexclienteBdDao;
use Dao\SeniasxclientelenteBdDao as SeniasxclientelenteBdDao;
use Dao\CuentasaldosBdDao as CuentasaldosBdDao;
use Dao\FacturaBdDao as FacturaBdDao;

class AdministrarControladora
{
	protected $daoRol;
	protected $daoCliente;
	protected $daoUsuario;
	protected $daoLente;
	protected $daoLentexcliente;
	protected $daoSeniasaldos;
	protected $daoCuentasaldos;
	protected $daoFactura;

	private $cliente;
	private $usuario;
	private $lente;
	private $lentexcliente;
	private $senia;



	public function __construct()
	{
		$this->daoRol = RolBdDao::getInstancia();
		$this->daoCliente = ClienteBdDao::getInstancia();
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoLente = LenteBdDao::getInstancia();
		$this->daoLentexcliente = LentexclienteBdDao::getInstancia();
		$this->daoSeniasaldos = SeniasxclientelenteBdDao::getInstancia();
		$this->daoCuentasaldos =CuentasaldosBdDao::getInstancia();
		$this->daoFactura =FacturaBdDao::getInstancia();
	}

	public function eliminarcliente($id_cliente){
		try{
			
			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				if(isset($id_cliente)){
					$cliente= $this->daoCliente->traerPorId($id_cliente);
					$nombreapellido = $cliente->getNombre() .' '. $cliente->getApellido();
					//$apellido = $cliente->getApellido();
					$senia = $this->daoSeniasaldos->traerPorIdCliente($id_cliente);
					$this->daoSeniasaldos->eliminarPorIdCliente($id_cliente);

					if(!empty($senia))
					{
						$long = count($senia);

						for ($contador = 0; $contador <= $long; $contador++) 
						{
							if(!empty($senia[$contador]))
							{
								$senias[$contador] = $senia[$contador]->getIdCuentaSaldo();
								$id_ceunta = $senias[$contador]->getId();
								$this->daoCuentasaldos->eliminarPorId($id_ceunta);
							}
						}
					}
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
								if(!empty($lente[$contador]))
								{
									$id_lente = $lente[$contador]->getId();
									$this->daoFactura->eliminarPorIdLente($id_lente);
								}
								$this->daoLente->eliminarPorId($id_lente);
							}
						}
					}
					$this->daoCliente->eliminarPorId($id_cliente);
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje('success', 'Ha borrado satisfactoriamente al cliente
						! El CLiente eliminado fue:' .' '.'<i><strong>' .  $nombreapellido
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

	public function modificarcliente($id_cliente, $nombre, $apellido, $telefono){
		try{

			if(!empty($_SESSION)){

				$nombre = ucwords($nombre); 
				$apellido = ucwords($apellido); 
				
				$cliente = $this->daoCliente->traerPorId($id_cliente);
				$nombreapellido = $cliente->getNombre() .' '. $cliente->getApellido();
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

				$clientInstance = new Cliente($nombre, $apellido, $telefono);
				$idClie = $this->daoCliente->actualizar( $clientInstance, $id_cliente );
				$regCompleted = TRUE;
				$this->mensaje = new Mensaje('success', '!El Cliente 
					' .' '.'<i><strong>' .  $nombreapellido
					. '</strong> fue Modificaco con exito!</i>');
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "inicio.php");
				include URL_VISTA . 'footer.php';
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

	public function registrarclientelente($nombre, $apellido, $telefono, $doctor, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $complit, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color, $subtotal, $senia){
		try{
			if(!empty($_SESSION)){
				$regCompleted = FALSE;

				$nombre = ucwords($nombre); 
				$apellido = ucwords($apellido);
				$doctor = ucwords($doctor);
				$lejos_color = ucwords($lejos_color);
				$cerca_color = ucwords($cerca_color);
				$observacion = ucwords($observacion);


				$nombreapellido = $nombre .' '. $apellido;
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
				$userInstance = new Cliente($nombre, $apellido, $telefono);
				$idClie = $this->daoCliente->actualizar( $userInstance );
				$userInstance->setId( $idClie );
				$lentInstance = new Lente($doctor, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color, $fecha);
				$idLent= $this->daoLente->actualizar( $lentInstance );
				$lentInstance->setId( $idLent );
				$id_cliente = $this->daoCliente->traerPorId($idClie);
				$id_lente = $this->daoLente->traerPorId($idLent);
				$lentxclientInstance = new Lente_x_cliente($id_cliente, $id_lente);
				$idLentxclient = $this->daoLentexcliente->actualizar( $lentxclientInstance );
				$lentxclientInstance->setIdLenteXCliente($idLentxclient);
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
					$idfact = $this->daoFactura->actualizar( $factInstance );
					$factInstance->setId( $idfact );



					$a_cuenta = $senia; 
					$saldo = $saldo_total;
					$salInstance = new Cuenta_saldos($a_cuenta, $saldo, $fecha);
					$idsaldo = $this->daoCuentasaldos->actualizar( $salInstance );
					$salInstance->setId( $idsaldo );

					$id_cliente = $this->daoCliente->traerPorId($idClie);

					$id_cuentasaldos = $this->daoCuentasaldos->traerPorId($idsaldo);

					$id_lente = $this->daoLente->traerPorId($idLent);
					$clisald = new Senias_x_cliente_lente($id_cuentasaldos, $id_cliente, $id_lente);
					$idclsald = $this->daoSenia->actualizar( $clisald );
					$clisald->setIdSeniaXCliente( $idclsald );

					$factura =$this->daoFactura->traerPorId($idfact);
					$cuenta_saldos = $this->daoCuentasaldos->traerPorId($idsaldo);

				}
				else
				{
					$factura = null;
					$cuenta_saldos = null;
				}
				$lente = $this->daoLente->traerPorId($idLent);
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

	public function modificarusuario($id_usuario, $nombre, $apellido, $calle, $telefono, $email, $pass){
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

	public	function modificarpreousuario($id_usuario, $preoridad){
		try{

			if(!empty($_SESSION)){

				if ($_SESSION['rol'] == 'Administrador') {
					if(!empty($preoridad)){

						$rol = $this->daoRol->traerPorIdPreoridad($preoridad);

						$id_rol = $rol->getId();
					}
					else
					{
						$id_rol = $usuario->getIdRol();
					}


					$regCompleted = FALSE;

					$usuario = $this->daoUsuario->traerPorId($id_usuario);

					$nombre = $usuario->getNombre();			
					$apellido =  $usuario->getApellido();
					$email =  $usuario->getEmail();
					$pass =  $usuario->getPassword();
					$calle =  $usuario->getCalle();
					$telefono =  $usuario->getTelefono();

					if(!empty($id_usuario)){
						$usuarioInstance = new Usuario($nombre, $apellido, $email, $calle, $telefono, $pass, $this->daoRol->traerPorId( $id_rol ));
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
						require(URL_VISTA . "modificarpreoridadusuario.php");
						include URL_VISTA . 'footer.php';
						break;
					}
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

	public	function eliminarusuario($id_usuario){
		try{

			if(!empty($_SESSION)){

				if ($_SESSION['rol'] == 'Administrador') {

					$regCompleted = FALSE;

					if(isset($id_usuario)){
						$usuario= $this->daoUsuario->traerPorId($id_usuario);
						$nombreapellido = $usuario->getNombre() .' '. $usuario->getApellido();
						$this->daoUsuario->eliminarPorId($id_usuario);
						$regCompleted = TRUE;
						$this->mensaje = new Mensaje('success', 'Ha borrado satisfactoriamente al Usuario
							! El Usuario eliminado fue:' .' '.'<i><strong>' .  $nombreapellido
							. '</strong></i>');
					}


					switch ($regCompleted){
						case TRUE:
						include URL_VISTA . 'header.php';
						require(URL_VISTA . "inicio.php");
						include URL_VISTA . 'footer.php';
						break;

						case FALSE:
						$this->mensaje = new Mensaje( "success", "Error" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . "usuarios.php");
						include URL_VISTA . 'footer.php';
						break;
					}
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

	public	function modificarlente($id_lente, $doctor, $fecha, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $complit, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color){
		try{
			if(!empty($_SESSION)){


				$lente = $this->daoLente->traerPorId($id_lente);

				if(empty($doctor))
				{
					$doctor = $lente->getDoctor();
				}
				else
				{
					$doctor = ucwords($doctor); 
				}
				if(empty($fecha))
				{
					$fecha = date('Y-m-d');
				}
				if(empty($observacion))
				{
					$observacion =  $lente->getObservacion();
				}
				else
				{
					$observacion = ucwords($observacion);
				}
				if(empty($armazon_lejos))
				{
					$armazon_lejos =  $lente->getArmazonLejos();
				}
				if(empty($armazon_cerca))
				{
					$armazon_cerca =  $lente->getArmazonCerca();
				}
				if(empty($lejos_od_esferico))
				{
					$lejos_od_esferico =  $lente->getLejosOdEsferico();
				}
				if(empty($lejos_od_cilindrico))
				{
					$lejos_od_cilindrico =  $lente->getLejosOdCilindrico();
				}
				if(empty($lejos_od_grados))
				{
					$lejos_od_grados =  $lente->getLejosOdGrados();
				}
				if(empty($lejos_oi_esferico))
				{
					$lejos_oi_esferico =  $lente->getLejosOiEsferico();
				}
				if(empty($lejos_oi_cilindrico))
				{
					$lejos_oi_cilindrico =  $lente->getLejosOiCilindrico();
				}
				if(empty($lejos_oi_grados))
				{
					$lejos_oi_grados =  $lente->getLejosOiGrados();
				}
				if(empty($lejos_color))
				{
					$lejos_color =  $lente->getLejosColor();
				}
				else
				{
					$lejos_color = ucwords($lejos_color);
				}
				if(empty($cerca_od_esferico))
				{
					$cerca_od_esferico =  $lente->getCercaOdEsferico();
				}
				if(empty($cerca_od_cilindrico))
				{
					$cerca_od_cilindrico =  $lente->getCercaOdCilindrico();
				}
				if(empty($cerca_od_grados))
				{
					$cerca_od_grados =  $lente->getCercaOdGrados();
				}
				if(empty($cerca_oi_esferico))
				{
					$cerca_oi_esferico =  $lente->getCercaOiEsferico();
				}
				if(empty($cerca_oi_cilindrico))
				{
					$cerca_oi_cilindrico =  $lente->getCercaOiCilindrico();
				}
				if(empty($cerca_oi_grados))
				{
					$cerca_oi_grados =  $lente->getCercaOiGrados();
				}
				if(empty($cerca_color))
				{
					$cerca_color =  $lente->getCercaColor();
				}
				else
				{
					$cerca_color = ucwords($cerca_color); 
				}

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

				if(!empty($id_lente)){
					$lenteInstance = new Lente($doctor, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color, $fecha);
					$idLent = $this->daoLente->actualizar( $lenteInstance, $id_lente );

					$this->mensaje = new Mensaje( "success", "El Lente fue Modificaco con exito!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
				}
				else
				{
					$this->mensaje = new Mensaje( "success", "Ocurrio un Problema" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "modificarlente.php");
					include URL_VISTA . 'footer.php';
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

	public	function eliminarlente($id_lente, $id_cliente){
		try{

			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				if(isset($id_lente)){
					$cliente= $this->daoCliente->traerPorId($id_cliente);
					$nombreapellido = $cliente->getNombre() .' '. $cliente->getApellido();
					$senia = $this->daoSeniasaldos->traerPorIdLente($id_lente);
					$this->daoSeniasaldos->eliminarPorIdLente($id_lente);
					$longitud = count($senia);
					if(!empty($senia))
					{
						for ($i=0; $i < $longitud ; $i++) { 
							$cuenta = $senia[$i]->getIdCuentaSaldo();
							if(!empty($cuenta))
							{
								$id_cuenta = $cuenta->getId();
								$this->daoCuentasaldos->eliminarPorId($id_cuenta);	
							}
						}
					}
					$this->daoFactura->eliminarPorIdLente($id_lente);
					$this->daoLentexcliente->eliminarPorIdLente($id_lente);
					$this->daoLente->eliminarPorId($id_lente);
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje('success', 'Ha borrado satisfactoriamente el lente del cliente
						! El Cliente es:' .' '.'<i><strong>' .  $nombreapellido
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

	public	function modificarfactura($id_lente, $id_factura, $armasonl, $armazonc, $lejos_od, $lejos_oi, $cerca_od, $cerca_oi, $senia, $fecha){
		try{

			if(!empty($_SESSION)){
				if(!empty($id_factura)){

					$regCompleted = FALSE;

					$factura = $this->daoFactura->traerPorId($id_factura);
					$cuenta = $this->daoSeniasaldos->traerPorIdLente($id_lente);

					$longitud = count($cuenta);
					if(!empty($cuenta))
					{
						for ($i=0; $i <= $longitud ; $i++)
						{ 
							if (!empty($cuenta[$i])) {

								$cuentasaldos[$i] = $cuenta[$i]->getIdCuentaSaldo();
							}
						}
					}

					if(empty($armasonl))
					{
						$armasonl = $factura->getSaldoArmazoL();
					}
					if(empty($armazonc))
					{
						$armazonc =  $factura->getSaldoArmazonC();
					}
					if(empty($lejos_od))
					{
						$lejos_od =  $factura->getSaldoLejosoD();
					}
					if(empty($lejos_oi))
					{
						$lejos_oi =  $factura->getSaldoLejosoI();
					}
					if(empty($cerca_od))
					{
						$cerca_od =  $factura->getSaldoCercaOd();
					}
					if(empty($cerca_oi))
					{
						$cerca_oi =  $factura->getSaldoCercaOi();
					}
					if(empty($senia))
					{
						$senia =  $factura->getSenia();
					}
					if(empty($fecha))
					{
						$fecha = date('Y-m-d');
					}

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
					$idfact = $this->daoFactura->actualizar( $factInstance, $id_factura );

					$a_cuenta = $senia; 
					$saldo = $saldo_total;
					$salInstance = new Cuenta_saldos($a_cuenta, $saldo, $fecha);
					$idsaldo = $this->daoCuentasaldos->actualizar( $salInstance, $cuentasaldos[0]->getId());
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", "El costo del lente fue modificado con exito!" );
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

	public	function eliminarfactura($id_lente, $id_factura, $id_cliente){
		try{

			if(!empty($_SESSION)){

				$regCompleted = FALSE;
				if(isset($id_factura)){
					$cliente= $this->daoCliente->traerPorId($id_cliente);
					$nombreapellido = $cliente->getNombre() .' '. $cliente->getApellido();
					$senia = $this->daoSeniasaldos->traerPorIdLente($id_lente);
					$this->daoSeniasaldos->eliminarPorIdLente($id_lente);
					$longitud = count($senia);
					if(!empty($senia))
					{
						for ($i=0; $i < $longitud ; $i++) { 
							$cuenta = $senia[$i]->getIdCuentaSaldo();
							if(!empty($cuenta))
							{
								$id_cuenta = $cuenta->getId();
								$this->daoCuentasaldos->eliminarPorId($id_cuenta);	
							}
						}
					}
					$this->daoFactura->eliminarPorIdLente($id_lente);
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje('success', 'Ha borrado satisfactoriamente la Factura del cliente
						! El Cliente es:' .' '.'<i><strong>' .  $nombreapellido
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