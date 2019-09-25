<?php

namespace controllers;

//Modelo
//Dao

class ViewController
{

	public function __construct()
	{
	}

	public function index()
	{
		$vista = 'MOVIES';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "home.php");
		include URL_VISTA . 'footer.php';
	} 

	public function register()
	{

		$vista = 'REGISTER';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrer.php");
		include URL_VISTA . 'footer.php';
	}     
}