<?php
// Configura los detalles de conexión
require_once 'config.php';

// Crear conexión
$mysqli = getDbConnection();

// Verificar conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Consulta a la base de datos
$query = "SELECT * FROM especiales";
$result = $mysqli->query($query);

// Almacenar los datos en un array
$datos = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
}

// Cerrar la conexión
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Postres</title>
    <style>
        body {
            background-color: #fefefe; /* Fondo blanco */
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center; 
            height: 100vh;
        }

        .container {
            background-color: #ffffff; /* Fondo contenedor blanco */
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 800px; /* Ancho máximo */
            text-align: center;
        }

        h2 {
            color: #6a0dad; /* Morado oscuro */
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%; /* Tabla ocupa el 100% del contenedor */
            margin-top: 20px; /* Espacio superior */
            border-radius: 10px;
            overflow: hidden; /* Bordes redondeados */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            background-color: #e8d8f5; /* Morado claro para las celdas */
        }

        th {
            background-color: #d2a7e8; /* Morado más claro para las cabeceras */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f4e7fa; /* Color alternado para las filas */
        }

        tr:hover {
            background-color: #d3cce3; /* Color al pasar el cursor sobre las filas */
        }

        a {
            color: #6a0dad; /* Morado oscuro para los enlaces */
            text-decoration: none; /* Quita el subrayado */
            font-weight: bold; /* Negrita */
        }

        a:hover {
            text-decoration: underline; /* Subraya al pasar el cursor */
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6a0dad; /* Color del botón */
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px; /* Espacio arriba del botón */
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #5c0a9b; /* Color más oscuro al pasar el cursor */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Postres</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            <?php if (!empty($datos)): ?>
                <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['id']); ?></td>
                    <td><?php echo htmlspecialchars($fila['name']); ?></td>
                    <td><?php echo htmlspecialchars($fila['price']); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay datos disponibles.</td>
                </tr>
            <?php endif; ?>
        </table>
        
        <!-- Botón de menú -->
        <a href="<?= getenv('APP_URL') ?>/administracion.php" class="button">Menú</a>
    </div>
</body>
</html>
