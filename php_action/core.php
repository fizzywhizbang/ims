<?php 

session_start();
require_once 'db_connect.php';
require_once("functions.php");
//get system information

$sql = "SELECT * FROM ".$db_prefix."system WHERE id = 1";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$ims_companyname = $result['company'];
$ims_address = $result['address'];
$ims_city = $result['city'];
$ims_state = $result['state'];
$ims_zip = $result['zip'];
$ims_phone = $result['phone'];
$ims_cell = $result['cell'];
$ims_email = $result['email'];
$ims_tax = $result['tax'];




// echo $_SESSION['userId'];

if(!isset($_SESSION['userId'])) {
	header('Location: index.php');	
} 



?>