<?php
require_once 'config.php';
// Inicia la sesión
session_start();
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
$input_password = $_POST['login_password'] ?? '';

// Verifica que los datos estén presentes
if (empty($email) || empty($input_password)) {
    die("Todos los campos son requeridos.");
}

// Consulta para obtener la contraseña almacenada y el id del usuario
$sql = "SELECT password, id FROM usuario WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];
    $id_usuario = $row['id'];

    // Verifica la contraseña ingresada con la almacenada
    if ($input_password === $stored_password) {
        echo "Inicio de sesión exitoso.";

        // Almacena el ID del usuario en la sesión
        $_SESSION['user_id'] = $id_usuario;

        // Redirige a una página segura o muestra un mensaje de éxito
        header("Location: procesar_pedido.php");
        exit();
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