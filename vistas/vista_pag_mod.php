<!--
===========================================================================
Muestra las funcionalidades
Creado por: 
Fecha: /10/2015
============================================================================
-->

<!--Importar las cabeceras y la barra de navegacion-->
<?php include('../html/navBar.html'); ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>   
        <!-- Pagina1 1 -->
        <div class="col-md-8 col-md-offset-2 well">
          
                <div class="titulo">Nombre pagina</div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                           
                            <label for="nombre">Nuevo nombre:</label>
                            <input type="text" class="form-control" id="funcionalidad">
                            <br>
                            <label for="tipo">Nuevo tipo:</label>
                            <input type="text" class="form-control" id="funcionalidad">
                            <br><br>
                            
                            <fieldset>
                            <div class="col-md-4 col-md-offset-1 well">
                                <div class="titulo">Quitar usuarios</div>
                                <br>
                                <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
                                <p class="usuario">Usuario 1</p>
                                   <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
                                <p class="usuario">Usuario 2</p>
                                   <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
                                <p class="usuario">Usuario 3</p>
                                   <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
                                <p class="usuario">Usuario 4</p>
                            </div>
                            
                             <div class="col-md-4 col-md-offset-2 well">
                                <div class="titulo">Agregar usuarios</div>
                                 <br>
                                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a> Usuario 1 </p>
                                    <p class="usuario">Usuario 2</p>
                                    <p class="usuario">Usuario 3</p>
                                    <p class="usuario">Usuario 4</p>
                                </div>
                            </div>
                            </fieldset>
                            <br><br>
                            
                          
                            <fieldset>
                            <div class="col-md-4 col-md-offset-1 well">
                                <div class="titulo">Quitar funcionalidades</div>
                                <br>
                                <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
                                <p class="usuario">Funcionalidad 1</p>
                                   <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
                                <p class="usuario">Funcionalidad 2</p>
                                   <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
                                <p class="usuario">Funcionalidad 3</p>
                                   <a href="#" data-toggle="modal" data-target="#removeModal"> <div class="remove-icon glyphicon glyphicon-remove"></div></a>
                                <p class="usuario">Funcionalidad 4</p>
                            </div>
                            
                             <div class="col-md-4 col-md-offset-2 well">
                                <div class="titulo">Agregar funcionalidades</div>
                                <br>
                                 <select>
                                    <option value="1">Funcionalidad 1</option> 
                                    <option value="2">Funcionalidad 2</option> 
                                    <option value="3">Funcionalidad 3</option>
                                 </select>	
                            </fieldset>
                             
                            <div class="btn-parent">
                                <div class="btn-child"> <!-- centran el boton -->
                                    <button type="submit" class="btn btn-info btn-lg">
                                    Finalizar
                                    <div class="glyphicon glyphicon-ok"></div>
                                    </button>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel">Advertencia</h4>
              </div>
                
            <!-- Contenido de la página login modal -->
              <div class="modal-body">
                 <p>¿Est&#225; seguro de eliminar el usuario?</p>
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
    </body>
</html>
<?php include('../html/footer.html'); ?>