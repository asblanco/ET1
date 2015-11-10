
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
    
    
    private function getNombre ($pk){
        $db = new Database();
        
        $query = 'SELECT Nombre FROM Usuario WHERE Login = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $nombre = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $nombre;
    }
    
    private function getApellidos ($pk){
        $db = new Database();
        
        $query = 'SELECT Apellidos FROM Usuario WHERE Login = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $apellidos = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $apellidos;
    }
    
    private function getFechaAlta ($pk){
        $db = new Database();
        
        $query = 'SELECT FechaAlta FROM Usuario WHERE Login = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $fechaAlta = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $fechaAlta;
    }
    
    private function getEmail ($pk){
        $db = new Database();
        
        $query = 'SELECT Email FROM Usuario WHERE Login = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $email = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $email;
    }
    
    public function getPassword ($pk){
        $db = new Database();
        
        $query = 'SELECT Password FROM Usuario WHERE Login = \'' . $pk .  '\'';
        $result = $db->consulta($query);

        /* array numérico */
        $row = $result->fetch_array(MYSQLI_NUM);
        $pass = $row[0];

        /* liberar la serie de resultados */
        $result->free();
        $db->desconectar();
        
        return $pass;
    }
    
    private function getRoles ($pk){
        $db = new Database();
        
        $sqlRol = $db->consulta('SELECT Login, NombreRol FROM Usu_Rol WHERE Login = \'' . $pk . '\'');
        $arrayRol = array();
        
        while ($row_rol = mysqli_fetch_assoc($sqlRol))
            $arrayRol[] = $row_rol;
        
        $db->desconectar();
        return $arrayRol;
    }
    
    private function getPaginas ($pk){
        $db = new Database();
        
        $sqlPag = $db->consulta('SELECT Login, Url, NombrePag FROM Usu_Pag WHERE Login = \'' . $pk . '\'');
        $arrayPag = array();
        
        while ($row_pag = mysqli_fetch_assoc($sqlPag))
            $arrayPag[] = $row_pag;
        
        $db->desconectar();
        return $arrayPag;
    }
    
    //Devuelve true o false si realizo el cambio correctamente o no
    private function setPassword($oldPass, $newPass, $pk){
        //Si oldPass coincide con la de la de $pk en la BD, hace UPDATE con newPass
            $db = new Database();
        
            $pass = $this->getPassword($pk);

            if(strcmp($oldPass, $pass)!== 0){ return false;}
            //Si la contraseña nueva no es la cadena vacia en MD5
            else if (strcmp($newPass, "")!== 0){
                $sql = 'UPDATE Usuario SET Password=\''. $newPass . '\' WHERE Usuario.Login = \'' . $pk .  '\'' ;
                $db->consulta($sql) or die('Error al modificar la password');
                $result = $db->consulta($sql);
                $db->desconectar();

                return $result;
            }else return true;
    }
    
    public function setIdioma ($newIdioma, $pk){
        //Si newIdioma no es el que ya está, hace UPDATE
        //Este metodo se deberia llamar cada vez que se cambia el idioma en la navBar
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
        //Obtener el nombre
        $usuNombre = $this->getNombre($pk);
        //Obtener los apellidos
        $usuApellidos = $this->getApellidos($pk);
        //Obtener la fecha de alta
        $usuFecha = $this->getFechaAlta($pk);
        //Obtener el email
        $usuEmail = $this->getEmail($pk);
        //Obtener contraseña
        $usuPass = $this->getPassword($pk);
        //Obtener los roles
        $arrayRol = $this->getRoles($pk);
        //Obtener las paginas
        $arrayPag = $this->getPaginas($pk);
        
        //Crear array asoc con los datos de $pk
        $rol = array("loginClase"=>"$pk", "nombre"=>"$usuNombre", "apellidos"=>"$usuApellidos", "fechaAlta"=>"$usuFecha", "email"=>"$usuEmail", "password"=>$usuPass, "roles"=>$arrayRol, "paginas"=>$arrayPag );
        
        return $rol;
    }
    
    //Modifica los datos del objeto con $pk, y lo guarda segun los datos de $objeto pasado
    public function modificar ($pk, $objeto) {
        $db = new Database();
        //Guardar los datos del objeto $pk antes de modificar
        $datos = $this->consultar($pk);
		
	       $oldLogin= $datos['loginClase'];
        $newLogin = $objeto->loginClase;
		
        $oldNombre = $datos['nombre'];
        $newNombre = $objeto->nombre;
		
		      if ($oldNombre != $newNombre){
            $sql = 'UPDATE Usuario SET Nombre=\''. $newNombre . '\' WHERE Login = \'' . $oldLogin .  '\'' ;

            $db->consulta($sql) or die('Error al modificar el nombre');
        }
        
		      $oldApellidos = $datos['apellidos'];
        $newApellidos = $objeto->apellidos;
		
		      if ($oldApellidos != $newApellidos){
            $sql = 'UPDATE Usuario SET Apellidos=\''. $newApellidos . '\' WHERE Login = \'' . $oldLogin .  '\'' ;

            $db->consulta($sql) or die('Error al modificar los apellidos');
        }
		
		      $oldEmail = $datos['email'];
        $newEmail = $objeto->email;
		
		      if ($oldEmail != $newEmail){
            $sql = 'UPDATE Usuario SET Email=\''. $newEmail . '\' WHERE Login = \'' . $oldLogin .  '\'' ;

            $db->consulta($sql) or die('Error al modificar el email');
        }

        
    //Actualizar roles asociados al usuario
        //Crear un array asociativo con los roles sin modificar
        $arrayOldRol = $datos['roles'];
        //Crear el array asociativo con los nuevos roles
        $arrayNewRol = $objeto->roles;
        
        //Comparar si hay nuevos roles recorriendo $newRoles
        foreach ($arrayNewRol as $new){
            $resultado = $db->consulta('SELECT NombreRol FROM Usu_Rol WHERE NombreRol = \'' . $new .  '\' AND Login = \'' . $pk . '\'');
            //Si las filas es igual a 0, no existe, por lo tanto es nuevo
            if( mysqli_num_rows($resultado) == 0 ){
                $db->consulta('INSERT INTO Usu_Rol (Login, NombreRol) VALUES (\''.$pk.'\',\''.$new.'\')');
            }
        }
        
        //Comparar si hay roles a eliminar recorriendo $arrayOldRol
		      foreach ($arrayOldRol as $old){
            //Comprobar si el rol está en $arrayNewRol
            $cont=0;
            foreach($arrayNewRol as $new){
                if($new == $old['NombreRol']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarlo
            if( $cont == 0 ){
                $db->consulta('DELETE FROM Usu_Rol WHERE NombreRol = \'' . $old['NombreRol'] . '\' AND Login = \'' . $pk . '\'');
            }
        }
        
    //Actualizar paginas asociadas al usuario
        //Crear un array asociativo con las paginas sin modificar
        $arrayOldPag = $datos['paginas'];
        
        //Crear el array asociativo con los nombres de las paginas nuevas
        $arrayNewPag = $objeto->paginas;
        
        //Comparar si hay nuevas paginas recorriendo $arrayNewPag
        foreach ($arrayNewPag as $new){
            //Comprueba si existe esa pagina en la tabla de relacion Usu_Pag
            $result = $db->consulta('SELECT Url FROM Usu_Pag WHERE NombrePag = \''. $new .'\' AND Login = \''. $pk .'\'') or die("Error en la consulta de paginas");
            
            //Si las filas es igual a 0, no existe, por lo tanto es nueva y se añade
            if( mysqli_num_rows($result) == 0 ){
                //Como no existe, se coge la Url de la tabla Pagina
                $resultado = $db->consulta('SELECT Url FROM Pagina WHERE NombrePag = \''. $new .'\'');
                /* array numérico para guardar la url */
                $row = $resultado->fetch_array(MYSQLI_NUM);
                $url = $row[0];
                $resultado->free();
                
                //Insertar la relacion entre pagina y usuario
                $db->consulta('INSERT INTO Usu_Pag (Login, Url, NombrePag) VALUES (\''. $pk .'\', \''. $url .'\', \''. $new .'\')') or die("error al insertar paginas");
            }
        }
        
        //Comparar si hay paginas a eliminar recorriendo $arrayOldPag
        foreach ($arrayOldPag as $old){
            //Comprobar si la pagina está en $arrayNewPaG
            $cont=0;
            foreach($arrayNewPag as $new){
                $resultado = $db->consulta('SELECT Url FROM Usu_Pag WHERE NombrePag = \''. $new .'\' AND Login = \''. $pk .'\'');
                $row = $resultado->fetch_array(MYSQLI_NUM);
                $url = $row[0];
                if($url == $old['Url']) $cont++;
            }
            //Si las filas(cont) es igual a 0, no existe, por lo tanto hay que eliminarla
            if( $cont == 0 ){
                $db->consulta('DELETE FROM Usu_Pag WHERE Url = \'' . $old['Url'] . '\' AND Login = \'' . $pk . '\'');
            }
        }
        
        
        $existeNombre = $this->exists($newLogin);
        if($newLogin != "" && $existeNombre == false){
            //Comparar los datos con $objeto y modificar los que sean necesarios
            if ($oldLogin != $newLogin){
                $sql = 'UPDATE Usuario SET Login=\'' . $newLogin . '\' WHERE Login = \'' . $oldLogin .  '\'';
                $result = $db->consulta($sql);
                //Si da error que devuelva false
                if ($result === FALSE)
                    return false;
            }
            $result = true;
        }
        
        $oldPass = $datos['password'];
        $newPass = $objeto->password;
        
        $result = $this->setPassword($oldPass, $newPass, $pk);
        
        $db->desconectar();
        return $result;
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
                foreach ($objeto->roles as $newRol){
                    $queryRol = 'INSERT INTO Usu_Rol (Login, NombreRol) VALUES (\''.$objeto->loginClase.'\',\''.$newRol.'\')';
                    $db->consulta($queryRol) or die('Error al insertar los roles');
                }
            }
            
            //Comprueba si esta relacionado con alguna pagina
            if($objeto->paginas != array()){
                foreach ($objeto->paginas as $newPag){
                    //Coger la url de la tabla pagina
                    $resultado = $db->consulta('SELECT Url FROM Pagina WHERE NombrePag = \''. $newPag .'\'');
                    /* array numérico para guardar la url */
                    $row = $resultado->fetch_array(MYSQLI_NUM);
                    $url = $row[0];
                    
                    $queryPag = 'INSERT INTO Usu_Pag (Login, Url, NombrePag) VALUES (\''.$objeto->loginClase.'\',\''.$url.'\', \''. $newPag .'\')';
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
}
?>