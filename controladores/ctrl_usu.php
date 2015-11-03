<!--
===========================================================================
Controlador para mostrar los datos de los Usuarios
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 28/10/2015
============================================================================
-->
<?php
    include_once "../modelo/model_usu.php";

    //Conectar con el modelo de Rol
    $users = new Usuario();
    
    //Array asociativo de la tabla Usuarios, tiene Login, Nombre, etc..
    $arrayUsuarios = $users->listar();

//Listar Roles en modificar y crear Usuario
    include '../modelo/model_rol.php';
    $rol = new Rol();
    $roles = $rol->listar();
?>