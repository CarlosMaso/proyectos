<?php

    class BaseDatos{

        private $host;
        private $usu;
        private $pass;
        private $nombreTabla;
        private $conexion;

        public function __construct(){ //Creo la conexión a la Base de datos
            $this->host="localhost";
            $this->usu="daw";
            $this->pass="DAW";
            $this->nombreTabla="tiendaOnline";
            return  $this->conexion=mysqli_connect($this->host, $this->usu, $this->pass, $this->nombreTabla); //Devuelvo la conexion
        }

        public function __get($valor){ //funcion para poder usar las variables privadas
            return $this -> $valor;
        } 

        function cerrarConexion($conexion){
            mysqli_close($conexion->conexion); //cerrar conexion
        }
    }

?>