<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $sql = "INSERT INTO especiales (name, price) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sd", $name, $price);

    if ($stmt->execute()) {
        // Obtener la lista actualizada de postres
        $sql = "SELECT id, name, price FROM especiales";
        $result = $conexion->query($sql);
        
        $postres = [];
        while ($row = $result->fetch_assoc()) {
            $postres[] = $row;
        }

        echo json_encode($postres);
    } else {
        echo json_encode(["error" => $stmt->error]);
    }

    $stmt->close();
    $conexion->close();
}
?>
