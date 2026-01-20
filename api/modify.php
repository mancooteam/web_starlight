<?php
// 1. Fix the opening tag (no space allowed)
ini_set('display_errors', 0); // Hide system errors from output
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/db.php';

try {
    $pdo = getDBConnection();

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    $id = null;
    if (isset($input['id'])) {
        $id = $input['id'];
    } elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (!$id) {
        throw new Exception("Brak ID postaci (Missing Character ID)");
    }

    $sql = "SELECT * FROM st_postac WHERE id = "$id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $character = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($character) {
        echo json_encode([
            "status" => "ok",
            "data" => $character
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Nie znaleziono postaci o ID: " . $id
        ]);
    }
    exit;

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
    exit;
}
?>