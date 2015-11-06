<!--
===========================================================================
Modifica un rol
Creado por: Andrea Sanchez Blanco, Edgar Conde Novoa
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
    
    include('../html/navBar.html'); 
    //Para poder visualizar los datos
    include_once('../controladores/ctrl_func.php');
    //Obtiene el nombre de la func a modificar de la URL
    $funcName = $_GET['func'];
    //Obtiene los datos del rol en un array asociativo
    $f = new Funcionalidad();
    $func = $f->consultar($funcName); 
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>    
      <form action='../controladores/ctrl_func_mod.php' method="post">
        <div class="col-md-8 col-md-offset-2">
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $idioma["modificar_funcionalidad_func"]; ?></div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="rol"><?php echo $idioma["modificar_funcionalidad_nombre"]; ?></label>
                    <input type="text" class="form-control" name="newName" value="<?php echo $funcName; ?>">
                    <!-- Campo oculto para pasar el nombre de la func al ctrl de modificar -->
                    <input hidden="hidden" type="text" name="oldName" value="<?php echo $funcName; ?>">
                </div>
                  
                <div class="form-group">
                    <label for="comment"><?php echo $idioma["modificar_funcionalidad_descripcion"]; ?></label>
                    <textarea class="form-control" rows="5" name="newDesc"><?php echo $func['descripcion'] ?></textarea>
                </div>
              </div>
            </div>
            
            <!-- Lista de roles asociados a la func -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_funcionalidad_roles"]; ?>
                    <div class="pull-right">
                      <div class="dropdown">
                        <a href="#" data-toggle="dropdown">
                          <div class="glyphicon glyphicon-plus dropdown-toggle"></div>
                          <!-- Contenido del dropdown -->
                          <ul class="dropdown-menu">
                              <?php 
                              foreach($roles as $r){ ?>
                                  <li><a href="#" class="small addRol valor" value="<?php echo $r['NombreRol']; ?>" tabIndex="-1"><input type="checkbox"/>&nbsp; <?php echo $r['NombreRol']; ?> </a></li>
                              <?php
                              }
                              ?>
                          </ul>
                        </a>
                    </div>
                  </div>
               </div>
              <!-- List group -->
              <ul class="list-group list-onHover addRol">
                <?php
                  foreach ($func['roles'] as $rol){ ?> 
                    <li class="list-group-item">
                        <?php echo $rol['NombreRol'] ?>
                        <a class="rm" href="#" onclick="removeRol()"><div class="glyphicon glyphicon-trash"></div></a>
                    <!-- Elemento oculto para pasar el array con los roles modificados por POST -->
                    <input hidden="hidden" type="text" name="newRolFunc[]" value="<?php echo $rol['NombreRol']; ?>">
                    </li>
                <?php } ?>
              </ul>
            </div>
            
            <!-- Lista de paginas asociadas a la func -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_funcionalidad_pagina"]; ?>
                  <div class="pull-right">
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown">
                          <div class="glyphicon glyphicon-plus dropdown-toggle"></div>
                          <!-- Contenido del dropdown -->
                          <ul class="dropdown-menu">
                              <?php 
                              foreach($paginas as $p){ ?>
                                  <li><a href="#" class="small addPag" value="<?php echo $p['NombrePag']; ?>" tabIndex="-1"><input type="checkbox"/>&nbsp; <?php echo $p['NombrePag']; ?> </a></li>
                              <?php
                              }
                              ?>
                          </ul>
                        </a>
                    </div>
                  </div>
                </div>
                <!-- List group -->
                <ul class="list-group list-onHover addP">
                    <?php 
                      foreach ($func['paginas'] as $pag){ ?>
                        <li class="list-group-item">
                            <?php echo $pag['NombrePag'] ?>
                            <a href="#" class="rm" onclick="removePag()"><div class="glyphicon glyphicon-trash"></div></a>
                        <!-- Elemento oculto para pasar el array con las paginas modificados por POST -->
                            <input hidden="hidden" type="text" name="newPagFunc[]" value="<?php echo $pag['NombrePag']; ?>">
                        </li>
                        
                    <?php } ?>
                </ul>
            </div> 
            
            <!-- Boton guardar -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <button type="submit" class="btn btn-info btn-lg" value=<?php echo $idioma["modificar_funcionalidad_guardar"]; ?>><?php echo $idioma["reg_guardar"]; ?>
                    <div class="glyphicon glyphicon-save"></div>
                    </button>
                </div>
            </div>
        </div>
      </form>
        
    <script>
        function removeRol() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
        function removePag() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
        
    </script>
        
    </body> 
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>

<script>
$(document).ready(function(){
    $(".addRol").click(function(){
        var value = $(this).attr("value");
        $(".addR").append(" <li class='list-group-item'>"+ value +" <a class='rm' href='#' onclick='removeRol()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='newRolFunc[]' value='"+ value +"'></li>");
    });

    $(".addPag").click(function(){
        var value = $(this).attr("value");
        $(".addP").append(" <li class='list-group-item'>"+ value +" <a class='rm' href='#' onclick='removePag()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='newPagFunc[]' value='"+ value +"'></li>");
    });
});
</script>
