<?php
    session_start();
    require "../config/autocarga.php";

    $tablaNueva=$_POST["data"];//recojo los datos de las tablas

    $base= new BaseDatos();
    $alumno=new Alumno("", "", "", "", "");
    $mes= new Mes("", "", "", "","", "", "", "");

    $anios=[];//array años

    for($i=0; $i<count($tablaNueva); $i++){ 

        if(intval($tablaNueva[$i])>1000){//Si es mayor que mil metelo en anos

            $anios[]=$tablaNueva[$i];
        }
    }

    sort($anios); //Los ordena de menor a menor en caso de que estén desordenados

    $marcadores=[];

    for($l=0; $l<count($anios); $l++){ //por cada año

        for($p=0; $p<count($tablaNueva); $p++){ //por cada elemento dentro de la tabla 0

            if($anios[$l]==intval($tablaNueva[$p])){ //Si el año coincide con el año de la tabla

                array_push($marcadores, $p); //Meteme en este array los marcadores de donde están
                
            }
        } 
    }

    array_push($marcadores, (count($tablaNueva)-1)); //meto el ultimo marcador

    //Instancio la estructura del array que contiene TODO (arrayInsertar)
    for($a=0; $a<count($anios); $a++){
        $arrayInsertar[$anios[$a]]=[];
    }

    $t=1; //contador para las tablas

    $a=0; //contador para los años
        
    $n=0; //contador de posición de nombres
        
    $noms=[]; //array que contiene nombres de las tablas

    for($i=0; $i<count($anios); $i++){ //Lleno array
        
        for($m=$marcadores[$t-1]; $m<=$marcadores[$t]; $m++){

            if(strlen($tablaNueva[$m])>4){ //Si es un nombre 

                $v=$anios[$a]; //contador de años

                $arrayInsertar[$v][$n]=[$tablaNueva[$m]=>["puntos"=>array()]]; //lo meto en el array

                array_push($noms,$tablaNueva[$m]); //guardo los nombres en el array noms
                
                $bef=$m;
                $sig=$m+16; //número de posiciones en el array que corresponde a puntos
    
                //for($h=0; $h<3; $h++){ //por cada trimestre
                    
                    for($p=$bef; $p<$sig; $p++){ //mete los puntos al nombre
    
                        if(strlen($tablaNueva[$p])<4){ //si es menor de 4 cifras es seguro un punto

                            array_push($arrayInsertar[$v][$n][$tablaNueva[$m]]["puntos"], $tablaNueva[$p]); //metemelo en puntos
                        }
                    }   

                    for($num=0; $num<30; $num++){ //en los siguientes 2 trimestres todo serán ceros porque es la creacion de una tabla que se mostrará luego como una normal
                        array_push($arrayInsertar[$v][$n][$tablaNueva[$m]]["puntos"], "0");
                    }
                //}
                $n++;
           
            }
        }
            //incremento los contadores de tablas y años
            $t++;
            $a++;

    }

// ============ INSERTA ========== 

//Comprobación especial de la posicón 0 (que si no se hace así no se inserta)-----------------------------------------------------------------------------------------------------

$existe=false;

$compruebaNombres=$alumno->getNombres($base, $_SESSION['idProfesor']);

