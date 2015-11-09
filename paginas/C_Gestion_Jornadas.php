<?php

$accion = $_REQUEST['accion'];

switch ($accion) 
{
case 'alta':
	?>	
		<h1>Esta es la funcionalidad de alta de jornada</h1>
		<a href="C_Menu.php">Volver al menú</a>
	<?php
	include 'Administrar.php';
	break;

case 'baja':
	?>	
		<h1>Esta es la funcionalidad de baja de jornada</h1>
		<a href="C_Menu.php">Volver al menú</a>
	<?php
	include 'Administrar.php';
	break;
	
case 'modificar':
	?>	
		<h1>Esta es la funcionalidad de modificar jornada</h1>
		<a href="C_Menu.php">Volver al menú</a>
	<?php
	include 'Administrar.php';
	break;

case 'consultar':
	?>	
		<h1>Esta es la funcionalidad de consultar jornada</h1>
		<a href="C_Menu.php">Volver al menú</a>
	<?php
	include 'Administrar.php';
	break;

default:
	break;
	
}// fin del switch

?>
