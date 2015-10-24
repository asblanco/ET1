<?php
//Clase que establece la conexion con la base de datos DB_ET1_G5 usando MySQL improved (mysqli)

class Database {
    var $conexion;
    
    public function __construct($host="localhost",$user="admin",
                                $pass="iu", $db="DB_ET1_G5"){
        $this->conexion = mysqli_connect($host, $user, $pass, $db);
        
        // Check connection
        if (mysqli_connect_errno())
          {
          echo "Fallo al conectar con la base de datos: " . mysqli_connect_error();
          }
    }
    
    public function consulta($sentencia){
        return mysqli_query($this->conexion,$sentencia);
    }
    
    public function desconectar(){
        $this->conexion->close();
    }
}

?>



