<!--
===========================================================================
Controlador para modificar los datos de los usuarios
Creado por: Edgar Conde Nóvoa
Fecha: 03/11/2015
============================================================================
-->

<?php
    include_once "../modelo/model_usu.php";

    $modUsu = new Usuario();

    //Nuevos datos
    $oldUsuLogin = $_POST['oldLogin'];
    $newUsuLogin = $_POST['newLogin'];
    $newUsuName = $_POST['nombre'];
    $newUsuSurname = $_POST['apellidos'];
    $newUsuEmail = $_POST['email'];
    $oldUsuPassword = $_POST['oldPass'];
    $newUsuPassword = $_POST['newPass'];
    $fechaAlta = $_POST['fechaAlta'];
    $idioma= $_POST['idioma'];
    $roles = array();
    $pags = array();




    //Comprobamos que se hayan cubierto todos los campos
    if ( empty($newUsuLogin) OR empty($newUsuName) OR empty($newUsuSurname) OR (!filter_var($newUsuEmail, FILTER_VALIDATE_EMAIL) AND empty($newUsuEmail))){
                // Set a 400 (bad request) response code and exit.
                header("HTTP/1.0 400 bad request");
                echo '<p>Por favor, rellene correctamente todos los campos</p>';
                exit;
     }

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

    //Contraseña del usuarios de la BD
    $password = $modUsu->getPassword($oldUsuLogin);
    //d41d8cd98f00b204e9800998ecf8427e es cadena vacia en MD5
    //Si el campo contraseña esta vacio, modifica los datos
    if (strcmp($oldUsuPassword, "d41d8cd98f00b204e9800998ecf8427e")== 0){
            $newUsu = new Usuario($newUsuLogin, $newUsuName, $newUsuSurname, $fechaAlta, $newUsuEmail, "", $idioma, $roles, $pags);
        if ($modUsu->modificar($oldUsuLogin, $newUsu) == true){
            header('location:../vistas/vista_usu.php'); 
        }else {
            echo "Fallo en la actualizacion del usuario";
        }
    }
    //Si la contraseña antigua no es igual a la de la BD
    else if (strcmp($password, $oldUsuPassword) !== 0){
        echo "La contraseña actual introducida no corresponde con la del usuario.";
    }
        //Si la nueva contraseña esta vacia dar error
        else if (strcmp($newUsuPassword, "d41d8cd98f00b204e9800998ecf8427e")== 0){
            echo "La nueva contraseña no puede estar vacia.";}
            else {
                $newUsu = new Usuario($newUsuLogin, $newUsuName, $newUsuSurname, $fechaAlta, $newUsuEmail, $newUsuPassword, $idioma, $roles, $pags);
                if ($modUsu->modificar($oldUsuLogin, $newUsu) == true){
                    header('location:../vistas/vista_usu.php'); 
                }else {
                    echo "Fallo en la actualizacion del usuario";
                }
            }

?>