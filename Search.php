<?php
    if(isset($_POST['btnsearch']))
    {
        include_once("connection.php");
        $se= $_POST['txtSearch'];
        $result = pg_query($connect,"SELECT * from product where productname like '%{$se}%'");
    }
    ?>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <h1>Search</h1>
    <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Image</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
				$No=1;
                while($row = pg_fetch_array($result))
                {
			?>
			<tr>
              <td class="cotcheckbox"><?php echo $No; ?></td>
              <td><?php echo $row["productname"] ?></td>
              <td><?php echo $row["sellingprice"] ?></td>
              <td align='center' class='columnfunction'>
                        <img src='img/<?php echo $row["proimage"] ?>' border='0' width="50" height="50" />
                        </td>
                        <td align='center' class='columnfunction'>
                        <a href="#" class="btn btn-warning" style="color:black">Buy</a>
                        </td>
                        
            </tr>
            <?php
            $No++;
                }
			?>
			</tbody>
        
        </table>  