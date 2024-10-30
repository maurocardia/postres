<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

// Cargar variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Obtener las variables de conexión desde el archivo .env
$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];



// Comprobar que se cargan las variables de entorno correctamente (opcional)


// Crear conexión a la base de datos
//$conexion = new mysqli($servername, $username, $password, $dbname);
$conexion = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Si necesitas realizar alguna operación con la base de datos, puedes hacerlo aquí

?>
