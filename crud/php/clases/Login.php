<?php

class Login{
    private $id;
    private $usuario;
    private $password;

    public function __construct($ide, $usu, $pass){ //método constructor para instanciar las variables
        $this->id=$ide;
        $this->usuario=$usu;
        $this->password=$pass;
    }

    static function getAll($con){ //recojo todo de login

        $consulta='SELECT * FROM login'; 
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();

    }

    static function getAllMostrar($con){ //recojo todo de login

        $consulta='SELECT * FROM login WHERE usuario != "admin"'; 
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();

    }


    static function getID($con){ //Recojo todos los id de login

        $consulta='SELECT idProfesor FROM login';
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }

    static function getAllUsuario($con, $usu){ //esta función sirve para recoger todos los datos de un usuario en concreto

        $consulta="SELECT * FROM login WHERE usuario='$usu'";
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }

    public function hasheador($con, $pass){ //Le aplico un hash a una contraseña

        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        return $hashed_password;

    }

    public function creaLogin($con, $id, $usu, $pass){ //Esta funcion crea un nuevo usuario

        $consulta="INSERT INTO login (idProfesor, usuario, password) VALUES ('$id', '$usu', '$pass')";
       
        $result = $con->base->prepare($consulta);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
    }

    public function cambiaContrasenya($con, $id, $newPass){ //esta función cambia la contraseña

        $consulta="UPDATE login SET password='$newPass' WHERE idProfesor='$id'";
        $result = $con->base->prepare($consulta);
        $result->execute();
    }

    public function updateUsuario($con, $id, $usu, $pass){//esta función actualiza la información de un usuario
        $consulta="UPDATE login SET idProfesor='$id', usuario='$usu', password='$pass' WHERE idProfesor='$id'";
        $result = $con->base->prepare($consulta);
        $result->execute();
    }

    public function borrarUsuario($con, $usu){ //esta función borra un usuario
        $consulta= "DELETE FROM login WHERE usuario='$usu'";
        $result = $con->base->prepare($consulta);
        $result->execute();
    }
}
?>