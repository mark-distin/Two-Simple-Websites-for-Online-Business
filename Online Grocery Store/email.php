<?php
	session_start();

	$first_name = $_POST['first'];
	$family_name = $_POST['family'];
	$address = $_POST['address'];
	$suburb = $_POST['suburb'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$email = $_POST['email'];
	$subject = "Order Confirmation from Grocery Store";
	$header = "MIME-Version: 1.0" . "\r\n";
	$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$message = "
	<html>
	<head>
	<title>Email for purchase confirmation</title>
	<h4>Dear ".$first_name." ".$family_name.",</h4>
	</head>
	<body>
	<p>Thank you for purchasing in our Grocery Store. This is an confirmation email for your orders.</p>
	<table>
	<tr>
	<th>Amount</th>
	<th>Product</th>
	<th>Unit Price</th>
	<th>Total</th>
	</tr>
	<tr><td colspan=4>---------------------------------------------------</td></tr>
	";
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Grocery Store</title>
</head>
	<h2 align="middle">Orders</h1>
<body>
	<table style="position: relative; top: -21px" border="0" width="100%"><tr><td align="middle" width="100%">
		<table border="0">
			<tr>
				<td>Amount</td>
				<td>Product</td>
				<td>Unit Price</td>
				<td>Total</td>
			</tr>
			<tr>
				<td style="position: relative; top: -13px" colspan="4">______________________________________________________________________________________________________</td>
			</tr>
				<?php
					$total = 0;				
					foreach($_SESSION['products'] as $arrays) {	
					if($arrays['amount'] != 0) {
				?>
			<tr>
				<td>
					<?php
						print $arrays['amount'];
						$message .= "
						<tr>
						<td>".$arrays['amount']."</td>
						";
					?>
				</td>
				<td>
					<?php
						print $arrays['product_name'];
						print " (".$arrays['unit_quantity'].")";
						$message .= "
						<td>".$arrays['product_name']."</td>
						";
					?>
				</td>
				<td>
					<?php
						print $arrays['unit_price'];
						$message .= "
						<td>".$arrays['unit_price']."</td>
						";
					?>
				</td>
				<td>
					<?php
						print $arrays['total'];
						$total = $total+$arrays['total'];
						$message .= "
						<td>".$arrays['total']."</td>
						</tr>
						"; 
					}
					}
					?>
				</td>
			</tr>
			<tr>
				<td style="position: relative; top: -6px" colspan="4">______________________________________________________________________________________________________</td>
			</tr>
			<tr>
				<td colspan="5" align="right">Subtotal:
					<span>
						<?php
							print $total; 
							$message .= "
							<tr><td colspan=4>---------------------------------------------------</td></tr>
							<tr><td colspan=4 align=right>Subtotal: ".$total."
							</td></tr>
							</table>
							<p>Thank you, have a good day!</p>
							</body>
							</html>
							";
						?>
					</span><br><br><br>
				</td>
			</tr>
			<tr>
				<td colspan=4 align="middle">
					<h2 style="font-style: italic">Thank you for purchase!</h1>
				</td>
			</tr>
		
	<tr>
		<td colspan="4">Thank you for your purchase in our store 
			<span style="font-style: italic; font-weight: bold">
				<?php
					print $first_name." ";
					print $family_name; 
				?>
			</span>
		</td>
	</tr>
	<tr>
		<td colspan="4">A confirmation email for the purchase will be sent this address: 
			<span style="font-style: italic; font-weight: bold">
				<?php
					print $email;
				?>
			</span>
		</td>
	</tr>
	<tr>
		<td colspan="4">The orders will be delivered to the address: 
			<span style="font-style: italic; font-weight: bold">
				<?php
					print $address.", ".$suburb.", ".$state.", ".$country;
				?>
			</span>
		</td>
	</tr>
	</table>
	</td></tr>
</table>
</body>
</html>

<?php
	mail($email, $subject, $message, $header);
	session_destroy();
?>
