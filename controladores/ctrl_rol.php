<!--
===========================================================================
Controlador para mostrar los datos de los roles
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_rol.php";

    //Conectar con el modelo de Rol
    $roles = new Rol();
    
    //Array asociativo de la tabla roles, tiene NombreRol y DescRol
    $arrayRoles = $roles->listar();

//Listar Usuarios en modificar y crear Rol
    include_once '../modelo/model_usu.php';
    $usu = new Usuario();
    $users = $usu->listar();
//Listar Funcionalidades en modificar y crear Rol
    include_once '../modelo/model_func.php';
    $funcRol = new Funcionalidad();
    $funcRoles = $funcRol->listar();
?>