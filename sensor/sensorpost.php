<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

$station = $_POST["station"];
$reading = $_POST["reading"];
$level = $_POST["level"]; 
date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('Y-m-d');

$sql = "SELECT * FROM `station` WHERE station_id=$station";
$res = mysqli_query($mysqli,$sql);
$fetch = mysqli_fetch_array($res);

$que= "UPDATE station SET rescue_stat='true', rescue_date='$date' WHERE station_id=$station";
$yap = mysqli_query($mysqli,$que);

$query = "INSERT INTO water (station_id,reading,level) VALUES ('$station','$reading','$level')";
$result = mysqli_query($mysqli,$query);

echo "Insertion Success!<br>";

?>

