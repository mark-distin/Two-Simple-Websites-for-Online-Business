<?php
	session_start();
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Grocery Store</title>
</head>
	<h2 align="middle">Preview Orders</h1>
<body>
	<table style="font-weight: bold; position: relative; top: -21px" border="0" width="100%"><tr><td align="middle" width="100%">
	<table border="0">
		<tr>
			<td>Amount</td>
			<td>Product</td>
			<td>Unit Price</td>
			<td>Total</td>
		</tr>
		<tr>
			<td style="position: relative; top: -13px" colspan="4">_____________________________________________________________________________</td>
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
				?>
			</td>
			<td>
				<?php
					print $arrays['product_name'];
					print " (".$arrays['unit_quantity'].")";
				?>
			</td>
			<td>
				<?php
					print $arrays['unit_price'];
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
			<td style="position: relative; top: -6px" colspan="4">_____________________________________________________________________________</td>
		</tr>
		<tr>
			<td colspan="5" align="right">Subtotal:
				<span>
					<?php
						print $total; 
					?>
				</span><br><br><br>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="middle">
				<h2>Purchase Form</h1>
			</td>
		</tr>

		<form id="form" name="form" action="email.php" method="post" onsubmit="return validate_info()">
			<tr>
				<td>First Name:<span class="red">*</span>
				</td>
				<td colspan="3"><input type="text" id="first" name="first" size="65"></td>
			</tr>
			<tr>
				<td>Family Name:<span class="red">*</span>
				</td>
				<td colspan="3"><input type="text" id="family" name="family" size="65"></td>
			</tr>
			<tr>
				<td>Address:<span class="red">*</span>
				</td>
				<td colspan="3"><input type="text" id="address" name="address" size="65"></td>
			</tr>
			<tr>
				<td>Suburb:<span class="red">*</span>
				</td>
				<td colspan="3"><input type="text" id="suburb" name="suburb" size="65"></td>
			</tr>
			<tr>
				<td>State:<span class="red">*</span>
				</td>
				<td colspan="3"><input type="text" id="state" name="state" size="65"></td>
			</tr>
			<tr>
				<td>Country:<span class="red">*</span>
				</td>
				<td colspan="3"><input type="text" id="country" name="country" size="65"></td>
			</tr>
			<tr>
				<td>Email Address:<span class="red">*</span>
				</td>
				<td colspan="3"><input type="text" id="email" name="email" size="65"></td>
			</tr>
			<tr>
				<td id="position" colspan="4" align="right">
					<input id="purchase" name="purchase" type="submit" value="Purchase">
					</input>
				</td>
			</tr>
		</form>
	</table>
	</td></tr></table>
</body>
</html>

<script>
	
	function validate_info() {
		if (blanks()) {
			alert("One or more compulsory fields is blank");
			return false;
		}
		var email = document.getElementById('email');
		if (validEmail(email)) {
			alert("Invalid Email Address");
			return false;
		}
		return true;
	}

	function blanks() {
		var compulsory_fields = new Array("first","family","address","suburb","state","country","email")
		for (i=0; i< compulsory_fields.length; i++) {
			var field = document.getElementById(compulsory_fields[i]);
			if (field.value == "")
				return true;
		}
		return false;
	}

	function validEmail(email) {
		var value = email.value;
		var email_filter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
		var illegalChars = /[\(\)\<\>\,\;\:\\\"\[\] ]/ ; 
		if (!email_filter.test(value)) {
			return true;
		}
		else if (value.match(illegalChars)) {
			return true;
		}
		else {
			return false;
		}
	}

</script>
