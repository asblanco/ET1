<!--
===========================================================================
Controlador para mostrar los datos de los roles
Creado por: Edgar Conde Nóvoa
Fecha: 28/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_func.php";

    //Conectar con la bd
    $db = new Database();

    //Conectar con el modelo de Funcionalidad
    $funcionalidades = new Funcionalidad();
    
    //Array asociativo de la tabla funcionalidad, tiene NombreFun y DescFun
    $arrayFun = $funcionalidades->listar();

    //Desconectar de la base de datos
    $db->desconectar();
?>