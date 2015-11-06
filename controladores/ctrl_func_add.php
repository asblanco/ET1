<!--
===========================================================================
Controlador para procesar un nuevo registro
Creado por: David Ansia
Fecha: 01/11/2015
============================================================================
-->

<?php
    include '../modelo/connect_DB.php';
    include '../modelo/model_func.php';

	//Recogemos variables
    $nombre= $_POST['nombre'];
    $paginas= $_POST['Paginas'];
    $roles= $_POST['Roles'];
    $desc=$_POST['Roles'];
	

   //Conectamos con el gestor de la bd
    $db = new Database();
    $newFunc = new Funcionalidad();

    //Comprobamos si ya existe la funcionalidad
    $consultaSiFunc = $newFunc->exists($nombre);
    if ($consultaSiFunc == true){
        echo '<p>La funcionalidad ' . $nombre . ' ya existe en la bd</p>';
    } else {
        $insertFunc = new Funcionalidad ($nombre, $desc, $roles, $paginas);
        echo 'bien';
        if ($newFunc->crear($insertFunc) == true){
            echo 'La funcionalidad ' . $nombre . ' ha sido registrada en el sistema';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
 
        } else{
            echo "Error al insertar la funcionalidad";
        }
    }

?>

<!--
<script type="text/javascript">
setTimeout("window.location = '<?php echo $_SERVER['HTTP_REFERER'] ?>'", 4000);
</script>
-->
