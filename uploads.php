<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que este archivo esté bien configurado

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Manejo de la imagen
    $target_dir = "C:/xampp/htdocs/uploads/"; // Ajusta esta ruta según tu estructura de carpetas
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si la imagen es real o falsa
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        echo "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Limitar el tamaño del archivo
    if ($_FILES["imagen"]["size"] > 500000) {
        echo "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk es 0 por un error
    if ($uploadOk == 0) {
        echo "Lo siento, hubo un error al subir tu archivo.";
    } else {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            echo "El archivo " . htmlspecialchars(basename($_FILES["imagen"]["name"])) . " ha sido subido.";

            // Insertar en la base de datos
            $sql = "INSERT INTO postres (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssis", $nombre, $descripcion, $precio, $target_file);
            if ($stmt->execute()) {
                echo "Registro creado exitosamente.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }

    // Cerrar conexión
    $conn->close();
}
?>
