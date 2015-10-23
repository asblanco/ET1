<?php
//=================================================================================
//Fichero:FuncionesComunes.php V2
//Creado por: jrodeiro
//Fecha: 29/9/2015
//Funciones generales del proyecto AccessSkeleton 
//=================================================================================

//---------------------------------------------------------------------------------
//Funcion: ConectarBD()
//Creado por: jrodeiro
//Fecha: 29/9/2015
//Establece conexion con el gestor de bd, si no es posible informa y devuelve 0.
//A continuacion selecciona la bd, si no es posible informa y devuelve 0.
//---------------------------------------------------------------------------------
function ConectarBD()
{
	if (!(mysql_connect('localhost','root','iu')))
	{
		echo 'No es posible conectar al gestor de bd';
		return 0;
	}
	if (!(mysql_select_db('BD_ET1_G5')))
	{
		echo 'No es posible seleccionar la bd';
		return 0;
	}
}





