<!--
===========================================================================
Fichero: Registro.php V1
Creado por: jrodeiro
Fecha: 29/9/2015
Formulario de registro. Envia la informacion por POST a ProcesarRegistro.php
============================================================================
-->

<form action='ProcesarRegistro.php' method='POST'>

Login : <input type='text' name='login'><BR>
Password : <input type='password' name='pass'><BR>
Nombre : <input type='text' name='nombre'><BR>
Apellidos : <input type='text' name='apellidos'><BR>
Email : <input type='text' name='email'><BR>

<input type='submit' name='accion' value='validar'>

</form>
