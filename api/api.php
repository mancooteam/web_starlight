<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../db.php';

try {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT '¡Hola desde la Base de Datos Aiven!' as texto_prueba");
    $resultado = $stmt->fetch();

    $respuesta = [
        "status" => "ok",
        "message" => $resultado['texto_prueba']
    ];

    echo json_encode($respuesta);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Error del servidor: " . $e->getMessage()
    ]);
}
?>