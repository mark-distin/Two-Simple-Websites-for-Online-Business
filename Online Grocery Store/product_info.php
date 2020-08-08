<?php
	session_start();
	$product = array();

	if(isset($_GET['a'])) {
		$_SESSION['products'] = array();
		$id = $_SESSION['current_id'];
		$link = mysqli_connect('localhost','potiro','pcXZb(kL','poti');
		if (!$link)
			die("Could not connect to server.");
		$query = "select * from products where product_id=$id";
		$result = mysqli_query($link,$query);
		$number_rows=mysqli_num_rows($result);
		if ($number_rows > 0) {
			$a_row = mysqli_fetch_assoc($result);
			foreach ($a_row as $key => $value) 
			{
				$product[$key] = $value;
				$_SESSION['products'][$id][$key] = $value;
			}
		}
		$_SESSION['products'][$id]['amount'] = 0;
		$_SESSION['products'][$id]['total'] = 0;
		mysqli_close($link);
	}

	else if(isset($_GET['product_id'])) 
	{
		$id = $_GET['product_id'];
		$_SESSION['current_id'] = $id;

		if(isset($_SESSION['products'][$id]))
		{
			$a_row = $_SESSION['products'][$id];
			foreach ($a_row as $key => $value)
				$product[$key] = $value;
		}
		else 
		{	
			$link = mysqli_connect('localhost','potiro','pcXZb(kL','poti');
			if (!$link)
				die("Could not connect to server.");
			$query = "select * from products where product_id=$id";
			$result = mysqli_query($link,$query);
			$number_rows=mysqli_num_rows($result);
			if ($number_rows > 0) {
				$a_row = mysqli_fetch_assoc($result);
				foreach ($a_row as $key => $value) 
				{
					$product[$key] = $value;
					$_SESSION['products'][$id][$key] = $value;
				}
			}
			$_SESSION['products'][$id]['amount'] = 0;
			$_SESSION['products'][$id]['total'] = 0;
			mysqli_close($link);
		}
	}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Online Grocery Store</title>
</head>
<body>
	<p style="font-size: 25px; position: relative; top: 20px;"><b>Product Details:</b><br>
		<form id="the_form" name="the_form" action="cart.php" method="post" target="cart" onsubmit="return validate_form()">
			<table border="0" width="50%" height="200"
					style="font-weight: bold; position: relative; left: 150px; top: 15px;">
				<tr>
					<td>Product Name:</td>
					<td>
						<?php
							print $product['product_name'];
						?>
					</td>
				</tr>
				<tr>
					<td>Unit Price:</td>
					<td>
						<?php
							print $product['unit_price'];
						?>
					</td>
				</tr>
				<tr>
					<td>Unit Quantity:</td>
					<td>
						<?php
							print $product['unit_quantity'];
						?>
					</td>
				</tr>
				<tr>
					<td>In stock:</td>
					<td>
						<p><input id="num_added" type="text" name="num_added" maxlength="5" style="width: 50px;">/<span id="stock" name="stock">
							<?php
								print $product['in_stock'];
							?>
						</span> available
						</p>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input id="add_button" type="submit" value="Add to Cart"></td>
				</tr>
			</table>
		</form>
</body>
</html>


<script>

	function validate_form() {
		var number = document.getElementById('num_added').value;
		var n_number = Number(number);
		var stock = Number(document.getElementById('stock').innerHTML);
		if(number == "") {
			alert("The text field cannot be empty!");
			cleanField();
			return false;
		}
		if(stock == 0) {
			alert("The product is out of stock!");
			cleanField();
			return false;
		}
		if(n_number > 0 && n_number <= stock) {
			var rest = stock-number;
			document.getElementById('stock').innerHTML = rest;
			return true;
		}
		alert("Please enter proper amount of products!");
		cleanField();
		return false;
	}

	function cleanField() {
		document.getElementById('num_added').value = "";
		document.getElementById('num_added').focus();
	}

</script>