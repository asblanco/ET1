<?php 

 include_once '../modelo/connect_DB.php';
 include_once '../modelo/model_pag.php';
$db=new Database();
$pag=new Pagina();
$num=0;

                                
$sqlUsu = 'SELECT Login FROM Usu_Pag WHERE Url = \'' . $_SERVER['PHP_SELF'] . '\'';

$Resultado = $db->consulta($sqlUsu);
$row = mysqli_fetch_array($Resultado);


foreach ($row as $fila) {
	


	 if($fila  == $_SESSION["login_usuario"]){
            $num=1;
}


}

if ($num != 1) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);

           }

?>