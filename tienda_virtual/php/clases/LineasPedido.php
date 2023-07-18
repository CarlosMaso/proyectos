<?php
    class LineasPedido{

        private $idPedido;
        private $nlinea;
        private $idProducto;
        private $cantidad;
        private $precio;
        
        public function __construct($idPed, $linea, $idProd, $cant, $prec){ //instancio variables de la clase
            
            $this->idPedido=$idPed;
            $this->nlinea=$linea;
            $this->idProducto=$idProd;
            $this->cantidad=$cant;
            $this->precio=$prec;
        }

        static function getAll($con, $idPed){ //recojo todos los datos de lineas pedidos donde coincida el idPed
            $consulta="SELECT * FROM lineasPedidos WHERE idPedido='$idPed'";
            $datos=mysqli_query($con->conexion, $consulta);

            $pedido=[];

            while($fila=mysqli_fetch_assoc($datos)){ //Lo pongo así para que sea más manejable como array
                array_push($pedido, $fila);
            }

            return $pedido;
        }

        public function nuevaLineaPedido($con, $idPed, $nlinea, $idProd, $cant, $precio){ //insertar una nueva linea pedidos
            $consulta="INSERT INTO lineasPedidos (idPedido, nlinea, idProducto, cantidad, precio) VALUES ('$idPed','$nlinea','$idProd','$cant','$precio')";
            $datos=mysqli_query($con->conexion, $consulta);
        }

        static function borrar($con, $idPed){ //borra todo donde coincida el idPedido
            $consulta="DELETE FROM lineasPedidos WHERE idPedido='$idPed'";
            $datos=mysqli_query($con->conexion, $consulta);
        }
    }

?>