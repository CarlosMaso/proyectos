<?php

    session_start();

    require "../config/autocarga.php"; //incluyo las clases

    $base= new BaseDatos();

    $alumnos=new Alumno("","","","", "");

    $datosAlumnos= $alumnos->getAll($base, $_SESSION['idProfesor']); //recojo todos los datos de los alumnos

    $anio=[];

    $datos=[];

    for($i=0; $i<count($datosAlumnos); $i++){ //meto los años en un array
        array_push($anio, $datosAlumnos[$i]["any"]);
    }

    $anios=array_unique($anio); //elimino repetidos

    sort($anios); //los ordeno

    for($j=0; $j<count($anios); $j++){ //por cada año recojo la tabla de classificación con los alumnos ordenados por puntos de mayor a menor

        $tabla=$alumnos->getAlumneAniosClass($base->base, $anios[$j], $_SESSION['idProfesor']);
        array_push($datos, $tabla);
    }

    echo json_encode($datos); //Le paso los datos al metodo de javascript que lo ha llamado


?>