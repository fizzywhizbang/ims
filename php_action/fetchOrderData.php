<?php 	

require_once '../includes/core.php';

$orderId = $_POST['orderId'];

$valid = array('order' => array(), 'order_item' => array());

$sql = "SELECT ".$db_prefix."orders.order_id, ".$db_prefix."orders.order_date, ".$db_prefix."orders.client_name, ".$db_prefix."orders.client_contact, ".$db_prefix."orders.sub_total, ".$db_prefix."orders.vat, ".$db_prefix."orders.total_amount, ".$db_prefix."orders.discount, ".$db_prefix."orders.grand_total, ".$db_prefix."orders.paid, ".$db_prefix."orders.due, ".$db_prefix."orders.payment_type, ".$db_prefix."orders.payment_status FROM ".$db_prefix."orders 	
	WHERE ".$db_prefix."orders.order_id = {$orderId}";

$result = $connect->query($sql);
$data = $result->fetch_row();
$valid['order'] = $data;


$connect->close();

echo json_encode($valid);