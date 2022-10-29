<?php 
        if(isset($_SESSION["admin"]) && $_SESSION["admin"]!=1)
        {
            echo "<script>alert('You are not administrator')</sript>";
            echo '<meta http-equiv="refresh" content="0;URL=Mid-Autum-Cakes.php"/>';
        }
        else{
    ?>
   <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
        function deleteConfirm() {
            if (confirm("Are you sure to delete!")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <?php
    include_once("connection.php");
    if (isset($_GET["function"]) == "del") {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $sq = "SELECT proimage from product where productid='$id'";
            $res = pg_query($connect,$sq);
            $row = pg_fetch_array($res);
            $filePic = $row['proimage'];
            pg_query($connect, "DELETE FROM product where productid='$id'");
        }
    }
    ?>

        <form name="frm" method="post" action="">
        <h1>Product Management</h1>
        <p>
        	<img src="img/add.png" alt=""Add new"" width="16" height="16" border="0" />
            <a href="?page=add_product"> Add</a>
        </p>
        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Product ID</strong></th>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Buying price</strong></th>
                    <th><strong>Selling price</strong></th>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Category ID</strong></th>
                    <th><strong>Shop ID</strong></th>
                    <th><strong>Supplier ID</strong></th>
                    <th><strong>Image</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
                include_once("connection.php");
				$No=1;
                $result=pg_query($connect,"SELECT product.productid, product.productname, product.buyingprice, product.sellingprice, product.proqty, product.proimage, shop.shopname, category.catname, supplier.suppliername FROM product 
                INNER JOIN supplier ON product.supplierid = supplier.supplierid
				INNER JOIN category ON product.catid = category.catid
				INNER JOIN shop ON product.shopid = shop.shopid");
                while($row=pg_fetch_array($result)){
            ?>
			<tr>
              <td ><?php echo $No; ?></td>
              <td ><?php echo $row["productid"]; ?></td>
              <td><?php echo $row["productname"]; ?></td>
              <td><?php echo $row["buyingprice"]; ?></td>
              <td><?php echo $row["sellingprice"]; ?></td>
              <td ><?php echo $row["proqty"]; ?></td>
              <td><?php echo $row["catname"]; ?></td>
              <td><?php echo $row["shopname"]; ?></td>
              <td><?php echo $row["suppliername"]; ?></td>
              <td align='center' class='columnfunction'>
                <img src='img/<?php echo $row["proimage"]; ?>' border='0' width="50" height="50" />
                </td>
                <td align='center' class='columnfunction'>
                <a href="?page=product_management&&function=del&&id=<?php echo $row["productid"]; ?>" onclick="return deleteConfirm()">
                <img src="img/delete.png" width="16" height="16" border='0' />
                </a>
                </td>
            </tr>
            <?php
               $No ++;
                }
			?>
			</tbody>
        
        </table>  

 </form>
 <?php
        }
?>

