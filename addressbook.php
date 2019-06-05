<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>		  
		  <li class="breadcrumb-item active">Addressbook</li>
		</ol>

		<div class="card panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="fas fa-edit"></i> Manage Addressbook</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addUserModalBtn" data-target="#addUserModal"> <i class="fas fa-plus-sign"></i> Add Contact </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageUserTable">
					<thead>
						<tr>
							<th style="width:10%;">Contact Name</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add user -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitUserForm" action="php_action/createUser.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-plus"></i> Add Contact</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-user-messages"></div>

	      		     	           	       

	        <div class="row">
	        	<label for="clientname" class="col-sm-3 control-label">Client Name: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="clientname" placeholder="client name" name="clientname" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="row">
	        	<label for="phone" class="col-sm-3 control-label">Phone: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	        	 

	        <div class="row">
	        	<label for="uemail" class="col-sm-3 control-label">Email: </label>
	        	
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="uemail" placeholder="Email" name="uemail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	 
            <div class="row">
	        	<label for="address" class="col-sm-3 control-label">Address: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="address" placeholder="Address" name="address" autocomplete="off">
				    </div>
            </div> <!-- /form-group-->
            <div class="row">
	        	<label for="city" class="col-sm-3 control-label">City: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="city" placeholder="City" name="city" autocomplete="off">
				    </div>
            </div> <!-- /form-group-->
            <div class="row">
	        	<label for="state" class="col-sm-3 control-label">State: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="state" placeholder="ST" name="state" autocomplete="off">
				    </div>
            </div> <!-- /form-group-->
            <div class="row">
	        	<label for="zip" class="col-sm-3 control-label">Zip: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="zip" placeholder="12345" name="zip" autocomplete="off">
				    </div>
            </div> <!-- /form-group-->
            <div class="row">
	        	<label for="info" class="col-sm-3 control-label">Info: </label>
	        	
				    <div class="col-sm-8">
                        <textarea rows="5" cols="30" name="info" id="info"></textarea>
				      
				    </div>
	        </div> <!-- /form-group-->						         	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fas fa-window-close    "></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createUserBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fas fa-thumbs-up"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-edit"></i> Edit User</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#userInfo" aria-controls="profile" role="tab" data-toggle="tab">User Info</a></li>    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">

				  	
				    
				    <!-- product image -->
				    <div role="tabpanel" class="tab-pane active" id="userInfo">
				    	<form class="form-horizontal" id="editUserForm" action="php_action/editUser.php" method="POST">				    
				    	<br />

				    	<div id="edit-user-messages"></div>

				    	<div class="form-group">
			        		<label for="edituserName" class="col-sm-3 control-label">User Name: </label>
			        	
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="edituserName" placeholder="User Name" name="edituserName" autocomplete="off">
						    </div>
			        	</div> <!-- /form-group-->	    

				        <div class="form-group">
				        	<label for="editPassword" class="col-sm-3 control-label">Password: </label>
				        	
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="editPassword" placeholder="Password" name="editPassword" autocomplete="off">
							    </div>
				        </div> <!-- /form-group-->	        	 

			         
         	        

			        <div class="modal-footer editUserFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fas fa-window-close    "></i> Close</button>
				        
				        <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="fas fa-tuhumbs-up"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /product info -->
				  </div>

				</div>
	      	
	      </div> <!-- /modal-body -->
	      	      
     	
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeUserModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
			<h4 class="modal-title"><i class="fas fa-trash"></i> Remove User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">

      	<div class="removeUserMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close    "></i>  Close</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="fas fa-thumbs-up"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/addressbook.js"></script>

<?php require_once 'includes/footer.php'; ?>