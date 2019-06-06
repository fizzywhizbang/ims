<?php 	



require_once 'core.php';

$sql = "SELECT * FROM ".$db_prefix."clients";

$result = $connect->query($sql);

$output = array('data' => array());
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$userid = $row[0];
 	// active 
 	$username = $row[1];

$phone = $row[2];

$email = $row[3];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a class="dropdown-item" data-toggle="modal" id="editUserModalBtn" data-target="#editUserModal" onclick="editUser('.$userid.')"> <i class="fas fa-edit"></i> Edit</a></li>
	    <li><a class="dropdown-item" data-toggle="modal" data-target="#removeUserModal" id="removeUserModalBtn" onclick="removeUser('.$userid.')"> <i class="fas fa-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	

 	$output['data'][] = array( 		
 		// name
		 $username,
		 //phone
		 $phone,
		 //email
		 $email,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);