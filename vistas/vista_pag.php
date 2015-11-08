<!--
===========================================================================
Muestra las funcionalidades
Creado por: 
Fecha: /10/2015
============================================================================
-->

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

    include_once('../controladores/ctrl_permisos.php');
    include('../html/navBar.html'); 
    include_once('../controladores/ctrl_pag.php');
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir pagina -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_pag_add.php" class="btn btn-info btn-lg">
                   <?php echo $idioma["anadir_pagina"]; ?>
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
                
        
        
        <!-- Mostrar Paginas -->
        <?php 
        foreach ($arrayPaginas as $pag)  {
            //Array asoc de los datos de la pagina del bucle
            $pagX = $paginas->consultar($pag['Url']);
        ?>
        <div class='col-md-8 col-md-offset-2 well'>
            <a href="vista_pag_del.php?borrar=<?php echo $pag['NombrePag'];?>"> <div class='remove-icon glyphicon glyphicon-remove'></div></a>
            <div class='col-md-6'>
                <div class='titulo'> <?php echo $pag['NombrePag'] ?>
                    <a href="vista_pag_mod.php?pag=<?php echo $pag['NombrePag'];?>"> <div class='edit-icon glyphicon glyphicon-edit'></div></a>
                </div>
                <p class='descripcion'> <?php echo $pag['DescPag']; ?> </p>
            </div>
            <div class='col-md-3'>
                <h4>Usuarios</h4>
                <?php
                // array asociativo de los usuarios ligados a la pagina actual del bucle
                $arrayUsuarios = $pagX['usuarios'];
                foreach ($arrayUsuarios as $usu ){
                    echo "<p> {$usu['Login']} </p>";
                }
                 ?>
           
            </div>
            <div class='col-md-2'>
                <h4>Funcionalidad</h4>
                <?php
                //Funcionalidad ligada a la pagina actual del bucle
                $func = $pagX['funcionalidad'];
                 ?>
                <p><?php echo $func; ?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </body>
</html>


<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>
