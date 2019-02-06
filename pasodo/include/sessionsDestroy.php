<?php
session_start();
	$userName = $_GET["userName"];
	unset($userName);
	session_destroy();
	header('Location: ../index.php');
	exit;
?>