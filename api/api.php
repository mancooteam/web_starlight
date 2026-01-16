<?php
// Prevent PHP from sending HTML errors that break JSON parsing
ini_set('display_errors', 0);
header('Content-Type: application/json');

$datos = [];
$db = getenv('DB_PASSWORD');
$host = getenv('DB_HOST');

// 1. Safety Check: Verify environment variables exist in Vercel settings
if (!$db || !$host) {
    echo json_encode(["error" => "Database credentials (DB_PASSWORD or DB_HOST) are missing in Vercel."]);
    exit;
}

// 2. Connect and handle failures
$conexion = mysqli_connect($host, "avnadmin", $db, "starlight");

if (!$conexion) {
    echo json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]);
    exit;
}

// 3. Set charset (Modern replacement for utf8_encode)
mysqli_set_charset($conexion, "utf8mb4");

$sql = "SELECT * FROM st_postac;";
$result = mysqli_query($conexion, $sql);

if ($result) {
    while($fila = mysqli_fetch_assoc($result)){
        // Directly append row; mysqli_set_charset handles the encoding
        $datos[] = $fila; 
    }
    echo json_encode($datos);
} else {
    echo json_encode(["error" => "SQL Query failed: " . mysqli_error($conexion)]);
}

mysqli_close($conexion);
?>