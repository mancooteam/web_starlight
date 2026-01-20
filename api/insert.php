<?php
// api/insert.php

ini_set('display_errors', 0);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

try {
    if (file_exists(__DIR__ . '/../bd.php')) {
        require_once __DIR__ . '/../bd.php';
    } elseif (file_exists('../bd.php')) {
        require_once '../bd.php';
    } else {
        throw new Exception("Error crítico: No se encuentra el archivo bd.php en la ruta ../bd.php");
    }

    if (!isset($pdo)) {
        throw new Exception("El archivo bd.php se cargó, pero la variable \$pdo no existe.");
    }

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("JSON inválido.");
    }

    // Preparar SQL
    $sql = "INSERT INTO st_postac (id, imie, klan, ranga, avek, toyhouse)
            VALUES (:id, :imie, :klan, :ranga, :avek, :toyhouse)";

    $stmt = $pdo->prepare($sql);

    // Ejecutar
    $stmt->execute([
        ':id'       => $input['name'] ?? null,
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