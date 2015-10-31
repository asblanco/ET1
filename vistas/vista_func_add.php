<!--
===========================================================================
Añade una nueva funcionalidad
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
    
    //Barra de navegacion
    include('../html/navBar.html');
?>

<html lang="en">
    <!-- Contenido Principal -->
        <body>
        <div class="col-md-8 col-md-offset-2"> <!-- centra el contenido -->
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $idioma["anadir_func_funcionalidad"]; ?></div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="funcionalidad"><?php echo $idioma["anadir_func_nombre"]; ?></label>
                    <input type="text" class="form-control" id="funcionalidad">
                </div>
                  
                <div class="form-group">
                    <label for="comment"><?php echo $idioma["anadir_func_descripcion"]; ?></label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                </div>
              </div>
            </div>
            
            <!-- Boton crear -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <a href="vista_func.php" class="btn btn-info btn-lg">
                        <?php echo $idioma["anadir_func_crear"]; ?>
                        <div class="glyphicon glyphicon-ok"></div>
                    </a>
                </div>
            </div>
        </div>

    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>
