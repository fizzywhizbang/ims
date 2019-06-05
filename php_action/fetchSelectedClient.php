<?php 	

require_once 'core.php';

$clientid = $_POST['clientid'];

$sql = "SELECT * FROM ".$db_prefix."clients WHERE id_clients = $clientid";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);