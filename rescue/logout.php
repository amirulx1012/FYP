<?php
	include('connectionRescue.php');

	session_destroy();

	header('Location: index.php');
?>