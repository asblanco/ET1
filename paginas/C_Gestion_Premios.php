<?php

$accion = $_REQUEST['accion'];

switch ($accion) 
{
case '0':
	?>	
		<h1>Esta es la funcionalidad de alta de premio</h1>
		<a href="C_Menu.php">Volver al menú</a>
	<?php
	include 'Administrar.php';
	break;

case '1':
	?>	
		<h1>Esta es la funcionalidad de baja de premio</h1>
		<a href="C_Menu.php">Volver al menú</a>
	<?php
	include 'Administrar.php';
	break;
	
case '2':
	?>	
		<h1>Esta es la funcionalidad de modificar premio</h1>
		<a href="C_Menu.php">Volver al menú</a>
	<?php
	include 'Administrar.php';
	break;

case '3':
	?>	
		<h1>Esta es la funcionalidad de consultar premio</h1>
		<a href="C_Menu.php">Volver al menú</a>
	<?php
	include 'Administrar.php';
	break;

default:
	break;
	
}// fin del switch

?>
