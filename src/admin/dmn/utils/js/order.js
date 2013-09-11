var query 	= null;
var act 	= 0;


function order_update(id_order, action)
{
	query 	= null;
	act 	= action;
		
	if(window.XMLHttpRequest) 
	{
		query = new XMLHttpRequest();
	}
	
	if(window.ActiveXObject)  
	{
		query = new ActiveXObject('Microsoft.XMLHTTP');
	}
	
	query.onreadystatechange 	= success_update;	
	params 						= "o=" + id_order + "&s=" + $("#status").val() + "&a=" + action;
			 
	//alert(params);
	query.open("POST","order_update.php",true);
	query.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	query.send(params);
}


function success_update()
{
	//alert(query.responseText);	
	
	if ( query.readyState == 4 )
    {
		//alert((cquery.responseText == "error")); 
		if ( query.responseText == "error" )
		{
			alert("Неизвестная ошибка! Невозможно изменить статус заказа!");
		}
		else
		{
			if (act == 0)
			{
				$("#status_order").text(query.responseText);
			}
			else
			{
				window.location = "index.php?d=" + query.responseText;
			}
		}
	}
}
