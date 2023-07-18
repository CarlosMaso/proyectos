<?php

    session_start();

    require "../config/autocarga.php"; //funcion que carga automaticamente las clases
    require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body
    require "../vistas/vistaDetalle.php"; //muestro el header

    echo "<a href='principal.php'>Volver</a>";
    echo "<br>";

    $idProd=$_GET['idProd']; //recojo el id

    $base= new BaseDatos();
    $producto= new Producto("", "", "", "","", "", "", "");

    $producto->detalle($base, $idProd); //llamo a la función que imprime el detalle

    require "../vistas/vistaPrincipal2.php"; //uso el footer de vista principal porque es lo mismo
    require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body

?>