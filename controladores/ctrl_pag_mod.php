<?php
    include_once "../modelo/model_pag.php";

    $modPag = new Pagina();
    $db = new Database();
    //Nuevos datos
    $oldPagName = $_POST['oldName'];  
    $newPagDesc = $_POST['newDesc'];
    $usu = array();
    $func = $_POST['newFunc'];
    $url = $oldPagName;
   

    if(isset($_POST['newUsu'])){
      if (is_array($_POST['newUsu'])) {
        foreach($_POST['newUsu'] as $value){
          $usu[] = $value;
        }
      }
    }
  
    $newPag = new Pagina($url, $oldPagName, $newPagDesc, $usu, $func);
    if ($modPag->modificar($url, $newPag) == true){
        header('location:../vistas/vista_pag.php'); 
    }else {
        echo "Fallo en la actualizacion de la pagina";
    }

?>

