<!--
===========================================================================
Controlador para añadir roles a la base de datos
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include '../modelo/connect_DB.php';
    include_once "../modelo/model_rol.php";
    
		
	//Recogemos las variables
		$nombreRol=$_POST['nombreRol'];
		$desc=$_POST['descripcion'];
        $usuarios= $_POST['usuario'];
		$funcionalidades= $_POST['funcionalidades'];
		
    $db = new Database();

    $newRol = new Rol($nombreRol);

  //Comprobamos si ya existe el rol
    $consultaSiRol = $newRol->exists($nombreRol);
    if ($consultaSiRol == true){
        echo '<p>El rol ' . $nombreRol . ' ya existe en la bd</p>';
    } else {
        $insertRol = new Rol ($nombreRol,$desc,$usuarios,$funcionalidades);
        printr($insertRol);
        if ($newRol->crear($insertRol) == true){
            echo 'El rol ' . $nombreRol. ' ha sido registrado en el sistema';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
 
        } else{
            echo "Error al insertar el rol";
        }
    }




    $db->desconectar();
?>