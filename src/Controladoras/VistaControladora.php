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
//use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\ClienteBdDao as ClienteBdDao;
use Dao\LenteBdDao as LenteBdDao;
use Dao\LentexclienteBdDao as LentexclienteBdDao;

class VistaControladora
{
	protected $daoRol;
	protected $daoCliente;
	protected $daoLentexcliente;
	
	private $mensaje;
	private $cliente;
	private $lentexcliente;
	private $lente;

	public function __construct()
	{

		$this->daoRol = RolBdDao::getInstancia();
		$this->daoCliente = ClienteBdDao::getInstancia();
		$this->daoLente = LenteBdDao::getInstancia();
		$this->daoLentexcliente = LentexclienteBdDao::getInstancia();
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
}