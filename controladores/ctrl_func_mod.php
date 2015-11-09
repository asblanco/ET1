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

    $newFunc = new Funcionalidad($newFuncName, $newFuncDesc);
    
        $modFunc->modificar($oldFuncName, $newFunc);
        header('location:../vistas/vista_func.php'); 
?>

