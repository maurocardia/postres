<?php
// Incluir el archivo de configuración
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* Fondo blanco suave */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .welcome-message {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            text-align: center;
            color: #6a1b9a; /* Color morado oscuro */
            font-size: 2rem; /* Tamaño grande */
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .sidebar {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            background-color: #e1bee7; /* Morado claro */
            color: #333; /* Texto oscuro */
            padding: 30px 40px; /* Espacio dentro del menú */
            border-radius: 15px; /* Bordes redondeados */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 2;
            text-align: center; /* Centrar el texto */
        }

        .sidebar h2 {
            margin-bottom: 20px; /* Espacio debajo del título */
            font-size: 1.8rem; /* Tamaño de fuente grande */
            color: #4a148c; /* Morado oscuro para el título */
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 15px 0; /* Espacio entre los elementos de la lista */
        }

        .sidebar ul li a {
            color: #fff; /* Texto blanco */
            text-decoration: none;
            display: block;
            padding: 15px 20px; /* Espacio dentro del botón */
            border-radius: 8px; /* Bordes redondeados para los botones */
            background-color: #ab47bc; /* Morado más oscuro para los botones */
            transition: background-color 0.3s, transform 0.2s;
        }

        .sidebar ul li a:hover {
            background-color: #9c27b0; /* Morado un poco más oscuro para el hover */
            transform: scale(1.05); /* Efecto de zoom en el hover */
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    

    <div class="sidebar">
        <h2>Menú de Administración</h2>
        <ul>
            <li><a href="<?= getenv('APP_URL') ?>/postres/usuario.php" target="_blank">Registro Usuarios</a></li>
            <li><a href="baseuser.php">Usuarios</a></li>
            <li><a href="basepedidos.php">Pedidos</a></li>
            <li><a href="<?= getenv('APP_URL') ?>/postres/postre.php">Editar Mejores productos</a></li>
            <li><a href="basepostre.php">Lista de postres - Mejores productos</a></li>
            <li><a href="especiales.php">Editar Especiales</a></li>
            <li><a href="base_especial.php">Lista de postres - Especiales</a></li>
            <li><a href="base.php">Administradores</a></li>
            <li><a href="<?= getenv('APP_URL') ?>/postres/">Cerrar Sesión</a></li>
        </ul>
    </div>
</body>
</html>
