<?php
ini_set('display_errors', 0);
header('Content-Type: application/json');

$datos = [];
$db = getenv('DB_PASSWORD');
$host = getenv('DB_HOST');

if (!$db || !$host) {
    echo json_encode(["error" => "Database credentials missing in Vercel environment variables."]);
    exit;
}

$conexion = mysqli_connect($host, "avnadmin", $db, "starlight");

if (!$conexion) {
    echo json_encode(["error" => "Connection failed: " . mysqli_connect_error()]);
    exit;
}

mysqli_set_charset($conexion, "utf8mb4");

$sql = "SELECT * FROM st_postac;";
$result = mysqli_query($conexion, $sql);

if ($result) {
    while($fila = mysqli_fetch_assoc($result)){
        $datos[] = $fila;
    }
    echo json_encode($datos);
} else {
    echo json_encode(["error" => "Query failed: " . mysqli_error($conexion)]);
}

mysqli_close($conexion);
?>