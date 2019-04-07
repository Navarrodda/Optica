<?php

namespace Controladoras;

use Modelo\Rol as Rol;
use Modelo\Usuario as Usuario;
use Modelo\Mensaje as Mensaje;
use Modelo\LimpiarEntrada as Limpiar; 
use Dao\RolBdDao as RolBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;

class RegistrarControladora
{
	protected $daoUsuario;
	protected $daoRol;

	public function __construct() {
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoRol = RolBdDao::getInstancia();
	}

	public function registrarse($nombre, $apellido, $calle, $telefono, $email, $pass, $id_rol) {
		try{
			$regCompleted = FALSE;
	
			if( ! $this->daoUsuario->verificarEmail( $email ) ) {
				print_r($id_rol);
				$userInstance = new Usuario($nombre, $apellido, $email, $calle, $telefono, $pass, $this->daoRol->traerPorId( $id_rol ));
				$idUser = $this->daoUsuario->agregar( $userInstance );
				$userInstance->setId( $idUser );
				$regCompleted = TRUE;
				$this->mensaje = new Mensaje( "success", "El Usuario fue registrado con exito!" );
			}

			switch ($regCompleted) {
				case TRUE:
				require(URL_VISTA . "inicio.php");
				break;

				case FALSE:
				require(URL_VISTA . "registrarusuario.php");
				break;
			}

		}catch(\PDOException $pdo_error){
			require(URL_VISTA . "registrarse.php");
		}catch(\Exception $error){
			echo $error->getMessage();
		}
	}
}