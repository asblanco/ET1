191<?php
session_start();
if (!(isset($_SESSION['login'])))
	header('location:./vistas/login.php');
else
	header('location:./vistas/menu.php');

?>


