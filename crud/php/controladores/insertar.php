<?php

    session_start();

    require "../config/autocarga.php";

    $tablas=$_POST["data"]; //recojo los datos de las tablas

        //print_r("insertar");
        //print_r($tablas);

    $base= new BaseDatos();
    $alumno=new Alumno("", "", "", "", "");
    $mes= new Mes("", "", "", "","", "", "", "");

    $anios=[]; //array años

    for($i=0; $i<count($tablas[0]); $i++){ //meto los años en un array

        if(intval($tablas[0][$i])>1000){ //si es un año
            $anios[]=$tablas[0][$i];
        }
    }

    sort($anios); //los ordeno en caso de estar desordenados


    $marcadores=[]; //marcadores que marcan la posición de los años dentro del array tablas 

    for($i=0; $i<count($anios); $i++){ //por cada año
    
        for($j=0; $j<count($tablas[0]); $j++){ //por cada elemento dentro de la tabla 0
    
            if($anios[$i]==intval($tablas[0][$j])){ //Si el año coincide con el año de la tabla
    
                array_push($marcadores, $j); //Meteme en este array los marcadores de donde están
                
            }
        } 
    }
    
    array_push($marcadores, count($tablas[0])); //meto el ultimo marcador
    

    //Instancio la estructura del array que contiene TODO (arrayTrim)
    for($i=0; $i<count($anios); $i++){
        $arrayTrim[$anios[$i]]=[];
    }

    $t=1; //contador para las tablas

    $a=0; //contador para los años
    
    $n=0; //contador de posición de nombres
    
    $noms=[]; //array que contiene nombres de las tablas
    
    //Lleno arrayTrim
    for($i=0; $i<count($anios); $i++){ //por cada año
        
        for($m=$marcadores[$t-1]; $m<$marcadores[$t]; $m++){ //desde el anterior marcador al siguiente marcador
    
            if(strlen($tablas[0][$m])>4){ //Si es un nombre 
    
                $v=$anios[$a]; //contador de años simplificado en una variable para no liar el codigo
    
                $arrayTrim[$v][$n]=[$tablas[0][$m]=>["puntos"=>array()]]; //lo meto en el array
    
                array_push($noms, $tablas[0][$m]); //guardo los nombres en el array noms
    
                $bef=$m;
                $sig=$m+16; //número de posiciones en el array que corresponde a puntos
    
                for($h=0; $h<3; $h++){ //por cada trimestre
                    
                    for($p=$bef; $p<$sig; $p++){ //mete los puntos al nombre

                        if(strlen($tablas[$h][$p])<4){ //si es menor de 4 cifras es seguro un punto
            
                            array_push($arrayTrim[$v][$n][$tablas[0][$m]]["puntos"], $tablas[$h][$p]); //metemelo en puntos
                        }
                    }   
                }
                $n++;
            }
       
        }
        if($a<count($anios)-1){ //Le pongo +1 al contador de años
            $a++;
        }
        
        if($t<count($anios)){ //le pongo +1 al contador de marcadores 
            $t++;
        }
    }

 //================================================================================================================================================================

    $nomsBD=$alumno->getNombres($base, $_SESSION['idProfesor']);//Array que guardará los nombres que haya en la Base de Datos

    $totalMes=0; // variable dinamica que recogerá el total de cada mes para insertarlo en las tablas de la Base de Datos

    for($i=1; $i<count($noms); $i++){ //UPDATE-INSERT-DELETE!!!

        $busqueda=0; //inicializo a cero

        for($v=0; $v<count($nomsBD); $v++){ //si está en esta lista es update, sino insert

            if($noms[$i]==$nomsBD[$v]["nom"]){
                $busqueda=1;
            }
        }

        $any=""; //variable que contendrá el año

        $cont=""; //variable que contendrá la posición del nombre

        $p=0; //variable continua, dentro del arrayTrim los nombres están en diferentes años pero la posición es continua ej: 2009=>1,2, 2010=>3,4, 2011=>5,6 

        for($j=0; $j<count($anios); $j++){ //por cada año

            for($c=0; $c<count($arrayTrim[$anios[$j]]); $c++){ //por la cantidad de cosas que haya en cada año

                if(array_key_exists($noms[$i],$arrayTrim[$anios[$j]][$p])){ //Si existe la clave "nombre Alumno" en el array
                        $any=$anios[$j];
                        $cont=$p;
                }
                $p++;
            }
        }

        //==== UPDATE =======================================================================================================================================
        if($busqueda==1){ 

            $getId=$alumno->searchID($base, $noms[$i]); //Busco el id (para actualizarlo con los puntos de cada mes)

            $id=$getId[0]['id'];

            $totalAnualUpdate=0; //variable que contiene el total anual del update

            for($v=0; $v<9; $v++){ //una iteración por cada mes de la liga

                switch ($v) {
                    case '0': //Octubre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][0]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][1]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][2]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][3]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][4]);

                        //Calculo el total del mes
                        $totalOct= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes->modificarOct($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalOct, $_SESSION['idProfesor']); //llamo a la funcion que realiza el UPDATE
                        break;
        
                    case '1': //Noviembre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][5]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][6]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][7]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][8]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][9]);

                        //Calculo el total del mes
                        $totalNov= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes->modificarNov($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalNov, $_SESSION['idProfesor']);
                        break;

                    case '2': //Diciembre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][10]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][11]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][12]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][13]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][14]);

                        //Calculo el total del mes
                        $totalDic= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes->modificarDic($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalDic, $_SESSION['idProfesor']);
                        break;

                    case '3': //Enero

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][15]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][16]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][17]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][18]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][19]);

                        //Calculo el total del mes
                        $totalEne= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes->modificarEne($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalEne, $_SESSION['idProfesor']);
                        break;

                    case '4': //Febrero

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][20]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][21]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][22]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][23]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][24]);

                        //Calculo el total del mes
                        $totalFeb= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes-> modificarFeb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalFeb, $_SESSION['idProfesor']);
                        break;

                    case '5': //Marzo

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][25]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][26]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][27]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][28]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][29]);

                        //Calculo el total del mes
                        $totalMar= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes->modificarMar($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMar, $_SESSION['idProfesor']);
                        break;

                    case '6': //Abril

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][30]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][31]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][32]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][33]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][34]);

                        //Calculo el total del mes
                        $totalAb= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes->modificarAb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalAb, $_SESSION['idProfesor']);
                        break;

                    case '7': //Mayo

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][35]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][36]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][37]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][38]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][39]);

                        //Calculo el total del mes
                        $totalMay= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes->modificarMay($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMay, $_SESSION['idProfesor']);
                        break;

                    case '8': //Junio

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][40]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][41]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][42]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][43]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][44]);

                        //Calculo el total del mes
                        $totalJun= $kicho+$destreza+$salto+$combate+$extra;

                        $resultado=$mes->modificarJun($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalJun, $_SESSION['idProfesor']);
                        break;
                }
            }
            //Sumo todos los meses para tener el total anual
            $totalAnualUpdate= $totalOct+$totalNov+$totalDic+$totalEne+$totalFeb+$totalMar+$totalAb+$totalMay+$totalJun;

            //En alumnos está el "Total Final" esta funcion le añade ese total Anual al alumno en cuestión
            $alumno->insertaFinal($base, $id, $totalAnualUpdate); 

        // ============ INSERTA ==================================================================================================================================
        }else if($busqueda==0){  

            $v=1; //contador para marcadores

            $totalAnualInsert=0; //varibale que contendrá el valor del total anual del insert

            $maxId=$alumno->searchMaxID($base);//busco el maximo id en la bd
            $id=$maxId[0]["id"]+1; //le sumo 1 al maximo id 

            $newAlum= new Alumno($noms[$i], $any, $id, "0", $_SESSION['idProfesor']); 
        
            $newAlum->insertaAlumno($base); //inserto alumno

            $newAlum->insertaIDmeses($base, $id, $_SESSION['idProfesor']); //meto al alumno en todos los meses


            for($v=0; $v<9; $v++){ //modifico los valores default de los meses por los correctos

                switch ($v) {
                    case '0': //Octubre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][0]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][1]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][2]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][3]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][4]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;

                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarOct($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '1': //Noviembre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][5]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][6]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][7]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][8]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][9]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarNov($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '2': //Diciembre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][10]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][11]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][12]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][13]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][14]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarDic($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '3': //Enero

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][15]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][16]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][17]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][18]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][19]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarEne($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '4': //Febrero

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][20]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][21]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][22]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][23]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][24]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes-> modificarFeb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '5': //Marzo

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][25]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][26]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][27]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][28]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][29]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarMar($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '6': //Abril

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][30]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][31]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][32]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][33]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][34]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarAb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '7': //Mayo

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][35]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][36]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][37]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][38]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][39]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarMay($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '8': //Junio

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][40]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][41]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][42]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][43]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[$i]]['puntos'][44]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsert=$totalAnualInsert+$totalMes; //Añado al total anual

                        $mes->modificarJun($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;
                }
            }

            $newAlum->insertaFinal($base, $id, $totalAnualInsert);
        }
    }

    //========= Comprobación especial de Insert/Update =================

    $existeInserta=0; //variable para comprobar posición 0

    for($v=0; $v<count($nomsBD); $v++){//Este bucle es para comprobar la posición cero, porque con el array_search si te devuelve 0 lo entiende como false/null

        if($noms[0]==$nomsBD[$v]['nom']){
            $existeInserta=1;
        }
    }
    //Hacemos la comprobación solo para la posición 0
    if($existeInserta===1){

        $totalAnualUpdateEsp=0; //Variable que contiene el valor anual del update especial

        $getId=$alumno->searchID($base, $noms[0]); //Busco el id (para actualizarlo con los puntos de cada mes)

        $id=$getId[0]['id'];

        $any=""; //variable que contendrá el año

            $cont=""; //variable que contendrá la posición del nombre

            $p=0; //variable continua, dentro del arrayTrim los nombres están en diferentes años pero la posición es continua ej: 2009=>1,2, 2010=>3,4, 2011=>5,6 

            for($j=0; $j<count($anios); $j++){ //por cada año
    
                for($c=0; $c<count($arrayTrim[$anios[$j]]); $c++){ //por la cantidad de cosas que haya en cada año
    
                    if(array_key_exists($noms[0],$arrayTrim[$anios[$j]][$p])){ //Si existe la clave "nombre Alumno" en el array
                        $any=$anios[$j];
                        $cont=$p;
                    }
                    $p++;
                }
            }

        for($v=0; $v<9; $v++){ //una iteración por cada mes de la liga

            switch ($v) {
                case '0': //Octubre

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][0]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][1]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][2]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][3]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][4]);

                    //Calculo el total del mes
                    $totalOct= $kicho+$destreza+$salto+$combate+$extra;

                    $resultado=$mes->modificarOct($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalOct, $_SESSION['idProfesor']); //llamo a la funcion que realiza el UPDATE
                    break;
    
                case '1': //Noviembre

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][5]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][6]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][7]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][8]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][9]);

                    //Calculo el total del mes
                    $totalNov= $kicho+$destreza+$salto+$combate+$extra;

                    $resultado=$mes->modificarNov($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalNov, $_SESSION['idProfesor']);
                    break;

                case '2': //Diciembre

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][10]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][11]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][12]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][13]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][14]);

                    //Calculo el total del mes
                    $totalDic= $kicho+$destreza+$salto+$combate+$extra;

                    $resultado=$mes->modificarDic($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalDic, $_SESSION['idProfesor']);
                    break;

                case '3': //Enero

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][15]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][16]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][17]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][18]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][19]);

                    //Calculo el total del mes
                    $totalEne= $kicho+$destreza+$salto+$combate+$extra;

                    $resultado=$mes->modificarEne($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalEne, $_SESSION['idProfesor']);
                    break;

                case '4': //Febrero

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][20]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][21]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][22]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][23]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][24]);

                    //Calculo el total del mes
                    $totalFeb= $kicho+$destreza+$salto+$combate+$extra;

                    $resultado=$mes-> modificarFeb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalFeb, $_SESSION['idProfesor']);
                    break;

                case '5': //Marzo

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][25]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][26]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][27]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][28]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][29]);

                //Calculo el total del mes
                $totalMar= $kicho+$destreza+$salto+$combate+$extra;

                $resultado=$mes->modificarMar($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMar, $_SESSION['idProfesor']);
                    break;

                case '6': //Abril

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][30]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][31]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][32]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][33]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][34]);

                    //Calculo el total del mes
                    $totalAb= $kicho+$destreza+$salto+$combate+$extra;

                    $resultado=$mes->modificarAb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalAb, $_SESSION['idProfesor']);
                    break;

                case '7': //Mayo

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][35]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][36]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][37]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][38]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][39]);

                    //Calculo el total del mes
                    $totalMay= $kicho+$destreza+$salto+$combate+$extra;

                    $resultado=$mes->modificarMay($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMay, $_SESSION['idProfesor']);
                    break;

                case '8': //Junio

                    //pongo el valor en las variables
                    $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][40]);
                    $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][41]);
                    $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][42]);
                    $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][43]);
                    $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][44]);

                    //Calculo el total del mes
                    $totalJun= $kicho+$destreza+$salto+$combate+$extra;

                    $resultado=$mes->modificarJun($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalJun, $_SESSION['idProfesor']);
                    break;
            }
        }
        //Sumo todos los meses para tener el total anual
        $totalAnualUpdateEsp= $totalOct+$totalNov+$totalDic+$totalEne+$totalFeb+$totalMar+$totalAb+$totalMay+$totalJun;

        //En alumnos está el "Total Final" esta funcion le añade ese total Anual al alumno en cuestión
        $alumno->insertaFinal($base, $id, $totalAnualUpdateEsp); 


    }else if($existeInserta===0){

            $totalAnualInsertEsp=0; //Variable que contiene el valor anual del insert especial

            $maxId=$alumno->searchMaxID($base);//busco el maximo id en la bd
            $id=$maxId[0]["id"]+1; //le sumo 1 al maximo id 

            $any=""; //variable que contendrá el año

            $cont=""; //variable que contendrá la posición del nombre

            $p=0; //variable continua, dentro del arrayTrim los nombres están en diferentes años pero la posición es continua ej: 2009=>1,2, 2010=>3,4, 2011=>5,6 

            for($j=0; $j<count($anios); $j++){ //por cada año
    
                for($c=0; $c<count($arrayTrim[$anios[$j]]); $c++){ //por la cantidad de cosas que haya en cada año
    
                    if(array_key_exists($noms[0],$arrayTrim[$anios[$j]][$p])){ //Si existe la clave "nombre Alumno" en el array
                        $any=$anios[$j];
                        $cont=$p;
                    }
                    $p++;
                }
            }
                
            $newAlum= new Alumno($noms[0], $any, $id, "0", $_SESSION['idProfesor']);
        
            $newAlum->insertaAlumno($base); //inserto alumno

            $newAlum->insertaIDmeses($base, $id, $_SESSION['idProfesor']); //meto al alumno en todos los meses

            for($v=0; $v<9; $v++){ //modifico los valores default de los meses por los correctos

                switch ($v) {
                    case '0': //Octubre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][0]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][1]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][2]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][3]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][4]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;

                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes->modificarOct($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '1': //Noviembre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][5]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][6]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][7]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][8]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][9]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes->modificarNov($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '2': //Diciembre

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][10]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][11]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][12]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][13]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][14]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes->modificarDic($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '3': //Enero

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][15]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][16]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][17]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][18]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][19]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes->modificarEne($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '4': //Febrero

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][20]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][21]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][22]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][23]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][24]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes-> modificarFeb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '5': //Marzo

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][25]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][26]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][27]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][28]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][29]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes->modificarMar($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '6': //Abril

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][30]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][31]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][32]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][33]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][34]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes->modificarAb($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '7': //Mayo

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][35]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][36]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][37]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][38]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][39]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes->modificarMay($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;

                    case '8': //Junio

                        //pongo el valor en las variables
                        $kicho=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][40]);
                        $destreza=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][41]);
                        $salto=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][42]);
                        $combate=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][43]);
                        $extra=intval($arrayTrim[$any][$cont][$noms[0]]['puntos'][44]);

                        $totalMes=$kicho+$destreza+$salto+$combate+$extra;
                        $totalAnualInsertEsp=$totalAnualInsertEsp+$totalMes; //Añado al total anual

                        $mes->modificarJun($base, $id, $kicho, $destreza, $salto, $combate, $extra, $totalMes, $_SESSION['idProfesor']);
                        break;
                }
            }

            $newAlum->insertaFinal($base, $id, $totalAnualInsertEsp);

    }
    //======================================================================

    //======== DELETE ============= 
    $arrayDelete=[];

    for($j=0; $j<count($nomsBD); $j++){//Este bucle es para comprobar la posición cero, porque con el array_search si te devuelve 0 lo entiende como false/null

        $existeDelete=0;

        for($v=0; $v<count($noms); $v++){
        
            if($nomsBD[$j]['nom']==$noms[$v]){
                $existeDelete=1;
            }
        }

        if($existeDelete==0){
            array_push($arrayDelete, $nomsBD[$j]['nom']);
        }
        
    }

    if(!empty($arrayDelete)){ //Si el array delete tiene cosas entonces hay que borrarlas de las clases correspondientes

        for($p=0; $p<count($arrayDelete); $p++){
            
            $ide=$alumno->searchID($base, $arrayDelete[$p]);
            $idDel=$ide[0]["id"];

            for($v=0; $v<9; $v++){

                switch ($v) {
                    case '0':
                        $alumno->borrarDatosOct($base, $idDel, $_SESSION['idProfesor']);
                        break;
                    case '1':
                        $alumno->borrarDatosNov($base, $idDel, $_SESSION['idProfesor']);
                        break;
                    case '2':
                        $alumno->borrarDatosDic($base, $idDel, $_SESSION['idProfesor']);
                        break;
                    case '3':
                        $alumno->borrarDatosEne($base, $idDel, $_SESSION['idProfesor']);
                        break;
                    case '4':
                        $alumno->borrarDatosFeb($base, $idDel, $_SESSION['idProfesor']);
                        break;
                    case '5':
                        $alumno->borrarDatosMar($base, $idDel, $_SESSION['idProfesor']);
                        break;
                    case '6':
                        $alumno->borrarDatosAb($base, $idDel, $_SESSION['idProfesor']);
                        break;
                    case '7':
                        $alumno->borrarDatosMay($base, $idDel, $_SESSION['idProfesor']);
                        break;
                    case '8':
                        $alumno->borrarDatosJun($base, $idDel, $_SESSION['idProfesor']);
                        break;
                }
            }

            $alumno->borrarAlumn($base, $idDel, $_SESSION['idProfesor']);
        }  
    }

    //=========================================================================================================

    //Esta parte del código es para actualizar el año si se cambia en alguna tabla

    $todoBD=$alumno->getAll($base, $_SESSION['idProfesor']);

    for($a=0; $a<count($anios); $a++){ //Por cada año

        $anyCambiado=0;
    
        for($t=0; $t<count($todoBD); $t++){ //Por cada nombre en la BD

            if(intval($anios[$a])==$todoBD[$t]['any']){ //Si existe pongo 1
                $anyCambiado=1;
            }
        }

        if($anyCambiado==0){ //Si no existe es porque se ha cambiado

            $anyNuevo= $anios[$a]; //recojo el año que ha canviado

            $posicion= array_search($anios[$a],$tablas[0]); //busco el año nuevo en las tablas

            $nombreAlumno= $tablas[0][$posicion+1]; //la posicón siguiente del año es el primer alumno perteneciente a ese año

            $posColumna= array_column($todoBD, "nom"); //primero busco la columna "nom" dentro del array 

            $posAlumno=array_search($nombreAlumno, $posColumna); //busco la posición donde está esa columna para poder coger el año antiguo

            $anyAntiguo=$todoBD[$posAlumno]['any']; //recojo el año antiguo

            $alumno->anyUpdate($base, $anyNuevo, $anyAntiguo);
        }    
    }

?>