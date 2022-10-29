      <!-- Bootstrap --> 
      <link rel="stylesheet" type="text/css" href="styleAll.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	    
	<?php
		include_once("connection.php");
		if(isset($_POST["btnAdd"]))
		{
			$id = $_POST["txtID"];
			$name = $_POST["txtName"];
            $telephone= $_POST["txtTelephone"];
			$address = $_POST["txtAddress"];
			$err="";
			if($id=="")
			{
				$err.="<li>Enter Supplier ID, please</li>";
			}
			if($name=="")
			{
				$err.="<li>Enter Supplier Name, please</li>";
			}
			if($err!="")
			{
				echo "<ul>$err</ul>";
			}
			else{
				$sq="Select * from supplier where supplierid ='$id' or suppliername='$name'"; 
				$result = pg_query($connect,$sq);
				if(pg_num_rows($result)==0)
				{
					pg_query($connect,"INSERT INTO supplier (supplierid, suppliername, telephone, address) VALUES ('$id', '$name', '$telephone', '$address')");
					echo '<meta http-equiv="refresh" content="0;URL=?page=supplier_management"/>';
				}
				else
				{
					echo"<li>Duplicate Supplier ID or Name</li>";
				}
			}
		}
	?>

<div class="container">
	<h2>Adding Supplier</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Supplier ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Supplier ID" value='<?php echo isset($_POST["txtID"])?($_POST["txtID"]):"";?>'>
							</div>
					</div>	
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Supplier Name(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Supplier Name" value='<?php echo isset($_POST["txtName"])?($_POST["txtName"]):"";?>'>
							</div>
					</div>

                    <div class="form-group">
						    <label for="txtsdt" class="col-sm-2 control-label">Telephone(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTelephone" id="txtTelephone" class="form-control" placeholder="Telephone" value='<?php echo isset($_POST["txtTelephone"])?($_POST["txtTelephone"]):"";?>'>
							</div>
					</div>
                    
                    <div class="form-group">
						    <label for="txtdiachi" class="col-sm-2 control-label">Address(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="Address" value='<?php echo isset($_POST["txtAddress"])?($_POST["txtAddress"]):"";?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='Supplier_Management.php'" />
                              	
						</div>
					</div>
				</form>
	</div>