<!--Importar las cabeceras y la barra de navegacion-->
<?php include('../html/navBar.html'); ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir funcionalidad -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_func_add.php" class="btn btn-info btn-lg">
                    A&ntilde;adir Funcionalidad
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
        
        
        <!-- Funcionalidad 1 -->
        <div class="col-md-8 col-md-offset-2 well">
            <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
            <div class="col-md-15">
                <div class="titulo">Funcionalidad 1</div>
                <p class="descripcion">Esta funcionalidad sirve para algo </p>
                <br>
                <p>
                "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the                 charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound                   to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as                       saying through shrinking from toil and pain."
                </p>
            </div>
        </div>
        
        <!-- Funcionalidad 2 -->
        <div class="col-md-8 col-md-offset-2 well">
            <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
            <div class="col-md-15">
                <div class="titulo">Funcionalidad 2</div>
                <p class="descripcion">Esta funcionalidad tambi&eacute;n sirve para algo, será asignada a distintos usuarios y podrá                    ser eliminada, pero no podr&aacute; ser modificada. </p>
                <br>
                <p>
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                     Duis aute irure    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla  pariatur."
                </p>
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
