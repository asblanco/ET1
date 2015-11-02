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
    include_once('../controladores/ctrl_rol.php');
    //Obtiene el nombre del rol a modificar de la URL
    $rolName = $_GET['rol'];
    //Obtiene los datos del rol en un array asociativo
    $r = new Rol();
    $rol = $r->consultar($rolName); 
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>    
      <form action='../controladores/ctrl_rol_mod.php' method="post">
        <div class="col-md-8 col-md-offset-2">
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $idioma["modificar_rol_rol"]; ?></div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="rol"><?php echo $idioma["modificar_rol_nombre"]; ?></label>
                    <input type="text" class="form-control" name="rol" value="<?php echo $rolName; ?>">
                    <!-- Campo oculto para pasar el nombre del rol al ctrl de modificar -->
                    <input hidden="hidden" type="text" name="oldName" value="<?php echo $rolName; ?>">
                </div>
                  
                <div class="form-group">
                    <label for="comment"><?php echo $idioma["modificar_rol_descripcion"]; ?></label>
                    <textarea class="form-control" rows="5" name="comment"><?php echo $rol['descripcion'] ?></textarea>
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
                                  <li><a href="#" class="small" data-value="<?php echo $u['Login']; ?>" tabIndex="-1"><input type="checkbox"/>&nbsp; <?php echo $u['Login']; ?> </a></li>
                              <?php
                              }
                              ?>
                          </ul>
                        </a>
                    </div>
                  </div>
               </div>
              <!-- List group -->
              <ul class="list-group list-onHover">
                <?php 
                  foreach ($rol['usuarios'] as $usu){ ?>
                    <li class="list-group-item">
                        <?php echo $usu['Login'] ?>
                        <a class="rm" href="#" onclick="removeUsu()"><div class="glyphicon glyphicon-trash"></div></a>
                    <!-- Elemento oculto para pasar el array con los ususarios modificados por POST -->
                    <input hidden="hidden" type="text" name="newUsu[]" value="<?php echo $usu['Login']; ?>">
                    </li>
                <?php } ?>
              </ul>
            </div>
            
            <!-- Lista de funcionalidades asociadas al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_rol_funcionalidades"]; ?>
                  <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
                </div>
                <!-- List group -->
                <ul class="list-group list-onHover">
                    <?php 
                      foreach ($rol['funcionalidades'] as $func){ ?>
                        <li class="list-group-item">
                            <?php echo $func['NombreFun'] ?>
                            <a href="#" class="rm" onclick="removeFunc()"><div class="glyphicon glyphicon-trash"></div></a>
                        <!-- Elemento oculto para pasar el array con las funcionalidades modificados por POST -->
                            <input hidden="hidden" type="text" name="newFunc[]" value="<?php echo $func['NombreFun']; ?>">
                        </li>
                        
                    <?php } ?>
                </ul>
            </div> 
            
            <!-- Boton guardar -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <button type="submit" class="btn btn-info btn-lg" value=<?php echo $idioma["modificar_rol_guardar"]; ?>><?php echo $idioma["reg_guardar"]; ?>
                    <div class="glyphicon glyphicon-save"></div>
                    </button>
                </div>
            </div>
        </div>
      </form>
        
    <script>
        function removeUsu() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
        function removeFunc() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
        
    </script>
        
    </body> 
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>