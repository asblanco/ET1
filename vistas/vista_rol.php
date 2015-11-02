<!--
===========================================================================
Muestra los roles
Creado por: Andrea Sanchez Blanco, Edgar Conde Novoa
Fecha: 25/10/2015
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

    include_once('../html/navBar.html'); 
    include_once('../controladores/ctrl_rol.php');
 ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir rol -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_rol_add.php" class="btn btn-info btn-lg">
                   <?php echo $idioma["anadir_rol"]; ?>
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
                
        <?php 
        if(isset($_GET['confirmar'])){
            $roles::eliminar($_GET['confirmar']);
            header('location:vista_rol.php');
        } else if (isset($_GET['borrar'])){
        ?>
        <!-- Remove Modal Page -->
        <div class="modal show" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel"><?php echo $idioma["advertencia_borrar_rol"]; ?></h4>
              </div>
                
            <!-- Contenido de la página login modal -->
              <div class="modal-body">
                 <p><?php echo $idioma["seguro_borrar_rol"]; echo $_GET['borrar'];?> ?</p>
              </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick ="location='vista_rol.php'"><?php echo $idioma["NO_borrar_rol"]; ?></button>
                  <a class="btn btn-primary" href="vista_rol.php?confirmar=<?php echo $_GET['borrar'];?>"><?php echo $idioma["SI_borrar_rol"]; ?></a>
              </div>
            </div>
          </div>
        </div>
         <?php
        		}
									?>
        
        <!-- Mostrar Roles -->
        <?php 
        foreach ($arrayRoles as $rol)  {
            //Array asoc de los datos del rol del bucle
            $rolX = $roles->consultar($rol['NombreRol']);
        ?>
        <div class='col-md-8 col-md-offset-2 well'>
            <a href="vista_rol.php?borrar=<?php echo $rol['NombreRol'];?>"> <div class='remove-icon glyphicon glyphicon-remove'></div></a>
            <div class='col-md-6'>
                <div class='titulo'> <?php echo $rol['NombreRol'] ?>
                    <a href="vista_rol_mod.php?rol=<?php echo $rol['NombreRol']?>"> <div class='edit-icon glyphicon glyphicon-edit'></div></a>
                </div>
                <p class='descripcion'> <?php echo $rol['DescRol'] ?> </p>
            </div>
            <div class='col-md-3'>
                <h4>Usuarios</h4>
                <?php
                // array asociativo de los usuarios ligados al rol actual del bucle
                $arrayUsuarios = $rolX['usuarios'];
                foreach ($arrayUsuarios as $usu ){
                    echo "<p> {$usu['Login']} </p>";
                }
                 ?>
           
            </div>
            <div class='col-md-2'>
                <h4>Funcionalidades</h4>
                <?php
                // array asociativo de las funcionalidades ligadas al rol actual del bucle
                $arrayFuncionalidades = $rolX['funcionalidades'];
                foreach ($arrayFuncionalidades as $func ){
                    echo "<p> {$func['NombreFun']} </p>";
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