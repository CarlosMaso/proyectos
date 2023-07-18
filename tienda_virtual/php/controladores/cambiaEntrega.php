<?php
session_start();

require "../config/autocarga.php"; //funcion que carga automaticamente las clases

require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body


    if(isset($_POST['enviar'])){ //si se ha pulsado

        $base= new BaseDatos();
        $client= new Cliente("", "", "", "", "", "", "", "", "", "");

        $nuevaDir=$_POST['nuevaDir'];
        $dni=$_SESSION['dni'];
        
        if(!empty($nuevaDir)){ //cambio la dirección
            $client->cambiaDirEn($base, $dni, $nuevaDir);

            header('Location: confirmar.php');
        }else{ //si está vacio le advierto de que está vacio y le muestro el form otra vez
            echo "<p class='rojo'>Campo vacío, por favor ingrese una dirección válida</p><br>";

            echo "<div id='contenedorDirEntrega'>

                    <form action='cambiaEntrega.php' method='post'>

                        <label for='nuevaDir'>Nueva dirección de entrega: </label><input type='text' name='nuevaDir'><br>

                        <button type='submit' name='enviar'>Actualizar dirección</button>   
                    </form>
                </div>
            ";
        }
        

    }else{ //Sino muestra form de cambio de dirección
        echo "<div id='contenedorDirEntrega'>

                <form action='cambiaEntrega.php' method='post'>

                    <label for='nuevaDir'>Nueva dirección de entrega: </label><input type='text' name='nuevaDir'><br>

                    <button type='submit' name='enviar'>Actualizar dirección</button>   
                </form>
            </div>
        ";
    }

require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body

?>
