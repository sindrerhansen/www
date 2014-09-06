<?php
$con=mysqli_connect("localhost","root","Kaffe123","arduino");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$brewSessionName = mysqli_real_escape_string($con, $_POST['brewSessionName']);
$hwtMashInTemp_SP = mysqli_real_escape_string($con, $_POST['hwtMashInTemp_SP']);
$mashVolume_SP = mysqli_real_escape_string($con, $_POST['mashVolume_SP']);
$mashTankTemp_SP = mysqli_real_escape_string($con, $_POST['mashTankTemp_SP']);
$mashTime_SP = mysqli_real_escape_string($con, $_POST['mashTime_SP']);
$hwtMashOutRiseTemp_SP = mysqli_real_escape_string($con, $_POST['hwtMashOutRiseTemp_SP']);
$mashOutTime_SP = mysqli_real_escape_string($con, $_POST['mashOutTime_SP']);
$spargeVolume = mysqli_real_escape_string($con, $_POST['spargeVolume']);
$boilTime = mysqli_real_escape_string($con, $_POST['boilTime']);


$sql="UPDATE current_brew_session SET upd = 1, hwtMashInTemp_SP ='$hwtMashInTemp_SP', mashVolume_SP = '$mashVolume_SP', mashTankTemp_SP = '$mashTankTemp_SP', mashTime_SP = '$mashTime_SP', hwtMashOutRiseTemp_SP = '$hwtMashOutRiseTemp_SP', mashOutTime_SP = '$mashOutTime_SP', spargeVolume = '$spargeVolume', boilTime = '$boilTime', brewSessionName = '$brewSessionName' WHERE idcom = 1";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "Updated";


mysqli_close($con);
?>