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

    include_once('../controladores/ctrl_permisos.php');
    
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
        
    </body> 
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>