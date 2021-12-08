<?php 
    //Realizo instancia de la db
    $mysqli = new MYSQLI('localhost','root','','farmacia');
    if($mysqli->connect_errno > 0){
        die("Error de conexión ".$mysqli->connect_error);
    }
?>