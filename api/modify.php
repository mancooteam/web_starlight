<?php
// 1. Fix the opening tag (no space allowed)
ini_set('display_errors', 0); // Hide system errors from output
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/db.php'; // Ensure path to db.php is correct

try {
    // 2. Get connection
    $pdo = getDBConnection();

    // 3. Get the ID.
    // We check if it was sent via JSON (POST) or URL (GET)
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

    // 4. Secure Query (Prepared Statement)
    // NEVER use "$id" directly in SQL. Use :id placeholder.
    $sql = "SELECT * FROM st_postac WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $character = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($character) {
        // Character found
        echo json_encode([
            "status" => "ok",
            "data" => $character
        ]);
    } else {
        // Character not found
        echo json_encode([
            "status" => "error",
            "message" => "Nie znaleziono postaci o ID: " . $id
        ]);
    }

    // 5. STOP script to prevent HTML or whitespace from breaking JSON
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