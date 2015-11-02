<!--
===========================================================================
Controlador para mostrar los datos de los roles
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_rol.php";

    //Conectar con la bd
    $db = new Database();

    //Conectar con el modelo de Rol
    $roles = new Rol();
    
    //Array asociativo de la tabla roles, tiene NombreRol y DescRol
    $arrayRoles = $roles->listar();

//Listar Usuarios en modificar y crear Rol
    include '../modelo/model_usu.php';
    $usu = new Usuario();
    $users = $usu->listar();

    //Desconectar de la base de datos
    $db->desconectar();
?>