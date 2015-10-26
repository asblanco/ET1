<!--
===========================================================================
Clase Rol, permite gestionar todo lo relacionado a los Roles en la base de datos
Creado por: Andrea Sanchez Blanco
Fecha: 26/10/2015
============================================================================
-->

<?php
include_once 'interface.php';

//Clase rol con las funciones de iRol implementadas
class Rol implements iModel {
    private $rolName;
    private $descripcion;
    private $usuarios = array();
    private $funcionalidades = array();
    public $numRoles = 0;

    public function __construct($rolName="", $desc="", $usu=array(), $func=array()) {
        $this->rolName=$rolName;
        $this->descripcion=$desc;
        $this->usuarios = $usu;
        $this->funcionalidades= $func;
    }
    
    //Comprueba si existe
    public function exists ($pk) {
        $db = new Database();
        
        //Comprueba si ya existe ese rol
        $consultaRol = 'SELECT * FROM Rol WHERE NombreRol = \'' .  $pk .  '\'';
        $resultado = $db->consulta($consultaRol) or die('Error al ejecutar la consulta de rol');
        
        // Si el numero de filas es 0 significa que no encontro el rol
        if (mysqli_num_rows($resultado) == 0){
            $db->desconectar();
            return false;
        } else {
            echo '<p>El rol ' . $pk . ' ya existe en la db</p>';
            $db->desconectar();
            return true;
        }
    }
    
    //Devuelve un array asociativo de la tabla de la clase
    public function listar(){
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
    
    //Muestra los datos de la $pk indicada. Devuelve una array asociativo
    public function consultar ($pk){
        $db = new Database();
        
        $query = 'SELECT DescRol FROM Rol WHERE NombreRol = \'' . $pk .  '\'';
        $arrayDatos = array();
        
        while ($row_rol = mysqli_fetch_assoc($db->consulta($query))) {
            $arrayDatos[] = $row_rol;
        }
        
        $db->desconectar();
        return $arrayDatos();
    }
    
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objecto pasado
    public function modificar ($pk, $objeto) {
        $db = new Database();
        //Guardar los datos de $pk en la clase actual
        $datos = consultar($pk);
        $oldName = $datos['rolName'];
        $newName = $objeto->rolName;
        
        $oldDesc = $datos['descripcion'];
        $newDesc = $objeto->descripcion;
        if ($oldDesc != $newDesc){
            $sql = 'UPDATE Rol SET DescRol='. $newDesc . ' WHERE NombreRol = \'' . $oldName .  '\'' ;

            if ($db->consulta($sql) === TRUE) {
                echo "Guardado correctamente";
            } else {
                echo "Error actualizando la descripcion: " . $this->db->error;
            }
            
        }
        
        $existeNombre = exists($newName);
        if($newName != "" && $existeNombre == false){
            //Comparar los datos con $objeto y modificar los que sean necesarios
            if ($oldName != $newName){
                $sql = 'UPDATE Rol SET NombreRol=' . $newName . ' WHERE NombreRol = \'' . $oldName .  '\'';

                if ($db->consulta($sql) === TRUE) {
                    echo "Guardado correctamente";
                } else {
                    echo "Error actualizando el nombre: " . $db->error;
                }
            }
        }
        
        $db->desconectar();
    }
    
    //Crea el objeto pasado en la tabla de la base de datos
    public function crear($objeto){
        $db = new Database();
        if (exists() == false) 
        {
             //Inserta el rol en la db
             $InsertaRol = "INSERT INTO Rol (NombreRol, DescRol) VALUES ('$objeto->rolName','$objeto->descripcion')";
             $insercion = $db->consulta($InsertaRol) or die('Error al ejecutar la insercion de rol');
             echo 'El rol ' . $objeto->rolName . ' ha sido registrado en el sistema';
            //Falta insertar los usuarios y funcionalidades en sus tablas
        }
        $db->desconectar();
    }
    
    //Elimina de la base de datos segun la primary key pasada
    public function eliminar($pk){
        $db = new Database();
        $db->consulta('DELETE FROM Rol WHERE NombreRol = ' . $pk) or die('Error al eliminar el rol');
        $db->desconectar();
    }
    
    //Transformar y devuelve la tabla Usu_Rol de un Rol especificado en un array
    public function arrayA ($pk){
        $db = new Database();
        
        $sqlUsu = $db->consulta('SELECT Login, NombreRol FROM Usu_Rol WHERE NombreRol = \'' . $pk . '\'');
        $arrayUsu = array();
        
        while ($row_usu = mysqli_fetch_assoc($sqlUsu))
            $arrayUsu[] = $row_usu;
        
        $db->desconectar();
        return $arrayUsu;
    }
    
    //Transformar y devuelve la tabla Rol_Fun de un Rol especificado en un array
    public function arrayB ($pk){
        $db = new Database();
        
        $sqlFunc = $db->consulta('SELECT NombreRol, NombreFun FROM Rol_Fun WHERE NombreRol = \'' . $pk . '\'');
        $arrayFunc = array();
        
        while ($row_func = mysqli_fetch_assoc($sqlFunc))
            $arrayFunc[] = $row_func;
        
        $db->desconectar();
        return $arrayFunc;
    }
}
?>
