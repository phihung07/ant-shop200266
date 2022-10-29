<?php 
        if(isset($_SESSION["admin"]) && $_SESSION["admin"]!=1)
        {
            echo "<script>alert('You are not administrator')</sript>";
            echo '<meta http-equiv="refresh" content="0;URL=Mid-Autum-Cakes.php"/>';
        }
        else{
    ?>
    <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="styleAll.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">

    <script language="javascript">
            function deleteConfirm()
            {
                if(confirm("Are you sure to delete!")){
                    return true;
                }
                else{
                    return false;
                }
            }
    </script>
    <?php
            include_once("connection.php");
                    if(isset($_GET["function"])=="del")
                    {
                        if(isset($_GET["id"]))
                        {
                            $id = $_GET["id"];
                            pg_query($connect, "DELETE FROM supplier WHERE supplierid='$id'");
                        }
                    }
    ?>

        <form name="frm" method="post" action="">
        <h1>Supplier Management</h1>
        <p>
        <img src="img/add.png" alt="Add new" width="16" height="16" border="0" />
        <a href="?page=add_supplier"> Add</a> <!--tao duong lien ket qua trnag Add-->
        </p>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Supplier Name</strong></th>
                    <th><strong>Telephone</strong></th>
                    <th><strong>Address</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
                <?php
                 include_once("connection.php");
                $No=1;
                $result = pg_query($connect, "SELECT * FROM supplier");
                while($row=pg_fetch_array($result))
                {
            ?>
			<tr>
              <td class="cotCheckBox"><?php echo $No; ?></td>
              <td><?php echo $row["suppliername"]; ?></td>
              <td><?php echo $row["telephone"]; ?></td>
              <td><?php echo $row["address"]; ?></td>
              
              <td style='text-align:center'><a href="?page=update_supplier&&id=<?php echo $row["supplierid"]; ?>">
              <img src='img/edit.png' border='0'  /></a></td>
              <td style='text-align:center'>
              <a href="?page=supplier_management&&function=del&&id=<?php echo $row["supplierid"]; ?>" onclick="return deleteConfirm()">
              <img src='img/delete.png' border='0' /></a></td>
            </tr>
            <?php
                $No++;
                }
                ?>
			</tbody>
        </table>  
  
        
        <!--Nut them moi nut xoa tat ca-->
            <div class="row" style="background-color:#FFF"><!--Nut chuc nang-->
            <div class="col-md-12">
            	
            </div>
        </div><!--Nut chuc nang-->
 </form>
 <?php
        }
?>
   
