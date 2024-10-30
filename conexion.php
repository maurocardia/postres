<?php
require_once 'config.php';

$server= $_ENV['DB_HOST'];
$user="root";
$pass= "";
$db= "postres_bd";


$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno){
    die("Conexion Fallida" . $conexion->connect_errno);
} 
?>
