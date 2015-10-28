<?php
include_once 'interface.php';

class Funcionalidad implements iModel {
    
    private $funName;
    private $descripcion;
    private $roles = array();
    private $paginas = array();
    public $numFun = 0;

    public function __construct($funName="", $desc="", $rol=array(), $pag=array()) {
        $this->funName=$funName;
        $this->descripcion=$desc;
        $this->roles = $rol;
        $this->paginas= $pag;
    }
    
    //Comprueba si existe
    public function exists ($pk) {
        $db = new Database();
        
        //Comprueba si ya existe esa funcionalidad
        $consultaFun = 'SELECT * FROM Funcionalidad WHERE NombreFun = \'' .  $pk .  '\'';
        $resultado = $db->consulta($consultaFun) or die('Error al ejecutar la consulta de funcionalidad');
        
        // Si el numero de filas es 0 significa que no encontro el funcionalidad
        if (mysqli_num_rows($resultado) == 0){
            $db->desconectar();
            return false;
        } else {
            echo '<p> La funcionalidad ' . $pk . ' ya existe en la db</p>';
            $db->desconectar();
            return true;
        }
    }
    
    //Devuelve un array asociativo de la tabla de la clase
    public function listar(){
        $db = new Database();
        
        $sqlFun = $db->consulta("SELECT NombreFun, DescFun FROM Funcionalidad");
        $arrayFun = array();

        //Numero de funcionalidades 
        $this->numFun = 0;

        while ($row_fun = mysqli_fetch_assoc($sqlFun)) {
            $arrayFun[] = $row_Fun;
            $this->numFun++;
        }
        
        $db->desconectar();
        return $arrayFun;
    }
    
    //Muestra los datos de la $pk indicada. Devuelve una array asociativo
    public function consultar ($pk){
        $db = new Database();
        
        $query = 'SELECT DescFun FROM Funcionalidad WHERE NombreFun = \'' . $pk .  '\'';
        $arrayDatos = array();
        
        while ($row_fun = mysqli_fetch_assoc($db->consulta($query))) {
            $arrayDatos[] = $row_fun;
        }
        
        $db->desconectar();
        return $arrayDatos();
    }
    
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objecto pasado
    public function modificar ($pk, $objeto) {
        $db = new Database();
        //Guardar los datos de $pk en la clase actual
        $datos = consultar($pk);
        $oldName = $datos['funName'];
        $newName = $objeto->funName;
        
        $oldDesc = $datos['descripcion'];
        $newDesc = $objeto->descripcion;
        if ($oldDesc != $newDesc){
            $sql = 'UPDATE Funcionalidad SET DescFun='. $newDesc . ' WHERE NombreFun = \'' . $oldName .  '\'' ;

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
                $sql = 'UPDATE Funcionalidad SET NombreFun=' . $newName . ' WHERE NombreFun = \'' . $oldName .  '\'';

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
             //Inserta la funcionalidad en la db
             $InsertaFun = "INSERT INTO Funcionalidad (NombreFun, DescFun) VALUES ('$objeto->funName','$objeto->descripcion')";
             $insercion = $db->consulta($InsertaFun) or die('Error al ejecutar la insercion de funcionalidad');
             echo 'La funcionalidad ' . $objeto->funName . ' ha sido registrado en el sistema';
            
        }
        $db->desconectar();
    }
    
    //Elimina de la base de datos segun la primary key pasada
    public function eliminar($pk){
        $db = new Database();
        $db->consulta('DELETE FROM Funcionalidad WHERE NombreFun = ' . $pk) or die('Error al eliminar la funcionalidad');
        $db->desconectar();
    }
    
    //Transformar y devuelve la tabla Rol_Fun de una funcionalidad especificada en un array
    public function arrayA ($pk){
        $db = new Database();
        
        $sqlRol = $db->consulta('SELECT Rol, NombreFun FROM Rol_Fun WHERE NombreFun = \'' . $pk . '\'');
        $arrayRol = array();
        
        while ($row_Rol = mysqli_fetch_assoc($sqlRol))
            $arrayRol[] = $row_Rol;
        
        $db->desconectar();
        return $arrayRol;
    }
    
    //Transformar y devuelve la tabla Pagina de una Funcionalidad especificada en un array
    public function arrayB ($pk){
        $db = new Database();
        
        $sqlPag = $db->consulta('SELECT NombrePag FROM Pagina WHERE NombreFun = \'' . $pk . '\'');
        $arrayPag = array();
        
        while ($row_Pag = mysqli_fetch_assoc($sqlPag))
            $arrayPag[] = $row_Pag;
        
        $db->desconectar();
        return $arrayPag;
    }
}
?>