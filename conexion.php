<?php
require_once 'config.php';

$conexion = getDbConnection();

if ($conexion->connect_errno){
    die("Conexion Fallida" . $conexion->connect_errno);
} 
?>
