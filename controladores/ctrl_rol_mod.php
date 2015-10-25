<!--
===========================================================================
Controlador para modificar los datos de los roles
Creado por: Andrea Sanchez Blanco
Fecha: 25/10/2015
============================================================================
-->

<?php
    include_once '../modelo/connect_DB.php';
    include_once "../modelo/model_rol.php";

    //Conectar con la base de datos
    $db = new Database();

    //Conseguir nombre del rol de la vista
    $oldRolName;
    //Nuevo nombre del rol de la vista
    $newRolName;

    public function setRolName ($oldRolName, $newRolName) {
        $sql = 'UPDATE Rol SET NombreRol=' . $newRolName . ' WHERE NombreRol = \'' . $oldRolName .  '\'';

        if ($this->db->consulta($sql) === TRUE) {
            echo "Guardado correctamente";
        } else {
            echo "Error actualizando el nombre: " . $this->db->error;
        }
    }
    
    public function setDescripcion ($rolName, $newDescripcion) {
        $sql = 'UPDATE Rol SET DescRol='. $newDescripcion . ' WHERE NombreRol = \'' . $rolName .  '\'' ;

        if ($this->db->consulta($sql) === TRUE) {
            echo "Guardado correctamente";
        } else {
            echo "Error actualizando la descripcion: " . $this->db->error;
        }
    }

    //Desconectar de la base de datos
    $db->desconectar();
?>