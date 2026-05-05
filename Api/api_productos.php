<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../DB_Mysql/conexion.php';

// Consulta para unir productos con sus categorías
$query = "SELECT p.*, c.nombre_categoria 
          FROM producto p 
          INNER JOIN categoria_producto c ON p.categoria_id = c.id_categoria 
          WHERE p.disponible = 1";

$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $lista = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $lista[] = $fila;
    }
    echo json_encode(["status" => "success", "data" => $lista]);
} else {
    echo json_encode(["status" => "error", "message" => "No hay productos disponibles"]);
}
?>