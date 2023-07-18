<?php
    session_start();
    require "../config/autocarga.php"; //funcion que carga automaticamente las clases

    require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body
    require "../vistas/vistaPrincipal.php"; //Primera parte de la página principal, contiene el header

    $base=new BaseDatos();

    if(!isset($_SESSION['dni'])){ //Si no está logeado crea un idUnico

        if(!isset($_SESSION['idUnico'])){

            $carrito= new Carrito("", "", "");

            $dataID= Carrito::getID($base); //lo llamo así porque es static
    
            $idUnico=$carrito->idUnico($base, $dataID);
    
            $_SESSION['idUnico']=$idUnico;//le añado el valor a la variable de sesión
        } 
    }

    //Dependiendo de que botón se haya pulsado (o si no se ha pulsado ninguna seccion) mostrará una cosa o otra

    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        header("HTTP/1.1 200 OK");
        echo Producto::imprimirProd($base);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        header("HTTP/1.1 200 OK");

        if(isset($_POST['todo'])){ //Mostrar todos los productos

            echo Producto::imprimirProd($base);
            
        }else if(isset($_POST['masVendidos'])){ //Mostrar los productos más vendidos
    
            echo Producto::imprimirMasVendidos($base);
    
        }else if(isset($_POST['ofertas'])){ //Mostrar los productos en oferta
    
            echo Producto::imprimirOferta($base);
        
        }else if(isset($_POST['cocina'])){ //Mostrar los productos relacionados con la cocina
    
            echo Producto::imprimirCocina($base);
            
        }else if(isset($_POST['elec'])){ //Mostrar los productos relacionados con la electrónica
    
            echo Producto::imprimirElec($base);
        
        }else if(isset($_POST['jug'])){ //Mostrar los juguetes
    
            echo Producto::imprimirJuguete($base);
    
        }else if(isset($_POST['ropa'])){ //Mostrar la ropa

            echo Producto::imprimirRopa($base);
            
        }else if(isset($_POST['esc'])){ //Mostrar los esclavos de programación
    
            echo Producto::imprimirEsc($base);

        }else if(isset($_POST['buscar'])){ //Este es el buscador de productos

            $busqueda=$_POST['buscador']; //recojo lo que quiere buscar

            echo Producto::imprimirBusqueda($base, $busqueda);
        }
       
    }
    
    require "../vistas/vistaPrincipal2.php"; //segunda parte de página principal, contiene el footer
    require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body

?>