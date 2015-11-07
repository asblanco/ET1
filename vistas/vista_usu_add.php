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
 include_once "../modelo/connect_DB.php";
include_once "../modelo/model_usu.php";
include_once "../controladores/ctrl_usu.php";
$usu=new Usuario();
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
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                  
                <div class="form-group">
                    <label for="password"><?php echo $idioma["anadir_usuario_password"]; ?></label>
                    <input type="text" class="form-control" name="password" id="password">
                </div>  
              </div>
            </div>
            
                
                <!-- Nuevas paginas asociadas al usuario -->
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $idioma["anadir_usuario_paginas"]; ?>
                      <div class="pull-right">
                        <select name="paginas">
                        <?php 
                        $db = new Database();
                        $sql = ("SELECT NombrePag FROM Pagina");
                        $Resultado = $db->consulta($sql) ;
            
                                while ($row = mysqli_fetch_array($Resultado))
                                {
                                    echo "<option value=\"Páginas\">" . $row['NombrePag'] . "</option>";
                                }
                                ?>
                        </select>
                        </div></a>
                    </div>
                </div>
                
                <!-- Nuevos roles asociados al usuarios -->
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $idioma["anadir_func_roles"]; ?>
                      <div class="pull-right">
                        
                        </div></a>
                    </div>
                    <!-- List group -->
              <ul class="list-group list-onHover">
                <?php 
                  foreach ($usu['roles'] as $rol){ ?>
                    <li class="list-group-item">
                        <?php echo $rol['NombreRol'] ?>
                        <a class="rm" href="#" onclick="removeRol()"><div class="glyphicon glyphicon-trash"></div></a>
                    <!-- Elemento oculto para pasar el array con los roles modificados por POST -->
                    <input hidden="hidden" type="text" name="newRol[]" value="<?php echo $rol['NombreRol']; ?>">
                    </li>
                <?php } ?>
              </ul>
                </div>
                    
                    <!-- Boton crear -->
                    <div class="btn-parent">
                        <div class="btn-child"> <!-- centran el boton -->
                            <button type="submit" value="enviar" class="btn btn-info btn-lg">
                                <?php echo $idioma["anadir_func_crear"];?>
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