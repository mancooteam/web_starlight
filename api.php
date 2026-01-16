<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$datos = [];
$db = getenv('DB_PASSWORD');
$host = getenv('DB_HOST');

$conexion = mysqli_connect("$host","avnadmin",$db,"starlight");
$sql = "SELECT * FROM postacie";
$result = mysqli_query($conexion,$sql);
while($fila = mysqli_fetch_assoc($result)){
    $datos[]= array_map('utf8_encode', $fila);
}
echo json_encode($datos);