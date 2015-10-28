<!DOCTYPE html>
<!--
===========================================================================
Añade los usuarios
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 23/10/2015
============================================================================
-->

<!--Importar las cabeceras y la barra de navegacion-->
<?php include('../html/navBar.html'); ?>

<html lang="en">
    <div id="includedContent"></div>
    
    <!-- Contenido Principal -->
    <body>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Usuario</div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="rol">Nombre del usuario:</label>
                    <input type="text" class="form-control" id="rol">
                </div>
                  
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Roles
                    <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
               </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Paginas
                  <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
                </div>
            </div> 
			
		    <div class="panel panel-default">
              <div class="panel-heading">Permisos
                  <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
                </div>
            </div> 
            
            <!-- Boton crear -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <a href="roles.html" class="btn btn-info btn-lg">
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