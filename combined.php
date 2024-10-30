<?php
require_once 'config.php';
session_start();
// Configura la conexión a la base de datos

// Crea la conexión
$conn = getDbConnection();

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se ha enviado el formulario de registro
if (isset($_POST['register_email'])) {
    // Datos del formulario de registro
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['register_email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['register_password'] ?? '';

    // Verifica que los datos estén presentes
    if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
        die("Todos los campos son requeridos.");
    }

    // Inserta el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuario (full_name, email, username, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $full_name, $email, $username, $password);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
        // Mensaje y botón para regresar
        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registro Exitoso</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    margin: 0;
                    background-color: #e0d5e8; /* Fondo morado claro */
                }
                h2 {
                    color: #6a0dad; /* Morado oscuro */
                }
                button {
                    background-color: #8a2be2; /* Morado brillante */
                    color: white; /* Texto blanco */
                    border: none; /* Sin borde */
                    padding: 10px 20px; /* Espaciado interno */
                    text-align: center; /* Centrar texto */
                    text-decoration: none; /* Sin subrayado */
                    display: inline-block; /* Mostrar como bloque */
                    font-size: 16px; /* Tamaño de fuente */
                    margin: 20px 0; /* Margen */
                    cursor: pointer; /* Cursor de puntero */
                    border-radius: 5px; /* Bordes redondeados */
                }
                button:hover {
                    background-color: #5a2d92; /* Morado oscuro al pasar el mouse */
                }
            </style>
        </head>
        <body>
            
            <a href="/entrar.php"><button>Inicia Sesión</button></a>
        </body>
        </html>';
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
}

// Verifica si se ha enviado el formulario de inicio de sesión
if (isset($_POST['login_email'])) {
    // Datos del formulario de inicio de sesión
    $email = $_POST['login_email'] ?? '';
    $password = $_POST['login_password'] ?? '';

    // Verifica que los datos estén presentes
    if (empty($email) || empty($password)) {
        die("Todos los campos son requeridos.");
    }

    // Consulta para obtener la contraseña almacenada
    $sql = "SELECT password, id FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        $id_usuario = $row['id'];

        if ($password === $stored_password) {
            // Almacena el ID del usuario en la sesión
            $_SESSION['user_id'] = $id_usuario;

            // Redirige a la página principal
            header("Location: index.php");
            exit();
        } else {
            echo "Credenciales incorrectas.";
            if ($stmt->execute()) {
                // Mensaje y botón para regresar
                echo '<!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Registro Exitoso</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            height: 100vh;
                            margin: 0;
                            background-color: #e0d5e8; /* Fondo morado claro */
                        }
                        h2 {
                            color: #6a0dad; /* Morado oscuro */
                        }
                        button {
                            background-color: #8a2be2; /* Morado brillante */
                            color: white; /* Texto blanco */
                            border: none; /* Sin borde */
                            padding: 10px 20px; /* Espaciado interno */
                            text-align: center; /* Centrar texto */
                            text-decoration: none; /* Sin subrayado */
                            display: inline-block; /* Mostrar como bloque */
                            font-size: 16px; /* Tamaño de fuente */
                            margin: 20px 0; /* Margen */
                            cursor: pointer; /* Cursor de puntero */
                            border-radius: 5px; /* Bordes redondeados */
                        }
                        button:hover {
                            background-color: #5a2d92; /* Morado oscuro al pasar el mouse */
                        }
                    </style>
                </head>
                <body>
                   
                    <a href="/entrar.php"><button>Regresar</button></a>
                </body>
                </html>';
            } else {
                echo "Error al registrar: " . $stmt->error;
            }
        }
    } else {
        echo "No se encontró el usuario.";
    }

    $stmt->close();
}

// Cierra la conexión
$conn->close();
?>
