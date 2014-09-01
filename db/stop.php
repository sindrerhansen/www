
<?php
 $sqlcon = mysql_connect("localhost","root","Kaffe123","arduino"); 
 $result = mysql_query("UPDATE arduino.com SET change = 1, startbrewing=0 WHERE idcom =1", $sqlcon); 
 mysql_close($sqlcon);
 echo $result;
 ?>
