<?php
    session_start();

   require "../config/autocarga.php"; //funcion que carga automaticamente las clases

    //inicializo clases
    $base= new BaseDatos();
    $carrito= new Carrito("", "","");

   //recojo datos
   $ide=$_POST['ide'];
   $seccion=$_POST['seccion'];

   if(isset($_SESSION['dni'])){ //si se ha logueado

        $idCar=$_SESSION['dni'];

   }else if($_SESSION['idUnico']){ //sino, cojo el id anonimo

        $idCar=$_SESSION['idUnico'];

   }  

   $carrito->insertaLinea($base, $idCar, $ide, 1); //inserto nueva linea en el carrito
   $_SESSION['total']= $_SESSION['total']+1;
   
   require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body

?>

<script type='text/javascript'> //este script de aqui es para que haga auto-submit en el form  (para pasarle la seccion)

    window.onload=function(){
        var redirigir= $("#redirigir");
        redirigir.submit();
    }
</script>

<?php
    echo "<form action='principal.php' method='post' id='redirigir'>";
    echo "<input type='hidden' name='$seccion' value='$seccion'>";
    echo "<button type='submit'>enviar</button>";
    echo "</form>";

    require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body
?>