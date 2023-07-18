<?php
    session_start(); //inicio sesión
    require "../config/autocarga.php";
    require "../vistas/inicio.html";

    $base= new BaseDatos();
    $login= new Login("", "", "");

    $id=$_SESSION['cambiaPass']; //recojo la contraseña a cambiar

    if(isset($_POST['nueva'])){ //si se ha introducido una nueva contraseña

        $pass=$_POST['pass'];

        $newPass= $login->hasheador($base, $pass); //la hasheo

        $login->cambiaContrasenya($base, $id, $newPass);//cambio la contraseña

        header('Location: login.php'); //vuelvo a principal

    }else{ //sino muestro form
        echo "
            <div id='barraRecuperar'><h2>Cambiar Contraseña</h2></div>
            <a href='../controladores/login.php'>cancelar</a>
            <div id='formCambiaPass'>
                <form action='cambiaPass.php' method='post'>
                    <label for='nueva'> Nueva contraseña </label> <input type='password' name='pass' required><br>
                    <br>
                    <button type='submit' name='nueva'>cambiar</button>
                </form> 
            </div>
            <div id='barraFinalRecuperar'><img id='logoFooter' src='../../img/logo.png' alt='logo'></div>
        ";
    }

require "../vistas/final.html";

?>