<?php

	session_start();

	$link = mysqli_connect("localhost", "admin", "adminpass", "ifase") or die("Connection failed");



	if(!(isset($_SESSION['email']) && isset($_SESSION['password'])))
	{
		header("Location: http://".$_SERVER['HTTP_HOST']."/FYP/login.php");
	}

	else
	{
		$email = $_SESSION['email'];

		$query = mysqli_query($link, "SELECT email FROM users WHERE email = '$email' AND type='rescue'");

		if (mysqli_num_rows($query) <= 0)
		{
			header("Location: http://".$_SERVER['HTTP_HOST']."/FYP/login.php");
		}
	}

?>