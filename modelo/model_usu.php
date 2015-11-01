
<!--
===========================================================================
Clase Usuario, permite gestionar todo lo relacionado a los Usuarios en la base de datos
Creado por: Andrea Araujo Cuquejo y Elías Martínez Blanco
Fecha: 26/10/2015
============================================================================
-->



<?php
include_once 'interface.php';

//Clase usuario con las funciones de iUsuario implementadas
class Usuario implements iModel {
	
    private $loginClase;
    private $nombre;
    private $apellidos;
    private $fechaAlta;
    private $email;
    private $password;
    private $idioma;
    private $roles = array();
    private $paginas = array();
    public $numUsuarios = 0;
    
    public function __construct($loginClase="" , $nombre="", $apellidos="" , $fechaAlta="", $email="" , $password="" , $idioma="es", $rol=array(), $pag=array()) {
        $this->loginClase = $loginClase;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fechaAlta = $fechaAlta;
        $this->email = $email;
        $this->password = $password;
        $this->idioma = $idioma;
        $this->roles = $rol;
        $this->paginas= $pag;
    }
    
    //Comprueba si existe
    public function exists ($pk) {
        $db = new Database();
        
        //Comprueba si ya existe ese usuario
        $consultaUsuario = 'SELECT * FROM Usuario WHERE Login = \'' .  $pk .  '\'';
        $resultado = $db->consulta($consultaUsuario) or die('Error al ejecutar la consulta de usuario');
        
        // Si el numero de filas es 0 significa que no encontro el usuario
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
        
        $sqlUsuario = $db->consulta("SELECT Login , Nombre, Apellidos , Email , FechaAlta FROM Usuario");
        $arrayUsuario = array();
        //Numero de usuarios 
        $this->numUsuarios = 0;
        while ($row_usuario = mysqli_fetch_assoc($sqlUsuario)) {
            $arrayUsuario[] = $row_usuario;
            $this->numUsuarios++;
        }
        
        $db->desconectar();
        return $arrayUsuario;
    }
    
    //Muestra los datos de la $pk indicada. Devuelve una array asociativo
    public function consultar ($pk){
        $db = new Database();
        
        $query = 'SELECT  Nombre, Apellidos , Email , FechaAlta FROM Usuario WHERE Login = \'' . $pk .  '\'';
        $arrayDatos = array();
        
        while ($row_usuario = mysqli_fetch_assoc($db->consulta($query))) {
            $arrayDatos[] = $row_usuario;
        }
        
        $db->desconectar();
        return $arrayDatos;
    }
    
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objecto pasado
    public function modificar ($pk, $objeto) {
        $db = new Database();
        //Guardar los datos de $pk
        $datos = $objeto->consultar($pk);
		
		$oldLogin= $datos['loginClase'];
        $newLogin = $objeto->loginClase;
		
		
		$oldPassword = $datos['password'];
        $newPassword = $objeto->password;
		
			if ($oldPassword != $newPassword){
            $sql = 'UPDATE Usuario SET Password=\''. $newPassword . '\' WHERE Login = \'' . $oldLogin .  '\'' ;

            $db->consulta($sql) or die('Error al modificar la password');
        }
		
        $oldNombre = $datos['nombre'];
        $newNombre = $objeto->nombre;
		
			if ($oldNombre != $newNombre){
            $sql = 'UPDATE Usuario SET Nombre='. $newNombre . ' WHERE Login = \'' . $oldLogin .  '\'' ;

            $db->consulta($sql) or die('Error al modificar el nombre');
        }
		$oldApellidos = $datos['apellidos'];
        $newApellidos = $objeto->apellidos;
		
			if ($oldApellidos != $newApellidos){
            $sql = 'UPDATE Usuario SET Apellidos='. $newApellidos . ' WHERE Login = \'' . $oldLogin .  '\'' ;

            $db->consulta($sql) or die('Error al modificar los apellidos');
        }
		
		$oldEmail = $datos['email'];
        $newEmail = $objeto->email;
		
			if ($oldEmail != $newEmail){
            $sql = 'UPDATE Usuario SET Email='. $newEmail . ' WHERE Login = \'' . $oldLogin .  '\'' ;

            $db->consulta($sql) or die('Error al modificar el email');
        }
		$oldFechaAlta = $datos['fechaAlta'];
        $newFechaAlta = $objeto->fechaAlta;
	
				if ($oldFechaAlta != $newFechaAlta){
            $sql = 'UPDATE Usuario SET fechaAlta='. $newFechaAlta . ' WHERE Login = \'' . $oldLogin .  '\'' ;

            $db->consulta($sql) or die('Error al modificar la fecha');
        }

        
    //Actualizar roles asociados al usuario
        //Crear un array asociativo con los roles sin modificar
        $sqlOldRol = $db->consulta('SELECT NombreRol FROM Usu_Rol WHERE Login = \'' . $pk .  '\'');
        $arrayOldRol = array();
        while ($row_rol = mysqli_fetch_assoc($sqlOldRol))
            $arrayOldRol[] = $row_rol;
        
        //Crear el array asociativo con los nuevos roles
        $arrayNewRol = $objeto->roles;
        
        //Comparar si hay nuevos roles recorriendo $newRoles
        foreach ($arrayNewRol as $new){
            $resultado = $db->consulta('SELECT NombreRol FROM Usu_Rol WHERE NombreRol = \'' . $new['NombreRol'] .  '\'');
            //Si las filas es igual a 0, no existe, por lo tanto es nuevo
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('INSERT INTO Usu_Rol (Login, NombreRol) VALUES ('.$new['NombreRol'].','.$objeto->loginClase.')');
            }
        }
        
