<?php

class Rol {
    private $_db;
    private $rolName;
    private $descripcion;

    public function __construct($rolName, $desc=null, $db) {
        $this->rolName=$rolName;
        $this->descripcion=$desc;
        $this->_db = $db;
    }

    public function getDescripcion (){
        $query = "SELECT DescRol FROM Rol WHERE NombreRol = '$this->rolName'";
        return $this->_db->consulta($query);
    }
    
    public function setRolName ($newRolName) {
        $sql = "UPDATE Rol SET NombreRol='$newRolName' WHERE NombreRol = $this->rolName";

        if ($_bd->consulta($sql) === TRUE) {
            echo "Guardado correctamente";
        } else {
            echo "Error actualizando el nombre: " . $this->_bd->error;
        }
    }
    
    public function setDescripcion ($newDescripcion) {
        $sql = "UPDATE Rol SET DescRol='$newDescripcion' WHERE NombreRol = $this->rolName";

        if ($this->_bd->consulta($sql) === TRUE) {
            echo "Guardado correctamente";
        } else {
            echo "Error actualizando la descripcion: " . $this->_bd->error;
        }
    }
    
    public function exists () {
        //Comprueba si ya existe ese rol
        $consultaRol = "SELECT * FROM Rol WHERE NombreRol = '$this->rolName'";
        $resultado = $this->_db->consulta($consultaRol) or die('Error al ejecutar la consulta de rol');
        
        // Si el numero de filas es 0 significa que no encontro el rol
        if (mysqli_num_rows($resultado) == 0){
            return false;
        } else {
            echo '<p>El rol ' . $this->rolName . ' ya existe en la bd</p>';
            return true;
        }
    }
    
    public function newRol () {
        
        if (exists() == false) 
        {
             // inserta el rol en la bd
             $InsertaRol = "INSERT INTO Rol (NombreRol, DescRol) VALUES ('$this->rolName','$this->desc')";
             $insercion = $this->_db->consulta($InsertaRol) or die('Error al ejecutar la insercion de rol');
             echo 'El rol ' . $this->rolName . ' ha sido registrado en el sistema';
        }
    }
    
    public function deleteRol(){
        $this->_db->consulta('DELETE FROM Rol WHERE NombreRol = ' . $this->rolName);
    }
}
?>
