<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'Kaffe123');
define('DBNAME', 'bryggelogg');

$db = new mysqli(HOST, USER, PASS, DBNAME);

if (mysqli_connect_errno()) {
	printf("Connect failed: %s<br/>", mysqli_connect_error());
}


$sql = "SELECT date_enterd, Temp1, Temp2 FROM bryggnrtest";
$result_db = $db->query($sql);
$result = array();
while ($row = $result_db->fetch_assoc()) {
	$result[] = $row;
}

echo json_encode($result);
$db->close();
?>