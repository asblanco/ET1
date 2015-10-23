<!--Importar las cabeceras y la barra de navegacion-->
<?php include('../html/navBar.html'); ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir rol -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_rol_add.php" class="btn btn-info btn-lg">
                    A&ntilde;adir Rol
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
        <!-- Rol 1 -->
        <div class="col-md-8 col-md-offset-2 well">
            <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
            <div class="col-md-6">
                <div class="titulo"> Administrador 
                   <a href="vista_rol_mod.php"> <div class="edit-icon glyphicon glyphicon-edit"></div></a>
                </div>
                <p class="descripcion">El administrador debe poder modificar todo. Teniendo todas las funcionalidades asignadas.</p>
            </div>
            <div class="col-md-3">
                <h4>Usuarios</h4>
                <p>Manolo Perez</p>
                <p>Carlos Francisco</p>
                <p>Juan</p>
            </div>
            <div class="col-md-2">
                <h4>Funcionalidades</h4>
                <p>Hola</p>
            </div>
        </div>
        
        <!-- Rol 2 -->
        <div class="col-md-8 col-md-offset-2 well">
            <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
            <div class="col-md-6">
                <div class="titulo">Registrador
                    <a href="vista_rol_mod.php"> <div class="edit-icon glyphicon glyphicon-edit"></div></a>
                </div>
                <p class="descripcion">El registrador debe poder modificar todo. Teniendo todas las funcionalidades asignadas.</p>
            </div>
            <div class="col-md-3">
                <h4>Usuarios</h4>
                <p>Manolo Perez</p>
                <p>Carlos Francisco</p>
                <p>Juan</p>
            </div>
            <div class="col-md-2">
                <h4>Funcionalidades</h4>
                <p>Hola</p>
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
                 <p>¿Est&#225; seguro de eliminar el elemento?</p>
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