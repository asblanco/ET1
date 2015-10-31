<!--
===========================================================================
Muestra las funcionalidades
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
        <!-- Boton añadir pagina -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_pag_add.php" class="btn btn-info btn-lg">
                    A&ntilde;adir P&aacute;gina
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
        
        
        <!-- Pagina1 1 -->
        <div class="col-md-8 col-md-offset-2 well">
            <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
            <div class="col-md-15">
                <div class="titulo">Pagina 1</div>
                <br>
                <p class="tamanho">Tamaño:</p>
                <p class="tipo">Tipo:</p>
                <div class="col-md-4 col-md-offset-1 well">
                    <div class="titulo">Usuarios</div>
                    <br>
                    <p class="usuario">Usuario 1</p>
                    <p class="usuario">Usuario 2</p>
                    <p class="usuario">Usuario 3</p>
                    <p class="usuario">Usuario 4</p>
                </div>
                
                <div class="col-md-4 col-md-offset-2 well">
                    <div class="titulo">Funcionalidades</div>
                    <br>
                    <p class="funcionalidad">Funcionalidad 1</p>
                    <p class="funcionalidad">Funcionalidad 2</p>
                    <p class="funcionalidad">Funcionalidad 3</p>
                    <p class="funcionalidad">Funcionalidad 4</p>
                </div>
               <br></br><br></br><br></br><br></br><br></br><br></br><br>
                <div class="btn-child"> <!-- centran el boton -->
                    
                    <a href="vista_pag_mod.php" class="btn btn-info btn-lg">
                        Modificar
                    </a>
                </div>
            </div>
        </div>
        
                <!-- Pagina 2 -->
        <div class="col-md-8 col-md-offset-2 well">
            <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
            <div class="col-md-15">
                <div class="titulo">Pagina 2</div>
                <br>
                <p class="tamanho">Tamaño:</p>
                <p class="tipo">Tipo:</p>
                <div class="col-md-4 col-md-offset-1 well">
                    <div class="titulo">Usuarios</div>
                    <br>
                    <p class="usuario">Usuario 1</p>
                    <p class="usuario">Usuario 2</p>
                    <p class="usuario">Usuario 3</p>
                    <p class="usuario">Usuario 4</p>
                </div>
                
                <div class="col-md-4 col-md-offset-2 well">
                    <div class="titulo">Funcionalidades</div>
                    <br>
                    <p class="funcionalidad">Funcionalidad 1</p>
                    <p class="funcionalidad">Funcionalidad 2</p>
                    <p class="funcionalidad">Funcionalidad 3</p>
                    <p class="funcionalidad">Funcionalidad 4</p>
                </div>
               <br></br><br></br><br></br><br></br><br></br><br></br><br>
                <div class="btn-child"> <!-- centran el boton -->
                    
                    <a href="vista_pag_mod.php" class="btn btn-info btn-lg">
                        Modificar
                    </a>
                </div>
            </div>
        </div>
        <!-- Remove Modal Page -->
        <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel">Advertencia</h4>
              </div>
                
            <!-- Contenido de la página login modal -->
              <div class="modal-body">
                 <p>¿Est&#225; seguro de eliminar la funcionalidad?</p>
              </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Si</button>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>