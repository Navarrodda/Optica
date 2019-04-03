<?php

namespace Controladoras;

//use Dao\RolBdDao; ejemplo


class VistaControladora
{



	public function __construct()
	{

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

}