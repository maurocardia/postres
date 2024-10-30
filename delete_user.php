<?php
include 'conexion.php';
require_once 'config.php';

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

$message = ""; // Variable para mensajes

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Primero, elimina los pedidos relacionados con el usuario
    $deletePedidosSql = "DELETE FROM pedidos WHERE user_id = ?";
    $stmt = $conexion->prepare($deletePedidosSql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    
    // Ahora, elimina el usuario
    $deleteUserSql = "DELETE FROM usuario WHERE id = ?";
    $stmt = $conexion->prepare($deleteUserSql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Usuario eliminado con éxito."; // Mensaje de éxito
    } else {
        $message = "Error al eliminar el usuario: " . $conexion->error; // Mensaje de error
    }
} else {
    $message = "ID de usuario no especificado"; // Mensaje si no se especifica ID
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario eliminado</title>
    <link rel="stylesheet" href="styles_user.css">
    <style>
        .message {
            text-align: center; /* Centra el texto del mensaje */
            margin: 20px 0; /* Espaciado vertical */
            font-size: 18px; /* Tamaño de fuente */
            color: black; /* Color del mensaje en negro */
        }
        .btn {
            display: inline-block; /* Cambiar a inline-block para ajustar el tamaño */
            margin: 10px auto; /* Centra el botón */
            padding: 5px 10px; /* Reduce el padding */
            font-size: 14px; /* Tamaño de fuente más pequeño */
            background-color: #a77bca; /* Color morado claro */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center; /* Centra el texto del botón */
        }
        .btn-container {
            text-align: center; /* Centra el botón en su contenedor */
        }
        .btn:hover {
            background-color: #9a6db7; /* Un poco más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1></h1>
        <div class="message"><?= htmlspecialchars($message) ?></div>
        <div class="btn-container"> <!-- Contenedor para centrar el botón -->
            <a href="<?= getenv('APP_URL') ?>/postres/usuario.php" class="btn">Volver al Inicio</a> <!-- Botón para volver -->
        </div>
    </div>
</body>
</html>
