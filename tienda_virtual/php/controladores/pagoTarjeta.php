<?php
  session_start(); //cargo la sesión
   
  require "../config/autocarga.php"; //funcion que carga automaticamente las clases

  require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body

    if(isset($_POST['ingresar'])){ //informo que el pago es por transferencia

        $_SESSION['pago']="pagado";

        header("Location: confirmar.php");

        
        
    }else{
        require "../vistas/vistaPago.php"; //para que ingrese (de forma falsa) los datos de su tarjeta
    }

require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body
?>