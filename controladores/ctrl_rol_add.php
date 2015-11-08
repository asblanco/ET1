<!--
===========================================================================
Controlador para añadir roles a la base de datos
Creado por: Andrea Sanchez Blanco
Fecha: 8/11/2015
============================================================================
-->

<?php
    include_once "../modelo/model_rol.php";

    //Recogemos las variables
    $nombreRol = $_POST['nombreRol'];
    $desc = $_POST['descripcion'];
    $usuarios = array();
    $funcionalidades = array();

    //Añadir los datos a los arrays
    if(isset($_POST['newUsuRol'])){
      if (is_array($_POST['newUsuRol'])) {
        foreach($_POST['newUsuRol'] as $value){
          $usuarios[] = $value;
        }
      }
    }

    if(isset($_POST['newFuncRol'])){
      if (is_array($_POST['newFuncRol'])) {
        foreach($_POST['newFuncRol'] as $value){
          $funcionalidades[] = $value;
        }
      }
    }

    $db = new Database();
    $newRol = new Rol($nombreRol);

    //Comprobamos si ya existe el rol
    $consultaSiRol = $newRol->exists($nombreRol);
    if ($consultaSiRol == true){
        echo '<p>El rol ' . $nombreRol . ' ya existe en la bd</p>';
    } else {
        $insertRol = new Rol ($nombreRol,$desc,$usuarios,$funcionalidades);
        
        if ($newRol->crear($insertRol) == true){
            header('Location:../vistas/vista_rol.php');
        } else{
            echo "Error al insertar el rol";
        }
    }

    $db->desconectar();
?>