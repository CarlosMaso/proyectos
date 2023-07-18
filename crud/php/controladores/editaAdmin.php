<?php
    session_start();

    require "../config/autocarga.php"; //cargo automaticamente las clases
    require "../vistas/inicio.html";

    if(isset($_SESSION['admin'])){
        
        $base=new BaseDatos(); //obtengo la conexion

        $login= new Login("", "", "");

        $usu=$_SESSION['edita'];

        $datosUsuario= Login::getAllUsuario($base, $usu);

        if(isset($_POST['cambiar'])){ //si ha pulsado cambiar, hago update

            $idProf= $_POST['idProfesor'];
            $usuario=$_POST['usuario'];
            $pass=$_POST['password'];

            if($pass==null){
                $hashedPass=$datosUsuario[0]['password'];
            }else{
                $hashedPass=$login->hasheador($base, $pass);
            }

            $login->updateUsuario($base, $idProf, $usuario, $hashedPass);

            header('Location: ../vistas/vistaAdmin.php');

        }else{ //sino muestro form
            require "../vistas/formEditarAdmin.php";
        }

    }else{
        header("Location: principal.php");
    }

    require "../vistas/final.html";
?>  