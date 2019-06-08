<?php 	

require_once '../includes/core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$clientid = $_POST['clientid'];

if($clientid) { 

 $sql = "DELETE FROM ".$db_prefix."clients  WHERE id_clients = {$clientid}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the user";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST