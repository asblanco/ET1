<!--
===========================================================================
Clase Pagina, permite gestionar todo lo relacionado a las Paginas en la base de datos
Creado por: Edgar Conde Nóvoa
Fecha: 29/10/2015
============================================================================
-->

<?php
include_once 'interface.php';
//Clase paginas con las funciones de iModel implementadas
class Rol implements iModel {
    private $url;
    private $descripcion;
    private $usuarios = array();
    private $funcionalidad;
    public $numPags = 0;
    public function __construct($url="", $desc="", $usu=array(), $func="") {
        $this->url=$url;
        $this->descripcion=$desc;
        $this->usuarios = $usu;
        $this->funcionalidad= $func;
    }
    
    //Comprueba si existe
    public function exists ($pk) {
        $db = new Database();
        
        //Comprueba si ya existe ese rol
        $consultaPag = 'SELECT * FROM Pagina WHERE Url = \'' .  $pk .  '\'';
        $resultado = $db->consulta($consultaPag) or die('Error al ejecutar la consulta de pagina');
        
        // Si el numero de filas es 0 significa que no encontro el rol
        if (mysqli_num_rows($resultado) == 0){
            $db->desconectar();
            return false;
        } else {
            $db->desconectar();
            return true;
        }
    }
    
    //Devuelve un array asociativo de la tabla de la clase
    public function listar(){
        $db = new Database();
        
        $sqlPag = $db->consulta("SELECT Url, DescPag, NombreFun FROM Pagina");
        $arrayPag = array();
        //Numero de paginas 
        $this->numPags = 0;
        while ($row_pag = mysqli_fetch_assoc($sqlPag)) {
            $arrayPag[] = $row_pag;
            $this->numPags++;
        }
        
        $db->desconectar();
        return $arrayPag;
    }
    
    //Muestra los datos de la $pk indicada. Devuelve una array asociativo
    public function consultar ($pk){
        $db = new Database();
        
        $query = 'SELECT DescPag, NombreFun FROM Pagina WHERE Url = \'' . $pk .  '\'';
        $arrayDatos = array();
        
        while ($row_pag = mysqli_fetch_assoc($db->consulta($query))) {
            $arrayDatos[] = $row_pag;
        }
        
        $db->desconectar();
        return $arrayDatos();
    }
    
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objecto pasado
    public function modificar ($pk, $objeto) {
        $db = new Database();
        //Guardar los datos de $pk
        $datos = consultar($pk);
        $oldUrl = $datos['url'];
        $newUrl = $objeto->url;
        
        $oldDesc = $datos['descripcion'];
        $newDesc = $objeto->descripcion;
        if ($oldDesc != $newDesc){
            $sql = 'UPDATE Pagina SET DescPag='. $newDesc . ' WHERE Url = \'' . $oldUrl .  '\'' ;

            $db->consulta($sql) or die('Error al modificar la descripcion');
        }
        
    //Actualizar usuarios asociados a la pagina
        //Crear un array asociativo con los usuarios sin modificar
        $sqlOldUsu = $db->consulta('SELECT Login FROM Usu_Pag WHERE Url = \'' . $pk .  '\'');
        $arrayOldUsu = array();
        while ($row_usu = mysqli_fetch_assoc($sqlOldUsu))
            $arrayOldUsu[] = $row_usu;
        
        //Crear el array asociativo con los nuevos usuarios
        $arrayNewUsu = $objeto->usuarios;
        
        //Comparar si hay nuevos usuarios recorriendo $newUsuarios
        foreach ($arrayNewUsu as $new){
            $resultado = $db->consulta('SELECT Login FROM Usu_Pag WHERE Login = \'' . $new['Login'] .  '\'');
            //Si las filas es igual a 0, no existe, por lo tanto es nuevo
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('INSERT INTO Usu_Pag (Login, NombrePag) VALUES ('.$new['Login'].','.$objeto->url.')');
            }
        }
        
