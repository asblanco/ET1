<!--
===========================================================================
Controlador para modificar los datos de los roles
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_rol.php";

    $modRol = new Rol();

    //Nuevos datos
    $oldRolName = $_POST['oldName'];
    $newRolName = $_POST['rol'];
    $newRolDesc = $_POST['comment'];
    $newUsers = array();
    $func = array();

    if(isset($_POST['newUsuRol'])){
      if (is_array($_POST['newUsuRol'])) {
        foreach($_POST['newUsuRol'] as $value){
          $newUsers[] = $value;
        }
      }
    }

    if(isset($_POST['newFuncRol'])){
      if (is_array($_POST['newFuncRol'])) {
        foreach($_POST['newFuncRol'] as $value){
          $func[] = $value;
        }
      }
    }

    $newRol = new Rol($newRolName, $newRolDesc, $newUsers, $func);
    if ($modRol->modificar($oldRolName, $newRol) == true){
        header('location:../vistas/vista_rol.php'); 
    }else {
        echo "Fallo en la actualizacion del rol";
    }
?>