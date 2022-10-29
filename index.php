<!DOCTYPE html>
<html>
<head>
  <title>ATN Shop</title>
  <link rel="stylesheet" type="text/css" href="styleAll.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" 
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" 
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" 
integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php
    
    include_once("connection.php");
    session_start();
  ?>
   <header>
    <div class="container">
    <div class="menu"></div>
            <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">ATN Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <?php
		    if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
	       ?>
        <li class="nav-item">
			    <a class="nav-link" href="?page=update_customer">
			    Hi, <?php echo $_SESSION['us'] ?>
        </a>
		    </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=logout">Logout</a>
        </li>
        <?php
				} else {
			  ?>
        <li class="nav-item">
          <a class="nav-link" href="?page=login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=register">Register</a>
        </li>
        <?php
				}
			  ?> 
       
        
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Management
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?page=category_management">Category</a>
                <a class="dropdown-item" href="?page=shop_management">Shop</a>
                <a class="dropdown-item" href="?page=supplier_management">Supplier</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?page=product_management">Product</a>
                </div>
            </li>
         
            <form class="d-flex" action="?page=search" method="POST">
            <input class="form-control me-2" type="search" placeholder="Search" name="txtSearch" aria-label="Search">
            <button class="btn btn-outline-success" name="btnsearch" type="submit">Search</button>
        </form>
      </ul>
    </div>
  </div>
</nav>



</header>
<h6> </h6>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/qc1.png" alt="First slide" width="1000px" height="500px">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/qc2.png" alt="Second slide" width="1000px" height="500px">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/qc3.png" alt="Third slide" width="1000px" height="500px">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    <?php
	if(isset($_GET['page']))
    {
        $page = $_GET['page'];
        if($page=="register")
        {
            include_once("Register.php");
        }
        elseif($page=="login")
        {
            include_once("Login.php");
        }
        elseif($page=="category_management")
        {
            include_once("Category_Management.php");
        }
        elseif($page=="product_management")
        {
            include_once("Product_Management.php");
        }
        elseif($page=="add_category")
        {
            include_once("Add_Category.php");
        }
        elseif($page=="update_category")
        {
            include_once("Update_Category.php");
        }
		    elseif($page=="add_product")
        {
            include_once("Add_Product.php");
        }
        elseif($page=="update_product")
        {
            include_once("Update_Product.php");
        }
        elseif($page=="shop_management")
        {
            include_once("Shop_Management.php");
        }
        elseif($page=="add_shop")
        {
            include_once("Add_Shop.php");
        }
        elseif($page=="update_shop")
        {
            include_once("Update_Shop.php");
        }

        elseif($page=="supplier_management")
        {
            include_once("Supplier_Management.php");
        }
        elseif($page=="add_supplier")
        {
            include_once("Add_Supplier.php");
        }
        elseif($page=="update_supplier")
        {
            include_once("Update_Supplier.php");
        }
        elseif($page=="update_customer")
        {
            include_once("Update_Customer.php");
        }
        elseif($page=="search")
        {
            include_once("Search.php");
        }
        elseif($page=="logout")
        {
            include_once("Logout.php");
        }
    }
    else
        {
            include("Content.php");
        }
	?>
	
    <div style="clear:both"></div>
    <footer id="footer">
        <div class="left"> ATN Shop Co., Ltd - Vietnam Branch
            <br/> Addres: 01 - Hoa Binh - Ninh Kieu Dist - Can Tho city
            <br/> Tel: 0900000001
        </div>
        <div class="right" width="97" height="29">
        <a>ATN Shop</a>
        </div>
    </footer>


    </body>
</html>
