<?php
include_once '../modelo/connect_DB.php';

$db = new Database();

session_start();
$modif = 'UPDATE Usuario SET idioma = "en" WHERE Usuario.Login = "'.$_SESSION["login_usuario"].'"';

$Resultado = $db->consulta($modif);

if($Resultado){
	$_SESSION["idioma_usuario"] = "en";
}



header('Location: ' . $_SERVER['HTTP_REFERER']);


?>