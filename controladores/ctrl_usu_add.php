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

    $loginClase ; //traer de la vista
  
    $usuario = new usuario($loginClase);

    //Se debe pasar el nombre, roles y hacer un bucle para añadir los roles y paginas asociadas
        
		
		
		
	//Recogemos las variables
		$login=$_POST['login'];
		$nombre=$_POST['nombre'];
		$apellidos= $_POST['apellidos'];
		$fechaAlta="";
		$email= $_POST['email'];
		$password= $_POST['password'];
		$roles= $_POST['roles'];
		$paginas= $_POST['paginas'];
		$idioma="es";

  //Comprobamos si ya existe el usuario
    $consultaSiUsu = $newUsu->exists($login);
    if ($consultaSiUsu == true){
        echo '<p>El usuario ' . $login . ' ya existe en la bd</p>';
    } else {
        $insertUsu = new Usuario ($login,$nombre,$apellidos,$fechaAlta,$email,$password,$idioma,$roles,$paginas);
        if ($newUsu->crear($insertUsu) == true){
            echo 'El usuario ' . $login. ' ha sido registrado en el sistema';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
 
        } else{
            echo "Error al insertar el usuario";
        }
    }




    $db->desconectar();
?>