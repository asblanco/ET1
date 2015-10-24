<!--Importar las cabeceras y la barra de navegacion-->
<?php include('../html/navBar.html'); ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <div class="col-md-8 col-md-offset-2"> <!-- centra el contenido -->
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading">Funcionalidad</div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="funcionalidad">Nombre de la funcionalidad:</label>
                    <input type="text" class="form-control" id="funcionalidad">
                </div>
                  
                <div class="form-group">
                    <label for="comment">Descripci&oacuten:</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                </div>
              </div>
            </div>
            
            <!-- Boton crear -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <a href="vista_func.php" class="btn btn-info btn-lg">
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
