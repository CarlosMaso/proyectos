<?php
    session_start(); //inicio sesion

    if(isset($_SESSION['usuario'])){ //si se ha logeado

        require "../vistas/inicio.html";
        require "../vistas/header.php";

        if(isset($_POST['clasificacion'])){ //si se ha pulsado el botón clasificación

            require "../vistas/vistaClasificacion.php";

        }else if(isset($_POST['admin'])){ //Si es administrador

            header("Location: ../vistas/vistaAdmin.php");

        }else{ //Si no se ha pulsado nada o ha pulsado detalle muestro detalle

            require "../vistas/vistaDetalle.php";

        }
        require "../vistas/footer.html";
        require "../vistas/final.html";

    }else{

        header('Location: login.php'); //si no se ha logeado lo mando al login
    }



?>