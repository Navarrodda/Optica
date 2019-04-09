<?php

namespace Controladoras;

use Modelo\LimpiarEntrada;
use Modelo\Mensaje;
use Modelo\Rol as Rol;
use Modelo\Usuario as Usuario;;
use Dao\UsuarioBdDao as UsuarioBdDao;


class SesionControladora
{

	private $mensaje;
	private $limpiar;
	protected $daoUsuario;

	public function __construct()
	{
		$this->limpiar= new LimpiarEntrada();
		$this->daoUsuario = UsuarioBdDao::getInstancia();
	}

	public function logueando($mail, $pass)
	{
		$ir_a_inicio = FALSE;

		try {
			$this->limpiar->cleanInput($mail);

			$this->limpiar->cleanInput($pass);



			if (isset($mail) && isset($pass))  {
				if ($mail === "" || $pass === "") {
					$this->mensaje = new Mensaje('warning', 'Debe llenar todos los campos !');
				} else {
					/** @var Cuenta $usuario */
					$usuario = $this->daoUsuario->traerPorMail($mail);

					if ($mail === $usuario->getEmail() && $pass === $usuario->getPassword()) {
						$rol = $usuario->getIdRol();
                        //Seteo las variables de sesión.
						$_SESSION["mail"] = $mail;
						$_SESSION["nombre"] =$usuario->getNombre();
						$_SESSION["pass"] = $pass;
						$_SESSION["rol"] = $rol->getPrioridad();
                        //Mensaje de success
						$this->mensaje = new Mensaje('success', 'Ha iniciado sesión satisfactoriamente 
							! Se ha logueado como' . ' ' . '<i><strong>' . $usuario->getNombre()
							. '</strong></i>');
						$ir_a_inicio = TRUE;
					} else {
						$this->mensaje = new Mensaje('warning', 'Los datos introducidos son incorrectos !');
					}
				}
			} else {
				throw new \Exception('Error al iniciar sesión, intentelo más tarde !');
			}
		} catch (\PDOException $e) {
			$this->mensaje = new Mensaje('danger', 'Hubo un error al conectarse con la base de datos ! ' . $e);
		} catch (\Exception $exception) {
			$this->mensaje = new Mensaje('danger', $exception->getMessage());
		}

		if($ir_a_inicio){
			require(URL_VISTA . 'inicio.php');
		}else{
			require(URL_VISTA . 'iniciarSesion.php');
		}

	}
	public function terminar()
	{
        // Elimio las variables de sesión y sus valores.
		$_SESSION = array();
        // Eliminamos la cookie del usuario que identifcaba a esa sesión, verifcando "si existía".
		if (ini_get("session.use_cookies") == true) {
			$parametros = session_get_cookie_params();
			setcookie(
				session_name(),
				'',
				time() - 99999,
				$parametros["path"],
				$parametros["domain"],
				$parametros["secure"],
				$parametros["httponly"]
			);
		}
		session_destroy();

		$this->mensaje = new Mensaje('info', 'Ha cerrado sesión !');
		require("../Vistas/inicio.php");
	}

}