<?php
	session_start();

	$email = $_POST['email'];
	$first_name = $_POST['first'];
	$last_name = $_POST['last'];
	$total_payment = $_SESSION['total_payment'];
	$subject = "Car booking details from Hertz-UTS";
	$header = "MIME-Version: 1.0" . "\r\n";
	$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$message = "
	<html>
	<head>
	<title>Email for car booking</title>
	<h4>Dear ".$first_name." ".$last_name.",</h4>
	</head>
	<body>
	<p>Thank you for renting cars from Hertz-UTS, The total payment is: $.".$total_payment.".<br>
	Booking details a as follows:
	</p>";

	foreach ($_SESSION['reserved_cars'] as $car => $details) 
	{
		if (isset($details))
		{
			$brand = $details['brand'];
			$model = $details['model'];
			$model_year = $details['model_year'];
			$mileage = $details['mileage'];
			$fuel_type = $details['fuel_type'];
			$seats = $details['seats'];
			$price_per_day = $details['price_per_day'];
			$rental_days = $details['rental_days'];
			$description = $details['description'];

			$message .= "
			<P>Model: ".$brand."-".$model."-".$model_year."<br>
			Mileage: ".$mileage." kms<br>
			Fuel Type: ".$fuel_type."<br>
			Seats: ".$seats."<br>
			Price Per Day: ".$price_per_day."<br>
			Rent Days: ".$rental_days."<br>
			Description: ".$description."<br>
			</p>";
		}
	}
	$message .= "
	</body>
	</html>
	";
?>

<html>
<head>
    <title>Hertz-UTS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
            <td width="25%"></td>
            <td valign="top">
            	<P><h1 align="middle" style="font-style: italic;">Thank you for booking!</h1><br>
            		<p style="text-align: center; font-style: italic; font-size: 21px;">Please check the order details in email: 
	            		<?php
	            			print $email;
	            		?>
            		</p>
            	</P>
            </td>
            <td width="25%"></td>
        </tr>
    </table>
</body>
</html>   

<?php
	mail($email, $subject, $message, $header);
	session_destroy();
?>
