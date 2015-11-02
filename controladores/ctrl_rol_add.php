<!--
===========================================================================
Controlador para añadir roles a la base de datos
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_rol.php";

    $rolName ; //traer de la vista
    $rolDesc;

    $rol = new Rol($rolName);

    //Se debe pasar el nombre, descripcion, usuarios y hacer un bucle para añadir los usuarios y funcionalidades asociadas
        
?>