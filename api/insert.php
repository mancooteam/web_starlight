<?php

ini_set('display_errors', 0);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

try {
    $rutaDB = __DIR__ . '/db.php';

    if (file_exists($rutaDB)) {
        require_once $rutaDB;
    } else {
        throw new Exception("No encuentro el archivo en: " . $rutaDB);
    }

    if (!isset($pdo)) {
        throw new Exception("El archivo api/db.php se cargó, pero falta la variable \$pdo.");
    }

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("JSON inválido o vacío.");
    }

    $sql = "INSERT INTO st_postac (id, imie, klan, ranga, avek, toyhouse)
            VALUES (:id, :imie, :klan, :ranga, :avek, :toyhouse)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':id'       => $input['id'] ?? null,
        ':imie'     => $input['imie'] ?? null,
        ':klan'     => $input['klan'] ?? null,
        ':ranga'    => $input['ranga'] ?? '',
        ':avek'     => $input['avek'] ?? '',
        ':toyhouse' => $input['toyhouse'] ?? ''
    ]);

    echo json_encode(["status" => "ok", "message" => "Postać zachowana!"]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>