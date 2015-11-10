<?php
    include_once "../modelo/model_pag.php";

    $modPag = new Pagina();

    //Nuevos datos
    $oldPagName = $_POST['oldPag'];
    $newPagName = $_POST['newPag'];
    $newPagDesc = $_POST['newDesc'];
    $func = $_POST['newFuncPag'];
    $url = $modPag->getUrl($oldPagName);
    $usu = array();
   

    if(isset($_POST['newUsuPag'])){
      if (is_array($_POST['newUsuPag'])) {
        foreach($_POST['newUsuPag'] as $value){
          $usu[] = $value;
        }
      }
    }
  
    $newPag = new Pagina($url, $newPagName, $newPagDesc, $usu, $func);
    if ($modPag->modificar($url, $newPag) == true){
        header('location:../vistas/vista_pag.php'); 
    }else {
        echo "Fallo en la actualizacion de la pagina";
    }

?>

