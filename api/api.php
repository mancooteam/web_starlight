<?php
header('Content-Type: application/json');

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