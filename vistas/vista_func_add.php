<!--
===========================================================================
Añade una nueva funcionalidad
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
include_once('../controladores/ctrl_permisos.php');
 include_once '../modelo/connect_DB.php';
 include('../html/navBar.html');
  ?>



<html lang="en">
    <!-- Contenido Principal -->
    <body>
            <div class="col-md-8 col-md-offset-2"> <!-- centra el contenido -->
                <!-- Nombre y descripcion -->
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo $idioma["anadir_func_funcionalidad"]; ?></div>
                     <form id="crear_func" action='../controladores/ctrl_func_add.php' method='POST' enctype="multipart/form-data">
                  <div class="panel-body">
                    <div class="form-group">
                        <label for="rol"><?php echo $idioma["anadir_func_nombre"]; ?></label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="rol"><?php echo $idioma["anadir_funcionalidad_descripcion"]; ?></label>
                        <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
                    </div>
                  </div>
                </div>
                    
                    <!-- Boton crear -->
                    <div class="btn-parent">
                        <div class="btn-child"> <!-- centran el boton -->
                            <button type="submit" value="enviar" class="btn btn-info btn-lg">
                                <?php echo $idioma["anadir_func_crear"];?>
                                <div class="glyphicon glyphicon-ok"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </form>        
        </body>
    </html>
    
    <!--Importar los jquery, bootstrap.js y el footer-->
    <?php include('../html/footer.html'); ?>