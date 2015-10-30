<!--
===========================================================================
Controlador para añadir usuarios a la base de datos
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 28/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_usu.php";
    
    $db = new Database();

    $loginClase ; //traer de la vista
  
    $usuario = new usuario($loginClase);

    //Se debe pasar el nombre, roles y hacer un bucle para añadir los roles y paginas asociadas
        
    

    $db->desconectar();
?>