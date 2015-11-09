<?php
include_once 'interface.php';

class Funcionalidad implements iModel {
    
    private $funName;
    private $descripcion;
    public $numFun = 0;

    public function __construct($funName="", $desc="") {
        $this->funName=$funName;
        $this->descripcion=$desc;
    }
    
    
    private function getDesc ($pk){
        $db = new Database();
        
        $query = 'SELECT DescFun FROM Funcionalidad WHERE NombreFun = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $desc = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $desc;
    }
    
    private function getRoles ($pk){
        $db = new Database();
        
        $sqlRol = $db->consulta('SELECT NombreRol, NombreFun FROM Rol_Fun WHERE NombreFun = \'' . $pk . '\'');
        $arrayRol = array();
        
        while ($row_rol = mysqli_fetch_assoc($sqlRol))
            $arrayRol[] = $row_rol;
        
        $db->desconectar();
        return $arrayRol;
    }
    
    //Transformar y devuelve la tabla Pagina de una Funcionalidad especificada en un array
    private function getPaginas ($pk){
        $db = new Database();
        
        $sqlPag = $db->consulta('SELECT Url FROM Pagina WHERE NombreFun = \'' . $pk . '\'');
        $arrayPag = array();
        
        while ($row_Pag = mysqli_fetch_assoc($sqlPag))
            $arrayPag[] = $row_Pag;
        
        $db->desconectar();
        return $arrayPag;
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
            $arrayFun[] = $row_fun;
            $this->numFun++;
        }
        
        $db->desconectar();
        return $arrayFun;
    }
    
    //Muestra los datos de la $pk indicada. Devuelve una array asociativo
    public function consultar ($pk){        
        //Obtener la descripcion
        $funDesc = $this->getDesc($pk);
        //Obtener los roles
        $arrayRol = $this->getRoles($pk);
        //Obtener las paginas
        $arrayPag = $this->getPaginas($pk);
        
        //Crear array asoc con los datos de $pk
        $func = array("funName"=>"$pk", "descripcion"=>"$funDesc", "roles"=>$arrayRol, "paginas"=>$arrayPag);

        return $func;
    }
    
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objecto pasado
    public function modificar ($pk, $objeto) {
        $db = new Database();
        //Array con los datos de $pk
        $datos = $this->consultar($pk);
        $oldName = $datos['funName'];
        $newName = $objeto->funName;
        
        $oldDesc = $datos['descripcion'];
        $newDesc = $objeto->descripcion;
        if ($oldDesc != $newDesc){
            $sql = 'UPDATE Funcionalidad SET DescFun=\''. $newDesc . '\' WHERE NombreFun = \'' . $oldName .  '\'' ;

            $db->consulta($sql) or die('Error al modificar la descripcion'); 
        }
        
        
        $existeNombre = $this->exists($newName);
        if($newName != "" && $existeNombre == false){
            //Comparar los datos con $objeto y modificar los que sean necesarios
            if ($oldName != $newName){
                $sql = 'UPDATE Funcionalidad SET NombreFun=\'' . $newName . '\' WHERE NombreFun = \'' . $oldName .  '\'';

                if ($db->consulta($sql) === TRUE) {
                    echo "Guardado correctamente";
                    return true;
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
        if ($objeto->exists($objeto->funName) == false) 
        {
            //Inserta la funcionalidad en la db
            $InsertaFun = "INSERT INTO Funcionalidad (NombreFun, DescFun) VALUES ('$objeto->funName','$objeto->descripcion')";
            $db->consulta($InsertaFun) or die('Error al crear la funcionalidad');
            
            //Comprueba si esta relacionada con algun rol
            if($objeto->roles != array()){
                foreach ($objeto->$arrayA as $newRol){
                    $queryRol = 'INSERT INTO Rol_Fun (NombreRol, NombreFun) VALUES ('.$newRol['NombreRol'].','.$objeto->funName.')';
                    $db->consulta($queryRol) or die('Error al insertar los roles');
                }
            }
            
            //Comprueba si esta relacionada con alguna página
            if($objeto->$arrayB != array()){
                foreach ($objeto->$arrayB as $newPag){
                    $queryPag = 'INSERT INTO Pagina (NombreFun) VALUES ('.$objeto->funName.') WHERE Url='.$newPag['Url'] ;
                    $db->consulta($queryPag) or die('Error al insertar las funcionalidades');
                }
            }     
            return true;
        } else return false;
        
        $db->desconectar();
        
    }
    
    //Elimina de la base de datos segun la primary key pasada
    public function eliminar($pk){
        $db = new Database();
        $db->consulta('DELETE FROM Funcionalidad WHERE NombreFun = \'' .  $pk .  '\'') or die('Error al eliminar la funcionalidad');
        $db->desconectar();
    }
}
?>
