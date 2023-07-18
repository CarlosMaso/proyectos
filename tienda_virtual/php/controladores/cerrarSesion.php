<?php
//borro las sesiones y vuelvo a principal
    session_start();
    session_destroy();
    header("Location:principal.php");

?>