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
use Dao\CuentasaldosBdDao as CuentasaldosBdDao;
use Dao\SeniasxclientelenteBdDao as SeniasxclientelenteBdDao;

class VistaControladora
{
	protected $daoRol;
	protected $daoCliente;
	protected $daoUsuario;
	protected $daoLentexcliente;
	protected $daoFactura;
	protected $daoSenia;
	protected $daoCuenta_saldos;
	
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
		$this->daoCuenta_saldos = CuentasaldosBdDao::getInstancia();
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

				$limit = 10 * $entrada;
				$limit = $limit - 10;
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
		if(!empty($_SESSION)){

			if (!empty($dato)) {

				if($valor == 0)
				{
					print_r("aseasdsad");
					$this->mensaje = new Mensaje( "success", "Seleccionar algun Opcion!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "inicio.php");
					include URL_VISTA . 'footer.php';
				}
				if($valor == 1) {
					$limit = 0;
					$nombre = $this->daoCliente->traerTodoLimitNombre($dato,$limit);

					if(!empty($nombre))
					{
						$numero = count($nombre);
						$parametro = 'Nombre';
						$palabra = ucwords($dato);
						$cliente = $nombre;
						$entrada = 1; 
						$pantalla = 1;
						$medir = $this->daoCliente->traerPorNombre($dato);
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
						require(URL_VISTA . "serchclientes.php");
						include URL_VISTA . 'footer.php';
					}
					else
					{
						$parametro = 'Nombre';
						$palabra = ucwords($dato);
						$cliente = null;
						include URL_VISTA . 'header.php';
						require(URL_VISTA . "serchclientes.php");
						include URL_VISTA . 'footer.php';
					}
				}
				if($valor == 2){
					$limit = 0;
					$apellido = $this->daoCliente->traerTodoLimitApellido($dato,$limit);
					if(!empty($apellido))
					{
						$numero = count($apellido);
						$parametro = 'Apellido';
						$palabra = ucwords($dato);
						$cliente = $apellido;
						$entrada = 1; 
						$pantalla = 1;
						$medir = $this->daoCliente->traerPorApellido($dato);
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
						require(URL_VISTA . "serchclientes.php");
						include URL_VISTA . 'footer.php';
					}
					else
					{
						$parametro = 'Apellido';
						$palabra = ucwords($dato);
						$cliente = null;
						include URL_VISTA . 'header.php';
						require(URL_VISTA . "serchclientes.php");
						include URL_VISTA . 'footer.php';
					}

				}

				if($valor == 3){
					$palabra = ucwords($dato);
					$final = explode(" ", $dato);
					$limit = 0;
					$nombreapellido = $this->daoCliente->traerTodoLimitNombreApellido($final[0], $final[1],$limit);
					if(!empty($nombreapellido))
					{
						$numero = count($nombreapellido);
						$parametro = 'Nombre Apellido';
						$cliente = $nombreapellido;
						$entrada = 1; 
						$pantalla = 1;
						$medir = $this->daoCliente->traerTodoNombreApellido($final[0], $final[1]);
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
						require(URL_VISTA . "serchclientes.php");
						include URL_VISTA . 'footer.php';
					}
				}

				if($valor == 4){

				}





			}
			else
			{
				$this->mensaje = new Mensaje( "success", "Ningun dato enviado por el buscador!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "inicio.php");
				include URL_VISTA . 'footer.php';
			}

			$rest = substr($dato, -1); 
		   // devuelve "f"
			print_r('/Ultima letra :');
			print_r($rest);
			print_r('/Contador :');
			$cont = strlen($dato);
			print_r('/');
			print_r($cont);
			print_r('/Primera Letra: ');
		//Select * from cliente where nombre like 'a%';
			$rest = substr($dato, - $cont, 1);
			print_r($rest);
			print_r('/');
			print_r($dato);
		}
		else
		{
			$this->mensaje = new Mensaje( "success", "Debe iniciar sesion!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}

	}
	public function clientesparametrolimit($parametro, $numero,$palabra, $parametro, $limit, $longitud, $entrada, $pantalla)
	{	
		if (!empty($_SESSION)) {
			
			if($parametro == 'Nombre') 
			{
				$calcular = $this->daoCliente->traerPorNombre($palabra);
				$calcular = count($calcular);
			}
			if($parametro == 'Apellido') 
			{
				$calcular = $this->daoCliente->traerPorApellido($palabra);
				$calcular = count($calcular);
			}
			//Filtrar Parametros de la url
			$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
				"}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
				"â€”", "â€“", ",", "<", ".", ">", "/", "?","20");
			$parametro = trim(str_replace($strip, " ", strip_tags($parametro)));
			$parametro = preg_replace('/\s+/', " ", $parametro);
			//Filtrar Parametros de la url
			$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
				"}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
				"â€”", "â€“", ",", "<", ".", ">", "/", "?","20");
			$palabra = trim(str_replace($strip, " ", strip_tags($palabra)));
			$palabra = preg_replace('/\s+/', " ", $palabra);
			if($parametro == 'Nombre Apellido') 
			{
	
				$final = explode(" ", $palabra);
				$palabra = $final[0] . ' ' . $final[1];
				$calcular = $this->daoCliente->traerTodoNombreApellido($final[0], $final[1]);
				$calcular = count($calcular);
			}

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

					$limit = 10 * $entrada;
					$limit = $limit - 10;
				}

				if($parametro == 'Nombre') 
				{
					$cliente = $this->daoCliente->traerTodoLimitNombre($palabra,$limit);
					$contador =count($cliente);
					$pantalla = 1; 
				}
				if($parametro == 'Apellido') 
				{
					$cliente = $this->daoCliente->traerTodoLimitApellido($palabra,$limit);
					$contador =count($cliente);
					$pantalla = 1; 
				}
				if($parametro == 'Nombre Apellido') 
				{
					$final = explode(" ", $palabra);
					$cliente = $this->daoCliente->traerTodoLimitNombreApellido($final[0], $final[1], $limit);
					$contador =count($cliente);
					$pantalla = 1; 
				}
				
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
			require(URL_VISTA . "serchclientes.php");
			include URL_VISTA . 'footer.php';
		}
		else
		{
			$this->mensaje = new Mensaje( "success", "Debe iniciar sesion!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}
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
		if(!empty($_SESSION)){
			$lente = NULL;
			$limit = 0;
			$entrada = 1; 
			$pantalla = 1;
			$cliente = $this->daoCliente->traerPorId($id_cliente);

			if(!empty($id_cliente)){

				$cunt = $this->daoLentexcliente->traerPorIdCliente($id_cliente);
				$lentexcliente = $this->daoLentexcliente->traerLenteLimit($id_cliente,$limit);
				if(!empty($lentexcliente))
				{
					$longitud = count($lentexcliente);
					$lente = $lentexcliente[0]->getIdLente();
				}
				$longitud = count($cunt) + 1;
				$contar = count($cunt);
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "lentexcliente.php");
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

	public function lentesclienteslimit($id_cliente, $limit, $longitud, $entrada, $pantalla)
	{	
		if(!empty($_SESSION)){

			if (!empty($limit)) {
				if ($limit == -1) {
					$limit = $entrada + 1; 
					$entrada = $entrada + 1;
					if ($limit > $longitud) {
						$limit = $entrada - 1;
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
					$limit= $limit -1;
				}
			}
			if(!empty($id_cliente)){
				{
					$cunt = $this->daoLentexcliente->traerPorIdCliente($id_cliente);
					$cliente = $this->daoCliente->traerPorId($id_cliente);
					$lentexcliente = $this->daoLentexcliente->traerLenteLimit($id_cliente,$limit);
					if(!empty($lentexcliente))
					{
						$longitud = count($lentexcliente);
						$lente = $lentexcliente[0]->getIdLente();
					}
					$longitud = count($cunt)+1;
					$contar = count($cunt);
					$pantalla = 1; 
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "lentexcliente.php");
					include URL_VISTA . 'footer.php';
				}

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

	public function modificaclienterlente($id_cliente, $id_lente, $id_factura, $id_cuenta_saldos)
	{
		if(!empty($id_cliente))
		{
			$cliente = $this->daoCliente->traerPorId($id_cliente);
		}
		if(!empty($id_lente))
		{
			$lente = $this->daoLente->traerPorId($id_lente);
		}
		if(!empty($id_factura))
		{
			$factura = $this->daoFactura->traerPorId($id_factura);
		}
		if(!empty($id_cuenta_saldos))
		{
			$cuenta_saldos = $this->daoCuenta_saldos->traerPorId($id_cuenta_saldos);
		}
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modificarclientelente.php");
		include URL_VISTA . 'footer.php';
	}

}