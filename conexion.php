<?php
require 'config.php';

$connection = getDbConnection();


$conexion = new mysqli($server, $user, $pass, $db,$port);

if ($conexion->connect_errno){
    die("Conexion Fallida" . $conexion->connect_errno);
} 
?>
