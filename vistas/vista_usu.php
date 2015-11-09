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

include_once('../controladores/ctrl_permisos.php');
include_once('../html/navBar.html');
include_once('../controladores/ctrl_usu.php');
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir usuario -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_usu_add.php" class="btn btn-info btn-lg">
                   <?php echo $idioma["anadir_usuario"]; ?>
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
                
        
        
        <!-- Mostrar Usuarios -->
        <?php 
        foreach ($arrayUsuarios as $usu)  {
            //Array asoc de los datos del usuario del bucle
            $usuX = $users->consultar($usu['Login']);
        ?>
        <div class='col-md-8 col-md-offset-2 well'>
            <a href="vista_usu_del.php?borrar=<?php echo $usu['Login'];?>"> <div class='remove-icon glyphicon glyphicon-remove'></div></a>
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
                    echo "<p> {$pag['NombrePag']} </p>";
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