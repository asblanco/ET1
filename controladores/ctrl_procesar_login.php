<?php
//========================================================================================
//Recoge login y password del formulario de login Login.php. Accede a la bd y comprueba si
//el login existe, si no existe informa. Despues comprueba si la password coincide, si no coincide informa.
//Si el login existe y la password coincide redirige a Menu.php
//----------------------------------------------------------------------------------------
//Se utiliza una libreria de funciones FuncionesComunes.php para la funcion de conexion a la bd
//========================================================================================

//incluimos las funciones comunes para tener la conexion a la bd
include '../modelo/connect_DB.php';

//Recogemos las variables que vienen por POST desde el formulario
$login= $_POST['login'];
$pass= $_POST['pass'];

//Conectar con la bd
$db = new Database();

$ExisteLogin = 'SELECT * FROM Usuario WHERE Login = \''. $login . '\'';
$ResultadoExisteLogin = $db->consulta($ExisteLogin) or die('No se puede comprobar si existe login');

if (mysqli_num_rows($ResultadoExisteLogin)==1)
{
	//si existe el login
	//sacamos la fila de usuario del recordset
	$TuplaLogin = mysqli_fetch_array($ResultadoExisteLogin);
	//comprobamos si el atributo PASSWORD coincide con lo introducido por el usuario como password para ese login
	echo $pass;
	if ($TuplaLogin['Password'] == $pass)
	{
		header('Location:../vistas/menu.php');
	}
	else
	//la pass introducida por el usuario no es correcta para ese login
	{
		echo 'Error al introducir la password para ese login';
		echo "<a href='../index.php'>Volver al login</a>";
	}	
}
//si es incorrecta
else
{
	echo 'Error, no existe ese login';
	echo "<a href='../index.php'>Volver al login</a>";
}

?>
