<?php
require_once 'config.php';
// Conexión a la base de datos
$servername = $_ENV['DB_HOST'];
$username = "root"; // Cambia esto a tu usuario
$password = ""; // Cambia esto a tu contraseña
$dbname = "postres_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);

    // Manejar la imagen
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

    // Verificar si el archivo es una imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            // Insertar en la base de datos
            $sql = "INSERT INTO tarjetas (nombre, imagen, precio, descripcion, categoria) VALUES ('$nombre', '$target_file', '$precio', '$descripcion', '$categoria')";

            if ($conn->query($sql) === TRUE) {
                $mensaje = "Postre subido exitosamente.";
            } else {
                $mensaje = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $mensaje = "Lo siento, hubo un error al subir tu archivo.";
        }
    } else {
        $mensaje = "El archivo no es una imagen válida.";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Subida</title>
    <style>
        /* Estilos aquí */
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to bottom right, #e0c3fc, #f9d4d4);
            text-align: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
        }
        .message {
            font-size: 20px; /* Tamaño de fuente */
            color: #333; /* Color del mensaje */
            margin: 20px 0; /* Espaciado vertical */
        }
        .btn {
            display: inline-block;
            padding: 10px 15px; /* Ajustar padding */
            background-color: #6a0dad; /* Color del botón */
            color: white;
            border: none;
            border-radius: 5px; /* Bordes redondeados */
            text-decoration: none;
            margin-top: 20px; /* Espacio arriba del botón */
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #5c0a9b; /* Color más oscuro al pasar el cursor */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message">
            <?php if (isset($mensaje)) echo htmlspecialchars($mensaje); ?>
        </div>
        <a href="<?= getenv('APP_URL') ?>subir.php" class="btn">Volver a la Tabla</a>
    </div>
</body>
</html>
