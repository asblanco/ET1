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
    //Obtiene los datos del rol
    $rol = new Rol();
    $rol = $rol->consultar($rolName); 
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        
        <!-- Add Usuarios Modal Page -->
        <div class="modal fade" id="addUsu" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel"><?php echo $idioma["modificar_rol_addUsu"]; ?></h4>
              </div>
                
            <!-- Contenido de la página login modal -->
              <div class="modal-body">
                  <?php 
                  //Include al modelo de usuarios para listar los no relacionador con el rol
                  include('../modelo/model_usu.php');  ?>
                  
              </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick ="location='vista_rol_mod.php?rol=<?php echo $_GET['rol']; ?>'"><?php echo $idioma["modificar_rol_addUsu_cancel"]; ?></button>
                  <a class="btn btn-primary" href="vista_rol_mod.php?rol=<?php echo $_GET['rol']; ?>"><?php echo $idioma["modificar_rol_addUsu_OK"]; ?></a>
              </div>
            </div>
          </div>
        </div>
        
        
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
                    <textarea class="form-control" rows="5" name="comment"><?php echo $rol->descripcion ?></textarea>
                </div>
              </div>
            </div>
            
            <!-- Lista de usuarios asociados al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_rol_usuarios"]; ?>
                    <div class="pull-right">
                    <a href="#" data-toggle='modal' data-target='#addUsu'><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
               </div>
              <!-- List group -->
              <ul class="list-group list-onHover">
                <?php 
                  foreach ($rol->usuarios as $usu){ ?>
                    <li class="list-group-item" id="usuSelected">
                        <?php echo $usu['Login'] ?>
                        <a href="#" onclick="removeUsu()"><div class="glyphicon glyphicon-trash"></div></a>
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
                      foreach ($rol->funcionalidades as $func){ ?>
                        <li class="list-group-item" name="funcSelected">
                            <?php echo $func['NombreFun'] ?>
                            <a href="#" onclick="removeFunc()"><div class="glyphicon glyphicon-trash"></div></a>
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
            var x = document.getElementById("usuSelected");
            x.remove(x.selectedIndex);
        }
        function removeFunc() {
            var x = document.getElementsByTagName("funcSelected");
            x.remove(x.selectedIndex);
        }
        
    </script>
        
    </body> 
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>