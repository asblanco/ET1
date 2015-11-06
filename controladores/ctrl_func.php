<!--
===========================================================================
Controlador para mostrar los datos de las funcionalidades
Creado por: Edgar Conde Nóvoa
Fecha: 28/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_func.php";

    //Conectar con el modelo de Funcionalidad
    $funcionalidades = new Funcionalidad();
    
    //Array asociativo de la tabla funcionalidad, tiene NombreFun y DescFun
    $arrayFun = $funcionalidades->listar();

    //Listar Paginas en modificar 
    include '../modelo/model_pag.php';
    $rol = new Rol();
    $roles = $rol->listar();
    
    //Listar Paginas en modificar 
    include '../modelo/model_pag.php';
    $pag = new Pagina();
    $paginas = $pag->listar();
?>
