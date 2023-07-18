<!-- ======================================================================= -->
<!--                            CABECERA                                     -->
<!-- ======================================================================= -->
<div id='header'>
    <table>
        <tr>
            <td><a href='../controladores/principal.php'><img id='logoCabecera' src="../../img/logo.png" alt="Amasón"></a></td>

            <td> 
                <form action='principal.php' method='post' id='barraBuscar'> 
                    <input type='search' placeholder='buscar...' name='buscador'><button type='submit' name='buscar' id='buscar'><img id='lupa' src='../../img/lupa.png'></button>
                </form>
            </td>

            <td> 
                <?php
                    if(isset($_SESSION['nombre'])){
                        echo "<p class='blanco'> Bienvenido ".$_SESSION['nombre']."</p>";
                        echo "<form action='../controladores/cerrarSesion.php' method='post'><button type='submit'>salir</button></form>";
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
                    <p class='blanco'>
                    <?php 

                        $base=new BaseDatos();
                        $carrito= new Carrito("","","");

                        if(isset($_SESSION['total'])){ //si no está inicializada es 0 

                            if(isset($_SESSION['dni'])){ //si está logueado

                                $arrayCarrito=$carrito->getCarrito($base, $_SESSION['dni']); //recojo datos carrito
                                
                                if($arrayCarrito==null){ //si está vacio es 0

                                    $_SESSION['total']= 0;
                                    echo $_SESSION['total']; 

                                }else{ //Si tiene cosas
                                    $cantidad=0;

                                    for($i=0; $i<count($arrayCarrito); $i++){ //sumo las cantidades
                                        $cantidad+=intval($arrayCarrito[$i]['cantidad']);
                                    }

                                    $_SESSION['total']= $cantidad; //sumo la cantidad a la variable

                                    echo $_SESSION['total']; //imprimo
                                }
                                
                            }else{
                                
                                if(isset($_SESSION['idUnico'])){ //si es anonimo

                                    $arrayCarrito=$carrito->getCarrito($base, $_SESSION['idUnico']); //recojo datos carrito
                                
                                    if($arrayCarrito==null){ //si no hay es 0
                                        $_SESSION['total']= 0;
                                        echo $_SESSION['total']; 

                                    }else{ //si tiene cosaS
                                        $cantidad=0;

                                        for($i=0; $i<count($arrayCarrito); $i++){ //sumo las cantidades
                                            $cantidad+=intval($arrayCarrito[$i]['cantidad']);
                                        }

                                        $_SESSION['total']= $cantidad;
                                        echo $_SESSION['total']; //imprimo
                                    } 
                                }
                            }
                        }else{ //si no está inicializada la sesion total entonces 0
                            echo 0;
                        }
                    ?></p>
                </div>
            </td>
        </tr>
    </table>
</div>
<!-- ======================================================================= -->
<!--                             CUERPO                                      -->
<!-- ======================================================================= -->

<audio controls autoplay>
    <source src="../../music/bossa.mp3" type="audio/mp3">
        Tu navegador no soporta audio HTML5.
</audio>

<div id='secciones'>
    <form action='principal.php' method='post'> 
        <button type='submit' name='todo'>Todo</button>
        <button type='submit' name='masVendidos'>Los más vendidos</button> 
        <button type='submit' name='ofertas'>Ofertas</button>
        <button type='submit' name='cocina'>Cocina</button>
        <button type='submit' name='elec'>Electrónica</button>
        <button type='submit' name='jug'>Juguetes</button>
        <button type='submit' name='ropa'>Ropa</button>
        <button type='submit' name='esc'>Esclavos</button>
    </form>
</div>
