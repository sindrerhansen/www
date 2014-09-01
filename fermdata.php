<?php
$con = mysql_connect("localhost","root","Kaffe123");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("fermentation_logg", $con);

$result = mysql_query("SELECT * FROM fermentation2_temp");

while($row = mysql_fetch_array($result)) {
  echo $row['timeEnterd'] . "\t" . $row['temp']. "\n";
}
mysql_close($con);
?> 