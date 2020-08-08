<?php
	session_start();
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Online Grocery Store</title>
</head>
<body>
	<p style="font-size: 25px; margin-top: 10px;"><b>Shopping Cart:</b><br>
		<p>
		
	</p>
	<table style="font-weight: bold; position: relative; left: 20px;" border="0" width="700px">
		<tr>
			<td>Product</td>
			<td>Unit Price</td>
			<td>Unit Quantity</td>
			<td>Amount</td>
			<td>Total</td>
		</tr>
		<tr>
			<td colspan="5">---------------------------------------------------------------------------------------------------</td>
		</tr>

		<?php
			if (isset($_GET['a'])) {
		?>	

		<tr>
			<td colspan="5">The cart is empty.</td>
		</tr>
		<tr>
			<td colspan="5">---------------------------------------------------------------------------------------------------</td>
		</tr>
		<tr>
			<td colspan="5" align="right">Subtotal:<span id="total"></span></td>
		</tr>

		<?php
			}
			if (isset($_POST['num_added'])) {
				$amount = (integer)$_POST['num_added'];
				$id = $_SESSION['current_id'];
				$total = 0;
				$arrays = array();

				$_SESSION['products'][$id]['amount'] += $amount;
				$_SESSION['products'][$id]['in_stock'] -= $amount;
				$_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['unit_price']*$_SESSION['products'][$id]['amount'];

				foreach($_SESSION['products'] as $arrays) {
					if($arrays['amount'] != 0) {
		?>

		<tr>
			<td>
				<?php
					print $arrays['product_name'];
				?>
			</td>
			<td>
				<?php
					print $arrays['unit_price'];
				?>
			</td>
			<td>
				<?php
					print $arrays['unit_quantity'];
				?>
			</td>
			<td>x
				<?php
					print $arrays['amount'];
				?>
			</td>
			<td>
				<?php
					print $arrays['total'];
					$total = $total+$arrays['total'];
				}
				}
				?>
			</td>
		</tr>
		<tr>
			<td colspan="5">---------------------------------------------------------------------------------------------------</td>
		</tr>
		<tr>
			<td colspan="5" align="right">Subtotal:
				<span id="total">
					<?php
						print $total; 
					?>
				</span>
			</td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td colspan="5" align="right">
				<a href="cart.php?a=1" onclick="parent.frames['product_info'].location.href='product_info.php?a=1';"><button style="position: relative; right: 20px;">Clear All</button></a>
				<a href="purchase_form.php" target="_parent" onclick="return validate_cart()"><button>Checkout</button></a>
			</td>
		</tr>
	</table>
</body>
</html>

<script>

	function validate_cart() {
		var subtotal = document.getElementById('total').innerHTML;
		if(subtotal == "") {
			alert("The shopping cart cannot be empty!");
			return false;
		}
		return true;

	}

</script>
