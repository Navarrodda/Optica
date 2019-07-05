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

			
			$pdf = new pdf();
			$pdf->AddPage();
			$pdf->Image('img\Plantilla\plantilla.jpg',10,10,-110);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','B',8);
			ini_set('date.timezone','America/Buenos_Aires');
			$timed= date('d',time());
			$timem= date('m',time()); 
			$timey= date('y',time());
				//1 Parte{
				//Fecha{
				//Dia{
			$pdf->SetY(16);
			$pdf->SetX(83.5);
			$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
			$pdf->SetY(16);
			$pdf->SetX(93.5);
			$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
			$pdf->SetY(16);
			$pdf->SetX(103.5);
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
			$pdf->SetY(80.5);
			$pdf->SetX(163);
			$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
			$pdf->SetY(80.5);
			$pdf->SetX(173.5);
			$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
			$pdf->SetY(80.5);
			$pdf->SetX(183.5);
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
			$pdf = new pdf();
			$pdf->AddPage();
			$pdf->Image('img\Plantilla\plantilla.jpg',10,10,-110);
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
				$pdf = new pdf();
				$pdf->AddPage();
				$pdf->Image('img\Plantilla\plantilla.jpg',10,10,-110);
				$pdf->SetTextColor(0,0,0);
				$pdf->SetFont('Arial','B',8);
				ini_set('date.timezone','America/Buenos_Aires');
				$timed= date('d',time());
				$timem= date('m',time()); 
				$timey= date('y',time());
				//1 Parte{
				//Fecha{
				//Dia{
				$pdf->SetY(16);
				$pdf->SetX(83.5);
				$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
				$pdf->SetY(16);
				$pdf->SetX(93.5);
				$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
				$pdf->SetY(16);
				$pdf->SetX(103.5);
				$pdf->MultiCell(145,15,$timey);
				//Anio}
				//}
				//Senior{
				//Apellido{ 
				//Nombre{
				$pdf->SetY(16);
				$pdf->SetX(124);
				$resultado = $usuario->getNombre() .' '. $usuario->getApellido();
				$pdf->MultiCell(145,15,$resultado);
				//Nombre}
				//Apellido}
				//Senior}
				//Observaciones{
				$pdf->SetY(23);
				$pdf->SetX(89);
				$pdf->MultiCell(145,15,'monocromaticos');//Observacion
				//Observaciones}
				//Sera entregado el dia{
				//Dia{
				$pdf->SetY(30.5);
				$pdf->SetX(53);
				$pdf->MultiCell(145,15,'03');
				//Dia}
				//Mes{
				$pdf->SetY(30.5);
				$pdf->SetX(60);
				$pdf->MultiCell(145,15,'21');
				//Mes}
				//Anio{
				$pdf->SetY(30.5);
				$pdf->SetX(67.5);
				$pdf->MultiCell(145,15,'14');
				//Sera entregado el dia}
				//A cuenta{
				$pdf->SetY(25);
				$pdf->SetX(152.6);
				$pdf->MultiCell(145,15,'11111');
				//A cuenta}
				//Saldo{
				$pdf->SetY(30.3);
				$pdf->SetX(152.6);
				$pdf->MultiCell(145,15,'22222');
				//Saldo}
				//}
				//2 Parte{
				//Fecha{
				//Dia{
				$pdf->SetY(80.5);
				$pdf->SetX(163);
				$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
				$pdf->SetY(80.5);
				$pdf->SetX(173.5);
				$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
				$pdf->SetY(80.5);
				$pdf->SetX(183.5);
				$pdf->MultiCell(145,15,$timey);
				//Anio}
				//Fecha}
				//Senior{ 
				//Nombre{
				$pdf->SetY(92.5);
				$pdf->SetX(29.5);
				$pdf->MultiCell(135,15,'');
				//Nombre}
				//Apellido{
				$pdf->SetY(92.5);
				$pdf->SetX(38);
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
				//Reseta con fecha{
				//Dia{
				$pdf->SetY(99.5);
				$pdf->SetX(48);
				$pdf->MultiCell(145,15,'22');
				//Dia}
				//Mes{
				$pdf->SetY(99.5);
				$pdf->SetX(61);
				$pdf->MultiCell(145,15,'11');
				//Mes}
				//Anio{
				$pdf->SetY(99.5);
				$pdf->SetX(75);
				$pdf->MultiCell(145,15,'16');
				//Anio}
				//Reseta con fecha}
				//Dr{
				$pdf->SetY(99.5);
				$pdf->SetX(89.5);
				$pdf->MultiCell(145,15,'Perez');
				//Dr}
				//Proc{
				$pdf->SetY(99.5);
				$pdf->SetX(158.5);
				$pdf->MultiCell(145,15,'Roberto');
				//Proc}
				//Armazon Lejos{
				$pdf->SetY(108.6);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,'+asd');
				//Armazon Lejos}
				//$ Armazon Lejos{
				$pdf->SetY(108.6);
				$pdf->SetX(160);
				$pdf->MultiCell(145,15,'+asd');
				//$ Armazon Lejos}
				//Armazon Cerca{
				$pdf->SetY(117.9);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,'+as');
				//Armazon Cerca}
				//$ Armazon Cerca{
				$pdf->SetY(117.9);
				$pdf->SetX(160);
				$pdf->MultiCell(145,15,'+as');
				//$ Armazon Cerca}
				//Lejos OD ESF{
				$pdf->SetY(127.9);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,'+11');
				//Lejos OD ESF}
				//Cilindrico OD{
				$pdf->SetY(127.9);
				$pdf->SetX(68.5);
				$pdf->MultiCell(145,15,'+12');
				//Cilindrico OD}
				//En GRA OD{
				$pdf->SetY(127.9);
				$pdf->SetX(91.7);
				$pdf->MultiCell(145,15,'+12');
				//En GRA OD}
				//$ L OD{
				$pdf->SetY(128.2);
				$pdf->SetX(160);
				$pdf->MultiCell(145,15,'1112');
				//$ L OD}
				//Lejos OI ESF{
				$pdf->SetY(132.6);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,'+13');
				//Lejos OI ESF}
				//Cilindrico OI{
				$pdf->SetY(132.6);
				$pdf->SetX(68.5);
				$pdf->MultiCell(145,15,'+14');
				//Cilindrico OI}
				//EN GRA OI{
				$pdf->SetY(132.6);
				$pdf->SetX(91.7);
				$pdf->MultiCell(145,15,'+14');
				//EN GRA OI}
				//Color 1{
				$pdf->SetY(132.6);
				$pdf->SetX(120.2);
				$pdf->MultiCell(145,15,'+14');
				//Color 1}
				//$ L OI{
				$pdf->SetY(132.8);
				$pdf->SetX(160);
				$pdf->MultiCell(145,15,'1124');
				//$ L OI}
				//Cerca OD ESF{
				$pdf->SetY(137.6);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,'+14');
				//Cerca OD ESF} 
				//Cilindrico OD{
				$pdf->SetY(137.6);
				$pdf->SetX(68.5);
				$pdf->MultiCell(145,15,'+14');
				//Cilindrico OD}
				//EN GRA OD{
				$pdf->SetY(137.6);
				$pdf->SetX(91.7);
				$pdf->MultiCell(145,15,'+14');
				//EN GRA OD}
				//$ C OD{
				$pdf->SetY(137.7);
				$pdf->SetX(160);
				$pdf->MultiCell(145,15,'123123');
				//$ C OD}
				//Cerca OI ESF{
				$pdf->SetY(142.6);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,'+16');
				//Cerca OI ESF}
				//Cilindrico OI{
				$pdf->SetY(142.6);
				$pdf->SetX(68.5);
				$pdf->MultiCell(145,15,'+16');
				//Cilindrico OI}
				//EN GRA OI{
				$pdf->SetY(142.6);
				$pdf->SetX(91.7);
				$pdf->MultiCell(145,15,'+16');
				//EN GRA OI}
				//Color 2{
				$pdf->SetY(142.6);
				$pdf->SetX(120.2);
				$pdf->MultiCell(145,15,'+16');
				//Color 2}
				//$ OI{
				$pdf->SetY(142.7);
				$pdf->SetX(160);
				$pdf->MultiCell(145,15,'21223');
				//$ OI}
				//D.I.{
				$pdf->SetY(147.7);
				$pdf->SetX(26);
				$pdf->MultiCell(145,15,'pedro');
				//D.I.}
				//Calibre{
				$pdf->SetY(147.7);
				$pdf->SetX(57.2);
				$pdf->MultiCell(145,15,'ajustado');
				//Calibre}
				//Puente{
				$pdf->SetY(147.7);
				$pdf->SetX(94.7);
				$pdf->MultiCell(145,15,'sirculo');
				//Puente}
				//Sub Total{
				$pdf->SetY(147.7);
				$pdf->SetX(160);
				$pdf->MultiCell(145,15,'123123');
				//Sub Total}
				//Sera entregado el Dia{
				$pdf->SetY(155.2);
				$pdf->SetX(56);
				$pdf->MultiCell(145,15,'12');
				//Dia}
				//Mes{
				$pdf->SetY(155.2);
				$pdf->SetX(64);
				$pdf->MultiCell(145,15,'11');
				//Mes}
				//Anio{
				$pdf->SetY(155.2);
				$pdf->SetX(73);
				$pdf->MultiCell(145,15,'16');
				//Anio}				
				//Sera entregado el Dia}
				//$ Senia{
				$pdf->SetY(152.1);
				$pdf->SetX(160);
				$pdf->MultiCell(145,15,'1612');
				//$ Senia}
				//Saldo Total ${
				$pdf->SetY(156.4);
				$pdf->SetX(160);
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
				$pdf->AddPage();
				$pdf->Image('img\Plantilla\plantilla.jpg',10,10,-110);
				$pdf->SetTextColor(0,0,0);
				$pdf->SetFont('Arial','B',8);
				ini_set('date.timezone','America/Buenos_Aires');
			//1 Parte{
				$fecha = date('Y-m-d');
				if (!empty($fecha)) {

					$timed= date("d", strtotime($fecha));  
					$timem= date("m", strtotime($fecha));  
					$timey= date("y", strtotime($fecha)); 
			//Fecha{
			//Dia{
					$pdf->SetY(16);
					$pdf->SetX(83.5);
					$pdf->MultiCell(145,15,$timed);
			//Dia}
			//Mes{
					$pdf->SetY(16);
					$pdf->SetX(93.5);
					$pdf->MultiCell(145,15,$timem);
			//Mes}
			//Anio{
					$pdf->SetY(16);
					$pdf->SetX(103.5);
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
				$pdf->SetY(16);
				$pdf->SetX(124);
				$resultado =  $nombre.' '.$apellido;
				$pdf->MultiCell(145,15,$resultado);
			//Nombre}
			//Apellido{
			//Senior}
			//Observaciones{
				$pdf->SetY(23.3);
				$pdf->SetX(89);
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
			$pdf->SetY(25);
			$pdf->SetX(152.6);
			$pdf->MultiCell(145,15,$a_cuenta);
				//A cuenta}
				//Saldo{
			$pdf->SetY(30.3);
			$pdf->SetX(152.6);
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
				$pdf->SetY(80.5);
				$pdf->SetX(163);
				$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
				$pdf->SetY(80.5);
				$pdf->SetX(173.5);
				$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
				$pdf->SetY(80.5);
				$pdf->SetX(183.5);
				$pdf->MultiCell(145,15,$timey);
				//Anio}
			}
				//Fecha}
				//Senior{ 
				//Nombre{
				//Apellido{
			$pdf->SetY(92.5);
			$pdf->SetX(29.5);
			$pdf->MultiCell(135,15,$resultado);
				//Nombre}
				//Apellido}
				//Senior}
				//Telefono{
			$pdf->SetY(92.5);
			$pdf->SetX(165.5);
			$pdf->MultiCell(135,15,$telefono);
				//Telefono}
				//Dr{
			$pdf->SetY(99.5);
			$pdf->SetX(89.5);
			$pdf->MultiCell(145,15,$doctor);
				//Dr}
				//Armazon Lejos{
			$pdf->SetY(108.6);
			$pdf->SetX(40.5);
			$pdf->MultiCell(145,15,$armazon_lejos);
				//Armazon Lejos}
				//Armazon Cerca{
			$pdf->SetY(117.9);
			$pdf->SetX(40.5);
			$pdf->MultiCell(145,15,$armazon_cerca);
				//Armazon Cerca}
				//Lejos OD ESF{
			$pdf->SetY(127.9);
			$pdf->SetX(40.5);
			$pdf->MultiCell(145,15,$lejos_od_esferico);
				//Lejos OD ESF}
				//Cilindrico OD{
			$pdf->SetY(127.9);
			$pdf->SetX(68.5);
			$pdf->MultiCell(145,15,$lejos_od_cilindrico);
				//Cilindrico OD}
				//En GRA OD{
			$pdf->SetY(127.9);
			$pdf->SetX(91.7);
			$pdf->MultiCell(145,15,$lejos_od_grados);
				//En GRA OD}
				//Lejos OI ESF{
			$pdf->SetY(132.6);
			$pdf->SetX(40.5);
			$pdf->MultiCell(145,15,$lejos_oi_esferico);
				//Lejos OI ESF}
				//Cilindrico OI{
			$pdf->SetY(132.6);
			$pdf->SetX(68.5);
			$pdf->MultiCell(145,15,$lejos_oi_cilindrico);
				//Cilindrico OI}
				//EN GRA OI{
			$pdf->SetY(132.6);
			$pdf->SetX(91.7);
			$pdf->MultiCell(145,15,$lejos_oi_grados);
				//EN GRA OI}
				//Color 1{
			$pdf->SetY(132.6);
			$pdf->SetX(120.2);
			$pdf->MultiCell(145,15,$lejos_color);
				//Color 1}
				//Cerca OD ESF{
			$pdf->SetY(137.6);
			$pdf->SetX(40.5);
			$pdf->MultiCell(145,15,$cerca_od_esferico);
				//Cerca OD ESF} 
				//Cilindrico OD{
			$pdf->SetY(137.6);
			$pdf->SetX(68.5);
			$pdf->MultiCell(145,15,$cerca_od_cilindrico);
				//Cilindrico OD}
				//EN GRA OD{
			$pdf->SetY(137.6);
			$pdf->SetX(91.7);
			$pdf->MultiCell(145,15,$cerca_od_grados);
				//EN GRA OD}
				//Cerca OI ESF{
			$pdf->SetY(142.6);
			$pdf->SetX(40.5);
			$pdf->MultiCell(145,15,$cerca_oi_esferico);
				//Cerca OI ESF}
				//Cilindrico OI{
			$pdf->SetY(142.6);
			$pdf->SetX(68.5);
			$pdf->MultiCell(145,15,$cerca_oi_cilindrico);
				//Cilindrico OI}
				//EN GRA OI{
			$pdf->SetY(142.6);
			$pdf->SetX(91.7);
			$pdf->MultiCell(145,15,$cerca_oi_grados);
				//EN GRA OI}
				//Color 2{
			$pdf->SetY(142.6);
			$pdf->SetX(120.2);
			$pdf->MultiCell(145,15,$cerca_color);
				//Color 2}
			
				//Sub Total{
			$pdf->SetY(147.7);
			$pdf->SetX(160);
			$pdf->MultiCell(145,15,$subtotal);
				//Sub Total}
				//$ Senia{
			$pdf->SetY(152.1);
			$pdf->SetX(160);
			$pdf->MultiCell(145,15,$senia);
				//$ Senia}
				//Saldo Total ${
			$pdf->SetY(156.4);
			$pdf->SetX(160);
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
function pdfclientelente($id_lente, $id_cliente)
{
	if(!empty($_SESSION))
	{
		$cliente = $this->daoCliente->traerPorId($id_cliente);
		$lente = $this->daoLente->traerPorId($id_lente);
		$factura = $this->daoFactura->traerPorIdLente($id_lente);
		$senia = $this->daoSenia->traerPorIdCliente($id_cliente);
		
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
			$pdf = new pdf();
			$pdf->AddPage();
			$pdf->Image('img\Plantilla\plantilla.jpg',10,10,-110);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','B',8);
			ini_set('date.timezone','America/Buenos_Aires');
			$timed= date('d',time());
			$timem= date('m',time()); 
			$timey= date('y',time());
				//1 Parte{
				//Fecha{
				//Dia{
			$pdf->SetY(16);
			$pdf->SetX(83.5);
			$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
			$pdf->SetY(16);
			$pdf->SetX(93.5);
			$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
			$pdf->SetY(16);
			$pdf->SetX(103.5);
			$pdf->MultiCell(145,15,$timey);
				//Anio}
				//}
				//Senior{
				//Apellido{ 
				//Nombre{
			$pdf->SetY(16);
			$pdf->SetX(124);
			$resultado = $cliente->getNombre() .' '. $cliente->getApellido();
			$pdf->MultiCell(145,15,$resultado);
				//Nombre}
				//Apellido}
				//Senior}
				//Observaciones{
			if (!empty($lente)) {

				
				$pdf->SetY(23.3);
				$pdf->SetX(89);
				$pdf->MultiCell(145,15,$lente->getObservacion());//Observacion
				//Observaciones}
				if(!empty($senia))
				{
				//A cuenta{
					$pdf->SetY(25);
					$pdf->SetX(152.6);
					$pdf->MultiCell(145,15,$senia->getACuenta());
				//A cuenta}
				//Saldo{
					$pdf->SetY(30.3);
					$pdf->SetX(152.6);
					$pdf->MultiCell(145,15,$senia->getSaldo());
				}
				//Saldo}
				//}
				//2 Parte{
				//Fecha{
				//Dia{
				$pdf->SetY(80.5);
				$pdf->SetX(163);
				$pdf->MultiCell(145,15,$timed);
				//Dia}
				//Mes{
				$pdf->SetY(80.5);
				$pdf->SetX(173.5);
				$pdf->MultiCell(145,15,$timem);
				//Mes}
				//Anio{
				$pdf->SetY(80.5);
				$pdf->SetX(183.5);
				$pdf->MultiCell(145,15,$timey);
				//Anio}
				//Fecha}
				//Senior{ 
				//Nombre{
				//Apellido{
				$pdf->SetY(92.5);
				$pdf->SetX(29.5);
				$pdf->MultiCell(135,15,$resultado);
				//Apellido}
				//Nombre}				
				//Senior}
				//Telefono{
				$pdf->SetY(92.5);
				$pdf->SetX(165.5);
				$pdf->MultiCell(135,15,$cliente->getTelefono());
				//Telefono}
				//Dr{
				$pdf->SetY(98.9);
				$pdf->SetX(26.5);
				$pdf->MultiCell(145,15,$lente->getDoctor());
				//Dr}
				//Armazon Lejos{
				$pdf->SetY(108.6);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,$lente->getArmazonLejos());
				//Armazon Lejos}
				//Armazon Cerca{
				$pdf->SetY(117.9);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,$lente->getArmazonCerca());
				//Armazon Cerca}
				//$ Armazon Cerca}
				//Lejos OD ESF{
				$pdf->SetY(127.9);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,$lente->getLejosOdEsferico());
				//Lejos OD ESF}
				//Cilindrico OD{
				$pdf->SetY(127.9);
				$pdf->SetX(68.5);
				$pdf->MultiCell(145,15,$lente-> getLejosOdCilindrico());
				//Cilindrico OD}
				//En GRA OD{
				$pdf->SetY(127.9);
				$pdf->SetX(91.7);
				$pdf->MultiCell(145,15,$lente->getLejosOdGrados());
				//En GRA OD}
				//Lejos OI ESF{
				$pdf->SetY(132.6);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,$lente->getLejosOiEsferico());
				//Lejos OI ESF}
				//Cilindrico OI{
				$pdf->SetY(132.6);
				$pdf->SetX(68.5);
				$pdf->MultiCell(145,15,$lente->getLejosOiCilindrico());
				//Cilindrico OI}
				//EN GRA OI{
				$pdf->SetY(132.6);
				$pdf->SetX(91.7);
				$pdf->MultiCell(145,15,$lente->getLejosOiGrados());
				//EN GRA OI}
				//Color 1{
				$pdf->SetY(132.6);
				$pdf->SetX(120.2);
				$pdf->MultiCell(145,15,$lente->getLejosColor());
				//Color 1}
				//Cerca OD ESF{
				$pdf->SetY(137.6);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,$lente->getCercaOdEsferico());
				//Cerca OD ESF} 
				//Cilindrico OD{
				$pdf->SetY(137.6);
				$pdf->SetX(68.5);
				$pdf->MultiCell(145,15,$lente->getCercaOdCilindrico());
				//Cilindrico OD}
				//EN GRA OD{
				$pdf->SetY(137.6);
				$pdf->SetX(91.7);
				$pdf->MultiCell(145,15,$lente->getCercaOdGrados());
				//EN GRA OD}
				//Cerca OI ESF{
				$pdf->SetY(142.6);
				$pdf->SetX(40.5);
				$pdf->MultiCell(145,15,$lente->getCercaOiEsferico());
				//Cerca OI ESF}
				//Cilindrico OI{
				$pdf->SetY(142.6);
				$pdf->SetX(68.5);
				$pdf->MultiCell(145,15,$lente->getCercaOiCilindrico());
				//Cilindrico OI}
				//EN GRA OI{
				$pdf->SetY(142.6);
				$pdf->SetX(91.7);
				$pdf->MultiCell(145,15,$lente->getCercaOiGrados());
				//EN GRA OI}
				//Color 2{
				$pdf->SetY(142.6);
				$pdf->SetX(120.2);
				$pdf->MultiCell(145,15,$lente->getCercaColor());
				//Color 2}
				if(!empty($factura))
				{
				//Sub Total{
					$pdf->SetY(147.7);
					$pdf->SetX(160);
					$pdf->MultiCell(145,15,$factura[0]->getSubTotal());
				//Sub Total}
				//$ Senia{
					$pdf->SetY(152.1);
					$pdf->SetX(160);
					$pdf->MultiCell(145,15,$factura[0]->getSenia());
				//$ Senia}
				//Saldo Total ${
					$pdf->SetY(156.4);
					$pdf->SetX(160);
					$pdf->MultiCell(145,15,$factura[0]->getSaldoTotal());
				//Saldo Total $}
				//}
				}
				$pdf->Output();


			}
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