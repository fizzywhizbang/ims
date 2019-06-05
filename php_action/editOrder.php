<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	//update static items from the invoice
	$orderId = $_POST['orderId'];
	$orderDate = date('Y-m-d', strtotime($_POST['orderDate']));
	$clientName = $_POST['client_id'];
	$clientContact = $_POST['clientContact'];
	$subTotalValue = $_POST['subTotalValue'];
	$vatValue =	$_POST['vatValue'];
	$totalAmountValue = $_POST['totalAmountValue'];
	$discount = $_POST['discount'];
	$grandTotalValue = $_POST['grandTotalValue'];
	$paid = $_POST['paid'];
	$dueValue = $_POST['dueValue'];
	$paymentType = $_POST['paymentType'];
	$paymentStatus = $_POST['paymentStatus'];
	$paymentPlace = $_POST['paymentPlace'];
	$gstn = $_POST['gstn'];
	$userid = $_SESSION['userId'];
	$orderNumber = $_POST['orderNumber'];			
	//update base order data
	$sql = "UPDATE ".$db_prefix."orders SET order_date = '$orderDate', client_name = '$clientName', client_contact = '$clientContact', sub_total = '$subTotalValue', vat = '$vatValue', total_amount = '$totalAmountValue', discount = '$discount', grand_total = '$grandTotalValue', paid = '$paid', due = '$dueValue', payment_type = '$paymentType', payment_status = '$paymentStatus', order_status = 1 ,user_id = '$userid',payment_place = '$paymentPlace' , gstn = '$gstn', orderid='$orderNumber' WHERE order_id = {$orderId}";	
	$connect->query($sql);
	/// end update static

	//to be removed
	/*
	plan is to select the product id count and update table based on diff
	followed by return or remove from product availability based on returning a negative or positive integer
	1) loop through product id(s)
	2) get product quantity available
	3) check if order_item_id == new
		4) if not new then
			4.1) query order_item for quantity of item
			4.2)	return to inventory if qty decreased
			4.3)	remove from inventory if qty increased
		5) if new
			5.1) add to order_item
			5.2) then remove quantity from product availability
	
		***need something for orphaned order items
	*/


	//1)
	for($i = 0; $i < count($_POST['productName']); $i++) {
		//2)
		$quantity_available=getProdQty($_POST['productName'][$i]);
		if($_POST['order_item_id'][$i] != "new"){ //3
			//4.1) query order_item for quantity of item
			$order_item_sql="select quantity from " . $db_prefix ."order_item where order_item_id=" . $_POST["order_item_id"][$i];
			$order_item_query = $connect->query($order_item_sql);
			$order_item_data = $order_item_query->fetch_row();
			$order_item_quantity=$order_item_data[0];

			$total = $_POST['quantity'][$i] * $_POST['rateValue'][$i];

			if($order_item_quantity==$_POST['quantity'][$i]){
				// do nothing as there is no change
			} elseif ($order_item_quantity > $_POST['quantity'][$i]){ //if the quantity is decreased remove from
				//4.2) we removed from order
				$difference = $order_item_quantity - $_POST['quantity'][$i];
				// add the difference back to inventory
				$newval = $quantity_available + $difference;
				$updateInventory="update " . $db_prefix . "product set quantity=" . $newval . " where product_id=" . $_POST['productName'][$i];
				$connect->query($updateInventory);
				//calc new total
				$updateOrderItems="update " . $db_prefix . "order_item set quantity='" . $_POST['quantity'][$i] . "', total=".$total." where order_item_id=" . $_POST["order_item_id"][$i];
				$connect->query($updateOrderItems);
			} else { //
				//4.3) we added to order
				$difference =$_POST['quantity'][$i] - $order_item_quantity;
				// subtract the difference back from inventory
				$newval = $quantity_available - $difference;
				$updateInventory="update " . $db_prefix . "product set quantity=" . $newval . " where product_id=" . $_POST['productName'][$i];
				$connect->query($updateInventory);

				$updateOrderItems="update " . $db_prefix . "order_item set quantity='" . $_POST['quantity'][$i] . "', total=".$total." where order_item_id=" . $_POST["order_item_id"][$i];
				$connect->query($updateOrderItems);
			}
			

		} else { //5
			//add new items here
			//5.1) add to order_item
			$insertQuery="insert into " . $db_prefix . "order_item (order_id,product_id,quantity,rate,total,order_item_status) values (".$orderId.",'".$_POST["productName"][$i]."','".$_POST["quantity"][$i]."','".$_POST["rateValue"][$i]."',".$total.",'1')";
			$connect->query($insertQuery);
			//5.2) then remove quantity from product availability
			$newval = $quantity_available - $_POST['quantity'][$i];
			$updateInventory="update " . $db_prefix . "product set quantity=" . $newval . " where product_id=" . $_POST['productName'][$i];
			$connect->query($updateInventory);
		}

	}	

	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);