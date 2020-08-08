<?php
    session_start();

    if (isset($_POST))
    {
        $carID = $_POST['model'];
        
        if (!isset($_SESSION['reserved_cars'][$carID]))
        { 
             
            $_SESSION['reserved_cars'][$carID]['brand'] = $_POST['brand'];
            $_SESSION['reserved_cars'][$carID]['model'] = $_POST['model'];
            $_SESSION['reserved_cars'][$carID]['model_year'] = $_POST['year'];
            $_SESSION['reserved_cars'][$carID]['mileage'] = $_POST['mile'];
            $_SESSION['reserved_cars'][$carID]['fuel_type'] = $_POST['fuel'];
            $_SESSION['reserved_cars'][$carID]['seats'] = $_POST['seats'];
            $_SESSION['reserved_cars'][$carID]['price_per_day'] = $_POST['price'];
            $_SESSION['reserved_cars'][$carID]['availability'] = $_POST['ava'];
            $_SESSION['reserved_cars'][$carID]['description'] = $_POST['des'];
            $_SESSION['reserved_cars'][$carID]['rental_days'] = 0;
          
            echo "1"; #return 1 when successfully reserved car first time.
        }
        else
        {   
            echo "2"; #if the car has been reserved, return 2.
        } 
    }
?>
