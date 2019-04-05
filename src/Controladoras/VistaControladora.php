<?php

namespace Controladoras;
//Modelo
use \Modelo\Mensaje;
use\Modelo\Rol;
//Dao
use \Dao\RolBdDao;

class VistaControladora
{

	protected $daoRol;

	public function __construct()
	{

		$this->daoRol = \Dao\RolBdDao::getInstancia();
	}

	public function index()
	{
		require(URL_VISTA . "inicio.php");
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

	public function registrarusuario()
	{

		$roles = $this->daoRol->traerTodo();
		require(URL_VISTA . "registrarusuario.php");
	}

}