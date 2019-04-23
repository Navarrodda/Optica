<?php

namespace Controladoras;

use Modelo\Mensaje;
use Modelo\Usuario as Usuario;;
use Modelo\Cliente as Cliente;

use Vendor\FpdfVendor as pdf;

use Dao\RolBdDao as RolBdDao;
use Dao\UsuarioBdDao as UsuarioBdDao;
use Dao\ClienteBdDao as ClienteBdDao;


class PdfControladora 
{
	protected $pdf;
	protected $usuario;
	protected $daoRol;
	protected $daoUsuario;
	protected $daoCliente;

	private $mensaje;
	private $cliente;

	public function __construct()
	{
		//$this->daoRol = RolBdDao::getInstancia();
		//ini_set('date.timezone','America/Buenos_Aires');
		//$time1= date('Y-m-d',time()); Fecha con las letras mayusculas te pone diferente.
		//$time1= date('d-m-y',time()); 
		//print_r($time1);
		$this->daoUsuario = UsuarioBdDao::getInstancia();
		//$this->daoCliente = ClienteBdDao::getInstancia();	
	}

	//SetTextColor
	//AddFont añadir fuente
	//SetFont establecer fuente
	//Set Font Size establecer tamaño de fuente
	//Text texto Text($x, $y, $txt) top:45.300;left:436.152
	//MultiCell($w, $h, $txt);

	function pdfvista()
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
				//Nombre{
				$pdf->SetY(16);
				$pdf->SetX(124);
				$pdf->MultiCell(145,15,$usuario->getNombre());
				//Nombre}
				//Apellido{
				$pdf->SetY(16);
				$pdf->SetX(132);
				$pdf->MultiCell(145,15,$usuario->getApellido());
				//Apellido}
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
				$pdf->MultiCell(135,15,$usuario->getNombre());
				//Nombre}
				//Apellido{
				$pdf->SetY(92.5);
				$pdf->SetX(37);
				$pdf->MultiCell(135,15,$usuario->getApellido());
				//Apellido}
				//Senior}
				//Calle{
				$pdf->SetY(92.5);
				$pdf->SetX(110.5);
				$pdf->MultiCell(135,15,$usuario->getCalle());
				//Calle}
				//Telefono{
				$pdf->SetY(92.5);
				$pdf->SetX(165.5);
				$pdf->MultiCell(135,15,$usuario->getTelefono());
				//Telefono}
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
			$this->mensaje = new Mensaje('warning', 'Deve iniciar secion!');
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
				//Nombre{
				$pdf->SetY(16);
				$pdf->SetX(124);
				$pdf->MultiCell(145,15,$usuario->getNombre());
				//Nombre}
				//Apellido{
				$pdf->SetY(16);
				$pdf->SetX(132);
				$pdf->MultiCell(145,15,$usuario->getApellido());
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
				$pdf->SetX(29);
				$pdf->MultiCell(135,15,$usuario->getNombre());
				//Nombre}
				//Apellido{
				$pdf->SetY(92.5);
				$pdf->SetX(37);
				$pdf->MultiCell(135,15,$usuario->getApellido());
				//Apellido}
				//Senior}
				//Calle{
				$pdf->SetY(92.5);
				$pdf->SetX(110.5);
				$pdf->MultiCell(135,15,$usuario->getCalle());
				//Calle}
				//Telefono{
				$pdf->SetY(92.5);
				$pdf->SetX(165.5);
				$pdf->MultiCell(135,15,$usuario->getTelefono());
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
			$this->mensaje = new Mensaje('warning', 'Deve iniciar secion!');
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