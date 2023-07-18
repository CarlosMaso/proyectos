<!-- ======================================================================= -->
<!--                            CABECERA                                     -->
<!-- ======================================================================= -->
<div id="header">
    <table>
        <tr>
            <td id='celIzq'><a href='../controladores/principal.php'><img id='logoCabecera' src="../../img/logo.png" alt="Almookwan"></a></td>
            <td id='celCent'><h2 class='blanco'> LIGA INFANTIL</h2></td>
            <td id='celDer'><p class='blanco'>Bienvenido 
            <?php
               echo $_SESSION['usuario']; //variable con el nombre del usuario
            ?>
            <!--</p><form action='../controladores/salir.php' method='post'><button type="submit" name='salir'>Desconectar</button></form></td>-->
        </tr>
    </table>
</div>

<div id='secciones'> <!-- Botones a diferentes secciones -->
    <form action='../controladores/principal.php' method='post'> 
        <button type='submit' name='detalle'>Detalle</button>
        <button type='submit' name='clasificacion'>Clasificación</button> 
        <?php
            if(isset($_SESSION['admin'])){ //si es admin, le dejo acceder a la vista administrador
                echo "<button type='submit' name='admin'> Administrador</button>";
            }
        ?>
    </form>
</div>