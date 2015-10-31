<!--
===========================================================================
Controlador para añadir funcionalidades a la base de datos
Creado por: David Ansia Fernández
Fecha: 31/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_func.php";
    
    $db = new Database();

    $funName ; //traer de la vista
    $funDesc;

    $func = new Funcionalidad($funName);

    //Se debe pasar el nombre, descripcion, usuarios y hacer un bucle para añadir los usuarios y funcionalidades asociadas
        
    

    $db->desconectar();
?>
