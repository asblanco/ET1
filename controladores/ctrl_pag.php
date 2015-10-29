<!--
===========================================================================
Controlador para mostrar los datos de las paginas
Creado por: Edgar Conde Nóvoa
Fecha: 29/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_pag.php";

    //Conectar con la bd
    $db = new Database();

    //Conectar con el modelo de Pagina
    $paginas = new Pagina();
    
    //Array asociativo de la tabla Pagina, tiene Url, DescPag y NombreFun
    $arrayPaginas = $paginas->listar();

    //Desconectar de la base de datos
    $db->desconectar();
?>