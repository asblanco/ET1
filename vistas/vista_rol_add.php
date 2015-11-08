<!--
===========================================================================
Añade un nuevo rol
Creado por: Andrea Sanchez Blanco, Edgar Conde Novoa
Fecha: 25/10/2015
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


    if(!$_SESSION){
    session_start();
    header('Location:../vistas/login.php');

    }
     include_once('../controladores/ctrl_permisos.php');
     include('../html/navBar.html');
    //Para poder visualizar los datos
    include_once('../controladores/ctrl_rol.php');
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <div class="col-md-8 col-md-offset-2"> <!-- centra el contenido -->
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $idioma["anadir_rol_rol"]; ?></div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="rol"><?php echo $idioma["anadir_rol_nombre"]; ?></label>
                    <input type="text" class="form-control" id="rol">
                </div>
                  
                <div class="form-group">
                    <label for="comment"><?php echo $idioma["anadir_rol_descripcion"]; ?></label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                </div>
              </div>
            </div>
            
            
            <!-- Lista de usuarios asociados al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_rol_usuarios"]; ?>
                    <div class="pull-right">
                      <div class="dropdown">
                        <a href="#" data-toggle="dropdown">
                          <div class="glyphicon glyphicon-plus dropdown-toggle"></div>
                          <!-- Contenido del dropdown -->
                          <ul class="dropdown-menu">
                              <?php 
                              foreach($users as $u){ ?>
                                  <li><a href="#" class="small addUsu valor" value="<?php echo $u['Login']; ?>" tabIndex="-1"><input type="checkbox"/>&nbsp; <?php echo $u['Login']; ?> </a></li>
                              <?php
                              }
                              ?>
                          </ul>
                        </a>
                    </div>
                  </div>
               </div>
              <!-- List group -->
              <ul class="list-group list-onHover addU">
                <?php
                  foreach ($users as $usu){ ?> 
                    <li class="list-group-item">
                        <?php echo $usu['Login'] ?>
                        <a class="rm" href="#" onclick="removeUsu()"><div class="glyphicon glyphicon-trash"></div></a>
                    <!-- Elemento oculto para pasar el array con los ususarios modificados por POST -->
                    <input hidden="hidden" type="text" name="newUsuRol[]" value="<?php echo $usu['Login']; ?>">
                    </li>
                <?php } ?>
              </ul>
            </div>
            
            <!-- Lista de funcionalidades asociadas al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_rol_funcionalidades"]; ?>
                  <div class="pull-right">
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown">
                          <div class="glyphicon glyphicon-plus dropdown-toggle"></div>
                          <!-- Contenido del dropdown -->
                          <ul class="dropdown-menu">
                              <?php 
                              foreach($funcRoles as $f){ ?>
                                  <li><a href="#" class="small addFunc" value="<?php echo $f['NombreFun']; ?>" tabIndex="-1"><input type="checkbox"/>&nbsp; <?php echo $f['NombreFun']; ?> </a></li>
                              <?php
                              }
                              ?>
                          </ul>
                        </a>
                    </div>
                  </div>
                </div>
                <!-- List group -->
                <ul class="list-group list-onHover addF">
                    <?php 
                      foreach ($funcRoles as $func){ ?>
                        <li class="list-group-item">
                            <?php echo $func['NombreFun'] ?>
                            <a href="#" class="rm" onclick="removeFunc()"><div class="glyphicon glyphicon-trash"></div></a>
                        <!-- Elemento oculto para pasar el array con las funcionalidades modificados por POST -->
                            <input hidden="hidden" type="text" name="newFuncRol[]" value="<?php echo $func['NombreFun']; ?>">
                        </li>
                        
                    <?php } ?>
                </ul>
            </div> 
            
            <!-- Boton crear -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <a href="vista_rol.php" class="btn btn-info btn-lg">
                        <?php echo $idioma["anadir_rol_crear"]; ?>
                        <div class="glyphicon glyphicon-ok"></div>
                    </a>
                </div>
            </div>
        </div>

    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>
