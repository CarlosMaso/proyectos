<?php
    class Carrito{

        private $idCarrito; //el cual será el  idUnico de anonimo o el dni cliente
        private $idProd;
        private $cantidad;
        
        public function __construct($idCar, $idProducto, $cant){ //instancio variables de la clase
            
            $this->idCarrito=$idCar;
            $this->idProd=$idProducto;
            $this->cantidad=$cant;
        }

        static function getID($con){ //Esta funcion recoje todos los id que hay en el carrito y devuelve un array con esos id
            $consulta="SELECT idCarrito FROM lineasCarrito";
            $datos=mysqli_query($con->conexion, $consulta);

            $ides=[];

            while($fila=mysqli_fetch_row($datos)){ //Lo pongo así para que sea más manejable como array
                array_push($ides, $fila[0]);
            }

            return $ides;
        }

        public function idUnico($con, $dataID){ //Esta función busca si hay algún numero libre para darselo al anonimo como id de sesión

            $id=0;

            $arrayNumerico=[];

            for($i=0; $i<count($dataID); $i++){ //Separo los id Unicos (numericos) y los meto en un array
                
                if(is_numeric($dataID[$i])){

                    array_push($arrayNumerico, $dataID[$i]);
                }
            }

            for($j=1; $j<count($arrayNumerico); $j++){ //Si hay un numero "vacio" entre alguno de los idUnicos, lo asigna al id y para el bucle

                //asigno variables
                $a=intval($arrayNumerico[$j-1]);
                $b=intval($arrayNumerico[$j]);

                //hago resta
                $resultado=$b-$a;

                if($resultado>1){ //Si el resultado es mayor que 1 es porque hay numeros "vacios" entre medio, le resto 1 y lo asigno al id
                    $id=intval($arrayNumerico[$j])-1;
                    break;
                }
            }

            if($id==0){ //en el caso de que no hayan numeros disponibles, cojo el maximo y le sumo 1

                if(empty($arrayNumerico)){ //si está vacio le doy un valor
                    $id=1;
                }else{
                    $num= max($arrayNumerico); //sino cojo el maximo y le sumo 1

                    $id=intval($num)+1;
                }
                
            }

            return $id;
        }

        static function getCarrito($con, $id){

            $consulta="SELECT * FROM lineasCarrito WHERE idCarrito='$id'";
            $datos=mysqli_query($con->conexion, $consulta);

            $carrito=[];

            while($fila=mysqli_fetch_assoc($datos)){ //Lo pongo así para que sea más manejable como array
                array_push($carrito, $fila);
            }

            return $carrito;

        }

        public function insertaLinea($con, $idCar, $idProducto, $cant){ //inserto una linea cada vez que se añade algo al carrito
            $consulta="INSERT INTO lineasCarrito (idCarrito, idProd, cantidad) VALUES ('$idCar', '$idProducto', '$cant')";
            $datos=mysqli_query($con->conexion, $consulta);
        }

        public function updateLinea($con, $idUnico, $dni){ //Updateo las lineas cuando el anonimo inicia sesión
            $consulta="UPDATE lineasCarrito SET idCarrito='$dni' WHERE idCarrito='$idUnico'";
            $datos=mysqli_query($con->conexion, $consulta);
        }

        public function borrarLinea($con, $idCar, $idProduct){ //borro una linea
            $consulta="DELETE FROM lineasCarrito  WHERE idCarrito='$idCar' AND idProd='$idProduct'";
            $datos=mysqli_query($con->conexion, $consulta);
        }

        static function borrar($con, $idCar){ //borro al usuario (sobretodo es para los anonimos)
            $consulta="DELETE FROM lineasCarrito WHERE idCarrito='$idCar'";
            $datos=mysqli_query($con->conexion, $consulta);
        }
        
    }

?>