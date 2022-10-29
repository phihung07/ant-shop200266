<link rel="stylesheet" type="text/css" href="styleAll.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">
<script src="js/jquery-3.2.0.min.js"/></script>
<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>
<?php
//Get custmer information
$query = "SELECT custname, address, email, telephone
			FROM account
			WHERE username = '". $_SESSION["us"] ."'";
	$result = pg_query($connect, $query);
	$row = pg_fetch_array($result);

	$us =$_SESSION["us"];
	$email =$row["email"];
	$fullname = $row['custname'];
	$address = $row["address"];
	$telephone =$row["telephone"];

//Update information when the user presses the "Update" button
if(isset($_POST['btnUpdate']))
{
	$fullname=$_POST['txtFullname'];
	$address = $_POST['txtAddress'];
	$tel =$_POST['txtTel'];
	$email = $_POST['txtEmail'];

	$test = check();
	if($test=="")
	{
		if($_POST['txtPass1']!=""){
		$pass =md5($_POST['txtPass1']);

		$sq = "UPDATE account
		SET custName= '$fullname', address='$address',
		telephone= '$telephone', password= '$pass', email= '$email',
		WHERE username = '" .$_SESSION['us'] ."'";

		pg_query($connect,$sq);
	}

	else{
		$sq = "UPDATE account
		SET custName= '$fullname', address='$address',
		telephone= '$telephone', email= '$email' WHERE username = '" .$_SESSION['us'] ."'";

		pg_query($connect,$sq);
	}
	echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
}else{
	echo $test;
}
}

//Write check() function to check information
function check(){
	if($_POST['txtFullname']=="")
	{
		return "<li>Enter Full name, please</li>";
	}
	elseif($_POST['txtAddress']=="")
	{
		return "<li>Enter Address, please</li>";
	}
	elseif($_POST['txtTel']=="")
	{
		return "<li>Enter Telephone, please</li>";
	}
	elseif($_POST['txtEmail']=="")
	{
		return "<li>Enter Email, please</li>";
	}
	elseif(strlen($_POST['txtPass1'])>0 && strlen($_POST['txtPass1'])<=5){
		return "<li>Password is greater than 5 characters</li>";
	}
	elseif($_POST['txtPass1']!=$_POST['txtPass2'])
	{
		return "<li>Password and Confirm Pass do not match</li>";
	}
	else
	{
		return"";
	}
}
?>
<div class="container">
	
<h2>Update Profile</h2>

			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    
                            <label for="lblTenDangNhap" class="col-sm-2 control-label">Username(*):  </label>
							<div class="col-sm-10">
							      <label class="form-control" style="font-weight:400"><?php echo $us; ?></label>
							</div>
                     </div>
                           
                         <div class="form-group">   
                            <label for="lblEmail" class="col-sm-2 control-label">Email(*):  </label>
							<div class="col-sm-10">
								   <input type="text" name="txtEmail" id="txtEmail" value="<?php echo $email; ?>" 
								  class="form-control" placeholder="Enter Email, please"/>
							</div>
                          </div>  
                          
                           <div class="form-group"> 
                            <label for="lblMatKhau1" class="col-sm-2 control-label">Password(*):  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtPass1" id="txtPass1" class="form-control"/>
							</div>
                            </div>
                            
                             <div class="form-group"> 
                            <label for="lblMatKhau2" class="col-sm-2 control-label">Confirm Password(*):  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtPass2" id="txtPass2" class="form-control"/>
							</div>
                            </div>
                            
                            <div class="form-group">                         
                            	<label for="lblHoten" class="col-sm-2 control-label">Full name(*):  </label>
								<div class="col-sm-10">
							      <input type="text" name="txtFullname" id="txtFullname" value="<?php echo $fullname; ?>" 
								  class="form-control" placeholder="Enter Fullname, please"/>
								</div>
                            </div>
                           
                             <div class="form-group"> 
                             <label for="lblDiaChi" class="col-sm-2 control-label">Address(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtAddress" id="txtAddress" value="<?php echo $address; ?>" class="form-control" placeholder="Enter Address, please"/>
							</div>
                            </div>
                            
                            <div class="form-group"> 
                            <label for="lblDienThoai" class="col-sm-2 control-label">Telephone(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTel" id="txtTel" value="<?php echo $telephone; ?>" class="form-control" placeholder="Enter Telephone, please" />
							</div>
                            </div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              	
						</div>
					</div>
				</form>
</div>






