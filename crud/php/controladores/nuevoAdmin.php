<?php
    session_start();
    require "../config/autocarga.php"; //cargo automaticamente las clases
    require "../vistas/inicio.html";

    if(isset($_SESSION['admin'])){

        $base=new BaseDatos(); //obtengo la conexion

        $login= new Login("", "", "");

        if(isset($_POST['crear'])){ //Si ha pulsado crear, inserto nuevo usuario

            $id= $_POST['idProfesor'];
            $usu= $_POST['usuario'];
            $pass= $_POST['password'];

            $hashPass= $login->hasheador($base, $pass);

            $login->creaLogin($base, $id, $usu, $hashPass);

            header('Location: ../vistas/vistaAdmin.php');

        }else{ //sino muestro form

            require "../vistas/formNuevoAdmin.php";
        }
        
    }else{
        header("Location: principal.php");
    }
    require "../vistas/final.html";
?>