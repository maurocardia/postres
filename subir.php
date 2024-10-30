<?php
// Incluir el archivo de configuración
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Postre</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom right, #e0c3fc, #f9d4d4);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 26px;
            color: #5b0f9f;
        }
        input[type="text"], input[type="number"], input[type="file"], select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #5b0f9f;
            border-radius: 6px;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #ffffff;
        }
        input[type="text"]:focus, input[type="number"]:focus, select:focus {
            border-color: #9b59b6;
            box-shadow: 0 0 5px rgba(155, 89, 182, 0.5);
            outline: none;
        }
        input[type="submit"] {
            background-color: #9b59b6;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #7a5c91;
            transform: scale(1.05);
        }
        input[type="submit"]:active {
            transform: scale(0.95);
        }
        .volver-menu {
            text-align: center;
            margin-top: 20px;
        }
        .volver-menu a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #6a0dad;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 0;
            transition: background-color 0.3s;
            width: 100%;
            text-align: center;
        }
        .volver-menu a:hover {
            background-color: #5c0a9b;
        }
        #productos {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form id="postreForm">
            <h2>Agregar Nuevo Postre</h2>
            <input type="text" name="nombre" placeholder="Nombre del postre" required>
            <input type="text" name="descripcion" placeholder="Descripción" required>
            <input type="number" name="precio" placeholder="Precio" required>
            <input type="text" name="categoria" placeholder="Categoría" required>
            <input type="file" name="imagen" accept="image/*" required>
            <input type="submit" value="Subir Postre">
        </form>
        <div id="productos"></div>
        <div class="volver-menu">
            <a href="<?= $_ENV['APP_URL'] ?>/postres/administracion.php">Volver al Menú</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#postreForm").on("submit", function(event) {
            event.preventDefault(); // Prevenir el envío normal

            $.ajax({
                url: 'subir_postre.php', // Cambia esto a tu script PHP que guarda en la BD
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    loadProducts(); // Cargar productos después de agregar el nuevo
                },
                error: function() {
                    alert("Error al agregar el postre.");
                }
            });
        });

        function loadProducts() {
            $.ajax({
                url: 'cargar_productos.php', // Cambia esto a la ruta donde consultas los productos
                type: 'GET',
                success: function(data) {
                    $("#productos").html(data); // Actualiza la sección de productos
                }
            });
        }

        // Cargar productos al inicio
        loadProducts();
    });
    </script>
</body>
</html>
