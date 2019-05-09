<?php 	

$webroot = "ims/";
$db_prefix = "ims_";
$localhost = "localhost";
$username = "sparky";
$password = "NGKD@t@b@se";
$dbname = "sparky";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>