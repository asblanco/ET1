<!--
===========================================================================
Formulario de registro. Envia la informacion por POST a ProcesarRegistro.php
Creado por: Edgard Ruiz
Fecha: 29/9/2015
============================================================================
-->

<?php

$idioma = $_GET["lang"];

if(!$idioma){
    unset($idioma);
    include "../modelo/es.php";
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
        <link rel="stylesheet" type="text/css" href="../css/form.css">
    </head>
    
    <body>
        <section class="jumbotron">
            <div class="container" align="center">
                <form id="registro" action='../controladores/ctrl_procesar_registro.php' method='POST'>
                    <label for="nombre"><?php echo $idioma["reg_usuario"]; ?></label>
                    <input id="login" type='text' name='login'><BR>
                    <label for="password"><?php echo $idioma["reg_pass"]; ?></label>
                    <input id="password" type='password' name='password'><BR>
                    <label for="nombre"><?php echo $idioma["reg_nombre"]; ?></label>
                    <input id="nombre" type='text' name='nombre'><BR>
                    <label for="apellidos"><?php echo $idioma["reg_apellidos"]; ?></label>
                    <input id="apellidos" type='text' name='apellidos'><BR>
                    <label for="email"><?php echo $idioma["reg_email"]; ?></label>
                    <input id="email" type='text' name='email'><BR>
                    <input id="submit" type='submit' onclick="cifrar()" name='accion' value=<?php echo $idioma["reg_valor"]; ?>>
                </form>
                    
                <div id="alerta-wrapper">
                    <div id="alerta"></div>
                </div>
            </div>
        </section>
            <a href="./registro.php?lang=es">ESP</a><br>       
            <a href="./registro.php?lang=en">ENG</a>		
    </body>
                    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/formulario.js"></script>
    <script src="../js/md5.js" type="text/javascript"></script> 
<script>
        function cifrar(){
            var input_pass = document.getElementById("password");
            input_pass.value = hex_md5(input_pass.value);
        }
    </script>
</html>
