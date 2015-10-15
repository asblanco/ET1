<?php
//=====================================================================================================================
// Fichero : RegistrarUsuario.php
// Creado por : jrodeiro
// Fecha : 29/9/2015
// Recoge por post los valores de registro de un usuario. Conecta con el gestor de bd y selecciona la bd
// Comprueba si existe el login. Si no existe lo inserta e informa. Si existe informa y proporciona link a Registro.php
//=====================================================================================================================
include 'FuncionesComunes.php';

//Recogemos las variables que vienen por POST desde el formulario
$login= $_POST['login'];
$pass= $_POST['pass'];
$nombre= $_POST['nombre'];
$apellidos= $_POST['apellidos'];
$email= $_POST['email'];

//Conectamos con el gestor de la bd
echo ConectarBD();


//Comprobamos si ya existe ese login
$consultaSilogin = "select * from Usuario where Login = '$login' ";
$resultado = mysql_query($consultaSilogin) or die('error al ejecutar la consulta de login');

// Si no devuelve ninguna fila no encontro el login
if (mysql_num_rows($resultado) == 0) 
{
	// insertamos el usuario en la bd
	$InsertaUsuario = "Insert into Usuario (Login, Password, Nombre, Apellidos, Email) values ('$login','$pass','$nombre','$apellidos','$email')";
	$insercion = mysql_query($InsertaUsuario) or die('error al ejecutar la insercion de usuario');
	echo 'El Login <b>' . $login . '</b> ha sido registrado en el sistema' . '<BR>';
}
// devuelve una fila por lo tanto encontro ese login
else
{
	echo 'El usuario <b>' . $login . '</b> ya existe en la bd <BR>';
	echo '<a href=\'Registro.php\'>Volver al registro</a><BR>';

}


?>
