<?php
include 'conexion.php';
require_once 'config.php';

// Conectar a la base de datos
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "users_crud_php";

// Crear conexión
//$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener datos del formulario
$full_name = $_POST['full_name'];

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Preparar la consulta SQL para evitar inyección SQL
$stmt = $conexion->prepare("INSERT INTO usuario (full_name, username, password, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $username, $password, $email);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Redirigir a la página principal si la inserción es exitosa
    header("Location: /usuario.php");
    exit(); // Asegúrate de que el script se detenga después de redirigir
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>

