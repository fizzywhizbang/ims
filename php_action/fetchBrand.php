<?php 	

require_once 'core.php';

$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM ".$db_prefix."brands WHERE brand_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeBrands = ""; 

 while($row = $result->fetch_array()) {
 	$brandId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeBrands = "<label class='btn btn-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeBrands = "<label class='btn btn-danger'>Not Available</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li class="dropdown-item"><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="fas fa-edit    "></i> Edit</a></li>
	    <li class="dropdown-item"><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="fas fa-trash    "></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeBrands,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);