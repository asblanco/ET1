<?php
    include_once "../modelo/model_pag.php";

    $modFunc = new Funcionalidad();

    //Nuevos datos
    $oldPagName = $_POST['oldName'];
    $newPagName = $_POST['pag'];
    $newFuncDesc = $_POST['comment'];
    $usu = array();
    $func = array();

    if(isset($_POST['newUsu'])){
      if (is_array($_POST['newUsu'])) {
        foreach($_POST['newUsu'] as $value){
          $usu[] = $value;
        }
      }
    }

    if(isset($_POST['newFunc'])){
      if (is_array($_POST['newFunc'])) {
        foreach($_POST['newFunc'] as $value){
          $func[] = $value;
        }
      }
    }

    $newPag = new Pag($newPagName, $newPagDesc, $usu, $func);
    if ($modFunc->modificar($oldFuncName, $newFunc) == true){
        header('location:../vistas/vista_pag.php'); 
    }else {
        echo "Fallo en la actualizacion de la pagina";
    }

?>
