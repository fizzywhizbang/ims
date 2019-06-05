<?php 	

require_once 'core.php';

$sql = "SELECT order_id, order_date, client_name, client_contact, payment_status, orderid FROM ".$db_prefix."orders WHERE order_status = 1";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $paymentStatus = ""; 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$orderId = $row[0];

 	$countOrderItemSql = "SELECT count(*) FROM ".$db_prefix."order_item WHERE order_id = $orderId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	// active 
 	if($row[4] == 1) { 		
 		$paymentStatus = "<label class='label label-success'>Full Payment</label>";
 	} else if($row[4] == 2) { 		
 		$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
 	} else { 		
 		$paymentStatus = "<label class='label label-warning'>No Payment</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li class="dropdown-item"><a class="dropdown-item" href="orders.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="fas fa-edit"></i> Edit</a></li>
	    
	    <li class="dropdown-item"><a class="dropdown-item" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$orderId.')"> <i class="fas fa-save"></i> Payment</a></li>

		<li class="dropdown-item"><a class="dropdown-item" onclick="printOrder('.$orderId.')"> <i class="fas fa-print"></i> Print </a></li>

		<!-- <li><a class="dropdown-item" onclick="printPDF('.$orderId.')"> <i class="fas fa-save-file"></i> Download PDF </a></li>-->
	    
	    <li class="dropdown-item"><a class="dropdown-item" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="fas fa-trash"></i> Remove</a></li>       
	  </ul>
	</div>';		

 	$output['data'][] = array( 		
 		// image
 		$x,
 		// order date
 		$row[5],
 		// client name
 		$row[2], 
 		// client contact
 		$row[3], 		 	
 		$itemCountRow, 		 	
 		$paymentStatus,
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);