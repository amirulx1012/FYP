<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

//$station_id = $_GET['station_id]
$reading = $_GET["reading"];
$level = $_GET["level"]; 
$date = date('Y-m-d');

$sql = "SELECT * FROM `station` WHERE station_id=111";
$res = mysqli_query($mysqli,$sql);
$fetch = mysqli_fetch_array($res);
$tarikh = $fetch['rescue_date'];

if ($tarikh == $date)
{
    $stat = 'false';
}

else
{
    $stat = 'true';
}

$query1 = "UPDATE `station` SET `rescue_stat`='$stat',`rescue_date`='$date' WHERE station_id=111";
$result1 = mysqli_query($mysqli,$query1);

$query = "INSERT INTO water (station_id,reading,level) VALUES ('111','$reading','$level')";
$result = mysqli_query($mysqli,$query);

echo "Insertion Success!<br>";

?>

