<?php
// Incluir el archivo de configuración
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_user.css"> 
    <title>Usuarios_CRUD</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Fondo suave */
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .users-form {
            background-color: #ffffff; /* Fondo blanco */
            padding: 15px; /* Reducir padding */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
            max-width: 300px; /* Ancho máximo del formulario */
        }

        .users-form h1 {
            color: #6a0dad; /* Morado oscuro */
            margin-bottom: 15px; /* Reducir margen */
            font-size: 1.5em; /* Ajustar tamaño de fuente */
        }

        .users-form input[type="text"],
        .users-form input[type="password"],
        .users-form input[type="email"],
        .users-form input[type="submit"] {
            width: 100%;
            padding: 8px; /* Reducir padding */
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .users-table {
            width: 100%;
            max-width: 800px; /* Ancho máximo de la tabla */
            overflow-x: auto; /* Habilitar desplazamiento horizontal */
        }

        h2 {
            color: #6a0dad; /* Morado oscuro */
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center; /* Centrar contenido */
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Color alternado para las filas */
        }

        tr:hover {
            background-color: #f1f1f1; /* Color al pasar el cursor sobre las filas */
        }

        a {
            text-decoration: none;
            color: #6a0dad; /* Morado oscuro */
        }

        a:hover {
            text-decoration: underline; /* Subrayar al pasar el cursor */
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #6a0dad; /* Color del botón */
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            margin-top: 20px; /* Espacio arriba del botón */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #5c0a9b; /* Color más oscuro al pasar el cursor */
        }

        /* Responsividad */
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
    
    <div class="users-form">
        <form action="insert_user.php" method="POST">
            <h1>Crear Usuario</h1>
            <input type="text" name="full_name" placeholder="Nombre" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="submit" value="Agregar usuario">
        </form>
    </div>

    <div class="users-table">
        <h2>Usuarios registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexion.php';

                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                }

                $sql = "SELECT id, full_name, username, email FROM usuario";
                $query = $conexion->query($sql);

                if (!$query) {
                    die("Error en la consulta: " . $conexion->error);
                }

                while($row = $query->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><a href="edit_user.php?id=<?= $row['id'] ?>">Editar</a></td>
                    <td><a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a></td>
                </tr>
                <?php endwhile; ?>

                <?php $conexion->close(); ?>
            </tbody>
        </table>
    </div>

    <!-- Botón para volver al menú -->
    <a href="<?= $_ENV['APP_URL'] ?>/postres/administracion.php" class="button">Volver al menú</a>
</body>
</html>
