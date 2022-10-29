     <!-- Bootstrap --> 
	 <link rel="stylesheet" type="text/css" href="styleAll.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
   <?php
    include_once("connection.php");
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
		$result = pg_query($connect, "SELECT * FROM supplier WHERE supplierid='$id'");
		$row = pg_fetch_array($result);
		$supplier_id = $row['supplierid'];
		$supplier_name = $row['suppliername'];
        $telephone = $row['telephone'];
		$address = $row['address'];

	?>
	<?php
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0;URL=Supplier_Management.php"/>';
	}
	?>
<div class="container">
	<h2>Updating Supplier</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Supplier ID(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Supplier ID" readonly 
								  value='<?php echo $supplier_id ;?>'>
							</div>
					</div>	
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Supplier Name(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Supplier Name" 
								  value='<?php echo $supplier_name ;?>'>
							</div>
					</div>

                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Telephone(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtTelephone" id="txtTelephone" class="form-control" placeholder="Telephone" 
								  value='<?php echo $telephone ;?>'>
							</div>
					</div>
                    
                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Address(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="Address" 
								  value='<?php echo $address ;?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='Supplier_Management.php'" />
                              	
						</div>
					</div>
				</form>
	</div>
    <?php
		if(isset($_POST["btnUpdate"]))
		{
			$id = $_POST["txtID"];
			$name = $_POST["txtName"];
            $telephone = $_POST["txtTelephone"];
			$address = $_POST["txtAddress"];
			$err="";
			if($name=="")
			{
				$err.="<li>Enter Supplier Name, please</li>";
			}
			if($err!="")
			{
				echo "<ul>$err</ul>";
			}
			else
			{
				$sq="Select * from supplier where supplierid != '$id' and suppliername='$name'"; 
				$result = pg_query($connect,$sq);
				if(pg_num_rows($result)==0)
				{
					pg_query($connect,"UPDATE supplier SET suppliername = '$name', telephone = '$telephone',  address='$address' WHERE supplierid='$id'");
					echo '<meta http-equiv="refresh" content ="0;URL=?page=supplier_management"/>';
				}
				else
				{
					echo"<li>Duplicate Shop Name</li>";
				}
			}
			
		}
	?>


	<?php
		
    ?>
      