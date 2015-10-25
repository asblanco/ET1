<?php
//Clase : Usuario
//Creado el : 22/10/2015
//Base De Dato: DB_ET1_G5
//Administrador: admin
//Contraseña: admin

//-------------------------------------------------------

class Usuario
{

//atributo login : guarda el login del usuario
var $login;

//atributo PASS : guarda la PASS del usuario
var $pass;

//atributo Nombre : guarda el nombre del usuario
var $nombre;

//atributo apellidos : guarda los apellidos del usuario
var $apellidos;


//atributo email: el email del usuario
var $email;


/* atributo tipo_usuario
var $Tipo_Usuario;
*/

//Constructor de la clase
//parametros: el dni, el nombre y los apellidos
function __construct($login, $pass, $nombre, $apellidos, $email, /*$Tipo_Usuario*/)
{
    $this->login			= $login;
	$this->pass				= $pass;
    $this->nombre 			= $nombre;
    $this->apellidos 		= $apellidos;
	$this->email	= $email;
	//$this->Tipo_Usuario 			= $Tipo_Usuario;
}

//Metodo (invocable estático) que conecta contra la BD y la tabla Usuario
function ConectarDB()
{
	//nombres base de datos
    mysql_connect("localhost","admin","admin") or die("Error de conexión a la BD");
    mysql_select_db("DB_ET1_G5") or die("Error de selección de la BD");
}

//Metodo Alta Usuario
function Alta_Usuario()
{
    $this->ConectarDB();

        $sql = "select * from Usuario where login = '".$this->login."'";

        $resultado = mysql_query($sql) or die(mysql_error());
        if (mysql_num_rows($resultado) == 0)
        {
           $sql = "INSERT INTO Usuario(login,pass,nombre,apellidos,email,/*Tipo_Usuario*/) VALUES ('".$this->login."','".$this->pass."','".$this->nombre."','".$this->apellidos."','".$this->email."')";
           mysql_query($sql);
		   header('location: /index.php');
        }
        else
		{
			header('Location: /error_registro.html');
		}
}

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{

}

//funcion Consultar: hace una búsqueda en la tabla Usuario con
//los datos del Usuario Si van vacios devuelve todos
function Consultar_Usuario($login,$pass,$nombre,$apellidos,$email /*$Tipo_Usuario*/)
{
    $this->ConectarDB();
    $sql = "select * from Usuario where (login LIKE '%".$Login_Usuario."%') AND (nombre LIKE '%".$nombre."%') AND (apellidos LIKE '%".$apellidos."%') AND (email LIKE '%".$email."%')";
    $resultado = mysql_query($sql);
	
    
	// llamada metodo mostrar usuario
	$this->Mostrar_Usuario($resultado);
}

//Presenta en pantalla los datos que se le pasan en un recordset
function Mostrar_Usuario($result)
{
    echo "login"."------"."nombre"."------"."apellidos"."------"."email"."<br>";
    while ($Usuario = mysql_fetch_array($result))
    {
    echo $Usuario['login'];
    echo "-------".$Usuario['nombre'];
    echo "-------".$Usuario['apellidos'];
	echo "-------".$Usuario['email'];
	//echo "-------".$Usuario['Tipo_Usuario'];
    echo "<br>";
    }
}

function Baja_Usuario()
{

    $this->ConectarDB();
    $sql = "select * from Usuario where login = '".$this->login."'";
    $resultado = mysql_query($sql);
    if (mysql_num_rows($resultado) == 1)
    {
        $sql = "delete from Usuario where login = '".$this->login."'";
        mysql_query($sql);
    echo "<br>El Login_Usuario con LOGIN = '".$this->login."' fue borrado correctamente.<br>";
    }
    else
        echo "<br>O '".$this->login."' no existe.<br>";
}

function RellenaDatos()
{
    $this->ConectarDB();
    $sql = "select * from Usuario where login = '".$this->login."'";
    $resultado = mysql_query($sql);
    $Usuario = mysql_fetch_array($resultado);
	
    $this->login			= $login;
	$this->pass				= $pass;
    $this->nombre 			= $nombre;
    $this->apellidos 		= $apellidos;
	$this->email	= $email;

}

function Modificar_Usuario()
{
    $this->ConectarDB();
    $sql = "select * from Usuario where login = '".$this->login."'";
    $resultado = mysql_query($sql);
    if (mysql_num_rows($resultado) == 1)
    {
        $sql = "UPDATE Usuario SET pass = '".$this->nombre."',nombre = '".$this->_apellidos."',apellidos = '".$this->email."',email ='"."' WHERE login = '".$this->login."'";
        echo $sql;
        mysql_query($sql);
    }
    else
    echo "<br>El login '".$this->login."' no existe<br>";
}

function Login_Usuario()
{
$this->ConectarDB();
        $sql = "select * from Usuario where login = '".$this->login."'";

        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 0)
		{
			header('location: /Error_Login.html');
        }
		else
		{
					$sql = "select * from Usuario where login = '".$this->login."'";
					$resultado = mysql_query($sql);
					$res = mysql_fetch_array($resultado);
					if( "".$this->pass."" == $res['pass'])
					{
						/*if ( $res['Tipo_Usuario'] == 0)
						{*/

						header('location: /menu.php');
						}
						/*else
						{
						
							header('location: /index.php');
						}
					}*/
					else
					{
						header('location: /Error_Login.html');									
					}	
					
		}	
    
}//fin funcion

}//fin de clase

?>