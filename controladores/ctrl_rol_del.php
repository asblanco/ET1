<!--
===========================================================================
Controlador para eliminar roles de la base de datos
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once '../modelo/connect_DB.php';
    include_once "../modelo/model_rol.php";

    $db = new Database();
    
    function deleteRol($nameRol){
        $db->consulta('DELETE FROM Rol WHERE NombreRol = ' . $nameRol);
    }

    $db->desconectar();
?>