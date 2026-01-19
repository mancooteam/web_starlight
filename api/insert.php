<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (!isset($input['imie']) || !isset($input['klan'])) {
        throw new Exception("Datos incompletos. Se requiere al menos 'imie' y 'klan'.");
    }

    $sql = "INSERT INTO st_postac (imie, klan, ranga, avek, toyhouse) VALUES (:imie, :klan, :ranga, :avek, :toyhouse)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':imie'     => $input['imie'],
        ':klan'     => $input['klan'],
        ':ranga'    => $input['ranga'] ?? 'nkt',
        ':avek'     => $input['avek'] ?? '',
        ':toyhouse' => $input['toyhouse'] ?? ''
    ]);

    // 7. Responder con éxito
    echo json_encode([
        "status" => "ok",
        "message" => "Postać pomyślnie stworzona",
        "id" => $pdo->lastInsertId()
    ]);

} catch (PDOException $e) {
    // Error de Base de Datos
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Error BD: " . $e->getMessage()]);
} catch (Exception $e) {
    // Error General
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>