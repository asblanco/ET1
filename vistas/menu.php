<!--Importar las cabeceras y la barra de navegacion-->
<?php include('../html/navBar.html'); ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <div class="content">
            <div class="boton" id="usuarios"><a href="vista_usu.php">Usuarios</a></div>
            <div class="boton" id="páginas"><a href="vista_pag.php">Paginas </a></div>
            <div class="boton" id="roles"><a href="vista_rol.php"> Roles</a></div>
            <div class="boton" id="funcionalidades"><a href="vista_func.php">Funcionalidades</a></div>
        </div>
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>