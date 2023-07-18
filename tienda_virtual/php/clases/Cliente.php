<?php

    class Cliente{

        private $dni;
        private $nombre;
        private $apellidos;
        private $edad;
        private $usuario;
        private $password;
        private $email;
        private $tlf;
        private $dirCliente;
        private $dirEntrega;
        
        public function __construct($dni, $nom, $ape, $edad, $usu, $pass, $mail, $tlf, $dirC, $dirE){ //instancio variables de la clase
            
            $this->dni=$dni;
            $this->nombre=$nom;
            $this->apellidos=$ape;
            $this->edad=$edad;
            $this->usuario=$usu;
            $this->password=$pass;
            $this->mail=$mail;
            $this->tlf=$tlf;
            $this->dirCliente=$dirC;
            $this->dirEntrega=$dirE;

        }

        static function getLogin($con){ //devuelve un array asociativo con todos los dni, nombre, usuario y passwords
            $consulta="SELECT dni, nombre, usuario, password FROM clientes";
            $datos=mysqli_query($con->conexion, $consulta);

            $ascArray=[];

            /* fetch associative array */
            while ($fila = $datos->fetch_assoc()) {
                $ascArray[]=$fila;
                
            }
            return $ascArray;
        }

        static function getUsuarios($con){ //ESTA FUNCION ES PARA LAS COMPROBACIONES DE COMPRUEBA CAMPOS
            $consulta="SELECT usuario FROM clientes";
            $datos=mysqli_query($con->conexion, $consulta);

            $arrayUsu=[];

            /* fetch normal array */
            while ($fila = $datos->fetch_row()) {
                $arrayUsu[]=$fila;
                
            }
            return $arrayUsu;

        }

        static function getDirEntrega($con, $dni){ //devuelve la dirección de entrega
            $consulta="SELECT dirEntrega FROM clientes WHERE dni='$dni'";
            $datos=mysqli_query($con->conexion, $consulta);
            $fila = $datos->fetch_row();
            return $fila[0];
        }

        public function cambiaDirEn($con, $dni, $dirNuev){ //sirve para cambiar la dirección de entrega
            $consulta="UPDATE clientes SET dirEntrega='$dirNuev' WHERE dni='$dni'";
            $datos=mysqli_query($con->conexion, $consulta);
        }

        public function nuevoCliente($con, $dni, $nom, $ape, $edad, $usu, $pass, $mail, $tlf, $dirC, $dirE){ //funcion para ingresar un nuevo cliente
            $consulta="INSERT INTO clientes (dni, nombre, apellidos, edad, usuario, password, email, telefono, dirCliente, dirEntrega) VALUES ('$dni','$nom','$ape','$edad','$usu','$pass','$mail','$tlf','$dirC','$dirE')";
            $datos=mysqli_query($con->conexion, $consulta);
        }

    }
?>