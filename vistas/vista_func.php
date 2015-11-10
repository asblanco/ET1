<!--
===========================================================================
Muestra las funcionalidades
Creado por: 
Fecha: /10/2015
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
include('../html/navBar.html');
include_once('../controladores/ctrl_func.php');
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir funcionalidad -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_func_add.php" class="btn btn-info btn-lg">
                    <?php echo $idioma["anadir_funcionalidad"]; ?>
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
        
        
        <!-- Mostrar Funcionalidades -->
        <?php 
        foreach ($arrayFun as $fun)  { 
            //Array asoc de los datos de la funcionalidad del bucle
            $funcX = $funcionalidades->consultar($fun['NombreFun']);
        ?>
          <div class='col-md-8 col-md-offset-2 well'>
            <a href="vista_func_del.php?borrar=<?php echo $fun['NombreFun'];?>"> <div class='remove-icon glyphicon glyphicon-remove'></div></a>
            <div class='col-md-6'>
                <div class='titulo'> <?php echo $fun['NombreFun']; ?> 
                    <a href='vista_func_mod.php?func=<?php echo $fun['NombreFun']; ?>'> <div class='edit-icon glyphicon glyphicon-edit'></div></a>
                </div>
                <p class='descripcion'> <?php echo $fun['DescFun']; ?> </p>
            </div>
            <div class='col-md-3'>
                <h4>Roles</h4>
                <?php
                //array asociativo de los roles con la funcionalidad actual del bucle
                $arrayRoles = $funcX['roles'];
                foreach ($arrayRoles as $rol ){
                    echo "<p> {$rol['NombreRol']} </p>";
                }
                ?>
            
            </div>
            <div class='col-md-2'>
                <h4>Paginas</h4>
                <?php
                // array asociativo de las paginas ligadas a la funcionalidad actual del bucle
                $arrayPaginas = $funcX['paginas'];
                foreach ($arrayPaginas as $pag ){
                    echo "<p> {$pag['Url']} </p>";
                } ?>      
            </div>
        </div>
        <?php
        }
        ?>
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>
