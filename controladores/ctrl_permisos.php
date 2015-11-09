<?php 

 include_once '../modelo/connect_DB.php';
 include_once '../modelo/model_pag.php';
$db=new Database();
$sqlUsu = 'SELECT Login FROM Usu_Pag WHERE Login = "'.$_SESSION["login_usuario"].'" AND Url = "'.$_SERVER["PHP_SELF"].'"';
$Resultado = $db->consulta($sqlUsu);

$numfilas = mysqli_num_rows($Resultado);

if($numfilas==0)

	{
	
header('Location: ' . $_SERVER['HTTP_REFERER']);
	}



?>