<?php
	session_start();

	$total_payment = 0;
	$_SESSION['total_payment'] = 0;

	foreach ($_POST as $car => $rental_days) {
		$_SESSION['reserved_cars'][$car]['rental_days'] = $rental_days;
		$price_per_day = $_SESSION['reserved_cars'][$car]['price_per_day'];
		$payment = $price_per_day*$rental_days;
		$total_payment += $payment;
	}
	$_SESSION['total_payment'] = $total_payment;
?>

<html>
<head>
    <title>Hertz-UTS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="cart_and_form_page.js" type="text/javascript"></script>
</head>
<body>
    <nav>
        <img id="uts" src="images/uts.png">
        <img id="chain" src="images/chain.png">
        <img id="hertz" src="images/hertz.png">
        <div id="title" align="middle">Car Rental Center</div>
    </nav>
    <table border="0" width="100%" height="80%">
        <tr>
            <td width="30%"></td>
            <td>
            	<form id="checkout_form" name="checkout_form" action="email.php" method="post" onsubmit="return validate_input_field()">
	            	<table border="0" width="40%">
	            		<tr>
	            			<td colspan="2" align="middle"><h2>Check Out</h2><br></td>
	            		</tr>
	            		<tr>
	            			<td colspan="2"><h2 align="left">Personal Details and Payment</h2></td>
	            		</tr>
	            		<tr>
	            			<td colspan="2" height="30px" style="padding-bottom: 14px;"><p align="left">Please fill your details. (<span class="red">*</span> is compulsory field.)</p></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">First Name<span class="red">*</span></td>
	            			<td><input class="input_field" type="text" id="first" name="first"></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">Last Name<span class="red">*</span></td>
	            			<td><input class="input_field" type="text" id="last" name="last"></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">Email Address<span class="red">*</span></td>
	            			<td><input class="input_field" type="text" id="email" name="email"></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">Address Line 1<span class="red">*</span></td>
	            			<td><input class="input_field" type="text" id="address1" name="address1"></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">Address Line 2</td>
	            			<td><input class="input_field" type="text" id="address2" name="address2"></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">City<span class="red">*</span></td>
	            			<td><input class="input_field" type="text" id="city" name="city"></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">State<span class="red">*</span></td>
	            			<td><input class="input_field" type="text" id="state" name="state"></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">Post Code<span class="red">*</span></td>
	            			<td><input class="input_field" type="text" id="postcode" name="postcode"></td>
	            		</tr>
	            		<tr>
	            			<td class="field_name">Payment Type<span class="red">*</span></td>
	            			<td>
	            				<select class="input_field" id="payment" name="payment">
	            					<option value="Paypal">Paypal</option>
	            					<option value="VISA">VISA</option>
	            					<option value="Master Card">Master Card</option>
	            					<option value="American Express">American Express</option>
	            					<option value="UnionPay">UnionPay</option>
	            					<option value="BitCoin">BitCoin</option>
	            					
	            				</select>
	            			</td>
	            		</tr>
	            		<tr>
	            			<td colspan="2" class="price">The total payment is: 
	            				<?php
									print "$".$total_payment;
								?>
	            				
	            			</td>
	            		</tr>

	            		<tr>
	            			<td colspan="2" height="50px">
	            				<a href="main_page.html" class="button" style="float: right">Select More Cars</a>
	            				<input id="checkout_button" type="submit" value="Confirm Booking" 
	            				style="float: right; 
	            						position: relative; 
	            						right: 20px;">
	            			</td>
	            		</tr>
	            	</table>
            	</form>
            </td>
            <td width="30%"></td>
        </tr>
    </table>
</body>
</html>