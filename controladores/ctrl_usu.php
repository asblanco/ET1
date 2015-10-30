<!--
===========================================================================
Controlador para mostrar los datos de los Usuarios
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 28/10/2015
============================================================================
-->
<?php
    include_once "../modelo/model_usu.php";

    //Conectar con la bd
    $db = new Database();

    //Conectar con el modelo de usuarios
    $usuarios = new Usuario();
    
    //Array asociativo de la tabla roles, tiene NombreRol y DescRol
    $arrayUsuarios = $usuarios->listar();

    //Desconectar de la base de datos
    $db->desconectar();
?>