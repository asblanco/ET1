<!--
===========================================================================
Muestra las funcionalidades
Creado por: 
Fecha: /10/2015
============================================================================
-->

<!--Importar las cabeceras y la barra de navegacion-->
<?php include('../html/navBar.html');
include_once('../controladores/ctrl_func.php');
?>

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
        
        <!-- Mostrar Funcionalidades -->
        <?php 
        foreach ($arrayFun as $fun)  {
            echo "<div class='col-md-8 col-md-offset-2 well'>
            <a href='#' data-toggle='modal' data-target='#removeModal'> <div class='remove-icon glyphicon glyphicon-remove'></div></a>
            <div class='col-md-6'>
                <div class='titulo'> {$fun['NombreFun']} 
            <a href='vista_rol_mod.php'> <div class='edit-icon glyphicon glyphicon-edit'></div></a>
                </div>
                <p class='descripcion'> {$fun['DescFun']} </p>
            </div>
            <div class='col-md-3'>
                <h4>Roles</h4>";
                // array asociativo de los roles con la funcionalidad actual del bucle
                $arrayRoles = $funcionalidades->arrayA($fun['NombreFun']);
                foreach ($arrayRoles as $rol ){
                    echo "<p> {$rol['NombreRol']} </p>";
                }
                
            echo "
            </div>
            <div class='col-md-2'>
                <h4>Paginas</h4>";
                // array asociativo de las paginas ligadas al rol actual del bucle
                $arrayPaginas = $funcionalidades->arrayB($fun['NombreFun']);
                foreach ($arrayPaginas as $pag ){
                    echo "<p> {$P['NombrePag']} </p>";
                }
            echo "        
            </div>
        </div>";
        }
        ?>
        
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