        //Comparar si hay usuarios a eliminar recorriendo $arrayOldUsu
        foreach ($arrayOldUsu as $old){
            //Comprobar si el usuario está en $arrayNewUsu
            $cont=0;
            foreach($arrayNewUsu as $new){
                if($new['Login'] == $old['Login']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarlo
            if( $cont == 0 ){
                $db->consulta('DELETE FROM Usu_Pag WHERE Login = \'' . $old['Login'] . '\' AND Url = \'' . $pk . '\'');
            }
        }
        
    //Actualizar funcionalidades asociadas a la pagina
        //Crear una variable con la funcionalidad sin modificar
        $OldFunc = $db->consulta('SELECT NombreFun FROM Pagina WHERE Url = \'' . $pk .  '\'');
        
        
        //Crear variable con la nueva funcionalidad
        $NewFunc = $objeto->funcionalidad;
        
        //Comparar si hay nueva funcionalidad comparando $NewFunc y $OldFunc
        if ($NewFunc != $OldFunc){
            $db->consulta('UPDATE Pagina SET NombreFun=' . $newFunc . ' WHERE Url = \'' . $pk .  '\'');
        }
        
        //Comparar si hay funcionalidad a eliminar 
        if ($newFunc==NULL){
            $db->consulta('DELETE FROM Pagina WHERE Url = \'' . $pk .  '\'');
        }
           
        
        
        $existeUrl = exists($newUrl);
        if($newUrl != "" && $existeUrl == false){
            //Comparar los datos con $objeto y modificar los que sean necesarios
            if ($oldName != $newName){
                $sql = 'UPDATE Pagina SET Url=' . $newUrl . ' WHERE Url = \'' . $oldUrl .  '\'';

                $result = $db->consulta($sql);
            }
        }
        
        if ($result === TRUE)
            return true;
        else return false;
        
        $db->desconectar();
    }
    
    //Crea el objeto pasado en la tabla de la base de datos, si fue bien devuelve true
    public function crear($objeto){
        $db = new Database();
        if (exists($objeto->url) == false) 
        {
             //Inserta esa pagina en la tabla Pagina
            $insertaPag = "INSERT INTO Pagina (Url, DescPag) VALUES ('$objeto->url','$objeto->descripcion')";
            $db->consulta($InsertaPag) or die('Error al crear la pagina');
            
            //Comprueba si esta relacionada con algun usuario
            if($objeto->usuarios != array()){
                foreach ($objeto->$arrayA as $newUsu){
                    $queryUsu = 'INSERT INTO Usu_Pag (Login, Url) VALUES ('.$newUsu['Login'].','.$objeto->url.')';
                    $db->consulta($queryUsu) or die('Error al insertar los usuarios');
                }
            }
            
            //Comprueba si esta relacionada con alguna funcionalidad
            if($objeto->$arrayB != array()){
                foreach ($objeto->$arrayB as $newFun){
                    $queryFun = 'INSERT INTO Pagina (NombreFun) VALUES ('.$newFun['NombreFun'].') WHERE Url ='.$objeto->rolName.'';
                    $db->consulta($queryFun) or die('Error al insertar la funcionalidad');
                }
            }     
        } else return false;
        
        $db->desconectar();
    }
    
    //Elimina de la base de datos segun la primary key pasada
    public function eliminar($pk){
        $db = new Database();
        $db->consulta('DELETE FROM Pagina WHERE Url = ' . $pk) or die('Error al eliminar la pagina');
        $db->desconectar();
    }
    
    //Transformar y devuelve la tabla Usu_Pag de una Pagina especificada en un array
    public function arrayA ($pk){
        $db = new Database();
        
        $sqlUsu = $db->consulta('SELECT Login, Url FROM Usu_Pag WHERE Url = \'' . $pk . '\'');
        $arrayUsu = array();
        
        while ($row_usu = mysqli_fetch_assoc($sqlUsu))
            $arrayUsu[] = $row_usu;
        
        $db->desconectar();
        return $arrayUsu;
    }
    
    //Transforma y devuelve la Funcionalidad de una Pagina especificada en un array
    public function arrayB ($pk){
        $db = new Database();
        
        $sqlFunc = $db->consulta('SELECT Url, NombreFun FROM Pagina WHERE Url = \'' . $pk . '\'');
        $arrayFunc = array();
        
        while ($row_func = mysqli_fetch_assoc($sqlFunc))
            $arrayFunc[] = $row_func;
        
        $db->desconectar();
        return $arrayFunc;
    }
}
?>