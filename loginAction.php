<?php
	
	include ('connection.php');

		$email = $_POST['email'];
		$password = $_POST['password'];

		$query = mysqli_query($link, "SELECT * FROM users WHERE email='$email' AND password = '$password'");

		if (mysqli_num_rows($query) > 0)
		{

			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;

			$fetch = mysqli_fetch_array($query);
			$type = $fetch['type'];

			if(isset($_SESSION['email']) && isset($_SESSION['password']))
			{
				if ($type == "admin")
				{
					header ("Location: admin/");
				}

				else if ($type == "rescue")
				{
					header ("Location: rescue/");
				}
			}
		}
		else
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
    		window.alert('Login Successfully');
    		window.location.href='index.php';
    		</SCRIPT>");
		}
?>