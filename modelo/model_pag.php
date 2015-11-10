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
class Pagina implements iModel {
    private $url;
    private $nombrePag;
    private $descripcion;
    private $usuarios = array();
    private $funcionalidad;
    
    public function __construct($url="",$nombrePag="", $desc="", $usu=array(), $func="") {
        $this->url=$url;
        $this->nombrePag = $nombrePag;
        $this->descripcion = $desc;
        $this->usuarios = $usu;
        $this->funcionalidad= $func;
    }
    
    private function getDesc ($pk){
        $db = new Database();
        
        $query = 'SELECT DescPag FROM Pagina WHERE Url = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $desc = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $desc;
    }
    
    private function getNombrePag ($pk){
        $db = new Database();
        
        $query = 'SELECT NombrePag FROM Pagina WHERE Url = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $desc = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $desc;
    }
    
    //Array de usuarios
    private function getUsuarios ($pk){
        $db = new Database();
        
        $sqlUsu = $db->consulta('SELECT Login, Url FROM Usu_Pag WHERE Url = \'' . $pk . '\'');
        $arrayUsu = array();
        
        while ($row_usu = mysqli_fetch_assoc($sqlUsu))
            $arrayUsu[] = $row_usu;
        
        $db->desconectar();
        return $arrayUsu;
    }
    
    //La funcionalidad de la pagina
    private function getFunc ($pk){
        $db = new Database();
        
        $query = 'SELECT NombreFun FROM Pagina WHERE Url = \'' . $pk . '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $func = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $func;
    }
    
    //Devuelve la Url segun el nombre de pagina pasado
    public function getUrl($nPag){
        $db = new Database();
        
        $query = 'SELECT Url FROM Pagina WHERE NombrePag = \'' .  $nPag .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $url = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        return $url;
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
        
        $sqlPag = $db->consulta("SELECT Url, NombrePag, DescPag, NombreFun FROM Pagina");
        $arrayPag = array();
        
        while ($row_pag = mysqli_fetch_assoc($sqlPag)) {
            $arrayPag[] = $row_pag;
        }
        
        $db->desconectar();
        return $arrayPag;
    }
    
    //Muestra los datos de la $pk indicada. Devuelve una array asociativo
    public function consultar ($pk){
        //Obtener el nombre
        $nomPag = $this->getNombrePag($pk);
        //Obtener la descripcion
        $pagDesc = $this->getDesc($pk);
        //Obtener los usuarios
        $arrayPag = $this->getUsuarios($pk);
        //Obtener la funcionalidad
        $func = $this->getFunc($pk);
        
        //Crear array asoc con los datos de $pk
        $pag = array("url"=>"$pk", "nombre"=>"$nomPag", "descripcion"=>"$pagDesc", "usuarios"=>$arrayPag, "funcionalidad"=>"$func");

        return $pag;
    }
    
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objecto pasado
    public function modificar ($pk, $objeto) {
        $db = new Database();
        //Guardar los datos de $pk en un array
        $datos = $objeto->consultar($pk);
        $oldNom = $datos['nombre'];
        $newNom = $objeto->nombrePag;
        if ($oldNom != $newNom){
            $sql = 'UPDATE Pagina SET NombrePag=\'' . $newNom . '\' WHERE Url = \'' . $pk .  '\'' ;

            $db->consulta($sql) or die('Error al modificar la descripcion');
        }
        
        $oldDesc = $datos['descripcion'];
        $newDesc = $objeto->descripcion;
        if ($oldDesc != $newDesc){
            $sql = 'UPDATE Pagina SET DescPag=\'' . $newDesc . '\' WHERE Url = \'' . $pk .  '\'' ;

            $db->consulta($sql) or die('Error al modificar la descripcion');
        }
        
    //Actualizar usuarios asociados a la pagina
        //Crear un array asociativo con los usuarios sin modificar
        $arrayOldUsu = $this->getUsuarios($pk);
        
        //Crear el array asociativo con los nuevos usuarios
        $arrayNewUsu = $objeto->usuarios;
        
        //Comparar si hay nuevos usuarios recorriendo $newUsuarios
        foreach ($arrayNewUsu as $new){
            $resultado = $db->consulta('SELECT Login FROM Usu_Pag WHERE Login = \'' . $new .  '\' AND Url = \'' . $pk . '\'');
            //Si las filas es igual a 0, no existe, por lo tanto es nuevo
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('INSERT INTO Usu_Pag (Login, Url) VALUES (\''.$new.'\',\''.$pk.'\')');
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
                $db->consulta('DELETE FROM Usu_Pag WHERE Login = \'' . $old['Login'] . '\' AND Url = \'' . $pk . '\'');
            }
        }
        
        //Actualizar funcionalidades asociadas a la pagina
        //Crear una variable con la funcionalidad sin modificar
        $oldFunc = $datos['funcionalidad'];
        
        //Crear variable con la nueva funcionalidad
        $newFunc = $objeto->funcionalidad;
        
        //Comparar si hay nueva funcionalidad comparando $NewFunc y $OldFunc
        if ($oldFunc != $newFunc){
            $sql = 'UPDATE Pagina SET NombreFun=\'' . $newFunc . '\' WHERE Url = \'' . $pk .  '\'';
            
            $db->consulta($sql) or die('Error al modificar la funcionalidad');
        }
        
        $db->desconectar();
        return true;
    }
    
    //Crea el objeto pasado en la tabla de la base de datos, si fue bien devuelve true
    public function crear($objeto){
        $db = new Database();
        if ($objeto->exists($objeto->url) == false) 
        {
             //Inserta esa pagina en la tabla Pagina
            $InsertaPag = "INSERT INTO Pagina (Url, NombrePag, DescPag, NombreFun) VALUES  ('$objeto->url','$objeto->nombrePag','$objeto->descripcion', '$objeto->funcionalidad')";
         
            $db->consulta($InsertaPag) or die('Error al crear la pagina');
            
            //Comprueba si esta relacionada con algun usuario
            if($objeto->usuarios != array()){
                foreach ($objeto->usuarios as $newUsu){
                    $queryUsu = 'INSERT INTO Usu_Pag (Login, Url) VALUES ('.$newUsu['Login'].','.$objeto->url.')';
                    $db->consulta($queryUsu) or die('Error al insertar los usuarios');
                }
            }
            
            //Comprueba si esta relacionada con alguna funcionalidad
            $newFunc = $objeto->funcionalidad;
            $queryFun = 'INSERT INTO Pagina (NombreFun) VALUES ('.$newFunc.') WHERE Url ='.$objeto->url.'';
            $db->consulta($queryFun) or die(header('location:../vistas/vista_pag.php'));
     
            return true;
        } else return false;
        
        $db->desconectar();
    }
    
    //Elimina de la base de datos segun la primary key pasada
    public function eliminar($pk){
        $db = new Database();
        $db->consulta('DELETE FROM Pagina WHERE NombrePag = \'' .  $pk .  '\'') or die('Error al eliminar la pagina');
        $db->desconectar();
    }
}
?>