        //Comparar si hay roles a eliminar recorriendo $arrayOldRol
		foreach ($arrayOldRol as $old){
            //Comprobar si el rol está en $arrayNewRol
            $cont=0;
            foreach($arrayNewRol as $new){
                if($new['NombreRol'] == $old['NombreRol']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarlo
            if( $cont == 0 ){
                $db->consulta('DELETE FROM Usu_Rol WHERE NombreRol = \'' . $old['NombreRol'] . '\'');
            }
        }
        
    //Actualizar paginas asociadas al usuario
        //Crear un array asociativo con las paginas sin modificar
        $sqlOldPag = $db->consulta('SELECT Url FROM Usu_Pag WHERE Login = \'' . $pk .  '\'');
        $arrayOldPag = array();
        while ($row_pag = mysqli_fetch_assoc($sqlOldPag))
            $arrayOldPag[] = $row_pag;
        
        //Crear el array asociativo con las nuevas paginas
        $arrayNewPag = $objeto->paginas;
        
        //Comparar si hay nuevas paginas recorriendo $arrayNewPag
        foreach ($arrayNewPag as $new){
            $resultado = $db->consulta('SELECT Url FROM Usu_Pag WHERE Url = \'' . $new['Url'] .  '\'');
            //Si las filas es igual a 0, no existe, por lo tanto es nueva
            
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('INSERT INTO Usu_Pag (Login, Url) VALUES ('.$objeto->loginClase.','.$new['Url'].')');
            }
        }
        
        //Comparar si hay paginas a eliminar recorriendo $arrayOldPag
        foreach ($arrayOldPag as $old){
            //Comprobar si la pagina está en $arrayNewPaG
            $cont=0;
            foreach($arrayNewPag as $new){
                if($new['Url'] == $old['Url']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarla
            if( $cont == 0 ){
                $db->consulta('DELETE FROM Usu_Pag WHERE Url = \'' . $old['Url'] . '\'');
            }
        }
        
        
        $existeNombre = $this->exists($newLogin);
        if($newLogin != "" && $existeNombre == false){
            //Comparar los datos con $objeto y modificar los que sean necesarios
            if ($oldLogin != $newLogin){
                $sql = 'UPDATE Usuario SET Login=' . $newLogin . ' WHERE Login = \'' . $oldLogin .  '\'';
                $result = $db->consulta($sql);
            }
        }
        
        if ($result === TRUE)
            return true;
        else return false;
        
        $db->desconectar();
    }
    
    //Crea el objeto pasado en la tabla de la base de datos, si devuelve fue bien devuelve true
    public function crear($objeto){
        $db = new Database();
        if ($objeto->exists($objeto->loginClase) == false) 
        {
             //Inserta el usuario en la tabla usuario
            $insertaUsu = "INSERT INTO Usuario (Login, Password, Nombre, Apellidos , Email , FechaAlta, Idioma) 
				VALUES ('$objeto->loginClase','$objeto->password','$objeto->nombre','$objeto->apellidos','$objeto->email','$objeto->fechaAlta','$objeto->idioma')";
            $db->consulta($insertaUsu) or die('Error al crear el Usuario');
            
            //Comprueba si esta relacionado con algun rol
            if($objeto->roles != array()){
                foreach ($objeto->$arrayA as $rol){
                    $newRol = $rol['NombreRol'];
                    $queryRol = 'INSERT INTO Usu_Rol (Login, NombreRol) VALUES ('.$objeto->loginClase.','.$newRol.')';
                    $db->consulta($queryRol) or die('Error al insertar los roles');
                }
            }
            
            //Comprueba si esta relacionado con alguna pagina
            if($objeto->paginas != array()){
                foreach ($objeto->paginas as $pag){
                    $newPag = $pag['Url'];
                    $queryPag = 'INSERT INTO Usu_Pag (Login, Url) VALUES ('.$objeto->loginClase.','.$newPag.')';
                    $db->consulta($queryPag) or die('Error al insertar las paginas');
                }
            }
            return true;
        } else return false;
        
        $db->desconectar();
    }
    
    //Elimina de la base de datos segun la primary key pasada
    public function eliminar($pk){
        $db = new Database();
        $db->consulta('DELETE FROM Usuario WHERE Login = \'' .  $pk .  '\'') or die('Error al eliminar el usuario');
        $db->desconectar();
    }
    
    //Transformar y devuelve la tabla Usu_Rol de un Usuario especificado en un array
    public function arrayA ($pk){
        $db = new Database();
        
        $sqlRol = $db->consulta('SELECT Login, NombreRol FROM Usu_Rol WHERE Login = \'' . $pk . '\'');
        $arrayRol = array();
        
        while ($row_rol = mysqli_fetch_assoc($sqlRol))
            $arrayRol[] = $row_rol;
        
        $db->desconectar();
        return $arrayRol;
    }
    
    //Transformar y devuelve la tabla Usu_Pag de un Usuario especificado en un array
    public function arrayB ($pk){
        $db = new Database();
        
        $sqlPag = $db->consulta('SELECT Login, Url FROM Usu_Pag WHERE Login = \'' . $pk . '\'');
        $arrayPag = array();
        
        while ($row_pag = mysqli_fetch_assoc($sqlPag))
            $arrayPag[] = $row_pag;
        
        $db->desconectar();
        return $arrayPag;
    }
}
?>