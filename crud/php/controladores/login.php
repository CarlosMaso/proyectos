<?php
session_start();

    require "../config/autocarga.php";
    require "../vistas/inicio.html";
    
    //instancio las clases
    $base= new BaseDatos();
    $login= new Login("", "","");
    

   // if(isset($_POST['iniciar'])){ //si se ha pulsado el botón de iniciar sesión

        $dataLogin= $login->getAll($base); //recojo el usuario de la Base de Datos

        //Recojo datos
        $usu="Salva";
        $pass="salva";
        
        $existe=0; //variable para determinar si existe o no el usuario/contraseña

        for($i=0; $i<count($dataLogin); $i++){ //Bucle para comparar usuario y contraseña con los de la base de datos

            $passVerify=password_verify($pass, $dataLogin[$i]['password']);

            if($passVerify==true && $dataLogin[$i]['usuario']==$usu) { //si coinciden ambos 

                //guardo las variables de sesión
                $_SESSION['usuario']=$usu; 
                $_SESSION['idProfesor']=$dataLogin[$i]['idProfesor'];

                if($usu=="admin"){ //si es el administrador inicializo la varible que otorga derechos de administrador

                    $_SESSION['admin']="administrador";
                }

                $existe=1;
    
                header("Location:principal.php"); //una vez logeado lo envio a la página principal

            }

        }

        if($existe==0){ //Si no existe el usuario/contraseña
            require "../vistas/formLogin.html";
            echo "<div id='modalPass' class='modal'><p>Error usuario o contraseña incorrectos</p><button type='button' onclick='borrarModal(1)'> Cerrar</button></div>"; //ventana modal
        }
        
   /* }else{ //sino muestro el formulario
       
        require "../vistas/formLogin.html";
    
    }*/
    require "../vistas/final.html";

?>