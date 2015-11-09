<!--
===========================================================================
Añade un nuevo rol
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
    include_once('../controladores/ctrl_rol.php');
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <form action='../controladores/ctrl_rol_add.php' method="post">
        <div class="col-md-8 col-md-offset-2"> <!-- centra el contenido -->
            <!-- Nombre y descripcion -->
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $idioma["anadir_rol_rol"]; ?></div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="rol"><?php echo $idioma["anadir_rol_nombre"]; ?></label>
                    <input type="text" class="form-control" name="nombreRol">
                </div>
                  
                <div class="form-group">
                    <label for="comment"><?php echo $idioma["anadir_rol_descripcion"]; ?></label>
                    <textarea class="form-control" rows="5" name="descripcion"></textarea>
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
                          <ul class="dropdown-menu rmU">
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
                  <!-- Lista de usuarios -->
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
                          <ul class="dropdown-menu rmF">
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

                </ul>
            </div> 
            
            <!-- Boton crear -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <button type="submit" class="btn btn-info btn-lg" value=<?php echo $idioma["anadir_rol_crear"]; ?>><?php echo $idioma["anadir_rol_crear"]; ?>
                    <div class="glyphicon glyphicon-ok"></div>
                    </button>
                </div>
            </div>
        </div>
        </form>
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>

<!-- Script despues del include footer porque ahi se importa jquery -->
<script>
    //Funcion para eliminar usuarios
    function removeUsu() {
        $(".rm").click(function(){
            var id = $(this).parents('li').attr("id");
            var value = id;
            value = id.replace("_",/ /);
            
            //Lo añade de nuevo al dropdown
            if (!$('#'+id).length) {
                $(".rmU").append("<li><a href='#' class='small addUsu valor' value='"+ value +"' tabIndex='-1'><input type='checkbox'/>&nbsp;"+ value +"</a></li>");
            }
            $(this).parents('li').remove();
        })        
    }
    
    //Funcion para eliminar funcionalidades
    function removeFunc() {
        $(".rm").click(function(){
            var value = $(this).parents('li').attr("id");
          $(this).parents('li').remove();
            $(".rmF").append("<li><a href='#' class='small addFunc valor' value='"+ value +"'' tabIndex='-1'><input type='checkbox'/>&nbsp; "+ value +" </a></li>");
        })     
    }
</script>

<script>
    
$(document).ready(function(){
    //Funcion para añadir usuarios seleccionados en el dropdown a la pagina
    $(".addUsu").click(function(){
        var value = $(this).attr("value");
        //El id no puede llevar espacios
        var id = value.replace(/ /g,"_");
        //Añadirlo si no está ya añadido
        if (!$('#'+id).length) {
            $(".addU").append(" <li class='list-group-item' id='"+ id +"'>"+ value +" <a class='rm' href='#' onclick='removeUsu()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='newUsuRol[]' value='"+ value +"'></li>");
            //Eliminarlo del dropdown
            $(this).parents('li').remove();
        }
    });
    
    //Funcion para añadir funcionalidades del dropdown a la pagina
    $(".addFunc").click(function(){
        var value = $(this).attr("value");
        //El id no puede llevar espacios
        var id = value.replace(/ /g,"_");
        if (!$('#'+id).length) {
            $(".addF").append(" <li class='list-group-item' id='"+ id +"'> "+ value +" <a class='rm' href='#' onclick='removeFunc()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='newFuncRol[]' value='"+ value +"'></li>");
        $(this).remove();}
    });    
    
});
</script>
