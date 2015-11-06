<!--
======================================================================
Formulario de login. Envia los datos a ProcesarLogin.php
Creado por: Edgard Ruiz, Andrea Sanchez Blanco
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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile first -->
        
        <link rel="stylesheet" type="text/css" href="../css/fonts.css"/>
        <link rel="stylesheet" type="text/css" href="../css/login.css"/>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        
        <title>Login</title> <!-- Titulo de la pestaña -->
        <link rel="shortcut icon" href="../img/gesTor_icon.png"/> <!-- Icono de la pestaña -->
    </head>
    
    <body>
        <div class="background-image"></div>
        <div class="content">
            <div class="col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 login">
                <!-- Nombre e idiomas -->
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <h1 class="opSansBFont">LOGIN</h1>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 idioma">
                        	<label for="espanol"><a href="./login.php?lang=es"><img class="ico-idioma" src="../img/ES.png"></a></label>
                        <label for="ingles"><a href="./login.php?lang=en"><img class="ico-idioma" src="../img/EN.png"></a></label>
                    </div>
                </div>
                
                <!-- Formulario -->
               <form id="login" action='../controladores/ctrl_procesar_login.php' method='POST'>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="nombre"><?php echo $idioma["usuario_login"]; ?></label>
                            <input id="login" name="login" type="text" class="form-control" placeholder="User name" required data-validation-required-message="Please enter your user name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="contraseña"><?php echo $idioma["pass_login"]; ?></label>
                            <input name="pass" id="pass" type="password" class="form-control" placeholder="Password" required data-validation-required-message="Please enter your password.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                   
                    <!-- Botones -->
                    <div class="row">
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <a href="registro.php"><button type="button" class="btn btn-default"><?php echo $idioma["registrarse"]; ?></button></a>
                        </div>
                        <div class="col-sm-1 col-md-1"></div>
                        <div class="col-xs-6 col-sm-8 col-md-8">
                            <button type="submit" class="btn-login" onclick="cifrar()" name='accion' value=<?php echo $idioma["valor_login"]; ?>>Enter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>	
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/md5.js" type="text/javascript"></script> 
    <script>
        function cifrar(){
            var input_pass = document.getElementById("pass");
            input_pass.value = hex_md5(input_pass.value);
        }
    </script>
<html>	