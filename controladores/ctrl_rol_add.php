<!--
===========================================================================
Controlador para añadir roles a la base de datos
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once '../modelo/connect_DB.php';
    include_once "../modelo/model_rol.php";
    
    $db = new Database();

    $rolName; //traer de la vista
    $rolDesc;

    $rol = new Rol();

    //Se debe pasar el nombre, descripcion, usuarios y hacer un bucle para añadir los usuarios y funcionalidades asociadas
        
    function addRol ($rolName, $rolDesc) {
        if (exists() == false) 
        {
             // inserta el rol en la db
             $InsertaRol = "INSERT INTO Rol (NombreRol, DescRol) VALUES ('$rolName','$rolDesc')";
             $insercion = $this->db->consulta($InsertaRol) or die('Error al ejecutar la insercion de rol');
             echo 'El rol ' . $this->rolName . ' ha sido registrado en el sistema';
        }
    }

    $db->desconectar();
?>