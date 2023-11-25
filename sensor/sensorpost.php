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
$tarikh = $fetch['rescue_date'];
$status = $fetch['rescue_stat'];

if ($level == 'DANGER MEDIUM' or $level == 'DANGER LOW' or $level == 'DANGER HIGH')
{
    if ($date > $tarikh)
    {
        $stat = 'true';
    }
    else if ($date == $tarikh)
    {
        if($status=='true')
        {
            $stat='true';
        }
        else if ($status == 'false')
        {
            $stat='false';
        }
    }
    $hari = $date;
}
else 
{
    $stat='false';
    $hari = $tarikh;
}

$query1 = "UPDATE `station` SET `rescue_stat`='$stat',`rescue_date`='$hari' WHERE station_id=$station";
$result1 = mysqli_query($mysqli,$query1);

$query = "INSERT INTO water (station_id,reading,level) VALUES ('$station','$reading','$level')";
$result = mysqli_query($mysqli,$query);

echo "Insertion Success!<br>";

?>

