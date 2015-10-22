<!--
===========================================================================
Fichero: Registro.php V1
Creado por: jrodeiro
Fecha: 29/9/2015
Formulario de registro. Envia la informacion por POST a ProcesarRegistro.php
============================================================================
-->

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
	<link rel="stylesheet" type="text/css" href="../css/form.css">
</head>
<body>
	<section class="jumbotron">
		<div class="container" align="center">
			<form action='ProcesarRegistro.php' method='POST'>
				<label for="nombre">Usuario</label>
				<input type='text' name='login'><BR>
				<label for="apellidos">Contraseña</label>
				<input type='password' name='pass'><BR>
				<label for="apellidos">Nombre</label>
				<input type='text' name='nombre'><BR>
				<label for="apellidos">Apellidos</label>
				<input type='text' name='apellidos'><BR>
				<label for="apellidos">Email</label>
				<input type='text' name='email'><BR>
				<input type='submit' name='accion' value='validar'>
			</div>
		</section>		
	</form>
</body>
<html>	
