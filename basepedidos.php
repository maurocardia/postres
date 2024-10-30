<?php
session_start(); // Iniciar la sesión

require_once 'config.php';
// Crear conexión
$mysqli = getDbConnection();

// Verificar conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Consulta a la base de datos
$query = "SELECT * FROM pedidos";
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
    <title>Tabla de Pedidos</title>
    <style>
        body {
            background-color: #ffffff; /* Fondo blanco */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0; /* Eliminar padding */
        }

        .container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: #f3f4f6; /* Fondo suave para el contenedor */
            width: 100%; /* Cambiar a 100% */
            max-width: 1200px; /* Ancho máximo */
            margin: 0 auto; /* Centra el contenedor */
        }

        h2 {
            color: #6a0dad; /* Morado oscuro */
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            margin: 20px auto; /* Centra la tabla */
            border-radius: 10px;
            overflow: hidden; /* Para bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%; /* Ancho de la tabla al 100% */
            min-width: 100%; /* Ancho mínimo para evitar que se colapse */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
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

        .button {
            display: inline-block;
            padding: 10px 15px;
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

        /* Responsividad */
        @media (max-width: 768px) {
            th, td {
                padding: 10px; /* Reducir el padding en pantallas más pequeñas */
            }
            .button {
                width: 100%; /* Hacer el botón más ancho en pantallas pequeñas */
            }
        }

        /* Permitir desplazamiento en pantallas más pequeñas */
        @media (max-width: 600px) {
            table {
                display: block;
                overflow-x: auto; /* Habilitar desplazamiento horizontal */
                white-space: nowrap; /* Evitar el salto de línea en celdas */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Pedidos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Teléfono</th>
                <th>País</th>
                <th>Dirección</th>
                <th>Pago</th>
                <th>Día</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Hora</th>
                <th>Nota</th>
                <th>User ID</th>
                <th>Carrito</th>
            </tr>
            <?php if (!empty($datos)): ?>
                <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['id']); ?></td>
                    <td><?php echo htmlspecialchars($fila['telefono']); ?></td>
                    <td><?php echo htmlspecialchars($fila['pais']); ?></td>
                    <td><?php echo htmlspecialchars($fila['direccion']); ?></td>
                    <td><?php echo htmlspecialchars($fila['pago']); ?></td>
                    <td><?php echo htmlspecialchars($fila['dia']); ?></td>
                    <td><?php echo htmlspecialchars($fila['mes']); ?></td>
                    <td><?php echo htmlspecialchars($fila['año']); ?></td>
                    <td><?php echo htmlspecialchars($fila['hora']); ?></td>
                    <td><?php echo htmlspecialchars($fila['nota']); ?></td>
                    <td>
                        <a href="baseuser.php?user_id=<?php echo htmlspecialchars($fila['user_id']); ?>">
                            <?php echo htmlspecialchars($fila['user_id']); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($fila['carrito']); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="12">No hay datos disponibles.</td>
                </tr>
            <?php endif; ?>
        </table>
        
        <!-- Botón de menú -->
        <a href="<?= getenv('APP_URL') ?>/postres/administracion.php" class="button">Menú</a>
    </div>
</body>
</html>
