<?php 

 include_once '../modelo/connect_DB.php';
 include_once '../modelo/model_pag.php';
$db=new Database();
$pag=new Pagina();
$num=0;
/*
 $sql = ("SELECT Login FROM Usuario");
 $Resultado = $db->consulta($sql); 
    while ($row = mysqli_fetch_array($Resultado))
       {
         echo $row['Login'];
       }*/
                                
$sqlUsu = 'SELECT Login FROM Usu_Pag WHERE Url = \'' . $_SERVER['PHP_SELF'] . '\'';

$Resultado = $db->consulta($sqlUsu);
$row = mysqli_fetch_array($Resultado);


foreach ($row as $fila) {
	


	 if($fila  == $_SESSION["login_usuario"]){
            $num=1;
}
//print_r($fila);


}
print_r($num);

if ($num != 1) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);

           }

?>