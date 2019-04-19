<?php

namespace Controladoras;

use Vendor\FpdfVendor as pdf;


class PdfControladora 
{
	protected $pdf;

	public function __construct()
	{
		
	}
	
//SetTextColor
	//AddFont añadir fuente
	//SetFont establecer fuente
	//Set Font Size establecer tamaño de fuente
	//Text texto Text($x, $y, $txt) top:45.300;left:436.152
	//MultiCell

	function pdfvista()
	{
		$pdf = new pdf();
		$pdf->AddPage();
		$pdf->Image('img\Plantilla\plantilla.jpg',10,10,-110);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Ln(6);
		$pdf->SetX(123);
		$pdf->MultiCell(145,15,"Peres Roberto");
		$pdf->Output();	
	}
}