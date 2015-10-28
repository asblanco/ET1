<!--
======================================================================
Formulario de login. Envia los datos a ProcesarLogin.php
Creado por: 
Fecha: /10/2015
======================================================================
-->

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
	<link rel="stylesheet" type="text/css" href="css/form.css">
</head>
<body>
	<section class="jumbotron">
		<div class="container" align="center">
			<h1>LOGIN</h1>
			<p> Introduzca su usuario y contrase&ntildea</p>
		</div>
		<div class="container" align="center">
			<form id="login" action='controladores/ctrl_procesar_login.php' method='POST'>
				<label for="nombre">Usuario</label>
				<input id="login" type="text" name="login" id="login"><br>
				<label for="contraseña">Contraseña</label>
				<input id="password" type="password" name="pass" id="pass"><br>
				<input type='submit' onclick="cifrar()" name='accion' value='Aceptar'>
			</form>
			<div id="alerta-wrapper">
				<div id="alerta"></div>
			</div>
			<a href="vistas/registro.php">Registrarse</a>
		</div>
	</section>		
</body>

<script src="js/jquery.min.js"></script>
<script src="js/login.js"></script>
<script src="../js/md5.js" type="text/javascript"></script> 
<script>
		function cifrar(){
			var input_pass = document.getElementById("password");
			input_pass.value = hex_md5(input_pass.value);
		}
	</script>
<html>	