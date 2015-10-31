<?php
session_start();
if (!(isset($_SESSION['login'])))
	header('location:./menu.php');
else
	header('location:./login.php');

?>