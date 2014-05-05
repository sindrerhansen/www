<?php


  $mysqli =mysqli_connect('localhost', 'root', 'Kaffe123', 'temperaturlogg');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}


  $sql = mysqli_query($mysqli, 'SELECT * FROM tempdata');

  if (!$sql) {
  die("Error running $sql: " . mysql_error());
  }



  $results = array();
  while($row = mysqli_fetch_assoc($sql))
{
   $results[] = array(
      'Date' => $row['date_entered'],
      'Temperature1' => $row['temp1']
   );
}
$json = json_encode($results, JSON_PRETTY_PRINT);
echo $json;

?>