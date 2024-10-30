<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = $_POST['telefono'] ?? null;
    $pais = $_POST['pais'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $pago = $_POST['pago'] ?? null;
    $dia = $_POST['dia'] ?? null;
    $mes = $_POST['mes'] ?? null;
    $año = $_POST['año'] ?? null; 
    $hora = $_POST['hora'] ?? null;
    $nota = $_POST['nota'] ?? null;
    $carrito = $_POST['cart_contents'] ?? null;

    if (!isset($_SESSION['user_id'])) {
        die("Debe iniciar sesión para realizar un pedido.");
    }

    $id_usuario = $_SESSION['user_id'];

    if (is_null($telefono) || is_null($pais) || is_null($direccion) || is_null($pago) || is_null($dia) || is_null($mes) || is_null($año) || is_null($hora) || is_null($carrito)) {
        die('Por favor complete todos los campos requeridos.');
    }

    // Validar y formatear la hora
    if (!empty($hora)) {
        $hora_formateada = date("h:i A", strtotime($hora));
    } else {
        die('Por favor ingrese una hora válida.');
    }

    $sql = "INSERT INTO pedidos (telefono, pais, direccion, pago, dia, mes, año, hora, nota, user_id, carrito) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssssssis", $telefono, $pais, $direccion, $pago, $dia, $mes, $año, $hora_formateada, $nota, $id_usuario, $carrito);

    if ($stmt->execute()) {
        // Mensaje y botón para regresar
        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pedido Exitoso</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    margin: 0;
                    background-color: #f5f0ff; /* Morado claro */
                    color: #4b0082; /* Texto oscuro */
                }
                h2 {
                    color: #7a4b8c; /* Morado más intenso */
                }
                button {
                    background-color: #eab8ff; /* Morado claro */
                    color: #4b0082; /* Texto oscuro */
                    border: none; /* Sin borde */
                    padding: 10px 20px; /* Espaciado interno */
                    text-align: center; /* Centrar texto */
                    text-decoration: none; /* Sin subrayado */
                    display: inline-block; /* Mostrar como bloque */
                    font-size: 16px; /* Tamaño de fuente */
                    margin: 20px 0; /* Margen */
                    cursor: pointer; /* Cursor de puntero */
                    border-radius: 5px; /* Bordes redondeados */
                    transition: background-color 0.3s; /* Transición suave */
                }
                button:hover {
                    background-color: #d8c3e5; /* Cambio al pasar el mouse */
                }
            </style>
        </head>
        <body>
            <h2>Pedido registrado exitosamente.</h2>
            <a href="index.php"><button>Regresar a la página principal</button></a>
        </body>
        </html>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "No se ha enviado ningún formulario.";
}
?>
