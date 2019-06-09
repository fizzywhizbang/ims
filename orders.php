<?php 
require_once 'includes/header.php'; 
?>
 <script>
  $( function() {
    $("#orderDate").datepicker({ dateFormat: 'yy-mm-dd' });
  } );
	</script>
	<?PHP

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order


?>

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	<?PHP if($_GET['o'] == 'editOrd') {?>
		<li class="breadcrumb-item"><a href="orders.php?o=manord">Manage Orders</a></li>
		<?PHP }?>
  
  	<?php if($_GET['o'] == 'add') { ?>
			<li class="active breadcrumb-item">Add Order</li>
		<?php } else if($_GET['o'] == 'manord') { ?>
			<li class="active breadcrumb-item">Manage Orders</li>
		<?php } ?>
	<?PHP if($_GET['o'] == 'editOrd' && $_GET['i']>=1) {?>
		<li class="breadcrumb-item active ">Order ID: <?PHP echo $_GET["i"];?></li>
		<?PHP }?>
</ol>


<h4>
	
	<i class="fas fa-arrow-circle-right    "></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Order";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Order";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Edit Order";
	}
	?>	
</h4>



<div class="card">
	<div class="card-header">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="fas fa-plus"></i>	Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="fas fa-edit"></i> Manage Order
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="fas fa-edit"></i> Edit Order
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order

				$clientName="";
				$clientPhone="";
				$clientAddress="";
				$clientCity="";
				$clientState="";
				$clientZip="";
				$client_id="new"; //setting client id to new just in case there is no client chosen
			if(isset($_GET['clientID'])){
				$query="select * from " . $db_prefix ."clients where id_clients=" . $_GET['clientID'];
				$client_result=$connect->query($query);
				$clientData=$client_result->fetch_row();
				$clientName=$clientData[1];
				$clientPhone=$clientData[2];
				$clientAddress=$clientData[4];
				$clientCity=$clientData[5];
				$clientState=$clientData[6];
				$clientZip=$clientData[7];
				$client_id=$clientData[0];
			}
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm" autocomplete="off">
			<!-- order form header -->
			  <div class="row">
			    <label for="orderDate" class="col-sm-1 control-label">Date</label>
			    <div class="col-sm-2">
			      <input type="text" class="form-control" id="orderDate" value="<?PHP echo date("Y-m-d");?>" name="orderDate" autocomplete="off" />
					</div>
					<label for="blank" class="col-sm-2 control-label"></label>
					<label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="clientName" name="clientName" value="<?PHP echo $clientName;?>"  placeholder="Client Name" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="row">
					<label for="orderNumber" class="col-sm-1 control-label">Order #</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="orderid" id="orderid" value="<?PHP echo prettyOrderId(getNextId(),date("Y-m-d")); ?>" readonly="readonly">
					</div>
					<label for="blank" class="col-sm-2 control-label"></label>
					<label for="clientName" class="col-sm-2 control-label">Address</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="clientAddr" name="clientAddr" value="<?PHP echo $clientAddress;?>" placeholder="Address" autocomplete="off" />
			    </div>
				</div> <!--/form-group-->
				<div class="form-row">
				<label for="orderNumber" class="col-sm-1 control-label"></label>
					<div class="col-sm-2">
						&nbsp;
					</div>
					<label for="blank" class="col-sm-2 control-label"></label>
			    <label for="clientContact" class="col-sm-2 control-label">City/ST/Zip</label>
			    
						<div class="col">
						<input type="text" class="form-control" id="clientCity" name="clientCity" value="<?PHP echo $clientCity;?>" placeholder="City" autocomplete="off" />
						</div>
						<div class="col">
						<input type="text" class="form-control" id="clientState" name="clientState" placeholder="ST" value="<?PHP echo $clientState;?>" autocomplete="off" />
						</div>
						<div class="col">
						<input type="text" class="form-control" id="clientZip" name="clientZip" placeholder="Zip" value="<?PHP echo $clientZip;?>" autocomplete="off" />
						</div>
						<input type="hidden" name="client_id" id="client_id" value="<?PHP echo $client_id;?>">
						
			    
			  </div> <!--/form-group-->		
			  <div class="row">
				<label for="orderNumber" class="col-sm-1 control-label"></label>
					<div class="col-sm-2">
						&nbsp;
					</div>
					<label for="blank" class="col-sm-2 control-label"></label>
			    <label for="clientContact" class="col-sm-2 control-label">Phone</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control phone" id="clientContact" name="clientContact" value="<?PHP echo $clientPhone;?>" placeholder="Contact Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->			  
	<!-- end order form header -->

	<!-- notes -->
	<div class="row">
		<div class="col-lg-12">
		<label for="notes" class="control-label float-left">&nbsp;Notes</label>
		</div>
	
		<div class="col-xl-12">
			
			<textarea rows="4" class="form-control" style="width:95%; display: block; margin-left: auto; margin-right: auto;" name="notes" id="notes"></textarea>
		</div>
		
	</div>
	<!-- end notes -->
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
							<th>Product</th>
							<th>Description</th>
			  			<th>Rate</th>
			  			<th>Available</th>
			  			<th>Quantity</th>			  			
			  			<th>Total</th>			  			
			  			<th><i class="fas fa-plus text-success" onclick="addRow()"></i></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control input-sm" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM ".$db_prefix."product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
								</td>
								<td>
									<input type="text" name="description[]" id="description<?PHP echo $x;?>" autocomplete="off" class="form-control input-sm">
								</td>
			  				<td>			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control input-sm small-input" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control input-sm" />			  					
			  				</td>
							<td>
			  					<div class="form-group ">
									<p id="available_quantity<?php echo $x; ?>"></p>
			  					</div>
			  				</td>
			  				<td>
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" onclick="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control input-sm small-input" min="1" />
			  					</div>
			  				</td>
			  				<td>			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control input-sm small-input" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fas fa-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-12">
			  	<div class="row">
					<label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-3">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Check</option>
				      	<option value="2">Cash</option>
								<option value="3">Credit Card</option>
								<option value="4">Trade</option>
								<option value="5">Estimate/Quote</option>
				      </select>
				    </div>
				    <label for="subTotal" class="col-sm-3 control-label">Subtotal</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  
				   <!--/form-group-->			  
				  <div class="row">
					<label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-3">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Full Payment</option>
				      	<option value="2">Advance Payment</option>
				      	<option value="3">No Payment</option>
				      </select>
						</div>
						
						<label for="totalAmount" class="col-sm-3 control-label">Total <small><i>w/tax</i></small></label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				    
				  </div> <!--/form-group-->			  
				  <div class="row">
					<label for="clientContact" class="col-sm-3 control-label">Payment Place</label>
				    <div class="col-sm-3">
				      <select class="form-control" name="paymentPlace" id="paymentPlace" onchange="subAmount()">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Local</option>
				      	<option value="2">Out of state</option>
				      </select>
						</div>
						<label for="discount" class="col-sm-3 control-label">Discount<small class="text-red"><i> dollar amount</i></small></label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="discount" name="discount" value="0" onkeyup="discountFunc()" autocomplete="off" />
				    </div>
				    
				  </div> <!--/form-group-->	
				  <div class="row">
									<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">
							
				    </div>
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="row">
					<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
						</div>
						<label for="vat" class="col-sm-3 control-label gst">Tax <?PHP echo $ims_tax;?></label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="vat" name="gstn" value="<?PHP echo $ims_tax;?>" readonly="true" />
							<input type="hidden" class="form-control" id="vatValue" name="vatValue" />
							<input type="hidden" class="form-control" id="taxrate" value="<?PHP echo $ims_tax;?>">
				    </div>
				    
				  </div>	  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-12">
			  	<div class="row">
					<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
				    </div>
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="paid" name="paid" value="0" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="row">
					<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
				    </div>
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> <!--/form-group-->		
								  					  
			  </div> <!--/col-md-6-->
						

			  <div class="row submitButtonFooter justify-content-end">
				<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
						</div>
						<label for="blank" class="col-sm-1 control-label"></label>
			    <div class="col-md-5 ml-auto mr-3">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fas fa-plus"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="fas fa-thumbs-up    "></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="fas fa-eraser    "></i> Reset</button>
			    </div>
			  </div>
			</form>
			<br>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>
			<div id="success-messages"></div>
			
			<table class="table" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Order Number</th>
						<th>Client Name</th>
						<th>Contact</th>
						<th>Total Order Item</th>
						<th>Payment Status</th>
						<th>Option</th>
					</tr>
				</thead>
			</table>

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT ".$db_prefix."orders.order_id, ".$db_prefix."orders.order_date, ".$db_prefix."orders.client_name, ".$db_prefix."orders.client_contact, ".$db_prefix."orders.sub_total, ".$db_prefix."orders.vat, ".$db_prefix."orders.total_amount, ".$db_prefix."orders.discount, ".$db_prefix."orders.grand_total, ".$db_prefix."orders.paid, ".$db_prefix."orders.due, ".$db_prefix."orders.payment_type, ".$db_prefix."orders.payment_status,".$db_prefix."orders.payment_place,".$db_prefix."orders.gstn, ".$db_prefix."orders.notes FROM ".$db_prefix."orders 	
					WHERE ".$db_prefix."orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();
				
				$query="select * from " . $db_prefix ."clients where id_clients=" . $data[2];
				$client_result=$connect->query($query);
				$clientData=$client_result->fetch_row();


  			?>
				
				<div class="row">
					<label for="orderDate" class="col-sm-1 control-label">Date</label>
					
			    <div class="col-sm-2">
			      <input type="text" class="form-control" id="orderDate" value="<?php echo $data[1] ?>" name="orderDate" autocomplete="off" />
					</div>
					<label for="blank" class="col-sm-2 control-label"></label>
					<label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-5">
						<input type="text" class="form-control" id="clientName" name="clientName" value="<?PHP echo $clientData[1]; ?>" placeholder="Client Name" autocomplete="off" />
						<input type="hidden" name="client_id" id="client_id" value="<?PHP echo $clientData[0];?>">
			    </div>
			  </div> <!--/form-group-->
			  <div class="row">
					<label for="orderNumber" class="col-sm-1 control-label">Order #</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="orderNumber" id="orderNumber" value="<?PHP echo prettyOrderId($data[0],$data[1]); ?>" readonly="readonly">
					</div>
					<label for="blank" class="col-sm-2 control-label"></label>
					<label for="clientName" class="col-sm-2 control-label">Address</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="clientAddr" readonly="readonly" name="clientAddr" value="<?PHP echo $clientData[4]; ?>" placeholder="Address" autocomplete="off" />
			    </div>
				</div> <!--/form-group-->
				<div class="form-row">
				<label for="orderNumber" class="col-sm-1 control-label"></label>
					<div class="col-sm-2">
						&nbsp;
					</div>
					<label for="blank" class="col-sm-2 control-label"></label>
			    <label for="clientContact" class="col-sm-2 control-label">City/ST/Zip</label>
			    
						<div class="col">
						<input type="text" class="form-control" id="clientCity" readonly="readonly" name="clientCity" value="<?PHP echo $clientData[5]; ?>" placeholder="City" autocomplete="off" />
						</div>
						<div class="col">
						<input type="text" class="form-control" id="clientState" readonly="readonly" name="clientState" value="<?PHP echo $clientData[6]; ?>" placeholder="ST" autocomplete="off" />
						</div>
						<div class="col">
						<input type="text" class="form-control" id="clientZip" readonly="readonly" name="clientZip" placeholder="Zip" value="<?PHP echo $clientData[7]; ?>" autocomplete="off" />
						</div>
						
						
			    
			  </div> <!--/form-group-->		
			  <div class="row">
				<label for="orderNumber" class="col-sm-1 control-label"></label>
					<div class="col-sm-2">
						&nbsp;
					</div>
					<label for="blank" class="col-sm-2 control-label"></label>
			    <label for="clientContact" class="col-sm-2 control-label">Phone</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="clientContact" value="<?PHP echo $clientData[2]; ?>" name="clientContact" readonly="readonly" placeholder="Contact Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
	<!-- notes -->
	<div class="row">
		<div class="col-lg-12">
		<label for="notes" class="control-label float-left">&nbsp;Notes</label>
		</div>
	
		<div class="col-xl-12">
			
			<textarea rows="4" class="form-control" style="width:95%; display: block; margin-left: auto; margin-right: auto;" name="notes" id="notes"><?PHP echo $data[15]; ?></textarea>
		</div>
		
	</div>
	<!-- end notes -->
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
							<th>Product</th>
							<th>Description</th>
			  			<th>Rate</th>
			  			<th>Available</th>			  			
			  			<th>Quantity</th>			  			
			  			<th>Total</th>			  			
			  			<th><button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fas fa-plus"></i></button></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT * FROM ".$db_prefix."order_item WHERE ".$db_prefix."order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">
										<input type="hidden" name="order_item_id[]" value="<?PHP echo $orderItemData['order_item_id'];?>">
										<input type="hidden" name="productName[]" id="productName<?php echo $x; ?>" value="<?PHP echo $orderItemData['product_id'];?>">
			  					<select class="form-control" name="productNameDisplay" disabled="disabled" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM ".$db_prefix."product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >" .$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
								</td>
								<td>
									<input type="text" name="description[]" id="description<?PHP echo $x;?>" value="<?php echo $orderItemData['description']; ?>" autocomplete="off" class="form-control input-sm">
								</td>
			  				<td>			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control small-input" value="<?php echo $orderItemData['rate']; ?>" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
			  				</td>
							<td>
			  					<div class="form-group">
									<?php

											echo "<p id='available_quantity".$row['product_id']."'>" . getProdQty($orderItemData['product_id']) . "</p>";
			  					
			  						?>
									
			  					</div>
			  				</td>
			  				<td>
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" onclick="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control small-input" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
			  					</div>
			  				</td>
			  				<td>			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control small-input" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
									<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control small-input" value="<?php echo $orderItemData['total']; ?>"/>	
									<input type="hidden" name="order_item_status[]" id="order_item_status<?PHP echo $x;?>" value="<?PHP echo $orderItemData['order_item_status'];?>">		  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fas fa-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-12">
			  	<div class="row">
						 <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-3">
				      <select class="form-control" name="paymentType" id="paymentType" >
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[11] == 1) {
				      		echo "selected";
				      	} ?> >Check</option>
				      	<option value="2" <?php if($data[11] == 2) {
				      		echo "selected";
				      	} ?>  >Cash</option>
				      	<option value="3" <?php if($data[11] == 3) {
				      		echo "selected";
								} ?> >Credit Card</option>
								<option value="4" <?php if($data[11] == 4) {
				      		echo "selected";
								} ?>>Trade</option>
								<option value="5" <?php if($data[11] == 5) {
				      		echo "selected";
								} ?>>Estimate/Quote</option>
				      </select>
				    </div>
				    <label for="subTotal" class="col-sm-3 control-label">Subtotal</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[4] ?>" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[4] ?>" />
				    </div>
				  </div> <!--/form-group-->			  
				  			  
				  <div class="row">
					<label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-3">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[12] == 1) {
				      		echo "selected";
				      	} ?>  >Full Payment</option>
				      	<option value="2" <?php if($data[12] == 2) {
				      		echo "selected";
				      	} ?> >Advance Payment</option>
				      	<option value="3" <?php if($data[12] == 3) {
				      		echo "selected";
				      	} ?> >No Payment</option>
				      </select>
				    </div>
				    <label for="totalAmount" class="col-sm-3 control-label">Total <small><i>w/tax</i></small></label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[6] ?>" />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $data[6] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="row">
					<label for="clientContact" class="col-sm-3 control-label">Payment Place</label>
				    <div class="col-sm-3">
				      <select class="form-control" name="paymentPlace" id="paymentPlace">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[13] == 1) {
				      		echo "selected";
				      	} ?>  >Local</option>
				      	<option value="2" <?php if($data[13] == 2) {
				      		echo "selected";
				      	} ?> >Out of state</option>
				      </select>
				    </div>
				  
				    <label for="discount" class="col-sm-3 control-label">Discount<small class="text-red"><i> dollar amount</i></small></label>
				    <div class="col-sm-3">
							<input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="<?php echo $data[7] ?>" />
				    </div>
					</div> <!--/form-group-->
					
				  <div class="row">
					<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
				    </div>
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $data[8] ?>"  />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $data[8] ?>"  />
				    </div>
				  </div> <!--/form-group-->	
				  
				  <div class="row">
					<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
						</div>
						<label for="vat" class="col-sm-3 control-label gst">Tax <?PHP echo $ims_tax;?></label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="vat" name="gstn" value="<?PHP echo $ims_tax;?>" readonly="true" />
							<input type="hidden" class="form-control" id="vatValue" name="vatValue" />
							<input type="hidden" class="form-control" id="taxrate" value="<?PHP echo $ims_tax;?>">
				    </div>
				  </div><!--/form-group-->		  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-12">
			  	<div class="row">
					<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
				    </div>
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $data[9] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="row">
					<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
				    </div>
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $data[10] ?>"  />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $data[10] ?>"  />
				    </div>
				  </div> <!--/form-group-->		
				 						  
				 
			
								<br>
			  <div class="row justify-content-end editButtonFooter">
					
				<label for="blank" class="col-sm-3 control-label"></label>
				    <div class="col-sm-3">	      
				    </div>
			    <div class="col-md-5 ml-auto mr-3">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fas fa-plus"></i> Add Row </button>

			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="fas fa-thumbs-up"></i> Save Changes</button>
			      
			    </div>
				</div>
				<br>
			</form>

			<?php
		} // /get order else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	


<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fas fa-edit"></i> Edit Payment</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>

      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />					
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType" >
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Cheque</option>
			      	<option value="2">Cash</option>
							<option value="3">Credit Card</option>
							<option value="4">Trade</option>
								<option value="5">Estimate/Quote</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Full Payment</option>
			      	<option value="2">Advance Payment</option>
			      	<option value="3">No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  				  
      	        
      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fas fa-trash"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="fas fa-thumbs-up"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fas fa-trash"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="fas fa-thumbs-up"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->


<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	