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

use Vendor\FpdfVendor as pdf;

//Dao
use Dao\RolBdDao as RolBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\ClienteBdDao as ClienteBdDao;
use Dao\LenteBdDao as LenteBdDao;
use Dao\LentexclienteBdDao as LentexclienteBdDao;
use Dao\FacturaBdDao as FacturaBdDao;
use Dao\CuentsaldosBdDao as CuentsaldosBdDao;
use Dao\SeniasxclientelenteBdDao as SeniasxclientelenteBdDao;


class PdfControladora 
{
	protected $pdf;
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
		//$this->daoRol = RolBdDao::getInstancia();
		//ini_set('date.timezone','America/Buenos_Aires');
		//$time1= date('Y-m-d',time()); Fecha con las letras mayusculas te pone diferente.
		//$time1= date('d-m-y',time()); 
		//print_r($time1);
		$this->daoRol = RolBdDao::getInstancia();
		$this->daoCliente = ClienteBdDao::getInstancia();
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		$this->daoLente = LenteBdDao::getInstancia();
		$this->daoLentexcliente = LentexclienteBdDao::getInstancia();
		$this->daoFactura = FacturaBdDao::getInstancia();
		$this->daoSenia = SeniasxclientelenteBdDao::getInstancia();
		//$this->daoCliente = ClienteBdDao::getInstancia();	
	}

	//SetTextColor
	//AddFont añadir fuente
	//SetFont establecer fuente
	//Set Font Size establecer tamaño de fuente
	//Text texto Text($x, $y, $txt) top:45.300;left:436.152
	//MultiCell($w, $h, $txt);

	public	function pdfvista()
	{
		if(!empty($_SESSION))
		{
			$pdf = new pdf('P','mm','Legal');
			$pdf->AddPage();
			$pdf->Image('img\Plantilla\plantilla.jpg',-3.1,10,-86);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','B',16);
			ini_set('date.timezone','America/Buenos_Aires');
			$timed= date('d',time());
			$timem= date('m',time()); 
			$timey= date('y',time());
				//1 Parte{
				//Fecha{
				//Dia{
			$pdf->SetY(19);
			$pdf->SetX(88);
			$pdf->MultiCell(146,15,$timed);
				//Dia}
				//Mes{
			$pdf->SetY(19);
			$pdf->SetX(100.5);
			$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
			$pdf->SetY(19);
			$pdf->SetX(112.5);
			$pdf->MultiCell(145,15,$timey);
				//Anio}
				//}
				//Senior{ 
				//Nombre{
				//Apellido{
			$pdf->SetY(16);
			$pdf->SetX(124);
			$pdf->MultiCell(145,15,'');
				//Apellido}
				//Nombre}
				//Senior}
				//}
				//2 Parte{
				//Fecha{
				//Dia{
			$pdf->SetY(103.5);
			$pdf->SetX(173);
			$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
			$pdf->SetY(103.5);
			$pdf->SetX(186.5);
			$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
			$pdf->SetY(103.5);
			$pdf->SetX(198.5);
			$pdf->MultiCell(145,15,$timey);
				//Anio}
				//Fecha}
				//Senior{ 
				//Nombre{
			$pdf->SetY(92.5);
			$pdf->SetX(29);
			$pdf->MultiCell(135,15,'');
				//Nombre}
				//Apellido{
			$pdf->SetY(92.5);
			$pdf->SetX(37);
			$pdf->MultiCell(135,15,'');
				//Apellido}
				//Senior}
				//Calle{
			$pdf->SetY(92.5);
			$pdf->SetX(110.5);
			$pdf->MultiCell(135,15,'');
				//Calle}
				//Telefono{
			$pdf->SetY(92.5);
			$pdf->SetX(165.5);
			$pdf->MultiCell(135,15,'');
				//Telefono}
				//}

			$pdf->Output();

		}
		else
		{
			$this->mensaje = new Mensaje('warning', 'Debe iniciar secion!');
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}
	}		


	function pdfplantilla()
	{
		if(!empty($_SESSION))
		{
			$pdf = new pdf('P','mm','Legal');
			$pdf->AddPage();
			$pdf->Image('img\Plantilla\plantilla.jpg',-3.1,10,-86);
			$pdf->SetTextColor(0,0,0);
			$pdf->Output();	
		}
		else
		{
			$this->mensaje = new Mensaje('warning', 'Deve iniciar secion!');
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}

	}

	function pdfsimple()
	{
		if(!empty($_SESSION))
		{
			$email = $_SESSION["email"];
			$usuario = $this->daoUsuario->traerPorMail($email);
			if($usuario != NULL )
			{
				$pdf = new pdf('P','mm','Legal');
				$pdf->AddPage();
				$pdf->Image('img\Plantilla\plantilla.jpg',-3.1,10,-86);
				$pdf->SetTextColor(0,0,0);
				$pdf->SetFont('Arial','B',16);
				ini_set('date.timezone','America/Buenos_Aires');
				$timed= date('d',time());
				$timem= date('m',time()); 
				$timey= date('y',time());
				//1 Parte{
				//Fecha{
				//Dia{
				$pdf->SetY(19);
				$pdf->SetX(88);
				$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
				$pdf->SetY(19);
				$pdf->SetX(100.5);
				$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
				$pdf->SetY(19);
				$pdf->SetX(112.5);
				$pdf->MultiCell(145,15,$timey);
				//Anio}
				//}
				//Senior{
				//Apellido{ 
				//Nombre{
				$pdf->SetY(19);
				$pdf->SetX(138);
				$pdf->MultiCell(145,15,'roberto');
				//Nombre}
				//Apellido}
				//Senior}
				//Observaciones{
				$pdf->SetY(27.5);
				$pdf->SetX(95.7);
				$pdf->MultiCell(145,15,'monocrom');//Observacion
				//Observaciones}
				//A cuenta{
				$pdf->SetY(29);
				$pdf->SetX(165.6);
				$pdf->MultiCell(145,15,'21111');
				//A cuenta}
				//Saldo{
				$pdf->SetY(35.9);
				$pdf->SetX(165.6);
				$pdf->MultiCell(145,15,'22222');
				//Saldo}
				//}
				//2 Parte{
				//Fecha{
				//Dia{
				$pdf->SetY(103.5);
				$pdf->SetX(173);
				$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
				$pdf->SetY(103.5);
				$pdf->SetX(186.5);
				$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
				$pdf->SetY(103.5);
				$pdf->SetX(198.5);
				$pdf->MultiCell(145,15,$timey);
				//Anio}
				//Fecha}
				//Senior{ 
				//Nombre{
				//Apellido{
				$pdf->SetY(116.9);
				$pdf->SetX(24.5);
				$pdf->MultiCell(135,15,'roberto');
				//Apellido}
				//Nombre}
				//Senior}
				//Telefono{
				$pdf->SetY(116.9);
				$pdf->SetX(153.5);
				$pdf->MultiCell(135,15,'223123213');
				//Telefono}
				//Dr{
				$pdf->SetY(125.5);
				$pdf->SetX(21.5);
				$pdf->MultiCell(145,15,'Perez');
				//Dr}
				//Armazon Lejos{
				$pdf->SetY(137.5);
				$pdf->SetX(38.5);
				$pdf->MultiCell(145,15,'+asd');
				//Armazon Lejos}
				//Armazon Cerca{
				$pdf->SetY(149.5);
				$pdf->SetX(38.5);
				$pdf->MultiCell(145,15,'+16');
				//Armazon Cerca}
				//Lejos OD ESF{
				$pdf->SetY(162.5);
				$pdf->SetX(38.5);
				$pdf->MultiCell(145,15,'+16');
				//Lejos OD ESF}
				//Cilindrico OD{
				$pdf->SetY(162.5);
				$pdf->SetX(74.5);
				$pdf->MultiCell(145,15,'+1');
				//Cilindrico OD}
				//En GRA OD{
				$pdf->SetY(162.5);
				$pdf->SetX(102.5);
				$pdf->MultiCell(145,15,'+2');
				//En GRA OD}
				//Lejos OI ESF{
				$pdf->SetY(168.6);
				$pdf->SetX(38.5);
				$pdf->MultiCell(145,15,'+2');
				//Lejos OI ESF}
				//Cilindrico OI{
				$pdf->SetY(168.6);
				$pdf->SetX(74.5);
				$pdf->MultiCell(145,15,'+3');
				//Cilindrico OI}
				//EN GRA OI{
				$pdf->SetY(168.6);
				$pdf->SetX(102.5);
				$pdf->MultiCell(145,15,'+3');
				//EN GRA OI}
				//Color 1{
				$pdf->SetY(168.6);
				$pdf->SetX(140);
				$pdf->MultiCell(145,15,'+4');
				//Color 1}
				//Cerca OD ESF{
				$pdf->SetY(175);
				$pdf->SetX(38.5);
				$pdf->MultiCell(145,15,'+1');
				//Cerca OD ESF} 
				//Cilindrico OD{
				$pdf->SetY(175);
				$pdf->SetX(74.5);
				$pdf->MultiCell(145,15,'+2');
				//Cilindrico OD}
				//EN GRA OD{
				$pdf->SetY(175);
				$pdf->SetX(102.5);
				$pdf->MultiCell(145,15,'+3');
				//EN GRA OD}
				//Cerca OI ESF{
				$pdf->SetY(181.5);
				$pdf->SetX(38.5);
				$pdf->MultiCell(145,15,'+6');
				//Cerca OI ESF}
				//Cilindrico OI{
				$pdf->SetY(181.5);
				$pdf->SetX(74.5);
				$pdf->MultiCell(145,15,'+16');
				//Cilindrico OI}
				//EN GRA OI{
				$pdf->SetY(181.5);
				$pdf->SetX(102.5);
				$pdf->MultiCell(145,15,'+16');
				//EN GRA OI}
				//Color 2{
				$pdf->SetY(181.5);
				$pdf->SetX(140);
				$pdf->MultiCell(145,15,'+16');
				//Color 2}
				//Sub Total{
				$pdf->SetY(187.7);
				$pdf->SetX(171.7);
				$pdf->MultiCell(145,15,'123123');
				//Sub Total}
				//$ Senia{
				$pdf->SetY(193.4);
				$pdf->SetX(171.7);
				$pdf->MultiCell(145,15,'1612');
				//$ Senia}
				//Saldo Total ${
				$pdf->SetY(199);
				$pdf->SetX(171.7);
				$pdf->MultiCell(145,15,'2112');
				//Saldo Total $}
				//}
				$pdf->Output();

			}
			else
			{
				$this->mensaje = new Mensaje('warning', 'No se pudo mostrar el PDF hubo un error!');
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "pdf.php");
				include URL_VISTA . 'footer.php';
			}

		}
		else
		{
			$this->mensaje = new Mensaje('warning', 'Debe iniciar secion!');
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}
	}

	function pdfcargamanual($nombre, $apellido, $telefono, $doctor, $observacion, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $complit, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color, $subtotal, $senia)
	{
		if(!empty($_SESSION))
		{
			$email = $_SESSION["email"];
			$usuario = $this->daoUsuario->traerPorMail($email);

			
			$pdf = new pdf();
			$pdf = new pdf('P','mm','Legal');
			$pdf->AddPage();
			$pdf->Image('img\Plantilla\plantilla.jpg',-3.1,10,-86);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','B',16);
			ini_set('date.timezone','America/Buenos_Aires');
			//1 Parte{
			$fecha = date('Y-m-d');
			if (!empty($fecha)) {

				$timed= date("d", strtotime($fecha));  
				$timem= date("m", strtotime($fecha));  
				$timey= date("y", strtotime($fecha)); 
			//Fecha{
			//Dia{
				$pdf->SetY(19);
				$pdf->SetX(88);
				$pdf->MultiCell(145,15,$timed);
			//Dia}
			//Mes{
				$pdf->SetY(19);
				$pdf->SetX(100.5);
				$pdf->MultiCell(145,15,$timem);
			//Mes}
			//Anio{
				$pdf->SetY(19);
				$pdf->SetX(112.5);
				$pdf->MultiCell(145,15,$timey);
			//Anio}
			//}
			}
			if($complit=='SI')
			{
				$cerca_od_cilindrico = $lejos_od_cilindrico;
				$cerca_od_grados = $lejos_od_grados;
				$cerca_oi_cilindrico =	$lejos_oi_cilindrico;
				$cerca_oi_grados =	$lejos_oi_grados;
			}
			//}
			//Senior{ 
			//Apellido}
			//Nombre{
			$pdf->SetY(19);
			$pdf->SetX(138);
			$resultado =  $nombre.' '.$apellido;
			$pdf->MultiCell(145,15,$resultado);
			//Nombre}
			//Apellido{
			//Senior}
			//Observaciones{
			$pdf->SetY(27.5);
			$pdf->SetX(95.7);
			$pdf->MultiCell(145,15,$observacion);//Observacion
			//Observaciones}
				//A cuenta{
			if(!empty($senia)){
				$saldo_total = $subtotal - $senia;
				if ($saldo_total < 0) {
					$saldo_total = 0;
				}
			}
			else{
				$saldo_total = $subtotal;
			}
			$a_cuenta = $senia; 
			$pdf->SetY(29);
			$pdf->SetX(165.6);
			$pdf->MultiCell(145,15,$a_cuenta);
				//A cuenta}
				//Saldo{
			$pdf->SetY(35.9);
			$pdf->SetX(165.6);
			$pdf->MultiCell(145,15,$saldo_total);
				//Saldo}
				//}
				//2 Parte{
				//Fecha{
			if (!empty($fecha)) {
				$timed= date("d", strtotime($fecha));  
				$timem= date("m", strtotime($fecha));  
				$timey= date("y", strtotime($fecha)); 
				//Dia{
				$pdf->SetY(103.5);
				$pdf->SetX(173);
				$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
				$pdf->SetY(103.5);
				$pdf->SetX(186.5);
				$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
				$pdf->SetY(103.5);
				$pdf->SetX(198.5);
				$pdf->MultiCell(145,15,$timey);
				//Anio}
			}
				//Fecha}
				//Senior{ 
				//Nombre{
				//Apellido{
			$pdf->SetY(116.9);
			$pdf->SetX(24.5);
			$pdf->MultiCell(135,15,$resultado);
				//Nombre}
				//Apellido}
				//Senior}
				//Telefono{
			$pdf->SetY(116.9);
			$pdf->SetX(153.5);
			$pdf->MultiCell(135,15,$telefono);
				//Telefono}
				//Dr{
			$pdf->SetY(125.5);
			$pdf->SetX(21.5);
			$pdf->MultiCell(145,15,$doctor);
				//Dr}
				//Armazon Lejos{
			$pdf->SetY(137.5);
			$pdf->SetX(38.5);
			$pdf->MultiCell(145,15,$armazon_lejos);
				//Armazon Lejos}
				//Armazon Cerca{
			$pdf->SetY(149.5);
			$pdf->SetX(38.5);
			$pdf->MultiCell(145,15,$armazon_cerca);
				//Armazon Cerca}
				//Lejos OD ESF{
			$pdf->SetY(162.5);
			$pdf->SetX(38.5);
			$pdf->MultiCell(145,15,$lejos_od_esferico);
				//Lejos OD ESF}
				//Cilindrico OD{
			$pdf->SetY(162.5);
			$pdf->SetX(74.5);
			$pdf->MultiCell(145,15,$lejos_od_cilindrico);
				//Cilindrico OD}
				//En GRA OD{
			$pdf->SetY(162.5);
			$pdf->SetX(102.5);
			$pdf->MultiCell(145,15,$lejos_od_grados);
				//En GRA OD}
				//Lejos OI ESF{
			$pdf->SetY(168.6);
			$pdf->SetX(38.5);
			$pdf->MultiCell(145,15,$lejos_oi_esferico);
				//Lejos OI ESF}
				//Cilindrico OI{
			$pdf->SetY(168.6);
			$pdf->SetX(74.5);
			$pdf->MultiCell(145,15,$lejos_oi_cilindrico);
				//Cilindrico OI}
				//EN GRA OI{
			$pdf->SetY(168.6);
			$pdf->SetX(102.5);
			$pdf->MultiCell(145,15,$lejos_oi_grados);
				//EN GRA OI}
				//Color 1{
			$pdf->SetY(168.6);
			$pdf->SetX(140);
			$pdf->MultiCell(145,15,$lejos_color);
				//Color 1}
				//Cerca OD ESF{
			$pdf->SetY(175);
			$pdf->SetX(38.5);
			$pdf->MultiCell(145,15,$cerca_od_esferico);
				//Cerca OD ESF} 
				//Cilindrico OD{
			$pdf->SetY(175);
			$pdf->SetX(74.5);
			$pdf->MultiCell(145,15,$cerca_od_cilindrico);
				//Cilindrico OD}
				//EN GRA OD{
			$pdf->SetY(175);
			$pdf->SetX(102.5);
			$pdf->MultiCell(145,15,$cerca_od_grados);
				//EN GRA OD}
				//Cerca OI ESF{
			$pdf->SetY(181.5);
			$pdf->SetX(38.5);
			$pdf->MultiCell(145,15,$cerca_oi_esferico);
				//Cerca OI ESF}
				//Cilindrico OI{
			$pdf->SetY(181.5);
			$pdf->SetX(74.5);
			$pdf->MultiCell(145,15,$cerca_oi_cilindrico);
				//Cilindrico OI}
				//EN GRA OI{
			$pdf->SetY(181.5);
			$pdf->SetX(102.5);
			$pdf->MultiCell(145,15,$cerca_oi_grados);
				//EN GRA OI}
				//Color 2{
			$pdf->SetY(181.5);
			$pdf->SetX(140);
			$pdf->MultiCell(145,15,$cerca_color);
				//Color 2}
			
				//Sub Total{
			$pdf->SetY(187.7);
			$pdf->SetX(171.7);
			$pdf->MultiCell(145,15,$subtotal);
				//Sub Total}
				//$ Senia{
			$pdf->SetY(193.4);
			$pdf->SetX(171.7);
			$pdf->MultiCell(145,15,$senia);
				//$ Senia}
				//Saldo Total ${
			$pdf->SetY(199);
			$pdf->SetX(171.7);
			$pdf->MultiCell(145,15,$saldo_total);
				//Saldo Total $}
				//}
			$pdf->Output();
		}
		else
		{
			$this->mensaje = new Mensaje('warning', 'Debe iniciar secion!');
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}
	}		
	public function pdfclientelente($id_lente, $id_cliente)
	{
		if(!empty($_SESSION))
		{
			$cliente = $this->daoCliente->traerPorId($id_cliente);
			if ($id_lente != -1) {
				$lente = $this->daoLente->traerPorId($id_lente);
				$factura = $this->daoFactura->traerPorIdLente($id_lente);
				$senia = $this->daoSenia->traerPorIdLente($id_lente);
			}
			else
			{
				$lente = NULL;
				$factura = NULL;
				$senia = NULL;
			}



			if(!empty($senia))
			{
				foreach ($senia as $seni) {

					if (!empty($id_lente)) {

						$senias = $seni->getIdLente();

						if ($senias->getId() == $id_lente){

							$senia = $seni->getIdCuentaSaldo();	
						}
					}
				}
			}


			if(!empty($cliente))
			{
				$pdf = new pdf('P','mm','Legal');
				$pdf->AddPage();
				$pdf->Image('img\Plantilla\plantilla.jpg',-3.1,10,-86);
				$pdf->SetTextColor(0,0,0);
				$pdf->SetFont('Arial','B',16);
				ini_set('date.timezone','America/Buenos_Aires');
				$timed= date('d',time());
				$timem= date('m',time()); 
				$timey= date('y',time());
				//1 Parte{
				//Fecha{
				//Dia{
				$pdf->SetY(19);
				$pdf->SetX(88);
				$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
				$pdf->SetY(19);
				$pdf->SetX(100.5);
				$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
				$pdf->SetY(19);
				$pdf->SetX(112.5);
				$pdf->MultiCell(145,15,$timey);
				//Anio}
				//}
				//Senior{
				//Apellido{ 
				//Nombre{
				$pdf->SetY(19);
				$pdf->SetX(138);;
				$resultado = $cliente->getNombre() .' '. $cliente->getApellido();
				$pdf->MultiCell(145,15,$resultado);
				//Nombre}
				//Apellido}
				//Senior}
				
				if (!empty($lente)) 
				{
					//Observaciones{
					$pdf->SetY(27.5);
					$pdf->SetX(95.7);
					$pdf->MultiCell(145,15,$lente->getObservacion());//Observacion
					//Observaciones}
					if(!empty($senia))
					{
				//A cuenta{
						$pdf->SetY(29);
						$pdf->SetX(165.6);
						$pdf->MultiCell(145,15,$senia->getACuenta());
				//A cuenta}
				//Saldo{
						$pdf->SetY(35.9);
						$pdf->SetX(165.6);
						$pdf->MultiCell(145,15,$senia->getSaldo());
					}
				//Saldo}
				//}
				//2 Parte{
				//Fecha{
				//Dia{
					$pdf->SetY(103.5);
					$pdf->SetX(173);
					$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
					$pdf->SetY(103.5);
					$pdf->SetX(186.5);
					$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
					$pdf->SetY(103.5);
					$pdf->SetX(198.5);
					$pdf->MultiCell(145,15,$timey);
				//Anio}
				//Fecha}
				//Senior{ 
				//Nombre{
				//Apellido{
					$pdf->SetY(116.9);
					$pdf->SetX(24.5);
					$pdf->MultiCell(135,15,$resultado);
				//Apellido}
				//Nombre}				
				//Senior}
				//Telefono{
					$pdf->SetY(116.9);
					$pdf->SetX(153.5);
					$pdf->MultiCell(135,15,$cliente->getTelefono());
				//Telefono}
				//Dr{
					$pdf->SetY(125.5);
					$pdf->SetX(21.5);
					$pdf->MultiCell(145,15,$lente->getDoctor());
				//Dr}
				//Armazon Lejos{
					$pdf->SetY(137.5);
					$pdf->SetX(38.5);
					$pdf->MultiCell(145,15,$lente->getArmazonLejos());
				//Armazon Lejos}
				//Armazon Cerca{
					$pdf->SetY(149.5);
					$pdf->SetX(38.5);
					$pdf->MultiCell(145,15,$lente->getArmazonCerca());
				//Armazon Cerca}
				//$ Armazon Cerca}
				//Lejos OD ESF{
					$pdf->SetY(162.5);
					$pdf->SetX(38.5);
					$pdf->MultiCell(145,15,$lente->getLejosOdEsferico());
				//Lejos OD ESF}
				//Cilindrico OD{
					$pdf->SetY(162.5);
					$pdf->SetX(74.5);
					$pdf->MultiCell(145,15,$lente-> getLejosOdCilindrico());
				//Cilindrico OD}
				//En GRA OD{
					$pdf->SetY(162.5);
					$pdf->SetX(102.5);
					$pdf->MultiCell(145,15,$lente->getLejosOdGrados());
				//En GRA OD}
				//Lejos OI ESF{
					$pdf->SetY(168.6);
					$pdf->SetX(38.5);
					$pdf->MultiCell(145,15,$lente->getLejosOiEsferico());
				//Lejos OI ESF}
				//Cilindrico OI{
					$pdf->SetY(168.6);
					$pdf->SetX(74.5);
					$pdf->MultiCell(145,15,$lente->getLejosOiCilindrico());
				//Cilindrico OI}
				//EN GRA OI{
					$pdf->SetY(168.6);
					$pdf->SetX(102.5);
					$pdf->MultiCell(145,15,$lente->getLejosOiGrados());
				//EN GRA OI}
				//Color 1{
					$pdf->SetY(168.6);
					$pdf->SetX(140);
					$pdf->MultiCell(145,15,$lente->getLejosColor());
				//Color 1}
				//Cerca OD ESF{
					$pdf->SetY(175);
					$pdf->SetX(38.5);
					$pdf->MultiCell(145,15,$lente->getCercaOdEsferico());
				//Cerca OD ESF} 
				//Cilindrico OD{
					$pdf->SetY(175);
					$pdf->SetX(74.5);
					$pdf->MultiCell(145,15,$lente->getCercaOdCilindrico());
				//Cilindrico OD}
				//EN GRA OD{
					$pdf->SetY(175);
					$pdf->SetX(102.5);
					$pdf->MultiCell(145,15,$lente->getCercaOdGrados());
				//EN GRA OD}
				//Cerca OI ESF{
					$pdf->SetY(181.5);
					$pdf->SetX(38.5);
					$pdf->MultiCell(145,15,$lente->getCercaOiEsferico());
				//Cerca OI ESF}
				//Cilindrico OI{
					$pdf->SetY(181.5);
					$pdf->SetX(74.5);					
					$pdf->MultiCell(145,15,$lente->getCercaOiCilindrico());
				//Cilindrico OI}
				//EN GRA OI{
					$pdf->SetY(181.5);
					$pdf->SetX(102.5);
					$pdf->MultiCell(145,15,$lente->getCercaOiGrados());
				//EN GRA OI}
				//Color 2{
					$pdf->SetY(181.5);
					$pdf->SetX(140);
					$pdf->MultiCell(145,15,$lente->getCercaColor());
				//Color 2}
					if(!empty($factura))
					{
				//Sub Total{
						$pdf->SetY(187.7);
						$pdf->SetX(171.7);
						$pdf->MultiCell(145,15,$factura[0]->getSubTotal());
				//Sub Total}
				//$ Senia{
						$pdf->SetY(193.4);
						$pdf->SetX(171.7);
						$pdf->MultiCell(145,15,$factura[0]->getSenia());
				//$ Senia}
				//Saldo Total ${
						$pdf->SetY(199);
						$pdf->SetX(171.7);
						$pdf->MultiCell(145,15,$factura[0]->getSaldoTotal());
				//Saldo Total $}
				//}
					}



				}
				$pdf->Output();
			}
			else
			{
				$this->mensaje = new Mensaje('warning', 'No se pudo mostrar el PDF hubo un error!');
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "pdf.php");
				include URL_VISTA . 'footer.php';
			}

		}
		else
		{
			$this->mensaje = new Mensaje('warning', 'Debe iniciar secion!');
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "inicio.php");
			include URL_VISTA . 'footer.php';
		}
	}



	/*function pdfvista()
	{

		$pdf = new pdf();
		$pdf->AddPage();
		$pdf->Image('img\Plantilla\plantilla.jpg',10,10,-110);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Ln(6);
		$pdf->SetX(123);
		$pdf->MultiCell(145,15,"Paez Roberto");
		$pdf->Output();	
	}*/
}