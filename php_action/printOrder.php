<?PHP
if($_SERVER["SERVER_PORT"] == "80"){
    $server = "http://" . $_SERVER["SERVER_NAME"] . str_replace("printOrder.php","",$_SERVER['SCRIPT_NAME']);
} else {
    $server = "https://" . $_SERVER["SERVER_NAME"] . str_replace("printOrder.php","",$_SERVER['SCRIPT_NAME']);
}

if(strpos($_SERVER['HTTP_REFERER'],"orders.php?o=manord") || strpos($_SERVER['HTTP_REFERER'],"orders.php?o=add")){
    //
} else {
    header("Location: " . $server);
}
$curlOptions = array(
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_FOLLOWLOCATION => TRUE,
    CURLOPT_VERBOSE => TRUE,
    CURLOPT_STDERR => $verbose = fopen('php://temp', 'rw+'),
    CURLOPT_FILETIME => TRUE,
);

//echo $server;
$url = $server . "print2.php?orderId=" . $_GET["orderId"];
$handle = curl_init($url);
curl_setopt_array($handle, $curlOptions);
$content = curl_exec($handle);
//echo $content;
//echo "<pre>";
//echo "Verbose information:\n", !rewind($verbose), stream_get_contents($verbose), "\n";
curl_close($handle);
//echo "</pre>";
     
     //echo $table;
    // convert to PDF
    require '../vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;
    //$_GET['vuehtml']=true;
    try
    {
        $html2pdf = new HTML2PDF('P', 'LETTER', 'en');
        //$html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output("order".$_GET["orderId"].".pdf");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
   
?>