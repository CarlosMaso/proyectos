<?php

class Mes{

    protected $idAlumno;
    protected $kichoPoomsae;
    protected $destreza;
    protected $salto;
    protected $combate;
    protected $extra;
    protected $total;
    protected $idProfesor;

    public function __construct($id, $kicho, $des, $salt, $comb, $ext, $tot, $idProf){
        $this -> idAlumno=$id;
        $this -> kichoPoomsae=$kicho;
        $this -> destreza=$des;
        $this -> salto=$salt;
        $this -> combate=$comb;
        $this -> extra=$ext;
        $this -> total=$tot;
        $this -> idProfesor=$idProf;
    }
//=======================================================================================================================
//GET ALL de cada mes
    function getOct($con){

        $consulta='SELECT * FROM octubre'; //Recojo todo de octubre y lo devuelvo
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
    function getNov($con){

        $consulta='SELECT * FROM noviembre';//Recojo todo de noviembre y lo devuelvo
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
    function getDic($con){

        $consulta='SELECT * FROM diciembre';//Recojo todo de diciembre y lo devuelvo
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
    function getEne($con){

        $consulta='SELECT * FROM enero';//Recojo todo de enero y lo devuelvo
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
    function getFeb($con){

        $consulta='SELECT * FROM febrero';//Recojo todo de febrero y lo devuelvo
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
    function getMar($con){

        $consulta='SELECT * FROM marzo';//Recojo todo de marzo y lo devuelvo
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
    function getAb($con){

        $consulta='SELECT * FROM abril';//Recojo todo de abril y lo devuelvo
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
    function getMay($con){

        $consulta='SELECT * FROM mayo';//Recojo todo de mayo y lo devuelvo
        $result = $con->base->prepare($consulta); 
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
    function getJun($con){

        $consulta='SELECT * FROM junio';//Recojo todo de junio y lo devuelvo
        $result = $con->base->prepare($consulta);
        $result->execute();
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }
//=======================================================================================================================
    //EDITAR PUNTOS DE CADA MES
    function modificarOct($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE octubre SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
    function modificarNov($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE noviembre SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
    function modificarDic($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE diciembre SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
    function modificarEne($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE enero SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
    function modificarFeb($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE febrero SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
    function modificarMar($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE marzo SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
    function modificarAb($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE abril SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
    function modificarMay($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE mayo SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
    function modificarJun($con, $idAlum, $kichoPoomsae, $destreza, $salto, $combate, $extra, $total, $idProf){

        $consulta="UPDATE junio SET kichoPoomsae=$kichoPoomsae, destreza=$destreza, salto=$salto, combate=$combate, extra=$extra, total=$total WHERE idAlumno=$idAlum";
        $result = $con->base->prepare($consulta);
        $result->execute();
        $result->closeCursor();
    }
}
?>