for($v=0; $v<count($compruebaNombres); $v++){
    if($compruebaNombres[$v]['nom']==$noms[0]){
        $existe=true;
    }
}
if($existe===false){
    
    $totalAnualInsert=0; //varibale que contendrá el valor del total anual del insert

    $maxId=$alumno->searchMaxID($base);//busco el maximo id en la bd

    $id=$maxId[0]["id"]+1; //le sumo 1 al maximo id 
    
    
    $any=""; //variable que contendrá el año

    $cont=""; //variable que contendrá la posición del nombre

    $p=0; //variable continua, dentro del arrayInsertar los nombres están en diferentes años pero la posición es continua ej: 2009=>1,2, 2010=>3,4, 2011=>5,6 

    for($j=0; $j<count($anios); $j++){ //por cada año

        for($c=0; $c<count($arrayInsertar[$anios[$j]]); $c++){ //por la cantidad de cosas que haya en cada año

            if(array_key_exists($noms[0],$arrayInsertar[$anios[$j]][$p])){ //Si existe la clave "nombre Alumno" en el array
                    $any=$anios[$j];
                    $cont=$p;
            }
            $p++;
        }
    }

    $newAlum= new Alumno($noms[0], $any, $id, "0", $_SESSION['idProfesor']);


    $newAlum->insertaIDmeses($base, $id, $_SESSION['idProfesor']); //meto al alumno en todos los meses

    for($v=0; $v<9; $v++){ //modifico los valores default de los meses por los correctos

        switch ($v) {
            case '0': //Octubre

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][0]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][1]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][2]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][3]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][4]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;

                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                echo "$id, $kicho, $destreza, $salto, $combate, $extra, $totalMes".$_SESSION['idProfesor']."<br>";

                $mes->modificarOct($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;

            case '1': //Noviembre

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][5]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][6]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][7]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][8]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][9]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                $mes->modificarNov($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;

            case '2': //Diciembre

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][10]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][11]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][12]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][13]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][14]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                $mes->modificarDic($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;

            case '3': //Enero

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][15]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][16]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][17]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][18]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][19]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                $mes->modificarEne($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;

            case '4': //Febrero

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][20]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][21]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][22]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][23]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][24]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                $mes-> modificarFeb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;

            case '5': //Marzo

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][25]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][26]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][27]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][28]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][29]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                $mes->modificarMar($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;

            case '6': //Abril

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][30]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][31]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][32]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][33]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][34]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                $mes->modificarAb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;

            case '7': //Mayo

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][35]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][36]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][37]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][38]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][39]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                $mes->modificarMay($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;

            case '8': //Junio

                //pongo el valor en las variables
                $kicho=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][40]);
                $destreza=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][41]);
                $salto=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][42]);
                $combate=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][43]);
                $extra=intval($arrayInsertar[$any][$cont][$noms[0]]['puntos'][44]);

                $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                $mes->modificarJun($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                break;
        }
    }

   $newAlum->insertaTemporal($base, $totalAnualInsert); //inserto alumno ----!!!!! <o>

}

//INSERTA NORMAL
    for($i=1; $i<count($noms); $i++){

            $totalAnualInsert=0; //varibale que contendrá el valor del total anual del insert

            $maxId=$alumno->temporalMaxID($base);//busco el maximo id en la bd

            $id=$maxId[0]["id"]+1; //le sumo 1 al maximo id 

            $any=""; //variable que contendrá el año

            $cont=""; //variable que contendrá la posición del nombre
    
            $p=0; //variable continua, dentro del arrayInsertar los nombres están en diferentes años pero la posición es continua ej: 2009=>1,2, 2010=>3,4, 2011=>5,6 
    
            for($j=0; $j<count($anios); $j++){ //por cada año
    
                for($c=0; $c<count($arrayInsertar[$anios[$j]]); $c++){ //por la cantidad de cosas que haya en cada año

                    if(array_key_exists($noms[$i],$arrayInsertar[$anios[$j]][$p])){ //Si existe la clave "nombre Alumno" en el array
                            $any=$anios[$j];
                            $cont=$p;
                    }
                    $p++;
                }
            }

            $newAlum= new Alumno($noms[$i], $any, $id, "0", $_SESSION['idProfesor']); 

            $newAlum->insertaIDmeses($base, $id, $_SESSION['idProfesor']); //meto al alumno en todos los meses


            for($v=0; $v<9; $v++){ //modifico los valores default de los meses por los correctos

                switch ($v) {
                    case '0': //Octubre

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][0]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][1]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][2]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][3]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][4]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;

                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarOct($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '1': //Noviembre

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][5]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][6]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][7]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][8]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][9]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarNov($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '2': //Diciembre

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][10]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][11]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][12]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][13]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][14]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarDic($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '3': //Enero

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][15]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][16]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][17]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][18]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][19]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarEne($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '4': //Febrero

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][20]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][21]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][22]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][23]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][24]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes-> modificarFeb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '5': //Marzo

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][25]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][26]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][27]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][28]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][29]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarMar($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '6': //Abril

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][30]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][31]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][32]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][33]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][34]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarAb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '7': //Mayo

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][35]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][36]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][37]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][38]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][39]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarMay($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '8': //Junio

                        //pongo el valor en las variables
                        $kicho=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][40]);
                        $destreza=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][41]);
                        $salto=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][42]);
                        $combate=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][43]);
                        $extra=intval($arrayInsertar[$any][$cont][$noms[$i]]['puntos'][44]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarJun($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;
                }
            }
            $newAlum->insertaTemporal($base, $totalAnualInsert); //inserto alumno
    }

    $alumnosNuevos= new Alumno ("", "", "", "", $_SESSION['idProfesor']);

    $alumnosNuevos->temporalAlumnos($base); //traslado alumnos de temporal a la tabla real

    $alumnosNuevos->limpiaTemporal($base); //borro temporal

    require "compruebaID.php";

?>