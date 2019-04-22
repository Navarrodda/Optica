<?php

namespace Controladoras;

use Modelo\Mensaje;
use Modelo\Cliente as Cliente;

use Vendor\FpdfVendor as pdf;

use Dao\RolBdDao as RolBdDao;
use Dao\UsuarioBdDao as Usuario;
use Dao\ClienteBdDao as ClienteBdDao;


class PdfControladora 
{
	protected $pdf;
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
		//$this->daoUsuario = UsuarioBdDao::getInstancia();
		//$this->daoCliente = ClienteBdDao::getInstancia();	
	}

	//SetTextColor
	//AddFont añadir fuente
	//SetFont establecer fuente
	//Set Font Size establecer tamaño de fuente
	//Text texto Text($x, $y, $txt) top:45.300;left:436.152
	//MultiCell

	function pdfvista()
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