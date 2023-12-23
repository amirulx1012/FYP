<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

include 'connectionAdmin.php';
$email = $_SESSION['email'];

$cmd= "UPDATE `pps` SET `curr_cap`='0'";
$yek = mysqli_query($mysqli,$cmd);

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Sucessfully Reset PPS');
window.location.href='index.php';
</SCRIPT>");
?>