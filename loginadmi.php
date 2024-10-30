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
$email = $_POST['login_email'] ?? '';
$password = $_POST['login_password'] ?? '';

// Verifica que los datos estén presentes
if (empty($email) || empty($password)) {
    die("Todos los campos son requeridos.");
}

// Consulta para obtener la contraseña almacenada
$sql = "SELECT contraseña FROM administrador WHERE correo_electronico = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['contraseña'];

    // Verifica la contraseña ingresada con la almacenada
    if ($password === $stored_password) {
        // Redirige a la página de administración
        header("Location: ".$_ENV['APP_URL']."/postres/administracion.php");
        exit(); // Asegúrate de terminar el script después de redirigir
    } else {
        echo "Credenciales incorrectas.";
    }
} else {
    echo "No se encontró el usuario.";
}

// Cierra la conexión
$stmt->close();
$conn->close();
?>
