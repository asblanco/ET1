<!--
===========================================================================
Controlador para modificar los datos de los roles
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once '../modelo/connect_DB.php';
    include_once "../modelo/model_rol.php";

    //Conectar con la base de datos
    $db = new Database();

    //Conseguir nombre del rol de la vista
    $oldRolName;
    //Nuevo nombre del rol de la vista
    $newRolName;


    //Desconectar de la base de datos
    $db->desconectar();
?>