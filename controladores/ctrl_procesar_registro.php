<!--
===========================================================================
Controlador para procesar un nuevo registro
Creado por: Andrea Sanchez Blanco
Fecha: 01/11/2015
============================================================================
-->

<?php
    include '../modelo/connect_DB.php';
    include '../modelo/model_usu.php';

    //Recogemos las variables que vienen por POST desde el formulario
    $login= $_POST['login'];
    $pass= $_POST['password'];
    $nombre= $_POST['nombre'];
    $apellidos= $_POST['apellidos'];
    $email= $_POST['email'];
    $language = $_POST['language'];

    //Conectamos con el gestor de la bd
    $db = new Database();
    $newUsu = new Usuario();

    //Comprobamos que se hayan cubierto todos los campos
    if ( empty($login) OR empty($pass) OR empty($nombre) OR empty($apellidos) OR (!filter_var($email, FILTER_VALIDATE_EMAIL) AND empty($email))) {
                // Set a 400 (bad request) response code and exit.
                header("HTTP/1.0 400 bad request");
                echo '<p>Por favor, rellene correctamente todos los campos</p>';
                exit;
     }

    //Comprobamos si ya existe ese login
    $consultaSilogin = $newUsu->exists($login);
    if ($consultaSilogin == true){
        echo '<p>El usuario ' . $login . ' ya existe en la bd</p>';
    } else {
        $mysqldate = date('Y-m-d H:i:s');
        $insertUsu = new Usuario($login, $nombre, $apellidos, $mysqldate, $email, $pass, $language);
        
        if ($newUsu->crear($insertUsu) == true){
            echo 'El Login ' . $login . ' ha sido registrado en el sistema';
            header('location:../index.php'); 
        } else{
            echo "Error al insertar el usuario";
        }
    }

?>
