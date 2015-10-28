<!DOCTYPE html>
<!--
===========================================================================
Modifica los usuarios
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
                <p>Nombre del usuario:  <input type="text" name="nombreRol" value="Administrador"></p>
                <p>Descripcion: <input type="text" name="descRol" value="El Administrador es Dios."></p>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Roles
                    <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
               </div>
              <!-- List group -->
              <ul class="list-group list-onHover">
                <li class="list-group-item">
                    Rol1
                    <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                </li>
                <li class="list-group-item">
                    Rol2
                    <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                </li>
                <li class="list-group-item">
                    Rol3
                    <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                </li>
              </ul>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Paginas
                  <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
                </div>
                <!-- List group -->
                <ul class="list-group list-onHover">
                    <li class="list-group-item">
                        Pagina1
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                    <li class="list-group-item">
                        Pagina2
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                    <li class="list-group-item">
                        Pagina3
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                </ul>
            </div> 
			
			  <div class="panel panel-default">
              <div class="panel-heading">Permisos
                  <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
                </div>
                <!-- List group -->
                <ul class="list-group list-onHover">
                    <li class="list-group-item">
                        Permiso1
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                    <li class="list-group-item">
                        Permiso2
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                    <li class="list-group-item">
                        Permiso3
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                </ul>
            </div> 
            
            <!-- Boton guardar -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <a href="roles.html" class="btn btn-info btn-lg">
                        Guardar Usuario
                        <div class="glyphicon glyphicon-save"></div>
                    </a>
                </div>
            </div>
        </div>    
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>