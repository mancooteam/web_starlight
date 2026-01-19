<?php
// db.php

function getDBConnection() {
    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $db   = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

    try {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_SSL_CA => true,
        ];

        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        error_log("Error de conexión: " . $e->getMessage());
        die("Error al conectar con la base de datos.");
    }
}
?>