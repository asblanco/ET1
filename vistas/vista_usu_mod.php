<!--
===========================================================================
Modifica un usuario
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
    include_once('../controladores/ctrl_usu.php');
    //Obtiene el login a modificar de la URL
    $login = $_GET['usu'];
    //Obtiene los datos del usuario en un array asociativo
    $u = new Usuario();
    $usu = $u->consultar($login); 
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>    
      <form action='../controladores/ctrl_usu_mod.php' method="post">
        <div class="col-md-8 col-md-offset-2">
            <!-- Login, nombre, etc.. -->
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $idioma["modificar_usuario_usuario"]; ?></div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="login"><?php echo $idioma["modificar_usuario_login"]; ?></label>
                    <input type="text" class="form-control" name="newLogin" value="<?php echo $login; ?>">
                    <!-- Campo oculto para pasar el login del usuario al ctrl de modificar -->
                    <input hidden="hidden" type="text" name="oldLogin" value="<?php echo $login; ?>">
                    <input hidden="hidden" type="text" name="fechaAlta" value="<?php echo $fechaAlta; ?>">
                    <input hidden="hidden" type="text" name="idioma" value="<?php echo $_SESSION["idioma_usuario"]; ?>">
                </div>
                  
                <div class="form-group">
                    <label for="nombre"><?php echo $idioma["modificar_usuario_nombre"]; ?></label>
                    <textarea class="form-control" rows="1" name="nombre"><?php echo $usu['nombre'] ?></textarea>
                </div>
                  
                <div class="form-group">
                    <label for="apellidos"><?php echo $idioma["modificar_usuario_apellidos"]; ?></label>
                    <textarea class="form-control" rows="1" name="apellidos"><?php echo $usu['apellidos'] ?></textarea>
                </div>
                  
                <div class="form-group">
                    <label for="email"><?php echo $idioma["modificar_usuario_email"]; ?></label>
                    <textarea class="form-control" rows="1" name="email"><?php echo $usu['email'] ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="oldPass"><?php echo $idioma["modificar_usuario_actual_password"]; ?></label>
                    <input type="password" class="form-control" id="oldPass" name="oldPass">
                </div>
                  
                <div class="form-group">
                    <label for="newPass"><?php echo $idioma["modificar_usuario_nueva_password"]; ?></label>
                    <input type="password" class="form-control" id="newPass" name="newPass">
                </div>                  
              </div>
            </div>
            
            <!-- Lista de roles asociados al usuario -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_usuario_roles"]; ?>
                    <div class="pull-right">
                      <div class="dropdown">
                        <a href="#" data-toggle="dropdown">
                          <div class="glyphicon glyphicon-plus dropdown-toggle"></div>
                          <!-- Contenido del dropdown -->
                          <ul class="dropdown-menu rmR">
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
              <ul class="list-group list-onHover addR">
                <?php 
                  foreach ($usu['roles'] as $rol){ ?>
                    <li class="list-group-item" id="<?php echo str_replace(" ","_", $rol['NombreRol']) ?>">
                        <?php echo $rol['NombreRol'] ?>
                        <a class="rm" href="#" onclick="removeRol()"><div class="glyphicon glyphicon-trash"></div></a>
                    <!-- Elemento oculto para pasar el array con los roles modificados por POST -->
                    <input hidden="hidden" type="text" name="modRolUsu[]" value="<?php echo $rol['NombreRol']; ?>">
                    </li>
                <?php } ?>
              </ul>
            </div>
            
            <!-- Lista de paginas asociadas al usuario -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_usuario_paginas"]; ?>
                    <div class="pull-right">
                      <div class="dropdown">
                        <a href="#" data-toggle="dropdown">
                          <div class="glyphicon glyphicon-plus dropdown-toggle"></div>
                          <!-- Contenido del dropdown -->
                          <ul class="dropdown-menu rmP">
                              <?php 
                              foreach($paginas as $p){
                              ?>
                                  <li><a href="#" class="small addPag valor" value="<?php echo $p['NombrePag']; ?>" tabIndex="-1"><input type="checkbox"/>&nbsp; <?php echo $p['NombrePag']; ?> </a></li>
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
                      foreach ($usu['paginas'] as $pag){ ?>
                        <li class="list-group-item">
                            <?php echo $pag['NombrePag'] ?>
                            <a href="#" class="rm" onclick="removePag()"><div class="glyphicon glyphicon-trash"></div></a>
                        <!-- Elemento oculto para pasar el array con las paginas modificados por POST -->
                            <input hidden="hidden" type="text" name="modPagUsu[]" value="<?php echo $pag['NombrePag']; ?>">
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div> 
            
            <!-- Boton guardar -->
            <div class="btn-parent">
                <div class="btn-child"> <!-- centran el boton -->
                    <button type="submit" class="btn btn-info btn-lg" onclick="cifrar()" value=<?php echo $idioma["modificar_usuario_guardar"]; ?>><?php echo $idioma["reg_guardar"]; ?>
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
<script src="../js/md5.js" type="text/javascript"> </script>

<script>
    //Funcion para eliminar roles
    function removeRol() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
    
    //Funcion para eliminar paginas
    function removePag() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
    
    function cifrar(){
            var input_oldPass = document.getElementById("oldPass");
            input_oldPass.value = hex_md5(input_oldPass.value);
            var input_newPass = document.getElementById("newPass");
            input_newPass.value = hex_md5(input_newPass.value);
        }
</script>

<script>
    
$(document).ready(function(){
    
    //Funcion para añadir roles seleccionados en el dropdown al usuario
    $(".addRol").click(function(){
        var value = $(this).attr("value");
        //El id no puede llevar espacios
        var id = value.replace(/ /g,"_");
        //Añadirlo si no está ya añadido
        if (!$('#'+id).length) {
            $(".addR").append(" <li class='list-group-item' id='"+ id +"'>"+ value +" <a class='rm' href='#' onclick='removeRol()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='modRolUsu[]' value='"+ value +"'></li>");
        }
    });
    
    //Funcion para añadir funcionalidades del dropdown a la pagina
    $(".addPag").click(function(){
        var value = $(this).attr("value");
        //El id no puede llevar espacios
        var id = value.replace(/ /g,"_");
        //Añadirlo si no está ya añadido
        if (!$('#'+id).length) {
            $(".addP").append(" <li class='list-group-item' id='"+ id +"'> "+ value +" <a class='rm' href='#' onclick='removePag()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='modPagUsu[]' value='"+ value +"'></li>");
        }
    });    
    
});
</script>