<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Conectamos con tu archivo de conexión (asegúrate que la ruta sea esta)
require_once '../DB_Mysql/conexion.php';

// Consulta para traer todas tus categorías
$query = "SELECT id_categoria, nombre_categoria, descripcion_categoria FROM categoria_producto";

$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $categorias = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $categorias[] = $fila;
    }
    
    echo json_encode([
        "status" => "success",
        "data" => $categorias
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No hay categorías registradas"
    ]);
}
?>