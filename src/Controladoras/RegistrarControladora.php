<?php

namespace Controladoras;
    // Modelos

use \Modelo\Rol;
use \Modelo\Usuario;
use \Modelo\Mensaje;

	// Daos
use \Dao\RolBdDao;
use \Dao\UsuarioBdDao as UsuarioBdDao;

class RegistrarControladora
{

	protected $daoUsuario;
	protected $daoRol;

	public function __construct(){

		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoRol = \Dao\RolBdDao::getInstancia();

	}


	public function registrarse($id_rol, $nombre, $apellido, $calle, $telefono, $email, $pass)
	{

		try{

			$reg_completado = FALSE;
			print_r($daoUsuario);
	
			if(!$daoUsuario->verificarEmail($email))	
			{
				

				$usuario = new Usuario($daoRol->traerPorId($id_rol), $nombre, $apellido, $calle, $telefono,$email,$pass);
				print_r($usuario);
				$id_usuario = $daoUsuario->agregar($usuario);
				$usuario->setId($id_usuario);
				$reg_completado = TRUE;

				$this->mensaje = new Mensaje("success", "El Usuario fue registrado con exito!");

			}

			switch ($reg_completado) {
				case TRUE:
				require(URL_VISTA . 'inicio.php');
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