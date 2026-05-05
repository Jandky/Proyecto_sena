<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

require_once '../DB_Mysql/conexion.php';

// Recibimos los datos del carrito (vienen en formato JSON desde el Frontend)
$datos_recibidos = json_decode(file_get_contents("php://input"), true);

if (!empty($datos_recibidos)) {
    $cliente_id = $datos_recibidos['cliente_id'];
    $sucursal_id = $datos_recibidos['sucursal_id'];
    $metodo_pago_id = $datos_recibidos['metodo_pago_id'];
    $total = $datos_recibidos['total'];
    $notas = $datos_recibidos['notas'];
    $carrito = $datos_recibidos['productos']; // Esto será una lista de IDs

    // 1. Insertamos el Pedido
    $sql_pedido = "INSERT INTO pedido (cliente_id, estado, fecha_pedido, hora_pedido, metodo_pago_id, obervaciones, sucursal_id, total) 
                   VALUES ('$cliente_id', 'Pendiente', CURDATE(), CURTIME(), '$metodo_pago_id', '$notas', '$sucursal_id', '$total')";
    
    if (mysqli_query($conexion, $sql_pedido)) {
        $id_nuevo_pedido = mysqli_insert_id($conexion); // Obtenemos el ID que se acaba de crear

        // 2. Insertamos cada producto del carrito
        foreach ($carrito as $id_producto) {
            $sql_detalle = "INSERT INTO detalle_pedido (pedido_id, producto_id) VALUES ('$id_nuevo_pedido', '$id_producto')";
            mysqli_query($conexion, $sql_detalle);
        }

        echo json_encode(["status" => "success", "message" => "Pedido #$id_nuevo_pedido guardado con éxito"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al crear el pedido"]);
    }
}
?>