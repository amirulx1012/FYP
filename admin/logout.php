<?php
	include('connectionAdmin.php');

	session_destroy();

	header('Location: index.php');
?>