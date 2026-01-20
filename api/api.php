<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'db.php';

try {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT * FROM st_postac ORDER BY id");

    $resultarray = array();

    if ($stmt) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultarray[] = $row;
        }
    }

    $respuesta = [
        "status" => "ok",
        "message" => $resultarray
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