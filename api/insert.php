<?php
// api/insert.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

try {
    require_once 'bd.php';

    if (!isset($pdo)) {
        throw new Exception("No se pudo conectar: la variable \$pdo no está definida en bd.php");
    }

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    // Validar datos mínimos requeridos
    if (empty($input['imie']) || empty($input['klan'])) {
        throw new Exception("Faltan datos obligatorios (Imie o Klan).");
    }
    $sql = "INSERT INTO st_postac (id, imie, klan, ranga, avek, toyhouse)
            VALUES (:id, :imie, :klan, :ranga, :avek, :toyhouse)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':id'       => $input['id'],
        ':imie'     => $input['imie'],
        ':klan'     => $input['klan'],
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