<?php
    session_start(); //llamo a la sesión activa

    if(isset($_POST['salir'])){ //si se ha pulsado salir se destruyen las sesiones y lo envio a login

        session_destroy();
        header('Location: login.php');

    }else{ //si no ha pulsado el botón no debería estar aquí, lo redirijo a principal

        header('Location: principal.php');
    }
  
?>