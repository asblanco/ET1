<!--
===========================================================================
Controlador para añadir usuarios a la base de datos
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 28/10/2015
============================================================================
-->

<?php
    include '../modelo/connect_DB.php';
    include_once "../modelo/model_usu.php";
    
    $db = new Database();


    //Se debe pasar el nombre, roles y hacer un bucle para añadir los roles y paginas asociadas
		
		
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