<div id="contenedorRegistrar">

    <img id='logoRegistrar' src="../../img/logo2.png" alt="Amasón">

    <div id="lineaRegistrar">

        <h1>Crear cuenta</h1>

        <form action="registrarse.php" method="post">
        
            <label for="nom">Nombre: </label><input name="nom" type="text"><br>
            <br>
            <label for="ape">Apellidos: </label><input name="ape" type="text"><br>
            <br>
            <label for="edad">Edad: </label><input name="edad" type="number"><br>
            <br>
            <label for="dni">DNI: </label><input name="dni" type="text"><br>
            <br>
            <label for="usu">Usuario: </label><input name="usu" type="text"><br>
            <br>
            <label for="pass">Contraseña: </label><input name="pass" type="password"><br>
            <br>
            <label for="confirmPass">Repita contraseña: </label><input name="confirmPass" type="password"><br>
            <br>
            <label for="mail">Email: </label><input name="mail" type="email"><br>
            <br>
            <label for="tlf">Teléfono</label><input name="tlf" type="text"><br>
            <br>
            <label for="dir">Dirección de Vivienda: </label><input name="dirC" type="text"><br>
            <br>
            <label for="dir">Dirección de Entrega: </label><input name="dirE" type="text"><br>
            <br>
            <?php
                if(isset($_GET['dir'])){ //si existe

                    if($_GET['dir']=="confirmar"){ //y coincide con que efectivamente, viene de confirmar

                        echo "<input type='hidden' name='lugar' value='confirmar'>"; //mando la clave "confirmar" por hidden
                    }
                }
            ?>
            <button name='registrar' type="submit">Registrar</button>
        </form>

    </div>

    <br>
    <br>
    <div id="centraDiv"><a href="../controladores/principal.php">No quiero registrarme ahora.</a></div>
</div>
