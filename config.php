<?php
// config.php

// Cargar el archivo .env
if (file_exists(__DIR__ . '/.env')) {
    $env = file(__DIR__ . '/.env');
    foreach ($env as $line) {
        // Ignorar líneas vacías y comentarios
        if (trim($line) === '' || strpos(trim($line), '#') === 0) {
            continue;
        }
        // Separar clave y valor
        list($key, $value) = explode('=', trim($line), 2);
        $key = trim($key);
        $value = trim($value);
        putenv("$key=$value"); // Cargar la variable en el entorno
    }
}

// Crear conexión a la base de datos
function getDbConnection() {
    $host = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $password = getenv('DB_PASS');
    $dbname = getenv('DB_NAME');
    $dbport = getenv('DB_PORT');


    // Crear conexión
    $connection = mysqli_connect($host, $user, $password, $dbname, $dbport);

    // Verificar conexión
    if (mysqli_connect_errno()) {
        die("Fallo la conexión a la base de datos: " . mysqli_connect_error());
    }
    
    return $connection;
}