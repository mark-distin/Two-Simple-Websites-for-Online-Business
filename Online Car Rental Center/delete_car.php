<?php
	session_start();

	if(isset($_GET['car']))
	{	
		$carID = $_GET['car'];
		$_SESSION['reserved_cars'][$carID] = null;
		echo "1";
	}
?>
