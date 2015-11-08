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
    $p = new Pagina();
    $pagina = $p->consultar($pagName); 
?>


<html lang="en">
    <!-- Contenido Principal -->
    <body>   
        <!-- Pagina1 1 -->
        <form action='../controladores/ctrl_pag_mod.php' method="post">
            <div class="col-md-8 col-md-offset-2">
                <!--Nombre y descripcion-->
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $idioma["modificar_pagina_pagina"]; ?></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="pagina"><?php echo $idioma["modificar_pagina_nombre"]; ?></label>
                                <textarea class="form-control" rows="1" name="nombre"><?php echo $pagina['descripcion']; ?></textarea>
                                <input hidden="hidden" type="text" name="oldName" value="<?php echo $pagName; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="tipo"><?php echo $idioma["modificar_pagina_descripcion"]; ?></label>
                                <textarea class="form-control" rows="5" name="comment"><?php echo $pagina['descripcion']; ?></textarea>
                            </div>
                        </div>
                </div>
                
                
            <!-- Lista de funcionalidades para la pagina -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <?php echo $idioma["modificar_pagina_funcionalidad"]; ?>
                   <div class="pull-right">
                          <div class="pull-right">
                        <select name="Funcionalidad">
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
                <!-- List group -->
                <ul class="list-group list-onHover">
                    
                        <li class="list-group-item">
                            <?php echo $pagina['funcionalidad'] ?>
                            
                        <!-- Elemento oculto para pasar el array con las funcionalidades modificados por POST -->
                            <input hidden="hidden" type="text" name="newFunc" value="<?php echo $func['NombreFun']; ?>">
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
        function removeFunc() {
            $('.rm').click(function(){
              $(this).parents('li').remove();
            })
        }
        
    </script>
                            
                            
                          
    </body>
</html>
    </body>
</html>
<?php include('../html/footer.html'); ?>
