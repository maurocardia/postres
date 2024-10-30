<?php
require_once 'config.php';
// Configura la conexión a la base de datos
$servername = $_ENV['DB_HOST'];
$username = "root"; // Cambia esto según tu configuración
$password = ""; // Cambia esto según tu configuración
$dbname = "postres_bd";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtén los datos del formulario
$full_name = $_POST['full_name'] ?? '';
$email = $_POST['register_email'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['register_password'] ?? '';

// Verifica que los datos estén presentes
if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
    die("Todos los campos son requeridos.");
}

// Inserta el nuevo usuario en la base de datos
$sql = "INSERT INTO usuario (full_name, email, username, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $full_name, $email, $username, $password);

if ($stmt->execute()) {
    echo "Registro exitoso.";
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$conn->close();
?>