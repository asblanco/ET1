<!--
===========================================================================
Controlador para añadir usuarios a la base de datos
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 28/10/2015
============================================================================
-->

<?php
    include_once "../modelo/model_usu.php";
    
    $db = new Database();

		
	//Recogemos las variables
		$login=$_POST['login'];
		$nombre=$_POST['nombre'];
		$apellidos= $_POST['apellidos'];
		$fechaAlta="";
		$email= $_POST['email'];
		$password= $_POST['password'];
		$roles= array();
		$paginas= array();
		$idioma="es";

    $newUsu = new Usuario($login);

    if(isset($_POST['newRolUsu'])){
      if (is_array($_POST['newRolUsu'])) {
        foreach($_POST['newRolUsu'] as $value){
          $roles[] = $value;
        }
      }
    }

    if(isset($_POST['newPagUsu'])){
      if (is_array($_POST['newPagUsu'])) {
        foreach($_POST['newPagUsu'] as $value){
          $pags[] = $value;
        }
      }
    }

  //Comprobamos si ya existe el usuario
    $consultaSiUsu = $newUsu->exists($login);
    if ($consultaSiUsu == true){
        echo '<p>El usuario ' . $login . ' ya existe en la bd</p>';
    } else {
        $insertUsu = new Usuario ($login,$nombre,$apellidos,$fechaAlta,$email,$password,$idioma,$roles,$paginas);
        if ($newUsu->crear($insertUsu) == true){
            echo 'El usuario ' . $login. ' ha sido registrado en el sistema';
            header('Location:../vistas/vista_usu.php' );
 
        } else{
            echo "Error al insertar el usuario";
        }
    }


    $db->desconectar();
?>