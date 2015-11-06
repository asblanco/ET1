<!--
===========================================================================
Controlador para modificar los datos de los roles
Creado por: David Ansia
Fecha: 06/11/2015
============================================================================
-->

<?php
    include_once "../modelo/model_func.php";

    $modFunc = new Funcionalidad();

    //Nuevos datos
    $oldFuncName = $_POST['oldName'];
    $newFuncName = $_POST['newName'];
    $newFuncDesc = $_POST['newDesc'];
    $newRoles = array();
    $newPags = array();

    if(isset($_POST['newRolFunc'])){
      if (is_array($_POST['newRolFunc'])) {
        foreach($_POST['newRolFunc'] as $value){
          $newRoles[] = $value;
        }
      }
    }

    if(isset($_POST['newPagFunc'])){
      if (is_array($_POST['newPagFunc'])) {
        foreach($_POST['newPagFunc'] as $value){
          $newPags[] = $value;
        }
      }
    }

    $newRol = new Funcionalidad($newFuncName, $newFuncDesc, $newRoles, $newPags);
    if ($modFunc->modificar($oldFuncName, $newFuncName) == true){
        header('location:../vistas/vista_func.php'); 
    }else {
        echo "Fallo en la actualizacion de la funcionalidad";
    }
?>
