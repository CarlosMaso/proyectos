<?php
    if(!isset($_SESSION['admin'])){
        header("Location: ../controladores/principal.php");
    }
?>
<div id="barraEditar"><h2>Editar Usuario</h2></div>
<a href="../vistas/vistaAdmin.php">Volver</a>
<div id="contenedorEditar">
    <?php
        echo "
            <form action='editaAdmin.php' method='post'>
                <label for='id'>Id Profesor </label><input type='text' name='idProfesor' value='".$datosUsuario[0]['idProfesor']."'><br>
                <br>
                <label for='usuario'>Usuario </label><input type='text' name='usuario' value='".$datosUsuario[0]['usuario']."'><br>
                <br>
                <label for='password'>Contraseña </label><input type='text' name='password' placeholder='nueva o no pongas nada''><br>
                <br>
                <button type='submit' name='cambiar' id='btnCambiar'> Guardar cambios</button>
            </form>
        ";
    ?>
</div>
<div id="barraFinalEditar"><img id='logoFooter' src="../../img/logo.png" alt="logo"></div>