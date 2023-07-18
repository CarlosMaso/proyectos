<?php
    session_start();
    require "../config/autocarga.php"; //cargo automaticamente las clases

    if(isset($_SESSION['admin'])){

        $base=new BaseDatos(); //obtengo la conexion

        $login= new Login("", "", "");

        if(isset($_POST['nuevo'])){ //Si se ha pulsado nuevo

            header("Location: ./nuevoAdmin.php");

        }

        if(isset($_POST['editar'])){ //Si se ha pulsado editar

            $usu=$_POST['usuario'];

            $_SESSION['edita']= $usu;

            header("Location: ./editaAdmin.php");

        }

        if(isset($_POST['borrar'])){ //si se ha pulsado borrar, borro ese usuario

            $usu=$_POST['usuario'];

            $login->borrarUsuario($base, $usu);

            header("Location: ../vistas/vistaAdmin.php"); //vuelvo a vista admin
        }
    }else{
        header("Location: principal.php");
    }

?>