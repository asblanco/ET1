<!--
===========================================================================
Añade una nueva página
Creado por: 
Fecha: 25/10/2015
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
?>
<!--Importar las cabeceras y la barra de navegacion-->

<?php
session_start();


if(!$_SESSION["idioma_usuario"]){
include_once "../modelo/es.php";
    
}else{
    include_once '../modelo/'.$_SESSION["idioma_usuario"].'.php';
}


?>


<?php

if(!$_SESSION){
session_start();
header('Location:../vistas/login.php');

}

?>


<?php include('../html/navBar.html'); ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <div class="col-md-8 col-md-offset-2"> <!-- centra el contenido -->
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading">Página</div>
                <blockquote>
                    <br>
                    Selecciona la página:
                    <form action="demo_form.asp">
                    <input type="file" name="pic" accept="image/*">
                    </form>
                </blockquote>
              <div class="panel-body">
                <div class="form-group">
                    <label for="rol">Nombre de la página:</label>
                    <input type="text" class="form-control" id="rol">
                </div>
              </div>
            </div>
            
            <!-- Nuevos usuarios asociados al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">Usuarios
                    <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
               </div>
            </div>
            
            <!-- Nuevas funcionalidades asociados al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">Funcionalidades
                  <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
                </div>
            </div> 
            
            <!-- Boton crear -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <a href="vista_rol.php" class="btn btn-info btn-lg">
                        Crear
                        <div class="glyphicon glyphicon-ok"></div>
                    </a>
                </div>
            </div>
        </div>

    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>
