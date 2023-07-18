<?php
    session_start();

    require "../config/autocarga.php"; //funcion que carga automaticamente las clases
    require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body
    require "../vistas/vistaVerCarrito.php";

    $base=new BaseDatos();
    $carrito= new Carrito("","","");

    if(isset($_POST["comprarPrincipal"])){ // si llega desde: PRINCIPAL--------------------------------------------------------------------------------------------------------

        if(isset($_SESSION['dni'])){ //comrpuebo si  usuario está registrado

            $idCar=$_SESSION['dni']; //instancio la variable que contendrá el id

        }else{
            
            if(!isset($_SESSION['idUnico'])){ //comrpuebo si existe variable de sesión llamada idUnico//si no existe la creo

                $dataID= Carrito::getID($base); //recojo los id que hay para ver si hay alguno suelto entre medias para asignarlo (sino le asigna uno nuevo)

                $_SESSION['idUnico']= $carrito->idUnico($base, $dataID); //asigno nuevo idUnico

                $idCar=$_SESSION['idUnico'];  //instancio la variable que contendrá el id

            }else{
                $idCar=$_SESSION['idUnico'];  //instancio la variable que contendrá el id
            }
        }
    }

    if(isset($_POST['comprarDetalle'])){ //si llega desde: DETALLE ------------------------------------------------------------------------------------------------------------

        if(isset($_SESSION['dni'])){ //comrpuebo si  usuario está registrado

            $idCar=$_SESSION['dni']; //instancio la variable que contendrá el id

        }else{
            
            if(!isset($_SESSION['idUnico'])){ //comrpuebo si existe variable de sesión llamada idUnico//si no existe la creo

                $dataID= Carrito::getID($base); //recojo los id que hay para ver si hay alguno suelto entre medias para asignarlo (sino le asigna uno nuevo)

                $_SESSION['idUnico']= $carrito->idUnico($base, $dataID); //asigno nuevo idUnico

                $idCar=$_SESSION['idUnico'];  //instancio la variable que contendrá el id

            }else{
                $idCar=$_SESSION['idUnico'];  //instancio la variable que contendrá el id
            }
        }

        //Recojo las otras variables
        $idProducto= $_POST['idProd'];
        $cant= $_POST['cantidad'];

        $carrito->insertaLinea($base, $idCar, $idProducto, $cant); //meto una nueva linea en Lineas carrito

        echo "<div id='mensajeBueno'><p><strong>Producto añadido al carrito!!</strong></p></div>";
    }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    if(empty($idCar)){ //si está vacia la variable

        if(!empty($_POST['id'])){ //y si el usuario viene de donde toca guardo variable

            $idCar=$_POST['id'];

        }else{ //si no viene de donde toca, lo redirijo
            header('Location:principal.php');
        }
    }


    //una vez solucionado el si viene de principal o de detalle muestro el carrito
    $arrayCarrito=$carrito->getCarrito($base, $idCar);

    if($arrayCarrito==null){

        $_SESSION['total']=0;

        echo "<h2>Aún no hay articulos en su carrito!!</h2><br>";
        echo "<a href='principal.php'>Seguir comprando</a>";

    }else{

        $productos=[]; //array para guardar los idProductos

        for($i=0; $i<count($arrayCarrito); $i++){ 

            array_push($productos, $arrayCarrito[$i]['idProd']); //meto todos los idProd en el array de productos
        }

        $prod=array_unique($productos); //elimino repetidos

        sort($prod); //ordeno los campos para que no haya espacios vacios (el problema que tiene array_unique es que deja las keys vacias)

        $prodCant=[]; //array de idProd y cantidad final

        for($j=0; $j<count($prod); $j++){ //por cada idProd sin repetir

            $cant=0; //variable para sumar las cantidades

            for($p=0; $p<count($arrayCarrito); $p++){ //busco en el array Carrito

                if($prod[$j]==$arrayCarrito[$p]["idProd"]){ //si coincide el idProd le sumo la cantidad a ese idProd

                    $cant= $cant+ intval($arrayCarrito[$p]["cantidad"]);
                }

                //lo meto en el array final
                $prodCant[$j]["idProd"]=$prod[$j];
                $prodCant[$j]["cantidad"]=$cant;
                    
            }
    
        }

        $total=0; //variable que guarda la suma total de precios

        echo "<div id='contenedorVerCarrito'>";
        echo "<h2>Tu Carrito!</h2><img id='carrito' src='../../img/carritoNegro.png' alt='logoCarrito'>";
        echo "<br><br>";
        echo "<table id='tablaCarrito'>";
        echo "<tr><th class='lineaTD'>Nombre</th><th class='lineaTD'>Cantidad</th><th class='lineaTD'>Precio Unidad</th><th class='lineaTD'>Precio Conjunto</th><th class='lineaTD'></th></tr>";

        $cantidades=0;

        for($i=0; $i<count($prodCant); $i++){ //creo la tabla que muestra el carrito

            $idProduct=$prodCant[$i]["idProd"]; //guardo el id para pasarlo luego a borrar (en caso de que clicke borrar)

            $nomPrecio= Producto::getNomPrecio($base, $prodCant[$i]["idProd"]); //recojo el nombre y el precio del producto

            $totalPrecioUni= intval($prodCant[$i]["cantidad"]) * intval($nomPrecio['precio']); //multiplico la cantidad por el precio

            $cantidades+=intval($prodCant[$i]["cantidad"]);

            $total= $total+$totalPrecioUni; //añado precio al total

            echo "<tr><td class='lineaTD'>".$nomPrecio['nombre']."  </td><td class='lineaTD'>".$prodCant[$i]["cantidad"]." </td><td class='lineaTD'>".$nomPrecio['precio']." €</td><td class='lineaTD'>".$totalPrecioUni." €</td>";
            echo "<td class='lineaTD'><a href='borrarLineaCarrito.php?idCar=$idCar&idProd=$idProduct' >borrar</a></td></tr>"; //este botón borra la linea
        }
        $_SESSION['total']=$cantidades;
        $_SESSION['totalCarrito']=$total; //meto el total para usarlo luego

        echo "<tr><td></td><td></td><td></td><td class='lineaTD'><p><strong>Total: </strong>  ".$total." € </p></td><td></td></tr>";
        echo "</table>";
        echo "<br>";
        echo "<form action='confirmar.php' method='post'><button type='submit' name='confirmar'>Confirmar pedido!!</button></form>";
        echo "<button type='button' onclick=redirigeBotones('principal')>Seguir comprando</button>";
        echo "</div>";
    }

    require "../vistas/vistaPrincipal2.php";
    require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body

?>