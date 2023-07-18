<?php
    session_start();
    require "../vistas/inicio.html";
    require "../vistas/header.php";

    if(!isset($_SESSION['admin'])){
        header("Location: ../controladores/principal.php");
    }
?>
<form action="../controladores/gestionAdmin.php" method='POST' id='nuevoAdmin'>
    <button type='submit' name='nuevo'>Nuevo</button>
</form>

<?php
    require "../config/autocarga.php"; //cargo automaticamente las clases

    $base=new BaseDatos(); //obtengo la conexion

    $dataLogin= Login::getAllMostrar($base); //recojo todos los datos del login


    if($dataLogin !=null){ //si no está vacio muestra los usuarios

        echo "<table id='tablaAdmin'>";
        echo "<tr><th class='yellow'>Id Profesor</th><th class='yellow'>Usuario</th><th class='any'>Operaciones</th></tr>";
        
    
        for($i=0; $i<count($dataLogin); $i++){ //creo un crud con los datos, los botones son un form que dirigirá a gestionAdmin.php
            echo "<tr>
                    <td>".$dataLogin[$i]['idProfesor']."</td><td>".$dataLogin[$i]['usuario']."</td>
                    <td><form action='../controladores/gestionAdmin.php' method='post'>
                    <input type='hidden' name='usuario' value='".$dataLogin[$i]['usuario']."'>
                    <button type='submit' name='editar' id='btnEdit'>Editar</button>
                    <button type='submit' name='borrar' id='btnRojo'>Borrar</button>
                    </form></td>
                </tr>";
        }
    
        echo "</table>";

    }else{
        echo "No hay usuarios en la base de datos";
    }

    require "../vistas/footer.html";
    require "../vistas/final.html";

?>



