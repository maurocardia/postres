<?php
// Incluir el archivo de configuración
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión Cerrada</title>
    <link rel="stylesheet" href="cerrar.css">
</head>
<body>
    <div class="container">
        <h1>¡Has cerrado sesión correctamente!</h1>
        <p>Gracias por usar el sistema. Puedes volver a la <a href="<?= getenv('APP_URL') ?>/entraradmi.php">página principal</a> o cerrar esta ventana.</p>
    </div>
</body>
</html>
