<?php
	session_start();
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
            <td width="10%"></td>
            <td>
            	<form id="rental_form" name="rental_form" action="checkout.php" method="post" onsubmit="return validate_checkout()">
	            	<table border="0" width="75%">
	            		<tr>
	            			<td colspan="5" align="middle"><h2>Car Reservation</h2><br></td>
	            		</tr>
	            		<tr>
	            			<th>Thumbnail</th>
	            			<th>Vehicle</th>
	            			<th>Price Per Day</th>
	            			<th>Rental Days</th>
	            			<th>Actions</th>
	            		</tr>

	            		<?php
	            			if (isset($_SESSION['reserved_cars']))
	            			{	
	            				$cars = array();
	            				$cars = $_SESSION['reserved_cars'];

	            				foreach ($cars as $model => $value) {
	            					if (isset($value)) 
	            					{
	            						print "<tr class='hide_table'  id='".$value['model']."'>
	            							   <td><img src='images/".$value['model'].".jpg'></img></td>
	            							   <td>".$value['brand']."-".$value['model']."-".$value['model_year']."</td>
	            							   <td>".$value['price_per_day']."</td>
	            							   <td><input class='days' type='number' name='".$value['model']."' min='1'></td> 
									   <td><button form=''  id='".$value['model']."' onclick='delete_car(this.id)'>Delete</button></td>
	            							   </tr>";
	            					}
	            				}
	            			}
	            		?>

	            		<tr>
	            			<td colspan="5" height="50px">
	            				<input form="rental_form" id="checkout_button" type="submit" value="Processing to CheckOut">
	            			</td>
	            		</tr>
	            	</table>
            	</form>
            </td>
            <td width="10%"></td>
        </tr>
    </table>
</body>
</html>
