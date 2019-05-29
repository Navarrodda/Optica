<?php

namespace Controladoras;

//Modelo
use Modelo\Mensaje;
use Modelo\Rol as Rol;
use Modelo\Usuario as Usuario;
use Modelo\Cliente as Cliente;
use Modelo\Lente as Lente;
use Modelo\Lente_x_cliente as Lentexcliente;

//Dao
use Dao\RolBdDao as RolBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\ClienteBdDao as ClienteBdDao;
use Dao\LenteBdDao as LenteBdDao;
use Dao\LentexclienteBdDao as LentexclienteBdDao;

class VistaControladora
{
	protected $daoRol;
	protected $daoCliente;
	protected $daoUsuario;
	protected $daoLentexcliente;
	
	private $mensaje;
	private $cliente;
	private $usuario;
	private $lentexcliente;
	private $lente;

	public function __construct()
	{

		$this->daoRol = RolBdDao::getInstancia();
		$this->daoCliente = ClienteBdDao::getInstancia();
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoLente = LenteBdDao::getInstancia();
		$this->daoLentexcliente = LentexclienteBdDao::getInstancia();
	}

	public function index()
	{
		$cliente = $this->daoCliente->traerTodo();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "inicio.php");
		include URL_VISTA . 'footer.php';
	}   

	public function iniciar()
	{
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "iniciarSesion.php");
		include URL_VISTA . 'footer.php';
	}

	public function registrar()
	{
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrarcliente.php");
		include URL_VISTA . 'footer.php';
	}

	public function clientes()
	{
		$limit = 0;
		$entrada = 1; 
		$cliente = $this->daoCliente->traerTodoLimit($limit);
		$medir = $this->daoCliente->traerTodo();
		$longitud = count($medir);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "cliente.php");
		include URL_VISTA . 'footer.php';
	}

	public function clienteslimit($limit, $longitud, $entrada)
	{
		$entrada = $entrada + 1;
		$longitud = $longitud - 9;
		if (!empty($limit)) {
			$cliente = $this->daoCliente->traerTodoLimit($limit);
		}
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "cliente.php");
		include URL_VISTA . 'footer.php';
	}

	public function registrlente($id_cliente)
	{
		$cliente = $this->daoCliente->traerPorId($id_cliente);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrarlente.php");
		include URL_VISTA . 'footer.php';
	}

	public function modificarcliente($id_cliente)
	{
		$cliente = $this->daoCliente->traerPorId($id_cliente);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modificarcliente.php");
		include URL_VISTA . 'footer.php';
	}
	
	public function facturasimple()
	{
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "simple.php");
		include URL_VISTA . 'footer.php'; 
	}

	public function registrarusuario()
	{
		$role = $this->daoRol->traerPorId(1);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrarusuario.php");
		include URL_VISTA . 'footer.php';
	}

	public function usuario()
	{
		$id = $_SESSION["id"];
		$usuario = $this->daoUsuario->traerPorId($id);
		print_r($usuario->getNombre());
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "usuario.php");
		include URL_VISTA . 'footer.php';
	}

	public function modificarusuario()
	{
		$id = $_SESSION["id"];
		$usuario = $this->daoUsuario->traerPorId($id);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modificarusuario.php");
		include URL_VISTA . 'footer.php';
	}

	public function pdf()
	{
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "llamarpdf.php");
		include URL_VISTA . 'footer.php';
	}

	public function lentecliente($id_cliente)
	{
		$lente = NULL;
		$cliente = $this->daoCliente->traerPorId($id_cliente);
		if(!empty($id_cliente)){
			{
				$lentexcliente = $this->daoLentexcliente->traerPorIdCliente($id_cliente);

				if(!empty($lentexcliente))
				{
					$longitud = count($lentexcliente);
					
					for ($contador = 0; $contador <= $longitud; $contador++) 
					{
						if(!empty($lentexcliente[$contador]))
						{
							$lente[$contador] = $lentexcliente[$contador]->getIdLente();
						}
					}
				}
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "lentexcliente.php");
				include URL_VISTA . 'footer.php';
			}
		}
	}
	public function modificarlente($id_cliente, $id_lente)
	{
		$cliente = $this->daoCliente->traerPorId($id_cliente);
		$lente = $this->daoLente->traerPorId($id_lente);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modificarlente.php");
		include URL_VISTA . 'footer.php';
	}

}