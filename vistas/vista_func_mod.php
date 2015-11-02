<!--
===========================================================================
Modifica una funcionalidad
Creado por: 
Fecha: /10/2015
============================================================================
-->

<!--Importar las cabeceras y la barra de navegacion-->

<?php
    session_start();

    if(!$_SESSION["idioma_usuario"]){
    include_once "../modelo/es.php";

    }else{
        include_once '../modelo/'.$_SESSION["idioma_usuario"].'.php';
    }


    if(!$_SESSION){
    session_start();
    header('Location:../vistas/login.php');

    }
    include('../html/navBar.html');
    include_once('../controladores/ctrl_func.php');
?>

<html lang="en">    
    <!-- Contenido Principal -->
    <body>
        
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>