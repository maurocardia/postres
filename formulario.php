


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pedido</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            flex-direction: column;
            width: 80%;
            max-width: 800px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .form-section {
            padding: 20px;
            box-sizing: border-box;
        }
        h2 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
            height: 100px;
        }
        .form-group .inline {
            display: inline-block;
            width: calc(50% - 10px);
            margin-right: 10px;
        }
        .form-group .inline:last-child {
            margin-right: 0;
        }
        .form-group .inline input {
            width: 100%;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .button-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h2>Datos de Contacto</h2>
            <form id="pedido-form" action="procesar_pedido.php" method="POST">
                <div class="form-group">
                    <label for="telefono">Número de Teléfono Móvil:</label>
                    <input type="tel" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="pais">País/Región:</label>
                    <input type="text" id="pais" name="pais" value="Colombia" readonly>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>
                <div class="form-group">
                    <label for="pago">Pago:</label>
                    <select id="pago" name="pago" required>
                        <option value="contraentrega">Contraentrega</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dia">Día de Entrega:</label>
                    <input type="number" id="dia" name="dia" min="1" max="31" required>
                </div>
                <div class="form-group">
                    <label for="mes">Mes de Entrega:</label>
                    <input type="number" id="mes" name="mes" min="1" max="12" required>
                </div>
                <div class="form-group">
                    <label for="año">Año de Entrega:</label>
                    <input type="number" id="año" name="año" min="2024" required>
                </div>
                <div class="form-group">
                    <label for="hora">Hora de Entrega:</label>
                    <input type="time" id="hora" name="hora" required>
                </div>
                <div class="form-group">
                    <label for="notas">Notas, Comentarios o Sugerencias:</label>
                    <textarea id="nota" name="nota"></textarea>
                </div>
                <div class="form-group">
                    <label for="carrito">Carrito:</label>
                    <textarea name="cart_contents" id="cart_contents" rows="5" cols="40"></textarea>
                </div>
                <div class="button-container">
                    <button type="submit">Finalizar Pedido</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Recuperar el carrito almacenado en localStorage
        const savedCart = localStorage.getItem('cart');
        console.log("Carrito recuperado de localStorage:", savedCart);

        // Si hay algo en el carrito, pasarlo al campo de texto
        if (savedCart) {
            const cart = JSON.parse(savedCart);
            console.log("Carrito parseado:", cart);

            // Formatear el carrito para mostrar cada producto y precio
            const formattedCart = cart.map(item => `${item.name}: ${item.price.toFixed(3).replace('.', ',')}`).join('\n');
            console.log("Carrito formateado:", formattedCart);

            // Colocar el contenido del carrito en el campo de texto
            document.getElementById('cart_contents').value = formattedCart;
        }
    </script>
    

</body>
</html>
