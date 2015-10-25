<?php

/*Mediante la clase Rol se puede gestionar todo lo relacionado a los Roles en la base de datos
Para crearlo solo es necesario indicar la base de datos*/
include_once '../modelo/connect_DB.php';

class Rol {
    private $rolName;
    private $descripcion;
    public $numRoles = 0;

    public function __construct($rolName="", $desc="") {
        $this->rolName=$rolName;
        $this->descripcion=$desc;
    }

    public function getDescripcion ($rolName){
        $db = new Database();
        
        $query = 'SELECT DescRol FROM Rol WHERE NombreRol = \'' . $rolName .  '\'';
        
        $db->desconectar();
        return $db->consulta($query);
    }
    
    public function exists ($rolName) {
        $db = new Database();
        
        //Comprueba si ya existe ese rol
        $consultaRol = 'SELECT * FROM Rol WHERE NombreRol = \'' .  $rolName .  '\'';
        $resultado = $db->consulta($consultaRol) or die('Error al ejecutar la consulta de rol');
        
        // Si el numero de filas es 0 significa que no encontro el rol
        if (mysqli_num_rows($resultado) == 0){
            $db->desconectar();
            return false;
        } else {
            echo '<p>El rol ' . $this->rolName . ' ya existe en la db</p>';
            $db->desconectar();
            return true;
        }
    }
    
    //Transformar la tabla Rol en un array asociativo
    public function arrayRoles() {
        $db = new Database();
        
        $sqlRol = $db->consulta("SELECT NombreRol, DescRol FROM Rol");
        $arrayRol = array();

        //Numero de roles 
        $this->numRoles = 0;

        while ($row_rol = mysqli_fetch_assoc($sqlRol)) {
            $arrayRol[] = $row_rol;
            $this->numRoles++;
        }
        $db->desconectar();
        
        return $arrayRol;
    }
    
        
    //Transformar la tabla Usu_Rol de un Rol especificado en un array y devolverlo
    public function arrayUsu ($nameRol){
        $db = new Database();
        
        $sqlUsu = $db->consulta('SELECT Login, NombreRol FROM Usu_Rol WHERE NombreRol = \'' . $nameRol . '\'');
        $arrayUsu = array();
        
        while ($row_usu = mysqli_fetch_assoc($sqlUsu))
            $arrayUsu[] = $row_usu;
        
        $db->desconectar();
        return $arrayUsu;
    }
    
    //Transformar la tabla Rol_Fun de un Rol especificado en un array y devolverlo
    public function arrayFunc ($nameRol){
        $db = new Database();
        
        $sqlFunc = $db->consulta('SELECT NombreRol, NombreFun FROM Rol_Fun WHERE NombreRol = \'' . $nameRol . '\'');
        $arrayFunc = array();
        
        while ($row_func = mysqli_fetch_assoc($sqlFunc))
            $arrayFunc[] = $row_func;
        
        $db->desconectar();
        return $arrayFunc;
    }
}
?>
