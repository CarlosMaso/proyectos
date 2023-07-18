<?php
    session_start();
    require "../config/autocarga.php";
    require "../vistas/inicio.html";

    $base= new BaseDatos();
    $login= new Login("", "", "");
    
    if(isset($_POST['enviar'])){ //si se ha pulsado enviar 

        $dataLogin= $login->getID($base);//recojo los id de la Base de Datos

        $id=$_POST['id']; //recojo el input del formulario

        $_SESSION['cambiaPass']=$id; //lo meto en una variable de sesion para poder usarlo en cambiaPass.php

        $existe=0; //variable que cambia en caso de que coincidan ambos id

        for($i=0; $i<count($dataLogin); $i++){ //por todos los id que haya

            if($id == $dataLogin[$i]['idProfesor']){ //si son iguales 

                $existe=1;

                header('Location: cambiaPass.php');
                
            }
        }

        if($existe==0){ //si el id no coincide con ninguno de los de la Base de Datos

            require "../vistas/recuperarForm.html"; //Muestro error y formulario
            echo "<div id='modalRecu' class='modal'><p>Error identificación incorrecta</p><button type='button' onclick='borrarModal(2)'> Cerrar</button></div>"; //ventana modal
        }
        
    }else{ //sino muestro formulario
        require "../vistas/recuperarForm.html";
    }

    require "../vistas/final.html";

?>