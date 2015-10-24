<?php
    include '../modelo/connect_DB.php';
    include "../modelo/model_rol.php";

    //Conectar con la bd
    $db = new Database();

    $query= 'SELECT NombreRol FROM Rol WHERE NombreRol = "prueba"';
    $result = $db->consulta($query) or die('No se puede acceder al nombre');

    $db->desconectar();
?>