
function delete_car(carID)
{
    var ajax;
    var car = carID;
    ajax= new XMLHttpRequest();

    ajax.onreadystatechange = function()
    {
        if ((ajax.readyState == 4) && (ajax.status == 200))
        {
            if (ajax.responseText == "1")
            {   
                document.getElementById(car).style.display = "none";
            }
        }
    }
    
    ajax.open("GET", "delete_car.php?car="+car, true);
    ajax.send();
}

function validate_checkout()
{
    var day_field = document.getElementsByClassName('days');
    var hide_table = document.getElementsByClassName('hide_table');
    var num=0;
	for (var a=0;  a<hide_table.length; a++ )
	{	
		if(hide_table[a].style.display == "none")
		{
			num++;
		}
	}
	if(num == hide_table.length)
	{
		alert("No car has been reserved.");
		document.getElementById('rental_form').action = "main_page.html";
		return true;
	}

    if (day_field.length === 0)
    {
        alert("No car has been reserved.");
        document.getElementById('rental_form').action = "main_page.html";
        return true;
    }
    else if(day_field.length > 0)
    {
        for (var i=0; i<day_field.length; i++)
	{		
	
            if (day_field[i].value == "")
            {
                day_field[i].focus();
                alert("One or more cars have no rental days.");
                return false;
            }
	}
    }
}

function validate_input_field()
{
    if (blanks()) {
        alert("One or more required fields is blank");
        return false;
    }

    var email = document.getElementById('email');
    if (validEmail(email))
    {
        email.focus();
        alert("Invalid Email address.");
        return false;
    }

    var postcode = document.getElementById('postcode');
    if (!validPostcode(postcode.value))
    {
        postcode.focus();
        alert("Invalid postcode.");
        return false;
    }
    return true;
}

function blanks()
{
    var required_fields = ["first", "last", "email", "address1", "city", "state", "postcode", "payment"];
    for (var j=0; j<required_fields.length; j++)
    {
        var field = document.getElementById(required_fields[j]);
        if (field.value == "")
        {
            field.focus();
            return true;
        }
    }
    return false;
}

function validEmail(email)
{
    var value = email.value;
    var email_filter = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
    var illegalChars = /[\(\)\<\>\,\;\:\\\"\[\] ]/;

    if (!email_filter.test(value))
        return true;
    else if (value.match(illegalChars))
        return true;
    else
        return false;
}

function validPostcode(pcode)
{
    var lenofcode = pcode.length;
    var digits = "0123456789";
    var currchar;
    var currdigit;
    var charOK;

    for (var x=0; x<lenofcode; x++)
    {
        currchar = pcode.charAt(x);
        charOK = false;

        for (var y=0; y<digits.length; y++)
        {
            currdigit = digits.charAt(y);
            if (currchar == currdigit)
            {
                charOK = true;
                break;
            }
        }
        if (charOK == false)
            return false;
    }
    return true;
}
