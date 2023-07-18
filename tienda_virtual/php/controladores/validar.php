<?php
session_start();
require "../config/autocarga.php";
require "../vistas/inicio.html";

    if(isset($_POST['iniciar'])){

        //inicializo las variables que conectan con las clases
        $base= new BaseDatos();
        $carrito= new Carrito("","","");

        $dataLogin= Cliente::getLogin($base); //recojo datos de login (si es static no hi ha que fer un new cliente pa accedir en teoria)

        //Recojo los datos del formulario
        $usu=$_POST['usu'];
        $pass=$_POST['pass'];
        
        $existe=0; //variable para determinar si existe o no el usuario/contraseña

        for($i=0; $i<count($dataLogin); $i++){ //Bucle para comparar usuario y contraseña con los de la base de datos

            $passVerify=password_verify($pass, $dataLogin[$i]['password']); //comprueboo que la contraseña hasheada coincida con la contraseña de la Base Datos

            if($passVerify==true && $dataLogin[$i]['usuario']==$usu) { //si coinciden ambos 

                //guardo la variable de sesión
                $_SESSION['nombre']=$dataLogin[$i]['nombre']; 
                $_SESSION['dni']=$dataLogin[$i]['dni'];

                $arrayCarrito=$carrito->getCarrito($base, $_SESSION['dni']); //recojo datos carrito
                
                if($arrayCarrito==null){ //si no hay es 0
                    $_SESSION['total']=0;
                   
                }else{
                
                    $cantidad=0;

                    for($i=0; $i<count($arrayCarrito); $i++){ //sumo las cantidades
                        $cantidad+=intval($arrayCarrito[$i]['cantidad']);
                    }

                    $_SESSION['total']= $cantidad;
                }

                $existe=1;

                if(isset($_SESSION['idUnico'])){ //compruebo si existe variable de sesión idUnico

                    $carrito->updateLinea($base, $_SESSION['idUnico'], $_SESSION['dni']); //Modifico las lineas donde estaba logueado como anonimo
                    
                    Carrito::borrar($base, $_SESSION['idUnico']); //borro al anonimo

                    if($_GET['dir']=="confirmar"){//Si el usuario viene de confirmar le devuelvo allí

                        header('Location: http://localhost/PHP%20project/php/controladores/confirmar.php');

                    }else{

                        header('Location: http://localhost/PHP%20project/php/controladores/principal.php'); //Salto a la página principal
                    }
                }

            }

        }

        if($existe==0){ //Si no existe el usuario/contraseña
            echo "<div id='mensajeError'><p><strong>Error!!</strong></p>";
            echo "<p>usuario o contraseña incorrectos</p></div>";
            echo "<br>";
            require "../vistas/formLogin.html";
        }
        
        
    }else{
        require "../vistas/formLogin.html";
    }

require "../vistas/final.html";

//animation that fades out a div in css?



?>
