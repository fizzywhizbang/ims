<?PHP
/*
Copyright 2011 Marc Levine
    PTCM Invoice is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    PTCM Invoice is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with PTCM Invoice.  If not, see <http://www.gnu.org/licenses/>.
*/
?><?PHP
//include("../lib/dblib.php");
	include("../lib/functions.php");
//	require("../lib/html2fpdf/html2fpdf.php"); 
 	$htmlFile = "invoice_print2.php?open=" . $_GET["open"]; 
	$fp=fopen($htmlFile,"r");
	$strContent = stream_get_contents($fp);
	fclose($fp);
	//echo $strContent;
 //	$pdf = new HTML2FPDF('P', 'mm', 'Letter'); 
//	$pdf->AddPage(); 
//	$pdf->WriteHTML($strContent); 
//	$pdf->Output("../tmp/Invoice".$_GET["open"].".pdf");
	//javaJump("../tmp/Invoice".$_GET["open"].".pdf");

/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
  //  ob_start();
//    include(dirname(__FILE__).'/res/exemple05.php');
 //   $content = ob_get_clean();

    // convert to PDF
    require_once('lib/html2fpdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($strContent, isset($_GET['vuehtml']));
        $html2pdf->Output("invoice".$_GET["open"].".pdf");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>