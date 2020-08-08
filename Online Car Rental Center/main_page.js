window.onload = initiate;
var xml;
var cars = [];

function initiate()
{
    xml = new XMLHttpRequest();
    xml.onreadystatechange = loadCars;
    xml.open("get", "cars.xml", true);
    xml.send();
}

function loadCars() {
    if (xml.readyState == 4)
    {
        if (xml.status == 200 && xml.responseXML)
        {
            var allCars = xml.responseXML.getElementsByTagName("car");
            for (var i=0; i<allCars.length; i++)
            {
                cars[i] = [];
                /*var name = allCars[i].getAttributeNode("name").nodeValue;*/
                cars[i][0] = allCars[i].getElementsByTagName("brand")[0].childNodes[0].nodeValue;
                cars[i][1] = allCars[i].getElementsByTagName("model")[0].childNodes[0].nodeValue;
                cars[i][2] = allCars[i].getElementsByTagName("model_year")[0].childNodes[0].nodeValue;
                cars[i][3] = allCars[i].getElementsByTagName("mileage")[0].childNodes[0].nodeValue;
                cars[i][4] = allCars[i].getElementsByTagName("fuel_type")[0].childNodes[0].nodeValue;
                cars[i][5] = allCars[i].getElementsByTagName("seats")[0].childNodes[0].nodeValue;
                cars[i][6] = allCars[i].getElementsByTagName("price_per_day")[0].childNodes[0].nodeValue;
                cars[i][7] = allCars[i].getElementsByTagName("availability")[0].childNodes[0].nodeValue;
                cars[i][8] = allCars[i].getElementsByTagName("description")[0].childNodes[0].nodeValue;
            }
            displayCars();
        }
    }
}

function displayCars()
{
    var carTXT = "";
    for (var j=0; j<cars.length; j++)
    {
        carTXT = "<div><img src='images/" + cars[j][1] +".jpg'><p><span>" +
            cars[j][0] + "-" + cars[j][1] + "-" + cars[j][2] +"</span><br>" +
            "<b>Mileage (kms): </b>" + cars[j][3] + "<br>" +
            "<b>Fuel Type: </b>" + cars[j][4] + "<br>" +
            "<b>Seats: </b>" + cars[j][5] + "<br>" +
            "<b>Price Per Day: </b>" + cars[j][6] + "<br>" +
            "<b>Availability: </b>" + cars[j][7] + "<br><br>" +
            "<b>Description: </b>" + cars[j][8] + "<br><br>" +
            "<button id='" + cars[j][1] +"' onclick='validate(this.id)'>Add to Cart</button>" +
            "</p></div>";

        document.getElementById("cars").innerHTML += carTXT;
    }
}

function validate(carID)
{   
    var string;
    var id = carID;
   

    for (var j=0; j<cars.length; j++)
    {
        if (cars[j][1] == id)
        {
            if (cars[j][7] == "True")
            {   
                var brand = cars[j][0];
                var model = cars[j][1];
                var year = cars[j][2];
                var mile = cars[j][3];
                var fuel = cars[j][4];
                var seats = cars[j][5];
                var price = cars[j][6];
                var ava = cars[j][7];
                var des = cars[j][8];
                string = "brand=" + brand + "&" +  "model=" + model + "&" +  "year=" + year + "&" +  "mile=" + mile + "&" +  "fuel=" + fuel + "&" +  "seats=" + seats + "&" +  "price=" + price + "&" +  "ava=" + ava + "&" +  "des=" + des;
                    /*document.getElementById("test").innerHTML = string;*/
                reserveCar(id, string);
            }
            else if (cars[j][7] == "False")
            {
                alert("Sorry, the car is not available now. Please try other Cars.");
            }
        }
    }
}

function reserveCar(carID, string)
{
    var postStr = string;
    var php;
    var id = carID;

    php = new XMLHttpRequest();
    
    php.onreadystatechange = function()
    {
        if ((php.readyState == 4) && (php.status == 200))
        {
            if (php.responseText == "1")
            {
                alert("Add to the cart successfully.");
            }
            if (php.responseText == "2")
            {
                alert("This car has been added in cart.");
            }
        }
    }
    php.open("post", "reserve_cars.php", true);
    php.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    php.send(postStr);
}