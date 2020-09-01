<?php

   
  		
require_once("{{ asset('TCPDF/tcpdf.php')");
class MYPDF extends TCPDF {

	//Page header
function Header()
{
	$this->SetFont('dejavusans','B',15);
	$this->SetTextColor(53,63,75);
	$this->Image('sample1.jpg',10,10,25); 
	// Title
	$this->Cell(187,20,'Statement Of Account',0,0,'R');
	$this->SetFont('dejavusans','',10);

	

	
}
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, 51, 10);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 8);
$totaldebit=0;
$totalcredit=0;
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table
include('configdb.php');
$html ="";
// add a page
$pdf->AddPage();

$html='<table border="1"  cellpadding="4" BORDERCOLOR="#232a33">
<tr bgcolor="#353F4B" color="#FFFFFF">
<td>sdfsdf</td>
td>sfddsf</td>
</tr>
</table>';



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('timesheet.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
