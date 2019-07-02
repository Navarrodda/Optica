<?php

namespace Controladoras;

//Modelo
use Modelo\Mensaje as Mensaje;
use Modelo\Rol as Rol;
use Modelo\Usuario as Usuario;
use Modelo\Cliente as Cliente;
use Modelo\Lente as Lente;
use Modelo\Factura as Factura;
use Modelo\Cuenta_saldos as Cuenta_saldos;
use Modelo\Lente_x_cliente as Lente_x_cliente;
use Modelo\Senias_x_cliente_lente as Senias_x_cliente_lente;

//Dao
use Dao\RolBdDao as RolBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\ClienteBdDao as ClienteBdDao;
use Dao\LenteBdDao as LenteBdDao;
use Dao\LentexclienteBdDao as LentexclienteBdDao;
use Dao\FacturaBdDao as FacturaBdDao;
use Dao\CuentsaldosBdDao as CuentsaldosBdDao;
use Dao\SeniasxclientelenteBdDao as SeniasxclientelenteBdDao;

class VistaControladora
{
	protected $daoRol;
	protected $daoCliente;
	protected $daoUsuario;
	protected $daoLentexcliente;
	protected $daoFactura;
	protected $daoSenia;
	
	private $mensaje;
	private $cliente;
	private $usuario;
	private $lentexcliente;
	private $lente;
	private $factura;
	private $senia;

	public function __construct()
	{

		$this->daoRol = RolBdDao::getInstancia();
		$this->daoCliente = ClienteBdDao::getInstancia();
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoLente = LenteBdDao::getInstancia();
		$this->daoLentexcliente = LentexclienteBdDao::getInstancia();
		$this->daoFactura = FacturaBdDao::getInstancia();
		$this->daoSenia = SeniasxclientelenteBdDao::getInstancia();
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

	public function cuentasaldos($id_cliente)
	{
		$monto = 0;
		if(!empty($id_cliente))
		{
			$cliente = $this->daoCliente->traerPorId($id_cliente);
			$saldocuenta =$this->daoSenia->traerPorIdCliente($id_cliente);
			$longitud = count($saldocuenta);
			if(!empty($saldocuenta))
			{
				for ($i=0; $i <= $longitud ; $i++)
				{ 
					if (!empty($saldocuenta[$i])) {
						$cuentasaldos[$i] = $saldocuenta[$i]->getIdCuentaSaldo();
						$monto = $monto + $cuentasaldos[$i]->getSaldo();
					}
				}
			}
		}
		$fecha = date('d-m-Y');

		include URL_VISTA . 'header.php';
		require(URL_VISTA . "cuentasaldos.php");
		include URL_VISTA . 'footer.php';
	}

	public function clientes()
	{
		$limit = 0;
		$entrada = 1; 
		$pantalla = 1;
		$calcular = $this->daoCliente->traerTodo();
		$calcular = count($calcular);
		$cliente = $this->daoCliente->traerTodoLimit($limit);
		$medir = $this->daoCliente->traerTodo();
		$longitud = count($medir);
		$contador = count($cliente);
		$i = 0;
		foreach ($cliente as $clie) {

			$senia = $this->daoSenia->traerPorIdCliente($clie->getId());

			if (!empty($senia)) {

				if (!empty($senia[0])) 
				{
					$senias = $senia[0]->getIdCuentaSaldo();
					$cl = $senia[0]->getIdCliente();

					if ($clie->getId() == $cl->getId()){

						$cliente[$i]->codigo = $senias->getId();
					}	
				}
				$senia = NULL;
			}
			$i++;
		}
		$longitud = $longitud + 10;
		$longitud = $longitud / 10;
	
		$longitud = round($longitud,PHP_ROUND_HALF_DOWN);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "cliente.php");
		include URL_VISTA . 'footer.php';
	}

	public function clienteslimit($limit, $longitud, $entrada, $pantalla)
	{	

		$calcular = $this->daoCliente->traerTodo();
		$calcular = count($calcular);

		if (!empty($limit)) {
			if ($limit == -1) {
				$entrada = $entrada + 1;
				if ($entrada >= $longitud) {
					$limit = $limit - 2;
					$entrada = $entrada -1;
				}

			}

			if ($limit == -2) {
				$entrada = $entrada - $pantalla;
				if ($entrada <= 1){
					$entrada = 1;
					$pantalla = 1;
					$limit = 1;
				}
			}


			if($limit == 1){
				$limit = 0;
			}
			else
			{

				$limit = 9 * $entrada;
				$limit = $limit - 8;
			}
			$cliente = $this->daoCliente->traerTodoLimit($limit);
			$contador =count($cliente);
			$pantalla = 1; 
		}
		$i = 0;

		foreach ($cliente as $clie) {

			$senia = $this->daoSenia->traerPorIdCliente($clie->getId());
			$cliente[$i]->codigo = NULL;
			if (!empty($senia)) {

				if (!empty($senia[0])) 
				{
					$senias = $senia[0]->getIdCuentaSaldo();
					$cl = $senia[0]->getIdCliente();

					if ($clie->getId() == $cl->getId()){

						$cliente[$i]->codigo = $senias->getId();
					}	
				}
				$senia = NULL;
			}
			$i++;
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

	public function serch($valor, $dato)
	{
		print_r($valor);
		print_r($dato);
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
		$role = $this->daoRol->traerPorIdPreoridad('Cliente');
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrarusuario.php");
		include URL_VISTA . 'footer.php';
	}

	public function usuario()
	{
		if(!empty($_SESSION)){
			if ($_SESSION['rol'] == 'Administrador') {
				$usuario = $this->daoUsuario->traerTodo();
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "usuarios.php");
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$id = $_SESSION["id"];
				$usuario = $this->daoUsuario->traerPorId($id);
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "usuario.php");
				include URL_VISTA . 'footer.php';
			}
		}
		else
		{
			$this->mensaje = new Mensaje( "success", "Debe iniciar sesion!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}
		
		
	}


	public function modificarusuario($id)
	{
		if(!empty($_SESSION)){
			if ($_SESSION['rol'] == 'Administrador') {
				$usuario = $this->daoUsuario->traerPorId($id);
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "modificarpreoridadusuario.php");
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$usuario = $this->daoUsuario->traerPorId($id);
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "modificarusuario.php");
				include URL_VISTA . 'footer.php';
			}

		}
		else
		{
			$this->mensaje = new Mensaje( "success", "Debe iniciar sesion!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}
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
				$contar = count($lentexcliente);
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

	public function factura($id_lente,$id_cliente)
	{
		if(!empty($id_lente))
		{
			$lente = $this->daoLente->traerPorId($id_lente);
			$cliente = $this->daoCliente->traerPorId($id_cliente);
			$factura = $this->daoFactura->traerPorIdLente($id_lente);
			if(empty($factura))
			{

				include URL_VISTA . 'header.php';
				require(URL_VISTA . "registrarfactura.php");
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$factura = $factura[0];
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "factura.php");
				include URL_VISTA . 'footer.php';
			}
		}
	}

	public function modificarfactura($id_factura, $id_cliente, $id_lente)
	{
		$cliente = $this->daoCliente->traerPorId($id_cliente);
		$lente = $this->daoLente->traerPorId($id_lente);
		$factura = $this->daoFactura->traerPorId($id_factura);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modificarfactura.php");
		include URL_VISTA . 'footer.php';
	}

}