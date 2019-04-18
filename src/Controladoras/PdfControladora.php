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
		$pdf->Output();
		
	}
}