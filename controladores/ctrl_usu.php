<!--
===========================================================================
Controlador para mostrar los datos de los usuarios
Creado por: Edgar Conde Nóvoa
Fecha: 29/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_usu.php";

    //Conectar con la bd
    $db = new Database();

    //Conectar con el modelo de Usuario
    $usuarios = new Usuario();
    
    //Array asociativo de la tabla Usuario, tiene Login, Nombre, etc..
    $arrayUsuarios = $usuarios->listar();

    //Desconectar de la base de datos
    $db->desconectar();
?>