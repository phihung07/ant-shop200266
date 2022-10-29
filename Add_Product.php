    <!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
	include_once("connection.php");
	function bind_Category_List($connect)
	{
		$sqlstring = "SELECT catid, catname from category";
		$result = pg_query($connect, $sqlstring);
		echo "<select name='CategoryList' class='form-control'>
					<option value='0'>Choose category</option>";
		while ($row = pg_fetch_array($result)) {
			echo "<option value='" . $row['catid'] . "'>" . $row['catname'] . "</option>";
		}
		echo "</select>";
	}

	function bind_Shop_List($connect)
	{
		$sqlstring = "SELECT shopid, shopname from shop";
		$result = pg_query($connect, $sqlstring);
		echo "<select name='ShopList' class='form-control'>
					<option value='0'>Choose shop</option>";
		while ($row = pg_fetch_array($result)) {
			echo "<option value='" . $row['shopid'] . "'>" . $row['shopname'] . "</option>";
		}
		echo "</select>";
	}

	function bind_Supplier_List($connect)
	{
		$sqlstring = "SELECT supplierid, suppliername from supplier";
		$result = pg_query($connect, $sqlstring);
		echo "<select name='SupplierList' class='form-control'>
					<option value='0'>Choose supplier</option>";
		while ($row = pg_fetch_array($result)) {
			echo "<option value='" . $row['supplierid'] . "'>" . $row['suppliername'] . "</option>";
		}
		echo "</select>";
	}

	if(isset($_POST["btnAdd"]))
	{
		$id = $_POST["txtID"];
		$proname = $_POST["txtName"];
		$detail = $_POST["txtDetail"];
		$buyingprice = $_POST["txtBuyingprice"];
		$sellingprice = $_POST["txtSellingprice"];
		$qty = $_POST["txtQty"];
		$pic = $_FILES["txtImage"];
		$category = $_POST["CategoryList"];
		$shop = $_POST["ShopList"];
		$supplier = $_POST["SupplierList"];
		$err = "";

		if(trim($id) == "")
		{
			$err.="<li>Enter product ID, please</li>";
		}
		if(trim($proname) == "")
		{
			$err.="<li>Enter product Name, please</li>";
		}
		if($category == "0")
		{
			$err.="<li>Choose product category, please</li>";
		}
		if($shop == "0")
		{
			$err.="<li>Choose shop, please</li>";
		}
		if($supplier == "0")
		{
			$err.="<li>Choose supplier, please</li>";
		}
		if(!is_numeric($buyingprice))
		{
			$err.="<li>Product price must be number</li>";
		}
		if(!is_numeric($sellingprice))
		{
			$err.="<li>Product price must be number</li>";
		}
		if(!is_numeric($qty))
		{
			$err.="<li>Product quantity must be number</li>";
		}
		if($err != "")
		{
			echo "<ul>$err</ul>";
		}
		else
		{
			if($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif")
			{
				if($pic["size"] < 614400)
				{
					$sq = "SELECT * FROM product WHERE productid = '$id' or productname = '$proname'";
					$result = pg_query($connect, $sq);
					if(pg_num_rows($result) == 0)
					{
						copy($pic['tmp_name'], "img/".$pic['name']);
						$filePic = $pic['name'];
						$sqlstring = "INSERT INTO product (productid, productname, buyingprice, sellingprice, detaildes, proqty, proimage, supplierid, catid, shopid)
										VALUES ('$id', '$proname', '$buyingprice', '$sellingprice', '$detail', $qty, '$filePic', '$supplier', '$category', '$shop')";
						pg_query($connect, $sqlstring);
						echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
					}
					else
					{
						echo "<li>Duplicate Product ID or Name</li>";
					}
				}
				else
				{
					echo "Size of image too big";
				}
			}
			else
			{
				echo "Image format is not correct";
			}
		}
	}
?>
<div class="container">
	<h2>Adding new Product</h2>

	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtTen" class="col-sm-2 control-label">Product ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value=''/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtTen" class="col-sm-2 control-label">Product Name(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value=''/>
							</div>
                </div>   
                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Product category(*):  </label>
							<div class="col-sm-10">
							      <?php bind_Category_List($connect); ?>
							</div>
                </div>  

				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Shop(*):  </label>
							<div class="col-sm-10">
							      <?php bind_Shop_List($connect); ?>
							</div>
                </div> 

				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Supplier(*):  </label>
							<div class="col-sm-10">
							      <?php bind_Supplier_List($connect); ?>
							</div>
                </div> 
                          
                <div class="form-group">  
                    <label for="lblGiaMua" class="col-sm-2 control-label">Buying Price(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtBuyingprice" id="txtBuyingprice" class="form-control" placeholder="Buying price" value=''/>
							</div>
                 </div> 
				 
				 <div class="form-group">  
                    <label for="lblGiaBan" class="col-sm-2 control-label">Selling Price(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtSellingprice" id="txtSellingprice" class="form-control" placeholder="Selling price" value=''/>
							</div>
                 </div> 
                                      
                <div class="form-group">  
        	        <label for="lblDetail" class="col-sm-2 control-label">Detail description(*):  </label>
							<div class="col-sm-10">
							      <textarea name="txtDetail" rows="4" class="ckeditor"></textarea>
              					  <script language="javascript">
                                        CKEDITOR.replace( 'txtDetail',
                                        {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });
										
                                    </script> 
                                  
							</div>
                </div>
                            
            	<div class="form-group">  
                    <label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*):  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value=""/>
							</div>
                </div>
 
				<div class="form-group">  
	                <label for="sphinhanh" class="col-sm-2 control-label">Image(*):  </label>
							<div class="col-sm-10">
							      <input type="file" name="txtImage" id="txtImage" class="form-control" value=""/>
							</div>
                </div>
                        
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='Product_Management.php'" />
                              	
						</div>
				</div>
			</form>
</div>
