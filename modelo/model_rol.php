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
    
    public function __construct($rolName="", $desc="", $usu=array(), $func=array()) {
        $this->rolName=$rolName;
        $this->descripcion=$desc;
        $this->usuarios = $usu;
        $this->funcionalidades= $func;
    }
    
    private function getName ($objeto) {
        return $objeto->rolName;
    }
    
    private function getDesc ($pk){
        $db = new Database();
        
        $query = 'SELECT DescRol FROM Rol WHERE NombreRol = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $desc = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $desc;
    }
    
    //Transformar y devuelve la tabla Usu_Rol de un Rol especificado en un array
    private function getUsu ($pk){
        $db = new Database();
        
        $sqlUsu = $db->consulta('SELECT Login, NombreRol FROM Usu_Rol WHERE NombreRol = \'' . $pk . '\'');
        $arrayUsu = array();
        
        while ($row_usu = mysqli_fetch_assoc($sqlUsu))
            $arrayUsu[] = $row_usu;
        
        $db->desconectar();
        return $arrayUsu;
    }
    
    //Transformar y devuelve la tabla Rol_Fun de un Rol especificado en un array
    private function getFunc ($pk){
        $db = new Database();
        
        $sqlFunc = $db->consulta('SELECT NombreRol, NombreFun FROM Rol_Fun WHERE NombreRol = \'' . $pk . '\'');
        $arrayFunc = array();
        
        while ($row_func = mysqli_fetch_assoc($sqlFunc))
            $arrayFunc[] = $row_func;
        
        $db->desconectar();
        return $arrayFunc;
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
            $db->desconectar();
            return true;
        }
    }
    
    //Devuelve un array asociativo de la tabla de la clase, nombre y descripcion
    public function listar(){
        $db = new Database();
        
        $sqlRol = $db->consulta("SELECT NombreRol, DescRol FROM Rol");
        $arrayRol = array();
        
        while ($row_rol = mysqli_fetch_assoc($sqlRol)) {
            $arrayRol[] = $row_rol;
        }
        
        $db->desconectar();
        return $arrayRol;
    }
    
    //Devuelve un array asociativo de $pk con sus datos.
    public function consultar ($pk){
        //Obtener la descripcion
        $rolDesc = $this->getDesc($pk);
        //Obtener los usuarios
        $arrayUsu = $this->getUsu($pk);
        //Obtener las funcionalidades
        $arrayFunc = $this->getFunc($pk);
        
        //Crear array asoc con los datos de $pk
        $rol = array("rolName"=>"$pk", "descripcion"=>"$rolDesc", "usuarios"=>$arrayUsu, "funcionalidades"=>$arrayFunc);

        return $rol;
    }
    
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objecto pasado
    public function modificar ($pk, $objeto) {
        $db = new Database();
        //Array de los datos de $pk
        $modRol = $objeto->consultar($pk);
        
        $oldName = $modRol['rolName'];
        $newName = $objeto->rolName;
        $oldDesc = $modRol['descripcion'];
        $newDesc = $objeto->descripcion;
     
        $newDesc = $objeto->descripcion;
        if ($oldDesc != $newDesc){
            $sql = 'UPDATE Rol SET DescRol= \''. $newDesc . '\' WHERE NombreRol = \'' . $oldName .  '\'' ;

            $db->consulta($sql) or die('Error al modificar la descripcion');
        }
        
    //Actualizar usuarios asociados al rol
        //Array asociativo con los usuarios antes de modificar
        $arrayOldUsu = $this->getUsu($pk);
        
        //Crear el array con los usuarios modificados
        $arrayNewUsu = $objeto->usuarios;
        
        //Comparar si hay nuevos usuarios recorriendo $newUsuarios
        foreach ($arrayNewUsu as $new){
            $resultado = $db->consulta('SELECT Login FROM Usu_Rol WHERE Login = \'' . $new .  '\' AND NombreRol = \'' . $pk . '\'');
            //Si las filas es igual a 0, no existe, por lo tanto es nuevo
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('INSERT INTO Usu_Rol (Login, NombreRol) VALUES (\''. $new .'\',\''. $pk .'\')');
            }
        }
        
        //Comparar si hay usuarios a eliminar recorriendo $arrayOldUsu
        foreach ($arrayOldUsu as $old){
            //Comprobar si el usuario está en $arrayNewUsu
            $cont=0;
            foreach($arrayNewUsu as $new){
                if($new == $old['Login']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarlo
            if( $cont == 0 ){
                $db->consulta('DELETE FROM Usu_Rol WHERE Login = \'' . $old['Login'] . '\' AND NombreRol = \'' . $pk . '\'');
            }
        }
        
    //Actualizar funcionalidades asociadas al rol
        //Crear un array asociativo con las funcionalidades sin modificar
        $arrayOldFunc = $this->getFunc($pk);
        
        //Crear el array asociativo con las nuevas funcionalidades
        $arrayNewFunc = $objeto->funcionalidades;
        
        //Comparar si hay nuevas funcionalidades recorriendo $arrayNewFunc
        foreach ($arrayNewFunc as $new){
            $resultado = $db->consulta('SELECT NombreFun FROM Rol_Fun WHERE NombreFun = \'' . $new .  '\' AND NombreRol = \'' . $pk . '\'');
            //Si las filas es igual a 0, no existe, por lo tanto es nueva
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('INSERT INTO Rol_Fun (NombreRol, NombreFun) VALUES (\''. $pk .'\',\''. $new .'\')');
            }
        }
        
        //Comparar si hay funcionalidades a eliminar recorriendo $arrayOldFunc
        foreach ($arrayOldFunc as $old){
            //Comprobar si la funcionalidad está en $arrayNewFunc
            $cont=0;
            foreach($arrayNewFunc as $new){
                if($new == $old['NombreFun']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarla
            if( $cont == 0 ){
                $db->consulta('DELETE FROM Rol_Fun WHERE NombreFun = \'' . $old['NombreFun'] . '\' AND NombreRol = \'' . $pk . '\'');
            }
        }
        
        $result = true;
        
        $existeNombre = $this->exists($newName);
        //Si el nombre nuevo no esta vacio y no existe en la BD
        if(strcmp($newName, "")!== 0 && $existeNombre == false){
            $result = false;
            $sql = 'UPDATE Rol SET NombreRol= \'' . $newName . '\' WHERE Rol.NombreRol = \'' . $oldName .  '\'';
            $result = $db->consulta($sql) or trigger_error(mysqli_error()." in ".$sql);
        }
        $db->desconectar();
        
        if ($result == TRUE)
            return true;
        else return false;
    }
    
    //Crea el objeto pasado en la tabla de la base de datos, si devuelve fue bien devuelve true
    public function crear($objeto){
        $db = new Database();
        if ($objeto->exists($objeto->rolName) == false) 
        {
             //Inserta el rol en la tabla Rol
            $insertaRol = 'INSERT INTO Rol (NombreRol, DescRol) VALUES (\'' .$objeto->rolName. '\',\'' . $objeto->descripcion . '\')';
            $db->consulta($insertaRol) or die('Error al crear el rol');
            
            //Comprueba si esta relacionado con algun usuario
            if($objeto->usuarios != array()){
                foreach ($objeto->usuarios as $newUsu){
                    $queryUsu = 'INSERT INTO Usu_Rol (Login, NombreRol) VALUES (\'' . $newUsu . '\',\'' .$objeto->rolName. '\')';
                    $db->consulta($queryUsu) or die('Error al insertar los usuarios');
                }
            }
            
            //Comprueba si esta relacionado con alguna funcionalidad
            if($objeto->funcionalidades != array()){
                foreach ($objeto->funcionalidades as $newFun){
                    $queryFun = 'INSERT INTO Rol_Fun (NombreRol, NombreFun) VALUES (\'' . $objeto->rolName. '\',\'' . $newFun. '\')';
                    $db->consulta($queryFun) or die('Error al insertar las funcionalidades');
                }
            }
            return true;
        } else return false;
        
        $db->desconectar();
    }
    
    //Elimina de la base de datos segun la primary key pasada
    public function eliminar($pk){
        $db = new Database();
        $result = $db->consulta('DELETE FROM Rol WHERE NombreRol = \'' .  $pk .  '\'') or die('Error al eliminar el rol');
        $db->desconectar();
        return $result;
    }
}
?>