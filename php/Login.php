<!--
======================================================================
Formulario de login. Envia los datos a ProcesarLogin.php
======================================================================
-->
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
	<link rel="stylesheet" type="text/css" href="../css/form.css">
</head>
<body>
	<section class="jumbotron">
		<div class="container" align="center">
			<h1>LOGIN</h1>
			<p> Introduzca su usuario y contrase&ntildea</p>
		</div>
		<div class="container" align="center">
			<form action='ProcesarLogin.php' method='POST'>
				<label for="nombre">Usuario</label>
				<input type="text" name="login" id="login"><br>
				<label for="apellidos">Contraseña</label>
				<input type="text" name="pass" id="pass"><br>
				<input type='submit' name='accion' value='Aceptar'>
			</form>
			<a href="Registro.php">Registrarse</a>
		</div>
	</section>		
</body>
<html>	
