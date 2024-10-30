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
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$input_password = $_POST['password'] ?? '';

// Verifica que los datos estén presentes
if (empty($nombre) || empty($email) || empty($input_password)) {
    die("Todos los campos son requeridos.");
}

// Encripta la contraseña
$hashed_password = password_hash($input_password, PASSWORD_BCRYPT);

// Consulta para insertar el nuevo usuario
$sql = "INSERT INTO usuario (nombre, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Registro exitoso.";
    // Redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$conn->close();
?>
