<?php

namespace Controladoras;


class InicioControladora
{
	protected $MarcaDao;
	protected $UsuarioDao;
	protected $VehiculoDao;
	

	public function __construct()
	{
        
	}


	public function index()
	{
		require(URL_VISTA . "inicio.php");
	}

 public function logueando($mail, $pwd)
 {
    $ir_a_inicio = FALSE;

    try {
        $this->limpiar->cleanInput($mail);

        $this->limpiar->cleanInput($pwd);



        if (isset($mail) && isset($pwd))  {
            if ($mail === "" || $pwd === "") {
                $this->mensaje = new Mensaje('warning', 'Debe llenar todos los campos !');
            } else {
                $daoC = $this->daoCuenta;
                /** @var Cuenta $cuenta */
                $cuenta = $daoC->traerPorMail($mail);

                if ($mail === $cuenta->getEmail() && $pwd === $cuenta->getPass()) {
                    $rol = $cuenta->getRol();
                        //Seteo las variables de sesión.
                    $_SESSION["mail"] = $mail;
                    $_SESSION["pass"] = $pwd;
                    $_SESSION["nickname"] = $cuenta->getNickname();
                    $_SESSION["rol"] = $rol->getPrioridad();
                        //Mensaje de success
                    $this->mensaje = new Mensaje('success', 'Ha iniciado sesión satisfactoriamente 
                        ! Se ha logueado como' . ' ' . '<i><strong>' . $cuenta->getNickname() . '</strong></i>');
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

public function iniciar()
{
    require(URL_VISTA . "iniciarSesion.php");
}

public function registrar()
{
  require(URL_VISTA . "registrarcliente.php");
}

public function clientes()
{
  require(URL_VISTA . "cliente.php");
}

public function registrlente()
{
    require(URL_VISTA . "registrarlente.php");
}
public function facturasimple()
{
    require(URL_VISTA . "simple.php");
}

public function facturasimple1()
{
    require(URL_VISTA . "simple1.php");
    require("../conexion.php");

if(isset($_POST['guardar'])){

$titulo = $_POST['titulo'];
$encabezado = $_POST['encabezado'];
$area = $_POST['area'];
$dirige = $_POST['dirigido'].'<br>';

$p = $_POST['numero'];

for ($i=1; $i <=$p; $i++) {

        $pregunta = $_POST["pregunta$i"];

         echo $pregunta.'<br>';



        }
        echo "<br>";    
}
}

public function registrarvehiculo()
{

  $marca = $this->MarcaDao->traerTodo();
  require(URL_VISTA . 'registrarvehiculo.php');

}

public function registratpatente()
{
  $usuario = $this->UsuarioDao->traerTodo();
  $vehiculo = $this->VehiculoDao->traerTodo();
  require(URL_VISTA . 'registrarpatente.php');
}


}