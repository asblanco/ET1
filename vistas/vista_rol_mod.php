<!--
===========================================================================
Modifica un rol
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
    
    include('../html/navBar.html'); 
    include_once('../controladores/ctrl_rol_mod.php');
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
      <form method="post">
        <div class="col-md-8 col-md-offset-2">
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $idioma["modificar_rol_rol"]; ?></div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="rol"><?php echo $idioma["modificar_rol_nombre"]; ?></label>
                    <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $rolName; ?>">
                </div>
                  
                <div class="form-group">
                    <label for="comment"><?php echo $idioma["modificar_rol_descripcion"]; ?></label>
                    <textarea class="form-control" rows="5" id="comment" name="comment"><?php echo $rolDesc ?></textarea>
                </div>
              </div>
            </div>
            
            <!-- Lista de usuarios asociados al rol -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_rol_usuarios"]; ?>
                    <div class="pull-right">
                    <a href="#"><div class="glyphicon glyphicon-plus"></div></a>
                  </div>
               </div>
              <!-- List group -->
              <ul class="list-group list-onHover">
                <?php 
                  foreach ($usuarios as $usu){ ?>
                    <li class="list-group-item">
                        <?php echo $usu['Login'] ?>
                        <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
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
                      foreach ($funcionalidades as $func){ ?>
                        <li class="list-group-item">
                            <?php echo $func['NombreFun'] ?>
                            <a href="#"><div class="glyphicon glyphicon-trash"></div></a>
                        </li>
                    <?php } ?>
                </ul>
            </div> 
            
            <!-- Boton guardar -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <a href="vista_rol.php" class="btn btn-info btn-lg" type="submit">
                         <?php echo $idioma["modificar_rol_guardar"]; ?>
                        <div class="glyphicon glyphicon-save"></div>
                    </a>
                </div>
            </div>
        </div>
      </form>
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>