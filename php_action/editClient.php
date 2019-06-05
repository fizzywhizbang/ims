<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
    $client_name = $_POST['clientname'];
    $client_phone = $_POST['phone'];
    $client_email = $_POST['uemail'];
    $clent_address = $_POST['address'];
    $client_city = $_POST['city'];
    $client_state = $_POST['state'];
    $client_zip = $_POST['zip'];
    $client_info = addslashes($_POST['info']);
    $client_id = $_POST["id_clients"];

                $sql = "update ".$db_prefix."clients set client_name=\"". $client_name ."\", client_phone=\"".$client_phone."\", client_email=\"".$client_email."\", client_address=\"".$clent_address."\",client_city=\"".$client_city."\", client_state=\"".$client_state."\", client_zip=\"".$client_zip."\", client_info=\"".$client_info."\"";
                $sql .=" where id_clients=" . $client_id;




				
				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

				// /else	
		
	} // if in_array 		

	$connect->close();

	echo json_encode($valid);