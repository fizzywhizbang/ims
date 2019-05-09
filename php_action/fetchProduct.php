<?php 	
require_once 'core.php';

$sql = "SELECT ".$db_prefix."product.product_id, ".$db_prefix."product.product_name, ".$db_prefix."product.product_image, ".$db_prefix."product.brand_id,
".$db_prefix."product.categories_id, ".$db_prefix."product.quantity, ".$db_prefix."product.rate, ".$db_prefix."product.active, ".$db_prefix."product.status, 
".$db_prefix."brands.brand_name, ".$db_prefix."categories.categories_name FROM ".$db_prefix."product 
		INNER JOIN ".$db_prefix."brands ON ".$db_prefix."product.brand_id = ".$db_prefix."brands.brand_id 
		INNER JOIN ".$db_prefix."categories ON ".$db_prefix."product.categories_id = ".$db_prefix."categories.categories_id  
		WHERE ".$db_prefix."product.status = 1 AND ".$db_prefix."product.quantity > 0";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];
 	// active 
 	if($row[7] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Available</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" class="dropdown-item" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="fas fa-edit    "></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" class="dropdown-item" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="fas fa-trash    "></i> Remove</a></li>       
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

	$brand = $row[9];
	$category = $row[10];

	$imageUrl = substr($row[2], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// product name
 		$row[1], 
 		// rate
 		$row[6],
 		// quantity 
 		$row[5], 		 	
 		// brand
 		$brand,
 		// category 		
 		$category,
 		// active
 		$active,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);