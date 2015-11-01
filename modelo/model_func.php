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
            $arrayFun[] = $row_fun;
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
        return $arrayDatos;
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

        //Actualizar páginas con esa funcionalidad
        //Crear un array asociativo con las páginas sin modificar
        $sqlOldPag = $db->consulta('SELECT Url FROM Pagina WHERE NombreFun = \'' . $pk .  '\'');
        $arrayOldPag = array();
        while ($row_pag = mysqli_fetch_assoc($sqlOldPag))
            $arrayOldPag[] = $row_pag;
        
        //Crear el array asociativo con las nuevas páginas
        $arrayNewPag = $objeto->paginas;
        
        //Comparar si hay nuevas paginas recorriendo $arrayNewPag
        foreach ($arrayNewPag as $new){
            $resultado = $db->consulta('SELECT Url FROM Pagina WHERE Url = \'' . $new['Url'] .  '\'');
            //Si las filas es igual a 0, no existe, por lo tanto hay que actualizar la pagina
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('UPDATE Pagina SET NombreFun='.$objeto->nombreFun.'WHERE Url= \''.$new['Url']. '\'');
            }
        }
        
        //Comparar si hay paginas a eliminar recorriendo $arrayOldPag
        foreach ($arrayOldPag as $old){
            //Comprobar si el usuario está en $arrayNewUsu
            $cont=0;
            foreach($arrayNewPag as $new){
                if($new['Url'] == $old['Url']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarlo
            if( $cont == 0 ){
                $db->consulta('DELETE NombreFun FROM Pagina WHERE Url = \'' . $old['Url'] . '\'');
            }
        }
        
        //Actualizar roles con esa funcionalidad
        //Crear un array asociativo con los roles sin modificar
        $sqlOldRol = $db->consulta('SELECT NombreRol FROM Rol WHERE NombreFun = \'' . $pk .  '\'');
        $arrayOldRol = array();
        while ($row_rol = mysqli_fetch_assoc($sqlOldRol))
            $arrayOldRol[] = $row_rol;
        
        //Crear el array asociativo con los nuevos roles
        $arrayNewRol = $objeto->roles;
        
        //Comparar si hay nuevos roles recorriendo $arrayNewRol
        foreach ($arrayNewRol as $new){
            $resultado = $db->consulta('SELECT NombreRol FROM Rol WHERE NombreRol = \'' . $new['NombreRol'] .  '\'');
            //Si las filas es igual a 0, no existe, por lo tanto es nuevo
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('INSERT INTO Rol_Fun(NombreRol,NombreFun) VALUES ('.$objeto->rolName.','.$new['NombreFun'].')');
            }
        }
        
        //Comparar si hay roles a eliminar recorriendo $arrayOldRol
        foreach ($arrayOldPag as $old){
            //Comprobar si el rol está en $arrayNewRol
            $cont=0;
            foreach($arrayNewRol as $new){
                if($new['NombreRol'] == $old['NombreRol']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarlo
            if( $cont == 0 ){
                $db->consulta('DELETE FROM Rol_Fun WHERE NombreFun='.$objeto->NombreFun.'AND NombreRol = \'' . $old['NombreRol'] . '\'');
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
    
    //Transformar y devuelve la tabla Rol_Fun de una funcionalidad especificada en un array
    public function arrayA ($pk){
        $db = new Database();
        
        $sqlRol = $db->consulta('SELECT NombreRol, NombreFun FROM Rol_Fun WHERE NombreFun = \'' . $pk . '\'');
        $arrayRol = array();
        
        while ($row_rol = mysqli_fetch_assoc($sqlRol))
            $arrayRol[] = $row_rol;
        
        $db->desconectar();
        return $arrayRol;
    }
    
    //Transformar y devuelve la tabla Pagina de una Funcionalidad especificada en un array
    public function arrayB ($pk){
        $db = new Database();
        
        $sqlPag = $db->consulta('SELECT Url FROM Pagina WHERE NombreFun = \'' . $pk . '\'');
        $arrayPag = array();
        
        while ($row_Pag = mysqli_fetch_assoc($sqlPag))
            $arrayPag[] = $row_Pag;
        
        $db->desconectar();
        return $arrayPag;
    }
}
?>