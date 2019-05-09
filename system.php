<?php require_once 'includes/header2.php'; ?>

<?php
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM ".$db_prefix."system where id=1";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();
?>

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
			<li class="breadcrumb-item active">System Settings</li>
		</ol>

		<div class="card">
			<div class="card-head bg-light">
				<div class="card-title float-left"> <i class="fas fa-cog"></i> System Settings</div>
			</div> <!-- /panel-heading -->

			<div class="card-body">
            <form action="php_action/editSystemSettings.php" method="post" class="form-horizontal" id="companyInfoForm">
				<fieldset>
					<legend>Change Company Information</legend>
					
						<div class="row">
							<label for="companyname" class="col-sm-2 control-label">Company Name</label>
							<div class="changeMessages"></div>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="companyname" name="companyname" value="<?PHP echo $result['company'];?>">
							</div>
						</div>
						<div class="row">
							<label for="address" class="col-sm-2 control-label">Company Address</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="address" name="address" value="<?PHP echo $result['address'];?>">
							</div>
						</div>
						<div class="row">
							<label for="city" class="col-sm-2 control-label">City / State / Zip</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="city" name="city" value="<?PHP echo $result['city'];?>">
							</div>
							<div class="col-sm-1">
								
								<input type="text" class="form-control" id="state" name="state" value="<?PHP echo $result['state'];?>">
							</div>
							<div class="col-sm-2">
								
								<input type="text" class="form-control" id="zip" name="zip" value="<?PHP echo $result['zip'];?>">
							</div>
						</div>
						<div class="row">
							<label for="city" class="col-sm-2 control-label">Phone / Cell</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="phone" name="phone" value="<?PHP echo $result['phone'];?>">
							</div>
							<div class="col-sm-2">
								
								<input type="text" class="form-control" id="cell" name="cell" value="<?PHP echo $result['cell'];?>">
							</div>
						</div>
						<div class="row">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="email" name="email" value="<?PHP echo $result['email'];?>">
							</div>

						</div>
						<div class="row">
							<label for="tax" class="col-sm-2 control-label">Tax Rate</label>
							
							<div class="col-sm-1">
								
								<input type="text" class="form-control" id="tax" name="tax" value="<?PHP echo $result['tax'];?>" placeholder="10%">
							</div>
							
						</div>
                        <div class="row">
							<div class="col-sm-offset-2 col-sm-10">
								
								<button type="submit" class="btn btn-success" data-loading-text="Loading..." id="changeSettings"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
							</div>
						</div>
					
				</fieldset>
                </form>
			</div> <!-- /panel-body -->
			

		</div> <!-- /panel -->
	</div> <!-- /col-md-12 -->
</div> <!-- /row-->


<script src="custom/js/system.js"></script>
<?php require_once 'includes/footer.php'; ?>