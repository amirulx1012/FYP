<?php
	session_start();

	$link = mysqli_connect("localhost", "admin", "adminpass", "ifase") or die("Connection failed");

	if(!(isset($_SESSION['email']) && isset($_SESSION['password'])))
	{
		header("Location: http://".$_SERVER['HTTP_HOST']."/FYP/login.php");
	}

?>