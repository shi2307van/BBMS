<?php
	include_once "../connection.php";
	session_start();
	unset($_SESSION['user']);
	header('Location:index.php');
?>