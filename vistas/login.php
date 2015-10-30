<!--
======================================================================
Formulario de login. Envia los datos a ProcesarLogin.php
Creado por: Edgard Ruiz 
Fecha: /10/2015
======================================================================
-->

<?php

$idioma = $_GET["lang"];
   
if(!$idioma){
    unset($idioma);
    header('Location:../vistas/login.php?lang=es');
}else{
    if($idioma == "es"){
        unset($idioma);
        include "../modelo/es.php";
    }else{
        if($idioma == "en"){
            unset($idioma);
            include "../modelo/en.php";
        }else{
            unset($idioma);
            include "../modelo/es.php";
        }
    }
}


?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="../css/form.css"/>
</head>
<body>
	<section class="jumbotron">
		<div class="container" align="center">
			<h1>LOGIN</h1>
			<p> <?php echo $idioma["intro_login_pass"]; ?></p>
		</div>
		<div class="container" align="center">
			<form id="login" action='../controladores/ctrl_procesar_login.php' method='POST'>
				<label for="nombre"><?php echo $idioma["usuario_login"]; ?></label>
				<input id="login" type="text" name="login" id="login"><br>
				<label for="contraseña"><?php echo $idioma["pass_login"]; ?></label>
				<input id="password" type="password" name="pass" id="pass"><br>
				<input type='submit' onclick="cifrar()" name='accion' value=<?php echo $idioma["valor_login"]; ?>>
			</form>
			<div id="alerta-wrapper">
				<div id="alerta"></div>
			</div>
			<a href="./registro.php"><?php echo $idioma["registrarse"]; ?></a>
		</div>
	</section>
	<a href="./login.php?lang=es"><img src="../img/espana_icon.png"></a><br>		
	<a href="./login.php?lang=en"><img src="../img/uk_icon.png"></a>		
</body>	

<script src="../js/jquery.min.js"></script>
<script src="../js/login.js"></script>
<script src="../js/md5.js" type="text/javascript"></script> 
<script>
		function cifrar(){
			var input_pass = document.getElementById("password");
			input_pass.value = hex_md5(input_pass.value);
		}
	</script>
<html>	