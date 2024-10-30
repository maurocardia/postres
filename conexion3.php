<?php
require_once 'config.php';
$servername = $_ENV['DB_HOST'];
$username = "root"; // Cambia esto si usas otro nombre de usuario
$password = ""; // Cambia esto si usas una contraseña
$dbname = "postre"; // Cambia esto al nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
