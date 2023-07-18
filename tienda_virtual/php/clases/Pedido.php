<?php
    class Pedido{

        private $idPedido;
        private $fecha;
        private $dniCliente;
        private $dirEntrega;
        private $totalCompra;

        
        public function __construct($idPed, $fech, $dniCli, $dirEn, $totalCompra){ //instancio variables de la clase
            
            $this->idPedido=$idPed;
            $this->fecha=$fech;
            $this->dniCliente=$dniCli;
            $this->dirEntrega=$dirEn;
            $this->totalCompra=$totalCompra;
        }

        static function getAll($con, $idPed){ //recojo todos los datos de pedidos donde coincida el id pedido
            $consulta="SELECT * FROM pedidos WHERE idPedido='$idPed'";
            $datos=mysqli_query($con->conexion, $consulta);

            $pedido=[];

            while($fila=mysqli_fetch_assoc($datos)){ //Lo pongo así para que sea más manejable como array
                array_push($pedido, $fila);
            }

            return $pedido;
        }

        static function getMaxID($con){ //devuelve el id Pedido maximo 
            $consulta="SELECT MAX(idPedido) FROM pedidos";
            $datos=mysqli_query($con->conexion, $consulta);
            $fila=mysqli_fetch_row($datos);

            if(empty($fila[0])){ //si no hay devuelve 1
                return 1;
            }else{
                return $fila[0];
            }
        }

        public function nuevoPedido($con, $idPed, $fech, $dni, $dirE, $total){ //Esta funcion sirve para insertar un nuevo Pedido en la tabla Pedidos
            $consulta="INSERT INTO pedidos (idPedido, fecha, dniCliente, dirEntrega, totalCompra) VALUES ('$idPed','$fech','$dni','$dirE','$total')";
            $datos=mysqli_query($con->conexion, $consulta);

        }
        static function borrar($con, $idPed){ //borro todo donde coincida el idPedido
            $consulta="DELETE FROM pedidos WHERE idPedido='$idPed'";
            $datos=mysqli_query($con->conexion, $consulta);
        }
    }

?>