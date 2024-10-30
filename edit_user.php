<?php
include 'conexion.php';
require_once 'config.php';

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "SELECT * FROM usuario WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!$user) {
        echo "Usuario no encontrado";
        exit();
    }
} else {
    echo "ID de usuario no especificado";
    exit();
}

$message = ""; // Variable para mensajes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "UPDATE usuario SET full_name=?, username=?, password=?, email=? WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $full_name, $username, $password, $email, $id);
    
    if ($stmt->execute()) {
        $message = "Usuario actualizado con éxito."; // Mensaje de éxito
    } else {
        $message = "Error al actualizar el usuario: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
            <div class="btn-container"> <!-- Contenedor para centrar el botón -->
                <a href="<?= getenv('APP_URL') ?>usuario.php" class="btn">Volver al Inicio</a> <!-- Botón para volver -->
            </div>
        <?php else: ?>
            <form action="edit_user.php?id=<?= $id ?>" method="post">
                <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" placeholder="Nombre" required>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" placeholder="Username" required>
                <input type="password" name="password" value="<?= htmlspecialchars($user['password']) ?>" placeholder="Password" required>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required>
                <input type="submit" value="Actualizar usuario">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
