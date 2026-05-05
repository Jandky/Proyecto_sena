<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../DB_Mysql/conexion.php';

// Supongamos que queremos ver el detalle del pedido número 1
$pedido_id = isset($_GET['id_pedido']) ? $_GET['id_pedido'] : 1;

$query = "SELECT 
            d.id_detalle, 
            p.nombre_producto, 
            p.precio,
            d.pedido_id
          FROM detalle_pedido d
          INNER JOIN producto p ON d.producto_id = p.id_producto
          WHERE d.pedido_id = $pedido_id";

$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $detalles = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $detalles[] = $fila;
    }
    echo json_encode(["status" => "success", "data" => $detalles]);
} else {
    echo json_encode(["status" => "error", "message" => "Este pedido no tiene productos registrados."]);
}
?>