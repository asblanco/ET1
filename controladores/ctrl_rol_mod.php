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
    $newRol = new Rol($newRolName, $newRolDesc);
    if ($modRol->modificar($oldRolName, $newRol) == true){
        header('location:../vistas/vista_rol.php'); 
    }else {
        echo "Fallo en la actualizacion del rol";
    }

    //Desconectar de la base de datos
    $db->desconectar();
?>