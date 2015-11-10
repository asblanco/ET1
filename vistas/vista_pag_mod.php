<!--
===========================================================================
Muestra las funcionalidades
Creado por: 
Fecha: /10/2015
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
    include_once('../controladores/ctrl_pag.php');
    //Obtiene el nombre de la pagina a modificar de la URL
    $pagName = $_GET['pag'];
    //Obtiene los datos de la pagina en un array asociativo
    $url = $paginas->getUrl($pagName);
    $pagina = $paginas->consultar($url);
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>   
        <!-- Pagina 1 -->
        <form action='../controladores/ctrl_pag_mod.php' method="post">
            <div class="col-md-8 col-md-offset-2">
                <!--Nombre y descripcion-->
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $idioma["modificar_pagina_pagina"]; ?></div>
                        <div class="panel-body">
                            <div class="form-group">
                              <label for="pagina"><?php echo $idioma["modificar_pagina_nombre"]; ?></label>
                              <input type="text" class="form-control" name="newPag" value="<?php echo $pagName; ?>">
                              <!-- Campo oculto para pasar el nombre del rol al ctrl de modificar -->
                              <input hidden="hidden" type="text" name="oldPag" value="<?php echo $pagName; ?>">
							                     </div>
                            
                            <div class="form-group">
                                <label for="comment"><?php echo $idioma["modificar_pagina_descripcion"]; ?></label>
                                <textarea class="form-control" rows="5" name="newDesc"><?php echo $pagina['descripcion']; ?></textarea>     
                            </div>
                        </div>
                </div>
                
            <!-- Lista de usuarios asociados a la pagina -->
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
                  foreach ($pagina['usuarios'] as $usu){ ?> 
                    <li class="list-group-item" id="<?php echo str_replace(" ","_", $usu['Login']) ?>">
                        <?php echo $usu['Login'] ?>
                        <a class="rm" href="#" onclick="removeUsu()"><div class="glyphicon glyphicon-trash"></div></a>
                    <!-- Elemento oculto para pasar el array con los ususarios modificados por POST -->
                    <input hidden="hidden" type="text" name="newUsuPag[]" value="<?php echo $usu['Login']; ?>">
                    </li>
                <?php } ?>
              </ul>
            </div>    
                
            <!-- Funcionalidad de la pagina -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_pagina_funcionalidad"]; ?>
                  <div class="pull-right">
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown">
                          <div class="glyphicon glyphicon-plus dropdown-toggle"></div>
                          <!-- Contenido del dropdown -->
                          <ul class="dropdown-menu">
                              <?php 
                              foreach($freeFunc as $f){ ?>
                                  <li><a href="#" class="small addFunc" value="<?php echo $f; ?>" tabIndex="-1"><input type="checkbox"/>&nbsp; <?php echo $f; ?> </a></li>
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
                        <li class="list-group-item">
                            <?php echo $pagina['funcionalidad'] ?>
                            <a href="#" class="rmF" onclick="removeFunc()"><div class="glyphicon glyphicon-trash"></div></a>
                        <!-- Elemento oculto para pasar el array con las funcionalidades modificados por POST -->
                            <input hidden="hidden" type="text" name="newFuncPag" value="<?php echo $pagina['funcionalidad']; ?>">
                        </li>
                        
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
            $('.rmF').click(function(){
              $(this).parents('li').remove();
            })
        }
        
    </script>

    </body>
</html>
<?php include('../html/footer.html'); ?>

<script>
$(document).ready(function(){
    $(".addUsu").click(function(){
        var value = $(this).attr("value");
        //El id no puede llevar espacios
        var id = value.replace(/ /g,"_");
        if (!$('#'+id).length) {
        $(".addU").append(" <li class='list-group-item' id='"+ id +"'>"+ value +" <a class='rm' href='#' onclick='removeUsu()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='newUsuPag[]' value='"+ value +"'></li>");}
    });

    $(".addFunc").click(function(){
        var value = $(this).attr("value");
        $(".rmF").parents('li').remove();
        $(".addF").append(" <li class='list-group-item'>"+ value +" <a class='rmF' href='#' onclick='removeFunc()'><div class='glyphicon glyphicon-trash'></div></a><input hidden='hidden' type='text' name='newFuncPag' value='"+ value +"'></li>");
    });
});
</script>