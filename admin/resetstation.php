<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

include 'connectionAdmin.php';
$email = $_SESSION['email'];

$data = array(
    array('111', '3', 'NORMAL'),
    array('222', '6', 'ALERT'),
    array('333', '8', 'WARNING'),
    array('444', '11', 'DANGER LOW'),
    array('555', '14', 'DANGER MEDIUM'),
    array('666', '20', 'DANGER HIGH'),
);

$query = "INSERT INTO water (station_id, reading, level) VALUES ";
foreach ($data as $row) {
    $query .= "('" . implode("', '", $row) . "'), ";
}

// Remove the trailing comma and execute the query
$query = rtrim($query, ', ');
$result = mysqli_query($mysqli, $query);

$del= "DELETE FROM `rescue`";
$yapi = mysqli_query($mysqli,$del);

$que= "UPDATE station SET rescue_stat='true'";
$yap = mysqli_query($mysqli,$que);

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Sucessfully Reset Water Station');
window.location.href='index.php';
</SCRIPT>");
?>