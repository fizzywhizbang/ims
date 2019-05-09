<?php 	

require_once 'core.php';

$sql = "SELECT * FROM ".$db_prefix."clients where client_name like \"".$_GET["term"]."%\" order by client_name";
$result = $connect->query($sql);

//$output = array();

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeBrands = ""; 

 while($row = $result->fetch_array()) {
 	$client_id = $row[0];
 	
 	$client_name=$row[1];
    $client_phone=$row[2];
    $client_email=$row[3];
    $client_address=$row[4];
    $client_city=$row[5];
    $client_state=$row[6];
    $client_zip=$row[7];
    $client_info=$row[8];
 	$output[] = array( 	
         'value' => $client_phone,
         'label' => $client_name,	
        // $client_name,
        // $client_phone,
        // $client_email,
        // $client_address,
        // $client_city,
        // $client_state,
        // $client_zip,
        // $client_info,
 		); 	
 } // /while 

} // if num_rows
// $array[] = array (
//     'label' => strtoupper($mfg) . " " . strtoupper($plug),
//     'value' => strtoupper($plug),
// );
$connect->close();
//echo '{"item":"test","value":"test"}';
echo json_encode($output);