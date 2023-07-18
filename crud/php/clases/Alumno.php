<?php

class Alumno{
    protected $nom;
    protected $any;
    protected $id;
    protected $total;
    protected $idProfesor;

    public function __construct($nombre, $anio, $idAlum, $totalAny, $idProf){ //asigno las variables a las propiedades de la clase
        $this -> nom=$nombre;
        $this -> any=$anio;
        $this -> id=$idAlum;
        $this -> total=$totalAny;
        $this -> idProfesor=$idProf;
    }

    function getAll($con, $idProf){ //Esta función devuelve todos los datos de los alumnos, ordenados por año (de menor a mayor)
        $consulta="SELECT nom, any, id, total FROM alumnos WHERE idProfesor='$idProf' ORDER BY `alumnos`.`any` ASC";
        $result = $con->base->prepare($consulta);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNombres($con, $idProf){ //Devuelvo el nombre de los alumnos
        $consulta="SELECT nom FROM alumnos WHERE idProfesor= '$idProf'";
        $result = $con->base->prepare($consulta);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAlumneAniosClass($con, $any, $idProf){ //Recojo alumnos de un determinado año por orden descendente
        $consulta="SELECT * FROM alumnos WHERE any = $any AND idProfesor= '$idProf' ORDER BY `alumnos`.`total` DESC";
        $result = $con->prepare($consulta);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insertaAlumno($con){ //inserta un alumno
        try{
            $consulta="INSERT INTO alumnos VALUES (:nom, :any, :id, :totalAn, :idProf)";
            $result= $con->base->prepare($consulta);
            $result->bindParam(":nom", $this->nom );
            $result->bindParam(":any", $this->any );
            $result->bindParam(":id", $this->id);
            $result->bindParam(":totalAn", $this->total);
            $result->bindParam(":idProf", $this->idProfesor);
            
            $result->execute();
            $result->closeCursor();
        }
        catch(PDOException $e){ //en caso de que no se haya podido envia un mensaje de error
            $dato= "¡Error!: " . $e->getMessage() . "<br/>";
            require "../vistas/mensaje.php";
            die();
        } 
    }
    public function insertaIDmeses($con, $idAlum, $idProf){ //inserto nuevo alumno en todos los meses
        try{
            $consulta="INSERT INTO  octubre VALUES (:id, 0,0,0,0,0,0, :idProf);
            INSERT INTO  noviembre VALUES (:id, 0,0,0,0,0,0, :idProf);
            INSERT INTO  diciembre VALUES (:id, 0,0,0,0,0,0, :idProf);
            INSERT INTO  enero VALUES (:id, 0,0,0,0,0,0, :idProf);
            INSERT INTO  febrero VALUES (:id, 0,0,0,0,0,0, :idProf);
            INSERT INTO  marzo VALUES (:id, 0,0,0,0,0,0, :idProf);
            INSERT INTO  abril VALUES (:id, 0,0,0,0,0,0, :idProf);
            INSERT INTO  mayo VALUES (:id, 0,0,0,0,0,0, :idProf);
            INSERT INTO  junio VALUES (:id, 0,0,0,0,0,0, :idProf);";

            $result= $con->base->prepare($consulta);
            $result->bindParam(":id", $this->id );
            $result->bindParam(":idProf", $this->idProfesor );
            $result->execute();
            $result->closeCursor();
        }
        catch(PDOException $e){
            $dato= "¡Error!: " . $e->getMessage() . "<br/>";
            require "../vistas/mensaje.php";
            die();
        } 
    }

    function insertaFinal($con, $idAlum, $total){ //inserto la puntuación final
        $consulta="UPDATE alumnos SET `total`= $total WHERE id=$idAlum";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }

    function borrarAlumn ($con, $idAlum, $idProf){ //esta función borra un alumno
        $consulta="DELETE FROM alumnos WHERE id= $idAlum AND idProfesor='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }

    public function borrarDatosOct($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de Octubre
        $consulta="DELETE FROM octubre WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }
    public function borrarDatosNov($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de noviembre
        $consulta="DELETE FROM noviembre WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);    
        $result->execute();
        return true;
    }
    public function borrarDatosDic($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de diciembre
        $consulta="DELETE FROM diciembre WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }
    public function borrarDatosEne($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de enero
        $consulta="DELETE FROM enero WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }
    public function borrarDatosFeb($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de febrero
        $consulta="DELETE FROM febrero WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }
    public function borrarDatosMar($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de marzo
        $consulta="DELETE FROM marzo WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }
    public function borrarDatosAb($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de abril
        $consulta="DELETE FROM abril WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }
    public function borrarDatosMay($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de mayo
        $consulta="DELETE FROM mayo WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }
    public function borrarDatosJun($con, $idAlum, $idProf){ //Esta función borra los datos del alumno en el mes de junio
        $consulta="DELETE FROM junio WHERE idAlumno= $idAlum AND idProf='$idProf'";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }

    //=======================================================================================================================

    public function searchID($con, $nomAlum){ //esta función busca y devuelve el id del alumno pasandole el nombre de este
        $consulta= "SELECT id FROM alumnos WHERE nom = '$nomAlum'";
        $result = $con->base->prepare($consulta); //Aquí el SQL
        $result->execute(); //Lo ejecuto
        return $result->fetchall(PDO::FETCH_ASSOC);
    }

    public function searchMaxID($con){ //esta función devuelve el maximo id 
        $consulta= 'SELECT id FROM alumnos ORDER BY `id` DESC';
        $result = $con->base->prepare($consulta); //Aquí el SQL
        $result->execute(); //Lo ejecuto
        return $result->fetchall(PDO::FETCH_ASSOC);
    }
    //=======================================================================================================================
    public function insertaTemporal($con, $totalAnualInsert){ //inserta los nuevos alumnos en la tabla temporal
        try{
            $consulta="INSERT INTO temporal VALUES (:nom, :any, :id, :totalAn, :idProf)";
            $result= $con->base->prepare($consulta);
            $result->bindParam(":nom", $this->nom );
            $result->bindParam(":any", $this->any );
            $result->bindParam(":id", $this->id );
            $result->bindParam(":idProf", $this->idProfesor );
            $result->bindParam(":totalAn", $totalAnualInsert);

            $result->execute();
            $result->closeCursor();
        }
        catch(PDOException $e){
            $dato= "¡Error!: " . $e->getMessage() . "<br/>";
            require "../vistas/mensaje.php";
            die();
        } 
    }

    public function temporalAlumnos($con){ //inserta en la tabla alumnos los nuevos alumnos de la tabla temporal a la tabla alumnos
        $consulta="SELECT * FROM temporal";
        $result= $con->base->prepare($consulta);
        $result->execute();
        $resultado=$result->fetchall(PDO::FETCH_ASSOC);

        for($i=0; $i<count($resultado); $i++){

            $nom=$resultado[$i]['nom'];
            $any=$resultado[$i]['any'];
            $id=$resultado[$i]['id'];
            $total=$resultado[$i]['total'];
            $idProf=$resultado[$i]['idProfesor'];

            $alum=new Alumno($nom, $any, $id, $total, $idProf);

            $alum->insertaAlumno($con);
        }
    }

    public function limpiaTemporal($con){ //borra todo lo que hay en la tabla temporal
        $consulta="DELETE FROM temporal";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }

    public function temporalMaxID($con){ //esta función devuelve el max id de la tabla temporal
         $consulta= 'SELECT id FROM temporal ORDER BY `id` DESC';
        $result = $con->base->prepare($consulta); //Aquí el SQL
        $result->execute(); //Lo ejecuto
        return $result->fetchall(PDO::FETCH_ASSOC);
    }

    function anyUpdate($con, $any, $anyAnt){ //Esta función actualiza el año y devuelve true
        $consulta="UPDATE alumnos SET `any`= $any WHERE any=$anyAnt";
        $result= $con->base->prepare($consulta);
        $result->execute();
        return true;
    }

}   
?>