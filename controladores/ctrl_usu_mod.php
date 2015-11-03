<!--
===========================================================================
Controlador para modificar los datos de los usuarios
Creado por: Edgar Conde Nóvoa
Fecha: 03/11/2015
============================================================================
-->

<?php
    include_once "../modelo/model_rol.php";

    $modUsu = new Usuario();

    //Nuevos datos
    $oldUsuLogin = $_POST['oldLogin'];
    $newUsuLogin = $_POST['usu'];
    $newUsuName = $_POST['nombre'];
    $newUsuSurname = $_POST['apellidos'];
    $newUsuEmail = $_POST['email'];
    $newUsuPassword = $_POST['pass'];
    $roles = array();
    $pags = array();

    if(isset($_POST['newRol'])){
      if (is_array($_POST['newRol'])) {
        foreach($_POST['newRol'] as $value){
          $roles[] = $value;
        }
      }
    }

    if(isset($_POST['newPag'])){
      if (is_array($_POST['newPag'])) {
        foreach($_POST['newPag'] as $value){
          $pags[] = $value;
        }
      }
    }

    $newUsu = new Usuario($newUsuLogin, $newRolDesc, $roles, $pags);
    if ($modUsu->modificar($oldUsuLogin, $newUsu) == true){
        header('location:../vistas/vista_usu.php'); 
    }else {
        echo "Fallo en la actualizacion del usuario";
    }
?>