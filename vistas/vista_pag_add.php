<!--
===========================================================================
Añade una nueva página
Creado por: 
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
 include_once '../modelo/connect_DB.php';
 include('../html/navBar.html');
  ?>



<html lang="en">
    <!-- Contenido Principal -->
    <body>
            <div class="col-md-8 col-md-offset-2"> <!-- centra el contenido -->
                <!-- Nombre y descripcion -->
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo $idioma["anadir_pagina_pag"]; ?></div>
                    <blockquote>
                        <br>
                        <?php echo $idioma["anadir_pagina_selecciona"]; ?>
                     <form id="subir_pagina" action='../controladores/ctrl_pag_add.php' method='POST' enctype="multipart/form-data">
                        
                        <input type="file" name="archivo">
                    </blockquote>
                  <div class="panel-body">
                    <div class="form-group">
                        <label for="rol"><?php echo $idioma["anadir_pagina_nombre_pag"]; ?></label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="rol"><?php echo $idioma["anadir_pagina_desc"]; ?></label>
                        <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
                    </div>
                  </div>
                </div>
                
                <!-- Nuevos usuarios asociados al rol -->
                <div class="panel panel-default">
                  <div class="panel-heading"><?php echo $idioma["anadir_pagina_nombre_usuarios"]; ?>
                        <div class="pull-right">
                        <?php 
                        $db = new Database();
                        $sql = ("SELECT Login FROM Usuario");
                        $Resultado = $db->consulta($sql) ;
            
                                while ($row = mysqli_fetch_array($Resultado))
                                {
                                   echo $row['Login']." <input type='checkbox' name='usuario[]' value='". $row['Login'] ."'/> ";
                                }
                                ?>
                      </div>
                   </div>
                </div>
                
                <!-- Nuevas funcionalidades asociados al rol -->
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $idioma["anadir_pagina_nombre_func"]; ?>
                      <div class="pull-right">
                        <select name="Funcionalidades">
                        <?php 
                        $db = new Database();
                        $sql = ("SELECT NombreFun FROM Funcionalidad");
                        $Resultado = $db->consulta($sql) ;
            
                                while ($row = mysqli_fetch_array($Resultado))
                                {
                                    echo '<option value="'.$row['NombreFun'].'">'.$row['NombreFun'].'</option>';
                                }
                                ?>
                        </select>
                        </div></a>
                    </div>
                </div>
                    
                    <!-- Boton crear -->
                    <div class="btn-parent">
                        <div class="btn-child"> <!-- centran el boton -->
                            <button type="submit" value="enviar" class="btn btn-info btn-lg">
                                <?php echo $idioma["anadir_pagina_crear"];?>
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
    
