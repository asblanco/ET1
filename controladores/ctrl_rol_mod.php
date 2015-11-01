<!--
===========================================================================
Controlador para modificar los datos de los roles
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_rol.php";

    //Conectar con la base de datos
    $db = new Database();

    $modRol = new Rol();

    //Nuevos datos
    $oldRolName = $_POST['oldName'];
    $newRolName = $_POST['rol'];
    $newRolDesc = $_POST['comment'];
    $users = array();
    $func = array();

    if(isset($_POST['newUsu'])){
      if (is_array($_POST['newUsu'])) {
        foreach($_POST['newUsu'] as $value){
          $users[] = $value;
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

    $newRol = new Rol($newRolName, $newRolDesc, $users, $func);
    if ($modRol->modificar($oldRolName, $newRol) == true){
        header('location:../vistas/vista_rol.php'); 
    }else {
        echo "Fallo en la actualizacion del rol";
    }

    //Desconectar de la base de datos
    $db->desconectar();
?>