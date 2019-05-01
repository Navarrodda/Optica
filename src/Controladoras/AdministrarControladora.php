<?php

namespace Controladoras;

//Modelo
use Modelo\Mensaje;
use Modelo\Rol as Rol;
use Modelo\Cliente as Cliente;

//Dao
use Dao\RolBdDao as RolBdDao;
use Dao\ClienteBdDao as ClienteBdDao;

class AdministrarControladora
{



	public function __construct()
	{
		$this->daoCliente = ClienteBdDao::getInstancia();
	}

	function eliminarcliente($id_cliente){


	}	

}