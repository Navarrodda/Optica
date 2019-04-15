<?php

namespace Controladoras;
//Modelo

use Modelo\Mensaje;
use Modelo\Rol as Rol;
use Modelo\Cliente as Cliente;

//Dao

use Dao\RolBdDao as RolBdDao;
use Dao\ClienteBdDao as ClienteBdDao;

class VistaControladora
{
	protected $daoRol;
	protected $daoCliente;
	
	private $mensaje;
	private $cliente;

	public function __construct()
	{

		$this->daoRol = RolBdDao::getInstancia();
		$this->daoCliente = ClienteBdDao::getInstancia();
	}

	public function index()
	{
		
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
		$cliente = $this->daoCliente->traerTodo();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "cliente.php");
		include URL_VISTA . 'footer.php';
	}

	public function registrlente()
	{
		$cliente = $this->daoCliente->traerTodo();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrarlente.php");
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
		$roles = $this->daoRol->traerTodo();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrarusuario.php");
		include URL_VISTA . 'footer.php';
	}

		public function modificarusuario()
	{
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modificarusuario.php");
		include URL_VISTA . 'footer.php';
	}

}