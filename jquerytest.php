<html>
<head>
<script type="text/javascript" src="jquery.js"></script>	
<script type="text/javascript">
	function get(){
		$.post('datajqury.php', {name: form.name.value},
			function(output) {
				$('#age').html (output).show();
			});
	}

</script>
<body>
<p>
<form name="form">
	<input type="text" name="name"><input type="button" value="Get" onclick="get();">

</form>
<div id="age">
	
</div>
</p>
</body>

 
	


</head>
</html>

