<?php
    session_start();

    require "../config/autocarga.php"; //funcion que carga automaticamente las clases

    require "compruebaCampos.php"; //archivo que tiene las comprovaciones de los campos

    require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body

    if(isset($_POST['registrar'])){

        $base= new BaseDatos();

        $client=new Cliente("", "", "", "", "", "", "", "", "", "");

        //recojo campos
        $nom=$_POST['nom'];
        $ape=$_POST['ape'];
        $edad=$_POST['edad'];
        $dni=$_POST['dni'];
        $usu=$_POST['usu'];
        $pass=$_POST['pass'];
        $confirmPass=$_POST['confirmPass'];
        $mail=$_POST['mail'];
        $tlf=$_POST['tlf'];
        $dirC=$_POST['dirC'];
        $dirE=$_POST['dirE'];

        //los compruebo
        $comprueba[0]=compruebaNom($nom);
        $comprueba[1]=compruebaApe($ape);
        $comprueba[2]=compruebaEdad($edad);
        $comprueba[3]=compruebaDni($dni);
        $comprueba[4]=compruebaUsu($usu);
        $comprueba[5]=compruebaPass($pass, $confirmPass);
        $comprueba[6]=compruebaMail($mail);
        $comprueba[7]=compruebaTlf($tlf);
        $comprueba[8]=compruebaDireccion($dirC);
        $comprueba[9]=compruebaDireccion($dirE);

        //Mensajes que indican lo que está mal
        $arrayVariables[0]="Nombre, debe contener entre 3 y 15 letras (solo letras)";
        $arrayVariables[1]="Apellidos, debe contener entre 3 y 20 letras (solo letras)";
        $arrayVariables[2]="Edad, debe ser entre 0 y 120 años";
        $arrayVariables[3]="DNI incorrecto";
        $arrayVariables[4]="Usuario, campo vacío o usuario ya existente";
        $arrayVariables[5]="Mail, no se ha introducido un formato valido";
        $arrayVariables[6]="Password, no coinciden o se ha introducido algun caracter sospechoso";
        $arrayVariables[7]="Número, teléfono incorrecto";
        $arrayVariables[8]="Dirección, introduzca una dirección valida";
        $arrayVariables[9]="Dirección, introduzca una dirección valida";
 

        $dato="";
        /*compruebo si me ha devuelto false alguna, si lo ha hehco guardo 
        el error y lo imprimo despues junto al resto*/
        for($i=0; $i<count($comprueba); $i++){ 

            if($comprueba[$i]==false){
                $dato.="<p class='rojo'>Error en ".$arrayVariables[$i]."</p><br>"; 
            }
        }

        if(empty($dato)){//Si no hay errores, inserto el nuveo cliente y redirijo a principal

            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            $client->nuevoCliente($base, $dni, $nom, $ape, $edad, $usu, $hashed_password, $mail, $tlf, $dirC, $dirE); //creo nuevo cliente

            //guardo la variable de sesión
            $_SESSION['nombre']=$nom; 
            $_SESSION['dni']=$dni;

            if(isset($_SESSION['idUnico'])){ //compruebo si existe variable de sesión idUnico

                $carrito=new Carrito("","","");

                $carrito->updateLinea($base, $_SESSION['idUnico'], $_SESSION['dni']); //Modifico las lineas donde estaba logueado como anonimo

                Carrito::borrar($base, $_SESSION['idUnico']); //borro al anonimo

                if($_GET['dir']=="confirmar" || $_POST['lugar']=="confirmar"){//Si el usuario viene de confirmar le devuelvo allí

                    header('Location: http://localhost/PHP%20project/php/controladores/confirmar.php');

                }else{

                    header('Location: http://localhost/PHP%20project/php/controladores/principal.php'); //Salto a la página principal
                }
            }

        }else{ //Sino indico al usuario que hay errores y le vuelvo a mostrar el formulario
            echo $dato;
            require "../vistas/formRegistrar.php";
        }

    }else{
        require "../vistas/formRegistrar.php";
    }

    require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body

?>