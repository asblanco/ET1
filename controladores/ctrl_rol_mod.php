<!--
===========================================================================
Controlador para modificar los datos de los roles
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_rol.php";

    //Conectar con la base de datos
    $db = new Database();

    $modRol = new Rol();

    //Conseguir datos del rol a modificar
    $rolName = $_GET['rol'];
    $arrayDatos = $modRol->consultar($rolName);
    //El array solo va a contener la descripcion del rol
    foreach ($arrayDatos as $datos){
        $rolDesc = $datos['DescRol'];
    }

    $usuarios = $modRol->arrayA($rolName);
    $funcionalidades = $modRol->arrayB($rolName);

    //Nuevos datos
//    $newRolName= $_POST['rol'];
//    $newRolDesc= $_POST['comment'];
//    $newRol = new Rol($newRolName, $newRolDesc);
//    if ($modRol->modificar($rolName, $newRol) == true){
//        echo "Rol modificado correctamente";
//        header('location:../vistas/vista_rol.php'); 
//    }else {
//        echo "Fallo en la actualizacion del rol";
//    }

    //Desconectar de la base de datos
    $db->desconectar();
?>