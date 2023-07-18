<?php
spl_autoload_register(function ($clase) {  //Esta función hace un include automatico de la clase a la que se llame
    include "../clases/$clase.php"; 
});

?>