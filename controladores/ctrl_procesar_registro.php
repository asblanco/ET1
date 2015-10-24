<?php
//=====================================================================================================================
// Fichero : RegistrarUsuario.php
// Creado por : jrodeiro
// Fecha : 29/9/2015
// Recoge por post los valores de registro de un usuario. Conecta con el gestor de bd y selecciona la bd
// Comprueba si existe el login. Si no existe lo inserta e informa. Si existe informa y proporciona link a Registro.php
//=====================================================================================================================
include 'funciones_comunes.php';

//Recogemos las variables que vienen por POST desde el formulario
$login= $_POST['login'];
$pass= $_POST['password'];
$nombre= $_POST['nombre'];
$apellidos= $_POST['apellidos'];
$email= $_POST['email'];

//Conectamos con el gestor de la bd
echo ConectarBD();

//Comprobamos que se hayan cubierto todos los campos
if ( empty($login) OR empty($pass) OR empty($nombre) OR empty($apellidos) OR (!filter_var($email, FILTER_VALIDATE_EMAIL) AND !empty($email))) {
            // Set a 400 (bad request) response code and exit.
            header("HTTP/1.0 400 bad request");
            echo '<p>Por favor, rellene correctamente todos los campos<p>';
            exit;
 }

//Comprobamos si ya existe ese login
$consultaSilogin = "select * from Usuario where Login = '$login' ";
$resultado = mysql_query($consultaSilogin) or die('error al ejecutar la consulta de login');

// Si no devuelve ninguna fila no encontro el login
if (mysql_num_rows($resultado) == 0) 
{
     // insertamos el usuario en la bd
     $InsertaUsuario = "Insert into Usuario (Login, Password, Nombre, Apellidos, Email) values ('$login','$pass','$nombre','$apellidos','$email')";
     $insercion = mysql_query($InsertaUsuario) or die('error al ejecutar la insercion de usuario');
     echo 'El Login ' . $login . ' ha sido registrado en el sistema';
}
// devuelve una fila por lo tanto encontro ese login
else
{
	echo '<p>El usuario ' . $login . ' ya existe en la bd<p>';

}

?>
