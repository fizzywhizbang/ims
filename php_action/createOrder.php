<?php 	

require_once '../includes/core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	


	$orderDate 						= date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName 					= $_POST['client_id'];
  $clientContact 				= $_POST['clientContact'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 						=	$_POST['vatValue'];
  $totalAmountValue     = $_POST['totalAmountValue'];
  $discount 						= $_POST['discount'];
  $grandTotalValue 			= $_POST['grandTotalValue'];
  $paid 								= $_POST['paid'];
  $dueValue 						= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];
  $paymentPlace 				= $_POST['paymentPlace'];
  $gstn 				= $_POST['gstn'];
  $userid 				= $_SESSION['userId'];
  $clientAddr = $_POST["clientAddr"];
  $clientCity = $_POST["clientCity"];
  $clientState = $_POST["clientState"];
  $clientZip = $_POST["clientZip"];


	$notes = addslashes($_POST["notes"]);
//need to add if there is no client id to create the client on the fly
if($_POST["client_id"]=="new"){
	//add the client on the fly
	$query="insert into ".$db_prefix."clients (client_name, client_phone, client_address, client_city, client_state,client_zip) values";
	$query.="(\"".$_POST["clientName"]."\",\"".$clientContact."\",\"".$clientAddr."\",\"".$clientCity."\",\"".$clientState."\",\"".$clientZip."\")";
	$connect->query($query);
	$clientName=$connect->insert_id;
}
  

  //create pretty order id

				
  $sql = "INSERT INTO ".$db_prefix."orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status,payment_place, gstn,order_status,user_id,notes) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus,$paymentPlace,$gstn, 1,$userid,'$notes')";

  $order_id;
  $orderStatus = false;
  if($connect->query($sql) === true) {
	  $order_id = $connect->insert_id;
	  $valid['order_id'] = $order_id;	
	  $query="update " . $db_prefix . "orders set orderid='" . prettyOrderId($order_id, $orderDate) . "' where order_id=" . $order_id;
	  $connect->query($query);
	  $orderStatus = true;
  }

		
	// echo $_POST['productName'];
	$orderItemStatus = false;
if($orderStatus==true){


	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT ".$db_prefix."product.quantity FROM ".$db_prefix."product WHERE ".$db_prefix."product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE ".$db_prefix."product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO ".$db_prefix."order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

				$connect->query($orderItemSql);		

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity
} //order status true
	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);