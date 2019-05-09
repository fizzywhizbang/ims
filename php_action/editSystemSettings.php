<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$editCompanyName = $_POST['companyname'];
	$editaddress 		= $_POST['address'];
	$editcity 		= $_POST['city'];
    $editstate  = $_POST['state'];
    $editzip    = $_POST['zip'];
    $editphone  = $_POST['phone'];
    $editcell   = $_POST['cell'];
    $editemail  = $_POST['email'];
    $tax = $_POST['tax'];
				
    $sql = "UPDATE `sparky`.`ims_system`
    SET
    `company` = \"".$editCompanyName."\",
    `address` = \"".$editaddress."\",
    `city` = \"".$editcity."\",
    `state` = \"".$editstate."\",
    `zip` = \"".$editzip."\",
    `phone` = \"".$editphone."\",
    `cell` = \"".$editcell."\",
    `email` = \"".$editemail."\",
    `tax` = \"".$tax."\"
    WHERE `id` = 1;
    ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update <a href='system.php'><i>Click here to refresh the page if you changed the company name</i></a>";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
