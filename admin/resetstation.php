<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

include 'connectionAdmin.php';
$email = $_SESSION['email'];

$del= "DELETE FROM `rescue`";
$yapi = mysqli_query($mysqli,$del);

$que= "UPDATE station SET rescue_stat='true'";
$yap = mysqli_query($mysqli,$que);

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Sucessfully Reset Water Station');
window.location.href='index.php';
</SCRIPT>");
?>