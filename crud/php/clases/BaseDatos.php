<?php

class BaseDatos{

    public $base;
    
    public function __construct(){ //creo conexión y la devuelvo

        try {

            $opciones = array( //este array es la conexión PDO
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true
            );

           return $this->base= new PDO('mysql:host=localhost;dbname=ligaInfantil;charset=utf8', 'root', '', $opciones);

        } catch (Exception $e) {
            $dato= "¡Error!: " . $e->getMessage() . "<br/>";
            require "vistas/mensaje.php";
            die();
        }
    }
}

?>