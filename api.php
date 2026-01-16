<?php

/*header('Content-Type: application/json');
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
echo json_encode($datos);*/

<?php

header('Content-Type: application/json');

$response = [
    "status" => "success",
    "message" => "Hello from PHP!",
    "timestamp" => date("Y-m-d H:i:s")
];
echo json_encode($response);
?>