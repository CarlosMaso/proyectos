<?php
    if(!isset($_SESSION['admin'])){
        header("Location: ../controladores/principal.php");
    }
?>
<div id="barraNuevoAdmin"><h2>Nuevo Usuario</h2></div>
<a href="../vistas/vistaAdmin.php">Volver</a>
<div id="contenedorNuevoAdmin">
    <?php
        echo "
            <form action='nuevoAdmin.php' method='post'>
                <label for='id'>Id Profesor </label><input type='text' name='idProfesor' required><br>
                <br>
                <label for='usuario'>Usuario </label><input type='text' name='usuario' required><br>
                <br>
                <label for='password'>Contraseña </label><input type='text' name='password' required><br>
                <br>
                <button type='submit' name='crear' id='btnNuevoAdmin'> Crear nuevo usuario </button>
            </form>
        ";
    ?>
</div>
<div id="barraFinalNuevo"><img id='logoFooter' src="../../img/logo.png" alt="logo"></div>