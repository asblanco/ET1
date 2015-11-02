<!--
===========================================================================
Muestra los usuarios
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco, Andrea Sanchez Blanco
Fecha: 27/10/2015
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
header('Location:../vistas/login.php');}

include_once('../html/navBar.html');
include_once('../controladores/ctrl_usu.php');
 ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir usuario -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_rol_add.php" class="btn btn-info btn-lg">
                   <?php echo $idioma["anadir_usuario"]; ?>
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
                
        <?php 
        if(isset($_GET['confirmar'])){
            $usuarios::eliminar($_GET['confirmar']);
            header('location:vista_usu.php');
        } else if (isset($_GET['borrar'])){
        ?>
        <!-- Remove Modal Page -->
        <div class="modal show" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel"><?php echo $idioma["advertencia_borrar_usuario"]; ?></h4>
              </div>
                
            <!-- Contenido de la página login modal -->
              <div class="modal-body">
                 <p><?php echo $idioma["seguro_borrar_usuario"]; echo $_GET['borrar'];?> ?</p>
              </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick ="location='vista_usu.php'"><?php echo $idioma["NO_borrar_usuario"]; ?></button>
                  <a class="btn btn-primary" href="vista_usu.php?confirmar=<?php echo $_GET['borrar'];?>"><?php echo $idioma["SI_borrar_usuario"]; ?></a>
              </div>
            </div>
          </div>
        </div>
         <?php
        		}
									?>
        
        <!-- Mostrar Roles -->
        <?php 
        foreach ($arrayUsuarios as $usu)  {
            //Array asoc de los datos del rol del bucle
            $usuX = $usuarios->consultar($usu['Login']);
        ?>
        <div class='col-md-8 col-md-offset-2 well'>
            <a href="vista_usu.php?borrar=<?php echo $usu['Login'];?>"> <div class='remove-icon glyphicon glyphicon-remove'></div></a>
            <div class='col-md-6'>
                <div class='titulo'> <?php echo $usu['Login']; ?>
                    <a href="vista_usu_mod.php?usu=<?php echo $usu['Login'];?>"> <div class='edit-icon glyphicon glyphicon-edit'></div></a>
                </div>
                <p class='nombre'> Nombre:  <?php echo $usu['Nombre'] ?> </p>
                <p class='apellidos'> Apellidos: <?php echo $usu['Apellidos'] ?> </p>
                <p class='email'> Email: <?php echo $usu['Email'] ?> </p>
            </div>
            <div class='col-md-3'>
                <h4>Roles</h4>
                <?php
                // array asociativo de los roles ligados al usuario actual del bucle
                $arrayRoles = $usuX['roles'];
                foreach ($arrayRoles as $rol ){
                    echo "<p> {$rol['NombreRol']} </p>";
                }
                 ?>
           
            </div>
            <div class='col-md-2'>
                <h4>Paginas</h4>
                <?php
                // array asociativo de las paginas ligadas al usuario actual del bucle
                $arrayPaginas = $usuX['paginas'];
                foreach ($arrayPaginas as $pag ){
                    echo "<p> {$pag['Url']} </p>";
                }
                 ?>   
            </div>
        </div>
        <?php
        }
        ?>
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>