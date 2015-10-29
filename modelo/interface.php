<!--
===========================================================================
Interfaz del modelo de proyecto
Creado por: Andrea Sanchez Blanco
Fecha: 26/10/2015
============================================================================
-->

<?php
include_once 'connect_DB.php';

//Interfaz del modelo => funciones que las clases deben implementar
interface iModel {
    //Comprueba si existe, devuelve true si existe, o false si no
    public function exists ($pk);
    //Devuelve un array asociativo de la tabla de la clase
    public function listar();
    //Muestra los datos de la $pk indicada. Devuelve una array asociativo
    public function consultar ($pk);
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objecto pasado
    //Devuelve true si modifico correctamente
    public function modificar ($pk, $objeto);
    //Crea el objeto pasado en la tabla de la base de datos
    //Devuelve true si creo correctamente
    public function crear($objeto); 
    //Elimina de la base de datos segun la primary key pasada
    //Devuelve true si elimino correctamente
    public function eliminar($pk);  
    //Devuelve un array asociativo de la tabla de relacion con otra clase. Se debe indicar que tabla
    public function arrayA ($pk);
    //Devuelve un array asociativo de la tabla de relacion con otra clase. Se debe indicar que tabla
    public function arrayB ($pk);
}

?>