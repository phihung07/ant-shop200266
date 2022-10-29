  
<?php
include_once("connection.php");
?>

<div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Product</h2>
                        <div class="product-carousel">
                        
                        <!--Load san pham tu DB -->
                           <?php
						  // 	include_once("database.php");
		  				   	$result = pg_query($connect, "SELECT * FROM product" );
			
			                if (!$result) { //add this check.
                                die('Invalid query: ');
                            }
		
			            
			                while($row = pg_fetch_array($result)){
				            ?>
				            <!--Một sản phẩm -->
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/<?php echo $row['proimage']?>" width="250" height="300">
                                    <div class="product-hover">
                                        <a href="?func=dathang&ma=<?php echo  $row['productid']?>" class="add-to-cart-link" ><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="?page=quanly_chitietsanpham&ma=<?php echo  $row['orderid']?>" class="view-details-link"><i class="fa fa-link"></i> Buy now</a>
                                    </div>
                                </div>
                                
                                <h2><a href="?page=quanly_chitietsanpham&ma=<?php echo  $row['productid']?>"><?php echo  $row['productname']?></a></h2>
                                
                                <div class="product-carousel-price">
                                    <ins><?php echo  $row['sellingprice']?></ins>
                                </div> 
                            </div>
                
                <?php
				}
				?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

	