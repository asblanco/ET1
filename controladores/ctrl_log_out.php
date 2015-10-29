<?php
//Se inicializa la sesión
session_start();
//se destruye la sesión
session_destroy();
//se redirige al Login 
header('Location:../vistas/login.php');
?>
