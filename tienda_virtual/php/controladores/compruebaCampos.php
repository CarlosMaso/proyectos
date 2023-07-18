<?php

require "../config/autocarga.php";

    function compruebaNom($nom){ //comprueba que sean solo letras y que esten dentro de la longitud permitida
        $permitidos="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚáéíóú ";
        //comprueba que no tiene menos de 3 o más de 15 letras o es un número
        if(strlen($nom)<3 || strlen($nom)>15 || is_numeric($nom)){
            return false;
        }else{
            for ($i=0; $i<strlen($nom); $i++){ // hago un bucle que compruebe cada letra de la dirección y compruebo que tiene las cosas

                if(strpos($permitidos, substr($nom,$i,1))===false){

                     return false; 

                } 
            }
            return true;

        }
    }
    function compruebaApe($ape){ //comprueba que sean solo letras y que esten dentro de la longitud permitida
        $permitidos="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚáéíóú ";
        //comprueba que no tiene menos de 3 o más de 20 letras o es un número
        if(strlen($ape)<3 ||strlen($ape)>20 || is_numeric($ape)){
            return false;
        }else{
            for ($i=0; $i<strlen($ape); $i++){ // hago un bucle que compruebe cada letra de la dirección y compruebo que tiene las cosas

                if(strpos($permitidos, substr($ape,$i,1))===false){

                     return false; 

                } 
            }
            return true;

        }
    }
    function compruebaEdad($edad){
        //comprueba que sea un numero y que esté entre 0 y 120 años
        if(!is_numeric($edad) || $edad<=0 || $edad>=120){
            return false;
        }else{
            return true;
        }
    }
    function compruebaUsu($usu){ //comprueba el usuario

        $permitidos="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_$@#%€";

        $base= new BaseDatos();
    
        $usuBaseDatos= Cliente::getUsuarios($base); //recojo los usuarios de la Base Datos

        if($usu!==null){ //Comprueba si el campo está vacío

            for ($i=0; $i<strlen($usu); $i++){ // hago un bucle que compruebe cada letra de la dirección y compruebo que los caractares son los permitidos

                if(strpos($permitidos, substr($usu,$i,1))===false){

                    return false; 

                } 
            }

            $existe=0;

            for($i=0; $i<count($usuBaseDatos); $i++){   //comprueba que el usuario no sea igual que el de la "base de datos"

                if($usu== $usuBaseDatos[$i]){

                    $existe=1;
                }
            }

            if($existe==1){ //si existe en la BD devuelve false si está todo bien devuelve true
                return false;
            }else{
                return true;
            }

        }else{
            return false;
        }


    }
    function compruebaDni($dni){ //comprueba que sea un dni real

        if(empty($dni) ||  strlen($dni) != 9 ){ //si me lo pasa vacio
            return false;
        }else{
            $letra=substr($dni, -1); //Devuelve la letra del dni
            $numeros=substr($dni, 0, -1); //Devuelve los números del dni
            
            if(empty($numeros)){
                return false;
            }else{
                $letrasValidas="TRWAGMYFPDXBNJZSQVHLCKE";
                $division=substr($letrasValidas, $numeros%23, 1);
        
                /* Si la letra escogida, al dividr el numero por 23 es igual a la letra que le hemos pasado 
                y si la longitud de esta no supera a 1 y si la longitud de los numeros es 8 todo correcto */
                if( $division== $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
                    return true;
                }else{
                    return false;
                }
            } 
        }
    }

    function compruebaMail($mail){ //comprueba que tenga los caracteres que debe tener un email
        $permitidos="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_$@#%€";
        $pos = strpos($mail, "@"); //busco que haya una @
    
        if($pos==false){ //si no hay @ tenemos un problema
            return false;
        }else{
            return true;
        }   
        
    }
    function compruebaPass($pass1, $pass2){ //comrpueba que las contraseñas no tengan simbolos extraños y que coincidan

        $permitidos="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_$@#%€";

        if($pass1!=$pass2){
            return false;
        }else{
            /* hago un bucle que compruebe cada letra del pass y compruebo que tiene las cosas*/
            for ($i=0; $i<strlen($pass1); $i++){ 
                if (strpos($permitidos, substr($pass1,$i,1))===false){
                return false; 
                } 
            }
            return true;
        }
    }
    function compruebaTlf($tlf){
        //si el telefono es un numero y tiene 9 digitos es correcto
        if(is_numeric($tlf) && strlen($tlf)==9){
            return true;
        }else{
            return false;
        }
    }

    function compruebaDireccion($dir){  //Esta funcion comprueba la dirección (que no tenga caracteres raros de inyeccion de codigo)

        $permitidos="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-ºª/ ";

        if($dir!==null){ //Comprueba si el campo está vacío
            
            for ($i=0; $i<strlen($dir); $i++){ // hago un bucle que compruebe cada letra de la dirección y compruebo que tiene las cosas

                if(strpos($permitidos, substr($dir,$i,1))===false){

                     return false; 

                } 
            }
            return true;

        }else{
            return false;
        }
    }

?>