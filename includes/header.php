<?php require_once 'php_action/core.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <?PHP include("includes/pagehead.php");?>
</head>
<body>

<nav class="navbar navbar-light navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><?PHP echo $ims_companyname;?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
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
    
        <li class="nav-item dropdown" id="navSetting">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-cogs" aria-hidden="true"></i> User<span class="caret"></span></a>
          <ul class="dropdown-menu">    
			<?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
            <li class="dropdown-item" id="topNavSetting"><a class="dropdown-item" href="setting.php"> <i class="fas fa-wrench"></i> Setting</a></li>
            <li class="dropdown-item" id="topNavUser"><a class="dropdown-item" href="user.php"> <i class="fas fa-wrench"></i> Add User</a></li>
<?php } ?>              
            <li class="dropdown-item" id="topNavLogout"><a class="dropdown-item" href="logout.php"> <i class="fas fa-lock    "></i> Logout</a></li>   
            <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <li class="nav-item" id="navSystem"><a class="nav-link" href="system.php"><i class="fas fa-cog"></i> System Settings </a></li> 
		<?php } ?>         
          </ul>
        </li>        
    </ul>
  </div>
</nav>

<br>
	<div class="container">