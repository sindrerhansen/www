<?php
$con = mysql_connect("localhost","root","Kaffe123");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("bryggelogg", $con);

$result = mysql_query("SELECT * FROM bryggnrtest");

while($row = mysql_fetch_array($result)) {
  echo $row['date_enterd'] . "\t" . $row['Temp1']. "\t" . $row['Temp2']. "\t" . $row['Temp3'].  "\t" . $row['Liter']."\n";
}
mysql_close($con);
?> 