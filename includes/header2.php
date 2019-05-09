<?php require_once 'php_action/core.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <title><?PHP echo $ims_companyname;?> Stock Management System</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script   src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    
    
  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">
  
  <!-- print pdf -->
  <!-- <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script> -->
  <script>
  $( function() {
    $("#orderDate").datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
</head>
<body>

<nav class="navbar navbar-light navbar-expand-lg  bg-light">
  <a class="navbar-brand mb-0 h1" href="#"><?PHP echo $ims_companyname;?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item" id="navDashboard"><a class="nav-link" href="index.php"><i class="fas fa-list-alt    "></i>  Dashboard</a></li>        
        <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li class="nav-item" id="navBrand">
            <a class="nav-link" href="brand.php"><i class="fas fa-barcode    "></i>  Brand</a>
        </li>        
		<?php } ?>
		<?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li class="nav-item" id="navCategories">
            <a class="nav-link" href="categories.php"><i class="fas fa-list    "></i> Category</a>
        </li>        
		<?php } ?>
		<?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li class="nav-item" id="navProduct"><a class="nav-link" href="product.php"><i class="fas fa-store    "></i> Product </a></li> 
		<?php } ?>
   
		
        <li  class="nav-item dropdown" id="navOrder">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-shopping-basket    "></i> Orders <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li class="dropdown-item" id="topNavAddOrder"><a class="dropdown-item" href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Orders</a></li>            
            <li class="dropdown-item" id="topNavManageOrder"><a class="dropdown-item" href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>            
          </ul>
        </li> 
		
		<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li id="navReport"><a class="nav-link" href="report.php"> <i class="fas fa-check    "></i> Report </a></li>
    <?php } ?>   
    <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li class="nav-item" id="navSystem"><a class="nav-link" href="system.php"><i class="fas fa-cog"></i> System Settings </a></li> 
		<?php } ?>
        <li class="nav-item dropdown" id="navSetting">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-cogs" aria-hidden="true"></i> User<span class="caret"></span></a>
          <ul class="dropdown-menu">    
			<?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
            <li class="dropdown-item" id="topNavSetting"><a class="dropdown-item" href="setting.php"> <i class="fas fa-wrench"></i> Setting</a></li>
            <li class="dropdown-item" id="topNavUser"><a href="user.php"> <i class="fas fa-wrench"></i> Add User</a></li>
<?php } ?>              
            <li class="dropdown-item" id="topNavLogout"><a class="dropdown-item" href="logout.php"> <i class="fas fa-lock    "></i> Logout</a></li>            
          </ul>
        </li>        
    </ul>
  </div>
</nav>

<br>
	<div class="container">