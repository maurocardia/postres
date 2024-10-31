<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="./uploads/magdalena.png" type="image/x-icon">
    <link rel="stylesheet" href="admi.css">
</head>
<body>
    <main>
        <div class="contenedor__todo">
            
            <!-- Formulario de Login y registro -->
            <div class="contenedor__login-register">
                <!-- Login -->
                <form action="loginadmi.php" method="post" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="email" name="login_email" placeholder="Correo Electrónico" required>
                    <input type="password" name="login_password" placeholder="Contraseña" required>
                    <button type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </main>
    <script src="login.js"></script>
</body>
</html>
