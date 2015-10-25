<!--
===========================================================================
Modifica un rol
Creado por: Andrea Sanchez Blanco, Edgar Conde Novoa
Fecha: 25/10/2015
============================================================================
-->

<!--Importar las cabeceras y la barra de navegacion-->
<?php include('../html/navBar.html'); ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <div class="col-md-8 col-md-offset-2">
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading">Rol</div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="rol">Nombre del rol:</label>
                    <input type="text" class="form-control" id="rol">
                </div>
                  
                <div class="form-group">
                    <label for="comment">Descripcion:</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                </div>
              </div>
            </div>
            
            <!-- Lista de usuarios asociados al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">Usuarios
                    <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
               </div>
              <!-- List group -->
              <ul class="list-group list-onHover">
                <li class="list-group-item">
                    Manolo Perez
                    <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                </li>
                <li class="list-group-item">
                    Carlos Francisco
                    <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                </li>
                <li class="list-group-item">
                    Juan
                    <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                </li>
              </ul>
            </div>
            
            <!-- Lista de funcionalidades asociadas al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">Funcionalidades
                  <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
                </div>
                <!-- List group -->
                <ul class="list-group list-onHover">
                    <li class="list-group-item">
                        Editar
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                    <li class="list-group-item">
                        Ver
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                    <li class="list-group-item">
                        Eliminar
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                    </li>
                </ul>
            </div> 
            
            <!-- Boton guardar -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <a href="vista_rol.php" class="btn btn-info btn-lg">
                        Guardar Rol
                        <div class="glyphicon glyphicon-save"></div>
                    </a>
                </div>
            </div>
        </div>    
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>