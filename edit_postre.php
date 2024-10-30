<?php
include 'conexion.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = intval($_GET['id']);

    $sql = "SELECT id, name, price, image FROM especiales WHERE id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $price = $row['price'];
            $image = $row['image'];
        } else {
            echo "Postre no encontrado.";
            exit();
        }
        $stmt->close();
    } else {
        echo "Error en la consulta: " . $conexion->error;
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $image = $_FILES['image']['name'] ?? '';

    // Subir imagen
    if ($_FILES['image']['size'] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo "Error al subir la imagen.";
            exit();
        }
    } else {
        $sql = "SELECT image FROM especiales WHERE id = ?";
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $image = $row['image']; // Usar la imagen existente
            $stmt->close();
        }
    }

    $sql = "UPDATE especiales SET name = ?, price = ?, image = ? WHERE id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sdsi", $name, $price, $image, $id);
        if ($stmt->execute()) {
            header("Location: ".$_ENV['APP_URL']."/postres/especiales.php");
            exit();
        } else {
            echo "Error al actualizar el postre: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Postre</title>
    <link rel="stylesheet" href="styles_edit_dessert.css">
    <style>
        /* Resetea algunos estilos básicos para asegurar consistencia */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Configura el estilo general del cuerpo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        /* Estilo para el formulario de edición de postres */
        .edit-dessert-form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .edit-dessert-form h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .edit-dessert-form input[type="text"],
        .edit-dessert-form input[type="number"],
        .edit-dessert-form input[type="submit"] {
            display: block;
            width: calc(100% - 22px); /* Ajusta el ancho teniendo en cuenta el padding */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .edit-dessert-form input[type="submit"] {
            background-color: #bb83e0;
            color: white;
            border: none;
            cursor: pointer;
        }

        .edit-dessert-form input[type="submit"]:hover {
            background-color: #cf60da;
        }

        /* Estilo para el enlace de regreso */
        .edit-dessert-form a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
        }

        .edit-dessert-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="edit_postre.php" method="POST" class="edit-dessert-form" enctype="multipart/form-data">
        <h1>Editar Postre</h1>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
        <input type="number" name="price" value="<?= htmlspecialchars($price) ?>" step="0.01" required>
        <div class="image-upload">
            <label for="image">Cargar Imagen:</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <input type="submit" value="Actualizar Postre">
        <a href="<?= $_ENV['APP_URL'] ?>/postres/especiales.php">Regresar a la lista</a>
    </form>
</body>
</html>
