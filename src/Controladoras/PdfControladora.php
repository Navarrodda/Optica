<?php

namespace Controladoras;

use Vendor\FpdfVendor as pdf;


class PdfControladora 
{
	protected $pdf;

	public function __construct()
	{
		
	}
	
	function pdfvista()
	{
		$pdf = new pdf();
		$pdf->AddPage();
		$pdf->Image('img\Plantilla\plantilla.jpg',10,10,-110);
		$pdf->Output();	
	}
}