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
                    if(isset($_SESSION['nombre'])){
                        echo "<p class='blanco'> Bienvenido ".$_SESSION['nombre']."</p>";
                        echo "<form action='../controladores/cerrarSesion.php' method='post'><button type='submit'>salir</button></form>";
                    }else{
                        echo "<button onclick=redirigeBotones('iniciar')>iniciar sesión</button><button onclick=redirigeBotones('registrar')>registrarse</button>";
                    }
                ?>
            </td>
        </tr>
    </table>
</div>
