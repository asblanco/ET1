<!--
===========================================================================
Cabeceras y barra de navegacion
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    session_start();

    if(!$_SESSION["idioma_usuario"]){
        include_once "../modelo/es.php";
    } else{
        include_once '../modelo/'.$_SESSION["idioma_usuario"].'.php';
    }

    if(!$_SESSION){
    session_start();
    header('Location:../vistas/login.php');

    }

    include('../html/navBar.html'); 
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <div class="content">
            <div class="row">
                <div class="boton" id="usuarios"><a href="vista_usu.php"><?php echo $idioma["menu_usuarios"]; ?></a></div>
                <div class="boton" id="páginas"><a href="vista_pag.php"><?php echo $idioma["menu_paginas"]; ?> </a></div>
            </div>
            <div class="row">
                <div class="boton" id="roles"><a href="vista_rol.php"> <?php echo $idioma["menu_roles"]; ?></a></div>
                <div class="boton" id="funcionalidades"><a href="vista_func.php"><?php echo $idioma["menu_funcionalidades"]; ?></a></div>
            </div>
        </div>
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>