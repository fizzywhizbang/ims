<?php require_once 'includes/header2.php'; ?>

<?php 

$sql = "SELECT * FROM ".$db_prefix."product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM ".$db_prefix."orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = "";
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM ".$db_prefix."product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$userwisesql = "SELECT ".$db_prefix."users.username , SUM(".$db_prefix."orders.grand_total) as totalorder FROM ".$db_prefix."orders INNER JOIN ".$db_prefix."users ON ".$db_prefix."orders.user_id = ".$db_prefix."users.user_id WHERE ".$db_prefix."orders.order_status = 1 GROUP BY ".$db_prefix."orders.user_id";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

$connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">

<div class="row">
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="col-md-4">
	<a href="product.php" style="text-decoration:none;color:black;">
		<div class="card text-left">
			
				<div class="card-header alert-success">
				
					Total Product
					<span class="badge-success float-right">&nbsp;<?php echo $countProduct; ?>&nbsp;</span>	
				
				</div>
			
		</div>
		</a>
	</div> <!--/col-md-4-->
	
	<div class="col-md-4">
	<a href="product.php" style="text-decoration:none;color:black;">
		<div class="card text-left">
		
			<div class="card-header alert-danger">
				
					Low Stock
					<span class="alert-danger float-right"><?php echo $countLowStock; ?></span>	
				
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</a>
	</div> <!--/col-md-4-->
	
	
	<?php } ?>  
		<div class="col-md-4">
		<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
			<div class="card text-left">
			
			<div class="card-header alert-info">
			
					Total Orders
					<span class="alert-info float-right"><?php echo $countOrder; ?></span>
				
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</a>
		</div> <!--/col-md-4-->
	</div>
	<br>
<div class="row">
	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader header-blue">
		    <h1><?php if($totalRevenue) {
		    	echo $totalRevenue;
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p>Total Revenue</p>
		  </div>
		</div> 

	</div>
	
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header bg-light text-blue"> 
		<div class="float-left"> <i class="fas fa-calendar text-blue"></i> Orders</div>
		<div class="float-right"><a href="orders.php?o=add" class="text-blue"><i class="fas fa-plus-square"></i></a> </div>
		<br>
		</div>
			<div class="card-body">
				<table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Name</th>
			  			<th style="width:20%;">Orders</th>
			  		</tr>
			  	</thead>
			  	<tbody>
					<?php while ($orderResult = $userwiseQuery->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $orderResult['username']?></td>
							<td><?php echo $orderResult['totalorder']?></td>
							
						</tr>
						
					<?php } ?>
				</tbody>
				</table>
				<!--<div id="calendar"></div>-->
			</div>	
		</div>
		
	</div> 
	<?php  } ?>
	
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<?php require_once 'includes/footer.php'; ?>