<?php
include 'conexion.php';

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->conexion_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener todos los postres
$sql = "SELECT name, price FROM postre";
$result = $conn->query($sql);

// Crear un array para los resultados
$postres = array();

if ($result->num_rows > 0) {
    // Guardar resultados en el array
    while($row = $result->fetch_assoc()) {
        $postres[] = $row;
    }
}

// Retornar los datos como JSON
echo json_encode($postres);

// Cerrar conexión
$conexion->close();
?>