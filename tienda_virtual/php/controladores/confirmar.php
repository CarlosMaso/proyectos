<?php
    session_start(); //cargo la sesión
   
    require "../config/autocarga.php"; //funcion que carga automaticamente las clases

    require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body

    if(!isset($_SESSION['dni'])){ //si no está inicializada la variable de sesión dni

        if(isset($_POST['confirmar'])){ //si se ha pulsado el botón confirmar pedido

            echo "<div class='alineaTablaConfirm' id='lineaConfirm'>";
            echo "Para continuar con la operación debe iniciar sesión:<br>";
            echo "<a href='validar.php?dir=confirmar'>iniciar sesión</a><br>";
            echo "<br>";
            echo "Si no tiene una cuenta, puede registrarse aquí:<br>";
            echo "<a href='registrarse.php?dir=confirmar'>registrarse</a><br>";
            echo "</div>";

        }else{

            header('Location: verCarrito.php'); //sino se ha pulsado el botón confirmar, no debe estar aquí así que lo redirijo al carrito
        }

    }else{

        if(!isset($_SESSION['pago'])){
             header("Location:pagoTarjeta.php");
        }else{
            if($_SESSION['pago']=="pagado"){ //si la varibale contiene el string "pagado"
               
                $base= new BaseDatos();
                $pedido= new Pedido("", "", "", "", "");
                $lineas= new LineasPedido("", "", "", "", "");
                $dato=""; //string que contendrá todo.

                $total= $_SESSION['totalCarrito']; //recojo el total
                $dni= $_SESSION['dni'];  //recojo dni
                $nombreUsuario= $_SESSION['nombre'];

                //recojo datos carrito
                $carrito= Carrito::getCarrito($base, $dni);

                //recojo datos necesarios para Pedidos y LineasPedido
                $idPed= (Pedido::getMaxID($base))+1;
                $fecha=date("F j, Y, g:i a"); 
                $dirEntrega= Cliente::getdirEntrega($base, $_SESSION['dni']);

                //doy alta en pedidos
                $pedido->nuevoPedido($base, $idPed, $fecha, $dni, $dirEntrega, $total);

                //doy alta en lineas
                for($i=0; $i<count($carrito); $i++){

                    $nlinea=$i;//contador de lineas
                    $idProd=$carrito[$i]['idProd']; //recojo id Producto
                    $cant= $carrito[$i]['cantidad']; //recojo la cantidad
                    //recojo el precio
                    $nomPrecio= Producto::getNomPrecio($base, $idProd);
                    $precio= $nomPrecio['precio'];

                    $lineas->nuevaLineaPedido($base, $idPed, $nlinea, $idProd, $cant, $precio); //inserto linea
                }

                //muestro por pantalla un string que contendrá las sentencias en html necesarias para visualizar el pedido completo

                //recojo datos
                $ped=$pedido->getAll($base, $idPed);
                $lin=$lineas->getAll($base, $idPed);

                //monto la tabla
                $dato.="<div class='alineaTablaConfirm'><h2>Pedido de ".$nombreUsuario."</h2></div>";
                $dato.="<table class='tablaConfirm'>";
                $dato.="<tr><th>idPedido</th><th>Fecha</th></tr>";
                $dato.="<tr><td>".$ped[0]['idPedido']."</td><td>".$ped[0]['fecha']."</td></tr>"; //aquí el pedido
                $dato.="</table>";
                $dato.="<table class='tablaConfirm'>";
                $dato.="<tr><th>Nombre del Producto</th><th>Cantidad</th><th>Precio Linea</th></tr>";

                for($j=0; $j<count($lin); $j++){ //Este bucle imprime las lineas del pedido

                    $nom= Producto::getNomPrecio($base, $lin[$j]['idProducto']);
                    
                    $dato.="<tr><td>".$nom['nombre']."</td><td>".$lin[$j]['cantidad']."</td><td>".$lin[$j]["precio"]."</td></tr>";

                } 
                $dato.="<tr><td></td><td><strong>Total:</strong></td><td>".$ped[0]['totalCompra']."</td>"; //aquñi el total
                $dato.="</table>";
                $dato.="<table class='tablaConfirm'>";
                $dato.="<tr><th>Dirección de Entrega</th></tr>";
                $dato.="<tr><td>".$ped[0]['dirEntrega']."</td></tr>"; //aquí la dirección de entrega
                $dato.="</table>";

                echo $dato;

                echo "<div class='alineaTablaConfirm'><p>Si desea cambiar la dirección de entrega puede hacerlo aquí:</p> 
                            <form action='cambiaEntrega.php' method='post'>
                            <button type='submit' name='cambiaEntrega'>Cambiar Dirección</button>
                            </form></div>"; //Esto es por si quiere cambiar el lugar a donde va a enviarlo 

                echo "<br>";
                echo "<div class='alineaTablaConfirm'><p>Puede imprimir su pedido aquí:</p><button type='button' onclick='window.print()'>imprimir pdf</button></div><br>";


                if(isset($_POST['finalizar'])){ //si ha pulsado finalizar

                    //Se borrarán todas las sesiones y todos los registros del carrito.
                    LineasPedido::borrar($base, $idPed);
                    Pedido::borrar($base, $idPed);
                    Carrito::borrar($base, $dni);

                    session_destroy(); //destruyo todas las variables de sesión creadas
                    session_start(); //Vuelvo a iniciar y asigno las principales, por si quiere seguir con su sesión haciendo cosas

                    $_SESSION['dni']=$dni;
                    $_SESSION['nombre']=$nombreUsuario;
                    $_SESSION['total']=0;    

                    header("Location:principal.php");

                }else{ //sino muestro botón

                    echo "<div class='alineaTablaConfirm'><form action='confirmar.php' method='post'><p></p><button type='submit' name='finalizar'>Comprar</button></form></div>";
                }



            }
        }

        

            
      require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body
    }
?>