<?php
    session_start();
    require "../config/autocarga.php"; 

    $base=new BaseDatos();
    $alum=new Alumno("","","","","");
    $mes= new Mes("","","","","","","", "");

    $alumnos= $alum->getAll($base, $_SESSION['idProfesor']); //recojo todos los datos de los alumnos

    //Recojo todos los datos de cada mes
    $oct=$mes->getOct($base);
    $nov=$mes->getNov($base);
    $dic=$mes->getDic($base);
    $ene=$mes->getEne($base);
    $feb=$mes->getFeb($base);
    $mar=$mes->getMar($base);
    $ab=$mes->getAb($base);
    $may=$mes->getMay($base);
    $jun=$mes->getJun($base);

    //Monto los datos en un array asociativo
    $datos=array("alumnos"=>$alumnos, "octubre"=>$oct, "noviembre"=>$nov, "diciembre"=>$dic, "enero"=>$ene, "febrero"=>$feb, "marzo"=>$mar, "abril"=>$ab, "mayo"=>$may, "junio"=>$jun);
    echo json_encode($datos); //Devuelvo los datos
?>