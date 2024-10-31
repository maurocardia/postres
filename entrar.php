<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="./uploads/magdalena.png" type="image/x-icon">
</head>
<body>

<main>
    <div class="contenedor__todo">
        <div class="caja__trasera">
            <div class="caja__trasera-login">
                <h3>¿Ya tienes una cuenta?</h3>
                <p>Inicia sesión para entrar en la página</p>
                <button type="button" id="btn__iniciar-sesion">Iniciar Sesión</button>
            </div>
            <div class="caja__trasera-register">
                <h3>¿Aún no tienes una cuenta?</h3>
                <p>Regístrate para que puedas iniciar sesión</p>
                <button type="button" id="btn__registrarse">Regístrarse</button>
            </div>
        </div>

        <!-- Formulario de Login y registro -->
        <div class="contenedor__login-register">
            <!-- Login -->
            <form action="combined.php" method="post" class="formulario__login">
                <h2>Iniciar Sesión</h2>
                <input type="email" name="login_email" placeholder="Correo Electrónico" required>
                <input type="password" name="login_password" placeholder="Contraseña" required>
                <button type="submit">Entrar</button>
            </form>

            <!-- Register -->
            <form action="combined.php" method="post" class="formulario__register">
                <h2>Regístrarse</h2>
                <input type="text" name="full_name" placeholder="Nombre completo" required>
                <input type="email" name="register_email" placeholder="Correo Electrónico" required>
                <input type="text" name="username" placeholder="Usuario" required>
                <input type="password" name="register_password" placeholder="Contraseña" required>
                <button type="submit">Regístrarse</button>
            </form>
        </div>
    </div>
</main>

<script src="login.js"></script>
</body>
</html>