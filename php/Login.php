<!--
======================================================================
Formulario de login. Envia los datos a ProcesarLogin.php
======================================================================
-->
<html>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/form.css">


	<section class="jumbotron">
		<div class="container" align="center">
		<h1>Bienvenido a la pagina de login</h1>
					<p> Introduzca su usuario y contrase&ntildea</p>
		</div>
	</section>		

	<section class="jumbotron">
		<div class="container" align="center">
					<form action='ProcesarLogin.php' method='POST'>
						<fieldset>
						  <div>
    						<label for="nombre">Login</label>
   							 <input type="text" name="login" id="login" />
  						</div>
 
 						 <div>
 						   <label for="apellidos">Password</label>
 						   <input type="text" name="pass" id="pass" />
 						 </div>
 
						</fieldset>
					

					<input type='submit' name='accion' value='validar'>

					</form>

<html>	
