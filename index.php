<?php 
$ignoreAuth=true;
require_once 'includes/core.php';

if(isset($_SESSION['userId'])) {
	header('location: dashboard.php');	
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM ".$db_prefix."users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists
			echo $mainSql = "SELECT * FROM ".$db_prefix."users WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];

				// set session
				$_SESSION['userId'] = $user_id;

				header('location: dashboard.php');	
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} // /else
		} else {		
			$errors[] = "Username does not exists";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stock Management System</title>
<?PHP include("includes/pagehead.php");?>

</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-4 col-md-offset-4">
				<div class="card">
					<div class="card-head">
						<img src="assets/images/logo.png" class="col-sm-8">
					</div>
					<div class="card-head">
						<h3 class="card-title">Please Sign in</h3>
					</div>
					<div class="card-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="fas fa-exclamation"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>
						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							
							  <div class="form-group">
									
									<div class="col">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									
									<div class="col">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col">
									  <button type="submit" class="btn btn-default"> <i class="fas fa-sign-in-alt"></i> Sign in</button>
									</div>
								</div>
							
						</form>
					</div>
					<!-- panel-body -->
				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<!-- /row -->
	</div>
	<!-- container -->	
</body>
</html>