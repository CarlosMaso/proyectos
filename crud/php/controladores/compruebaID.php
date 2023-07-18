<?php
session_start();

$oct= $mes->getOct($base); //recojo datos de octubre
$datosBD= $alumno->getAll($base, $_SESSION['idProfesor']); //recojo todos los datos del alumno

var_dump($oct);
echo "<br>";
var_dump($datosBD);

if(count($oct) != count($datosBD)){ //Si no tienen la misma cantidad es porque hay uno o varios que sobran

    for($b=0; $b<count($oct); $b++){ //reviso todo octubre

        $existe=0; //variable que cambia si no existe el id
    
        for($t=0; $t<count($datosBD); $t++){ //Por cada id en la BD
            
            if(intval($oct[$b]['idAlumno'])==$datosBD[$t]['id']){ //Si existe pongo 1
                $existe=1;
            }
        }
    
        if($existe==0){ //Si no existe el id del alumno en la tabla del mes, entonces se borra ese id de todas las tablas
            $idBorrar= $oct[$b]['idAlumno'];
    
            $alumno->borrarDatosOct($base, $idBorrar, $_SESSION['idProfesor']);
            $alumno->borrarDatosNov($base, $idBorrar, $_SESSION['idProfesor']);
            $alumno->borrarDatosDic($base, $idBorrar, $_SESSION['idProfesor']);
            $alumno->borrarDatosEne($base, $idBorrar, $_SESSION['idProfesor']);
            $alumno->borrarDatosFeb($base, $idBorrar, $_SESSION['idProfesor']);
            $alumno->borrarDatosMar($base, $idBorrar, $_SESSION['idProfesor']);
            $alumno->borrarDatosAb($base, $idBorrar, $_SESSION['idProfesor']);
            $alumno->borrarDatosMay($base, $idBorrar, $_SESSION['idProfesor']);
            $alumno->borrarDatosJun($base, $idBorrar, $_SESSION['idProfesor']);

            echo "Borrado el id: $idBorrar";
        }
    
    }
}


?>