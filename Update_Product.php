<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
    <?php
	include_once("connection.php");
	function bind_Category_List($connect, $selectValue)
	{
		$sqlstring = "SELECT catid, catname from category";
		$result = pg_query($connect, $sqlstring);
		echo "<select name='CategoryList' class='form-control'>
					<option value='0'>Choose category</option>";
		while ($row = pg_fetch_array($result)) {
			if ($row['catid'] == $selectValue) {
				echo "<option value='" . $row['catid'] . "' selected>" . $row['catname'] . "</option>";
			} else {
				echo "<option value='" . $row['catid'] . "'>" . $row['catname'] . "</option>";
			}
		}
		echo "</select>";
	}

	function bind_Shop_List($connect, $selectValue)
	{
		$sqlstring = "SELECT shopid, shopname from shop";
		$result = pg_query($connect, $sqlstring);
		echo "<select name='ShopList' class='form-control'>
					<option value='0'>Choose shop</option>";
		while ($row = pg_fetch_array($result)) {
			if ($row['shopid'] == $selectValue) {
				echo "<option value='" . $row['shopid'] . "' selected>" . $row['shopname'] . "</option>";
			} else {
				echo "<option value='" . $row['shopid'] . "'>" . $row['shopname'] . "</option>";
			}
		}
		echo "</select>";
	}

	function bind_Supplier_List($connect, $selectValue)
	{
		$sqlstring = "SELECT supplierid, suppliername from supplier";
		$result = pg_query($connect, $sqlstring);
		echo "<select name='SupplierList' class='form-control'>
					<option value='0'>Choose supplier</option>";
		while ($row = pg_fetch_array($result)) {
			if ($row['catid'] == $selectValue) {
				echo "<option value='" . $row['supplierid'] . "' selected>" . $row['suppliername'] . "</option>";
			} else {
				echo "<option value='" . $row['supplierid'] . "'>" . $row['suppliername'] . "</option>";
			}
		}
		echo "</select>";
	}
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$sqlstring = "SELECT productname, buyingprice, sellingprice, detaildes, proqty, proimage, supplierid, catid, shopid
						FROM product WHERE productid = '$id'";
		$result = pg_query($connect, $sqlstring);
		$row = pg_fetch_array($result);

		$proname = $row["productname"];
		$detail = $row["detaildes"];
		$buyingprice = $row["buyingprice"];
		$sellingprice = $row["sellingprice"];
		$qty = $row["proqty"];
		$pic = $row["proimage"];
		$category = $row["catid"];
		$shop = $row["shopid"];
		$supplier = $row["supplierid"];
	?>
    	<div class="container">
    		<h2>Updating Product</h2>

    		<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
    			<div class="form-group">
    				<label for="txtTen" class="col-sm-2 control-label">Product ID(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" readonly value='<?php echo $id; ?>' />
    				</div>
    			</div>
    			<div class="form-group">
    				<label for="txtTen" class="col-sm-2 control-label">Product Name(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='<?php echo $proname; ?>' />
    				</div>
    			</div>
    			<div class="form-group">
    				<label for="" class="col-sm-2 control-label">Product category(*): </label>
    				<div class="col-sm-10">
    					<?php
						bind_Category_List($connect, $category);
						?>
    				</div>
    			</div>

				<div class="form-group">
    				<label for="" class="col-sm-2 control-label">Shop(*): </label>
    				<div class="col-sm-10">
    					<?php
						bind_Shop_List($connect, $shop);
						?>
    				</div>
    			</div>

				<div class="form-group">
    				<label for="" class="col-sm-2 control-label">Supplier(*): </label>
    				<div class="col-sm-10">
    					<?php
						bind_Supplier_List($connect, $supplier);
						?>
    				</div>
    			</div>

    			<div class="form-group">
    				<label for="lblGiaMua" class="col-sm-2 control-label">Buying price(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtBuyingprice" id="txtBuyingprice" class="form-control" placeholder="Buying price" value='<?php echo $buyingprice ?>' />
    				</div>
    			</div>

    			<div class="form-group">
    				<label for="lblGiaBan" class="col-sm-2 control-label">Selling price(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtSellingprice" id="txtSellingprice" class="form-control" placeholder="Selling price" value='<?php echo $sellingprice ?>' />
    				</div>
    			</div>

    			<div class="form-group">
    				<label for="lblDetail" class="col-sm-2 control-label">Detail description(*): </label>
    				<div class="col-sm-10">
    					<textarea name="txtDetail" rows="4" class="ckeditor"><?php echo $detail ?></textarea>
    					<script language="javascript">
    						CKEDITOR.replace('txtDetail', {
    							skin: 'kama',
    							extraPlugins: 'uicolor',
    							uiColor: '#eeeeee',
    							toolbar: [
    								['Source', 'DocProps', '-', 'Save', 'NewPage', 'Preview', '-', 'Templates'],
    								['Cut', 'Copy', 'Paste', 'PasteText', 'PasteWord', '-', 'Print', 'SpellCheck'],
    								['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
    								['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
    								['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Subscript', 'Superscript'],
    								['OrderedList', 'UnorderedList', '-', 'Outdent', 'Indent', 'Blockquote'],
    								['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'],
    								['Link', 'Unlink', 'Anchor', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
    								['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
    								['Style', 'FontFormat', 'FontName', 'FontSize'],
    								['TextColor', 'BGColor'],
    								['UIColor']
    							]
    						});
    					</script>

    				</div>
    			</div>

    			<div class="form-group">
    				<label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*): </label>
    				<div class="col-sm-10">
    					<input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $qty ?>" />
    				</div>
    			</div>

    			<div class="form-group">
    				<label for="sphinhanh" class="col-sm-2 control-label">Image(*): </label>
    				<div class="col-sm-10">
    					<img src='img/<?php echo $pic; ?>' border='0' width="50" height="50" />
    					<input type="file" name="txtImage" id="txtImage" class="form-control" value="" />
    				</div>
    			</div>

    			<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-10">
    					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" onclick="window.location='?page=product_management'"/>
    					<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=product_management'" />

    				</div>
    			</div>
    		</form>
    	</div>

    <?php
	} else {
		echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
	}
	?>
    <?php
	if (isset($_POST["btnUpdate"])) {
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

		if (trim($id) == "") {
			$err .= "<li>Enter product ID, please</li>";
		}
		if (trim($proname) == "") {
			$err .= "<li>Enter product Name, please</li>";
		}
		if ($category == "0") {
			$err .= "<li>Choose product category, please</li>";
		}
		if ($shop == "0") {
			$err .= "<li>Choose shop, please</li>";
		}
		if ($supplier == "0") {
			$err .= "<li>Choose supplier, please</li>";
		}
		if (!is_numeric($buyingprice)) {
			$err .= "<li>Product price must be number</li>";
		}
		if (!is_numeric($sellingprice)) {
			$err .= "<li>Product price must be number</li>";
		}
		if (!is_numeric($qty)) {
			$err .= "<li>Product quantity must be number</li>";
		} else {
			if ($pic['name'] != "") {
				if ($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif") {
					if ($pic["size"] < 614400) {
						$sq = "SELECT * FROM product WHERE productid = '$id' or productmame = '$proname'";
						$result = pg_query($connect, $sq);
						if (pg_num_rows($result) == 0) {
							copy($pic['tmp_name'], "img/" . $pic['name']);
							$filePic = $pic['name'];
							$sqlstring = "UPDATE product SET 
							productname ='$proname', buyingprice='$buyingprice', sellingprice='$sellingprice', 
							detaildes='$detail', proqty='$qty',
							proimage='$filePic', catid='$category', shopid='$shop', supplierid='$supplier'
							WHERE productid='$id'";
							pg_query($connect, $sqlstring);
							echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
						} else {
							echo "<li>Duplicate Product ID or Name</li>";
						}
					} else {
						echo "Size of image too big";
					}
				} else {
					echo "Image format is not correct";
				}
			} else {
				$sq = "SELECT * FROM product WHERE productid != '$id' and productname = '$proname'";
				$result = pg_query($connect, $sq);
				if (pg_num_rows($result) == 0) {
					// copy($pic['tmp_name'], "img/" . $pic['name']);
					$filePic = $pic['name'];
					$sqlstring = "UPDATE product SET productname ='$proname', buyingprice='$buyingprice', 
					sellingprice='$sellingprice', detaildes='$detail', proqty='$qty',
					proimage='$filePic', catid='$category', shopid='$shop', supplierid='$supplier'
					WHERE productid='$id'";
					pg_query($connect, $sqlstring);
					echo '<meta http-equiv="refresh" content="0;URL=?page=poduct_management"/>';
				} else {
					echo "<li>Duplicate Product ID or Name</li>";
				}
			}
		}
	}
	?>