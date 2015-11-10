<!DOCTYPE html>
<!--
===========================================================================
Añade los usuarios
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 23/10/2015
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
include_once "../modelo/model_usu.php";
include_once "../controladores/ctrl_usu.php";
include('../html/navBar.html'); ?>


<html lang="en">
    <div id="includedContent"></div>
    
    <!-- Contenido Principal -->
    <body>
        <form action='../controladores/ctrl_usu_add.php' method="post">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $idioma["anadir_usuario_usuario"]; ?></div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="login"><?php echo $idioma["anadir_usuario_login"]; ?></label>
                    <input type="text" class="form-control" name="login" id="login">
                </div>
                  
                <div class="form-group">
                    <label for="nombre"><?php echo $idioma["anadir_usuario_nombre"]; ?></label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                </div>
                  
                <div class="form-group">
                    <label for="apellidos"><?php echo $idioma["anadir_usuario_apellidos"]; ?></label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos">
                </div>
                  
                <div class="form-group">
                    <label for="email"><?php echo $idioma["anadir_usuario_email"]; ?></label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                  
                <div class="form-group">
                    <label for="password"><?php echo $idioma["anadir_usuario_password"]; ?></label>
                    <input type="password" class="form-control" name="password" id="password">
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
                              foreach($paginas as $p){ ?>
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
                    
                </ul>
            </div>
                    
                    <!-- Boton crear -->
                    <div class="btn-parent">
                        <div class="btn-child"> <!-- centran el boton -->
                            <button type="submit" onclick="cifrar()" value="enviar" class="btn btn-info btn-lg">
                                <?php echo $idioma["anadir_usuario_crear"];?>
                                <div class="glyphicon glyphicon-ok"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </form>        
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>
<script src="../js/md5.js" type="text/javascript"> </script>

<!-- Script despues del include footer porque ahi se importa jquery -->
<script>
    //Funcion para eliminar usuarios
    function removeRol() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
    
    //Funcion para eliminar funcionalidades
    function removePag() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
    function cifrar(){
        var input_newPass = document.getElementById("password");
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
            $(".addR").append(" <li class='list-group-item' id='"+ id +"'>"+ value +" <a class='rm' href='#' onclick='removeRol()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='newRolUsu[]' value='"+ value +"'></li>");
        }
    });
    
    //Funcion para añadir funcionalidades del dropdown a la pagina
    $(".addPag").click(function(){
        var value = $(this).attr("value");
        //El id no puede llevar espacios
        var id = value.replace(/ /g,"_");
        //Añadirlo si no está ya añadido
        if (!$('#'+id).length) {
            $(".addP").append(" <li class='list-group-item' id='"+ id +"'> "+ value +" <a class='rm' href='#' onclick='removePag()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='newPagUsu[]' value='"+ value +"'></li>");
        }
    });    
    
});
</script>
