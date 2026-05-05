<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../DB_Mysql/conexion.php';

// Filtramos por el ID del cliente (por ahora el 1, que es el que creamos)
$cliente_id = 1; 

$query = "SELECT 
            p.id_pedido, 
            p.fecha_pedido, 
            p.hora_pedido, 
            p.estado, 
            p.total, 
            m.nombre_metodo, 
            s.nombre_sucursal,
            p.obervaciones
          FROM pedido p
          INNER JOIN metodo_pago m ON p.metodo_pago_id = m.id_metodo_pago
          INNER JOIN sucursal s ON p.sucursal_id = s.id_sucursal
          WHERE p.cliente_id = $cliente_id
          ORDER BY p.id_pedido DESC";

$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $pedidos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $pedidos[] = $fila;
    }
    echo json_encode(["status" => "success", "data" => $pedidos]);
} else {
    echo json_encode(["status" => "error", "message" => "No tienes pedidos registrados."]);
}
?>