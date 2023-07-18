<?php

    require "../config/autocarga.php"; //funcion que carga automaticamente las clases   

    $base=new BaseDatos();
    $carrito= new Carrito("","","");

    $idCar=$_GET['idCar'];
    $idProd=$_GET['idProd'];

    $carrito->borrarLinea($base, $idCar, $idProd);
    require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body

?>

<script type='text/javascript'> //este script de aqui es para que haga auto-submit en el form porque tengo que re-pasarle el idCar a verCarrito desde aqui

    window.onload=function(){
        var redirigir= $("#redirigir");
        redirigir.submit();
    }


</script>

<?php
    //imprimo el formulario
    echo "<form id='redirigir' action='verCarrito.php' method='post'>";
    echo "<input type='hidden' name='id' value='$idCar'>";
    echo "<button type='submit'>button</button>";
    echo "</form>";

    require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body
    

?>