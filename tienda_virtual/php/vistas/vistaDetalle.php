<!-- ======================================================================= -->
<!--                            CABECERA                                     -->
<!-- ======================================================================= -->
<div id='header'>
    <table>
        <tr>
        <td><a href='../controladores/principal.php'><img id='logoCabecera' src="../../img/logo.png" alt="Amasón"></a></td>

            <td> 
                <div id='barraBuscar'>
                    <input type='search' placeholder='buscar...'><img id='lupa' src='../../img/lupa.png'>
                </div>
            </td>

            <td> 
                <?php
                    require "../config/autocarga.php"; //funcion que carga automaticamente las clases

                    if(isset($_SESSION['nombre'])){
                        echo "<p class='blanco'> Bienvenido ".$_SESSION['nombre']."</p>";
                    }else{
                        echo "<button onclick=redirigeBotones('iniciar')>iniciar sesión</button><button onclick=redirigeBotones('registrar')>registrarse</button>";
                    }
                
                ?>
            </td>

            <td>
            <div id='contendorCarrito'><!-- Este form es para ver el carrito de la compra --> 
                    <form action="../controladores/verCarrito.php" method='post'>
                    <button type='submit' name='comprarPrincipal' id='btnCarrito'><img id='carrito' src="../../img/carrito.png" alt="carrito"></button><br>
                    </form>
                    <p class='blanco'><?php 
                     if(!isset( $_SESSION['total'])){ //si no está inicializada es 0 

                        $base=new BaseDatos();
                        $carrito= new Carrito("","","");

                        if(isset($_SESSION['dni'])){ //si está logueado

                           
                            $arrayCarrito=$carrito->getCarrito($base, $_SESSION['dni']); //recojo datos carrito
                            
                            if($arrayCarrito==null){ //si no hay es 0
                                echo 0;
                            }else{
                                $cantidad=0;

                                for($i=0; $i<count($arrayCarrito); $i++){ //sumo las cantidades
                                    $cantidad.=$arrayCarrito[$i]['cantidad'];
                                }

                                echo $cantidad;
                            }


                        }else if(isset($_SESSION['idUnico'])){

                            $arrayCarrito=$carrito->getCarrito($base, $_SESSION['idUnico']); //recojo datos carrito
                            
                            if($arrayCarrito==null){ //si no hay es 0
                                echo 0;
                            }else{
                                $cantidad=0;

                                for($i=0; $i<count($arrayCarrito); $i++){ //sumo las cantidades
                                    $cantidad.=$arrayCarrito[$i]['cantidad'];
                                }

                                echo $cantidad;
                            }

                            
                        }else{
                            echo 0;
                        }      
                    }else{
                        echo $_SESSION['total']; 
                    }
                    ?></p>
                </div>
            </td>
        </tr>
    </table>
</div>