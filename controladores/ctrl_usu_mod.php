<!--
===========================================================================
Controlador para modificar los datos de los usuarios
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 28/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_usu.php";

    //Conectar con la base de datos
    $db = new Database();

    //Conseguir nombre del usuario de la vista
    $oldUsuName;
    //Nuevo nombre del usuario de la vista
    $newUsuName;


    //Desconectar de la base de datos
    $db->desconectar();
?>