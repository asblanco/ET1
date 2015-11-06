<!--
===========================================================================
Muestra las funcionalidades
Creado por: David Ansia Fdez
Fecha: 06/10/2015
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
    include_once('../controladores/ctrl_pag.php');
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir pagina -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_pag_add.php" class="btn btn-info btn-lg">
                   <?php echo $idioma["anadir_pagina"]; ?>
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
                
        <?php 
        if(isset($_GET['confirmar'])){
            $paginas::eliminar($_GET['confirmar']);
            header('location:vista_pag.php');
        } else if (isset($_GET['borrar'])){
        ?>
        <!-- Remove Modal Page -->
        <div class="modal show" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel"><?php echo $idioma["advertencia_borrar_pagina"]; ?></h4>
              </div>
                
            <!-- Contenido de la página login modal -->
              <div class="modal-body">
                 <p><?php echo $idioma["seguro_borrar_pagina"]; echo $_GET['borrar'];?> ?</p>
              </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick ="location='vista_pag.php'"><?php echo $idioma["NO_borrar_pagina"]; ?></button>
                  <a class="btn btn-primary" href="vista_pag.php?confirmar=<?php echo $_GET['borrar'];?>"><?php echo $idioma["SI_borrar_pagina"]; ?></a>
              </div>
            </div>
          </div>
        </div>
         <?php
        		}
									?>
        
        <!-- Mostrar Paginas -->
        <?php 
        foreach ($arrayPaginas as $pag)  {
            //Array asoc de los datos de la pagina del bucle
            $pagX = $paginas->consultar($pag['Url']);
        ?>
        <div class='col-md-8 col-md-offset-2 well'>
            <a href="vista_pag.php?borrar=<?php echo $pag['Url'];?>"> <div class='remove-icon glyphicon glyphicon-remove'></div></a>
            <div class='col-md-6'>
                <div class='titulo'> <?php echo $pag['Url'] ?>
                    <a href="vista_pag_mod.php?pag=<?php echo $pag['Url'];?>"> <div class='edit-icon glyphicon glyphicon-edit'></div></a>
                </div>
                <p class='descripcion'> <?php echo $pag['DescPag']; ?> </p>
            </div>
            <div class='col-md-3'>
                <h4>Usuarios</h4>
                <?php
                // array asociativo de los usuarios ligados a la pagina actual del bucle
                $arrayUsuarios = $pagX['usuarios'];
                foreach ($arrayUsuarios as $usu ){
                    echo "<p> {$usu['Login']} </p>";
                }
                 ?>
           
            </div>
            <div class='col-md-2'>
                <h4>Funcionalidad</h4>
                <?php
                //Funcionalidad ligada a la pagina actual del bucle
                $func = $pagX['funcionalidad'];
                 ?>
                <p><?php echo $func; ?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </body>
</html>


<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>
