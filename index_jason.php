
<!DOCTYPE html>
<head>
<script type="text/javascript" src="js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="js/highcharts.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
	$.getJSON('data_jason.php',null,function(data){			
            if(data) {
		//alert(data[0].id);
		var table = '<table border="1">';
		table += '<tr><td>User Id</td><td>User Name</td><td>User Age</td></tr>';
		$.each(data,function(i,element){
			table +='</tr>';
			table +='<td>'+ element.date_enterd + '</td>';
			table +='<td>'+ element.Temp1 + '</td>';
			table +='<td>'+ element.Temp2 + '</td>';
			table +='</tr>';
		});
		table +='</table>';
	      $('#user_profile_content').html(table);
	    }
	    else {
		alert('error');
	    }
}); 
    </script>
</head>
<html>