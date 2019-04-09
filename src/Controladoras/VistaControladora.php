<?php

namespace Controladoras;
//Modelo

use Modelo\Mensaje as Mensaje;
use Modelo\Rol as Rol;

//Dao

use Dao\RolBdDao as RolBdDao;

class VistaControladora
{

	protected $daoRol;

	public function __construct()
	{

		$this->daoRol = RolBdDao::getInstancia();
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