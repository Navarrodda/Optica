<?php

namespace Controladoras;

use Modelo\Rol as Rol;
use Modelo\Usuario as Usuario;
use Modelo\Cliente as Cliente;
use Modelo\Mensaje as Mensaje;
use Modelo\LimpiarEntrada as Limpiar; 
use Dao\RolBdDao as RolBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\ClienteBdDao as ClienteBdDao;

class RegistrarControladora
{
	protected $daoRol;
	protected $daoUsuario;
	protected $daoCliente;

	public function __construct() {
		$this->daoRol = RolBdDao::getInstancia();
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoCliente = ClienteBdDao::getInstancia();
	}

	public function registrarse($nombre, $apellido, $calle, $telefono, $email, $pass, $id_rol){
		try{
			$regCompleted = FALSE;

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

	public function registrarcliente($nombre, $apellido, $telefono){
		try{
			$regCompleted = FALSE;

			if( ! $this->daoCliente->verificarNombre($nombre) ){
				if( ! $this->daoCliente->verificarApellido($apellido) ){
					$userInstance = new Cliente($nombre, $apellido, $telefono);
					$idClie = $this->daoCliente->agregar( $userInstance );
					$userInstance->setId( $idClie );
					$regCompleted = TRUE;
					$this->mensaje = new Mensaje( "success", "El Cliente fue registrado con exito!" );
				}
			}

			switch ($regCompleted){
				case TRUE:
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "inicio.php");
				include URL_VISTA . 'footer.php';
				break;

				case FALSE:
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "registrarusuario.php");
				include URL_VISTA . 'footer.php';
				break;
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