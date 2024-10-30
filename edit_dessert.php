<?php
include 'conexion.php'; // Asegúrate de que este archivo establezca la conexión a la base de datos
require_once 'config.php'; // Asegúrate de tener la configuración necesaria

$name = $price = $image = ''; // Inicializar variables

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    // Consultar los datos actuales del postre
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
            echo "Postre no encontrado.";
            exit();
        }
        $stmt->close();
    } else {
        echo "Error: " . $conexion->error;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Gestionar la imagen
    if ($_FILES['image']['size'] > 0) {
        // Definir directorio y nombre único para la imagen
        $target_dir = "uploads/";
        $unique_name = uniqid() . '_' . basename($_FILES['image']['name']);
        $target_file = $target_dir . $unique_name;

        // Mover el archivo subido
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = $unique_name; // Guardar el nombre único en la base de datos
        } else {
            echo "Error al mover el archivo. Verifica permisos.";
            exit();
        }
    } else {
        // Si no se subió una nueva imagen, mantener la existente
        $sql = "SELECT image FROM postre WHERE id = ?";
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $image = $row['image']; // Usar la imagen existente
            }
            $stmt->close();
        }
    }

    // Actualizar datos en la base de datos
    $sql = "UPDATE postre SET name = ?, price = ?, image = ? WHERE id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sdsi", $name, $price, $image, $id);
        if ($stmt->execute()) {
            header("Location: /postres/postre.php"); // Redirigir después de la actualización
            exit();
        } else {
            echo "Error en la actualización: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conexion->error;
    }
}

$conexion->close(); // Cerrar conexión
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
    <form action="edit_dessert.php?id=<?= htmlspecialchars($id) ?>" method="POST" class="edit-dessert-form" enctype="multipart/form-data">
        <h1>Editar Postre</h1>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
        <input type="number" name="price" value="<?= htmlspecialchars($price) ?>" step="0.01" required>
        <div class="image-upload">
            <label for="image">Cargar Imagen:</label>
            <input type="file" name="image" id="image" accept="image/*">
            <?php if ($image): ?>
                <p>Imagen actual: <?= htmlspecialchars($image) ?></p>
            <?php endif; ?>
        </div>
        <input type="submit" value="Actualizar Postre">
        <a href="<?= getenv('APP_URL') ?>postre.php">Regresar a la lista</a>
    </form>
</body>
</html>
