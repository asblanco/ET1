<!--
===========================================================================
Formulario de registro. Envia la informacion por POST a ProcesarRegistro.php
Creado por: 
Fecha: 29/9/2015
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
                <form id="registro" action='../controladores/ctrl_procesar_registro.php' method='POST'>
                    <label for="nombre">Usuario</label>
                    <input id="login" type='text' name='login'><BR>
                    <label for="password">Contraseña</label>
                    <input id="password" type='password' name='password'><BR>
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type='text' name='nombre'><BR>
                    <label for="apellidos">Apellidos</label>
                    <input id="apellidos" type='text' name='apellidos'><BR>
                    <label for="email">Email</label>
                    <input id="email" type='text' name='email'><BR>
                    <input id="submit" type='submit' name='accion' value='validar'>
                </form>
                    
                <div id="alerta-wrapper">
                    <div id="alerta"></div>
                </div>
            </div>
        </section>		
    </body>
                    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/formulario.js"></script>
</html>
