<?php
include 'conexion.php';
require_once 'config.php';

$name = $price = '';
$image = null;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    $sql = "SELECT id, name, price, image FROM postre WHERE id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $price = $row['price'];
            $image = $row['image'];
        } else {
            exit("Postre no encontrado.");
        }
        $stmt->close();
    } else {
        exit("Error en la consulta: " . $conexion->error);
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    if ($_FILES['image']['size'] > 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $sql = "SELECT image FROM postre WHERE id = ?";
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $image = $row['image'];
            }
            $stmt->close();
        }
    }

    $sql = "UPDATE postre SET name = ?, price = ?, image = ? WHERE id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sdsi", $name, $price, $image, $id);
        if ($stmt->execute()) {
            $stmt->close();
            $conexion->close();
            header("Location: /postre.php");
            exit(); // Asegura que se detiene la ejecución aquí
        } else {
            exit("Error en la actualización: " . $stmt->error);
        }
    } else {
        exit("Error en la conexión: " . $conexion->error);
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Postre</title>
    <link rel="stylesheet" href="styles_edit_dessert.css">
</head>
<body>
    <form action="edit_dessert.php" method="POST" class="edit-dessert-form" enctype="multipart/form-data">
        <h1>Editar Postre</h1>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
        <input type="number" name="price" value="<?= htmlspecialchars($price) ?>" step="0.01" required>
        <div class="image-upload">
            <label for="image">Cargar Imagen:</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <input type="submit" value="Actualizar Postre">
        <a href="http://localhost/postres/postre.php">Regresar a la lista</a>
    </form>
</body>
</html>