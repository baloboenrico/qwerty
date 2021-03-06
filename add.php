<?php 
require('db.php');
?>
<?php
require ('db.php');

if (isset($_POST['add']))
{
	//$pcode = $_POST['pCode'];
	$pname = $_POST['pname'];
	$sku = $_POST['sku'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	
	$file_name=$_FILES['file']['name'];
	$file_type=$_FILES['file']['type'];
	$file_size=$_FILES['file']['size'];
	$file_tem_loc=$_FILES['file']['tmp_name'];
	$file_store="img/".$file_name;

	if($target=move_uploaded_file($file_tem_loc, $file_store))
	{


		echo "files are uploaded";
		$sql = "INSERT INTO products (name,sku,price,quantity,image VALUES('$pname','$sku', '$price', '$quantity','$target')";

	}
	
	
				if($mysqli->query($sql)==TRUE){
					header("location:index.php?message=saved");
				}
				else{
					echo "Error:".$sql."<br>". $mysqli->error;
				}
				$mysqli->close();
			}
		
		?>
<html lang="UTF-8">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" type="text/css" href="minty.css">
	<title>CRUD Query</title>
</head>
<body>
<div class="container">
<br>
<button class="btn btn-secondary btn-lg" onclick="document.getElementById('id01').style.display='block'"style="width:auto;">Add product</button>
</div>
<!---list of product-->
<?php
$sql="SELECT * FROM products";
$resultset=$mysqli->query($sql);

echo'<div class="container">';
echo '<table class="table table-hover">';
echo '<thead><tr class="table-secondary"><th scope="col">Product id</th>';
echo '<th scope="col">Product Name</th><th scope="col">sku</th>';
echo '<th scope="col">Price</th><th scope="col">Quantity</th>';
echo '<th scope="col">image</th><th colspan="3"></th></tr></thead>';
	while($row=$resultset->fetch_array(MYSQLI_ASSOC))
	{
		echo '<tr>';
		echo '<td>'.$row['product_id'].'</td><td>'.$row['name'];
		echo '<td>'.$row['sku'].'<td>'.$row['price'];
		echo '<td>'.$row['quantity'].'<td>'.$row['image'];
	
	}
	echo'</table>';
	echo'</div>';
?>
<!--Add Product-->
<div id="id01" class="modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-hear bg-success">
				<h5 class="modal-title text-white">Product Information</h5>
			</div>
			<div class="modal-body animate">
			<div class="container">
			<form method="post">
			
			<div class="form-group row">
			<label for="productname"><b>Product name</b></label>
				<input type="text" class="form-control" placeholder="Product name" name="productname" required>
				  <span style="color:red"><?php echo $pn ?></span>
			</div>
			<div class="form-group row">
			<label for="SKU"><b>SKU</b></label>
				<input type="text" class="form-control" placeholder="sku" name="SKU" required>
				<span style="color:red"><?php echo $sku ?></span>
			</div>
	
			<div class="form-group row"
			<label for="price"><b>Price</b></label>
			<input type="text" class="form-control" placeholder="Price" name="price" required>
			 <span style="color:red"><?php echo $pr ?></span>
		</div>
		<div class="form-group row">
			<label for="qty"><b>Quantity</b></label>
				<input type="text" class="form-control" placeholder="Quantity" name="qty" required>
				<span style="color:red"><?php echo $quan ?></span>
			</div>
			<div class="form-group row">
			<label for="imgs"><b>Image</b></label>
				<input type="file" class="form-control"  name="imgs" value="<?php echo htmlspecialchars($image); ?>" required>
				 <span style="color:red"><?php echo $img ?></span><br><br>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-secondary" name="add" value="Add product"/>
			<button type="button" name="close" class="btn btn-secondary" class="cancelbtn"><center><a href="add.php" style= color:white;>Close</a></center></button>
		</div>
		
		
			<a href="index.php"></a>		
		
	</form>
</div>
</div>
</div>
<script>
//for add product modal
var modal1 =document.getElementById('id01');

//when the user clikcs anywhere outside the modal, close it
window.onclick = funtion(event){
if(event.target == modal1){
		modal1.style.display="none";
	}
}
</script>
</body>

		</body>
		</html>
}
?>
