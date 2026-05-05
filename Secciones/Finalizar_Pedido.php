<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../DB_Mysql/conexion.php';

// Verificar que hay carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header("Location: Carrito.php");
    exit();
}

// Verificar que hay usuario logueado
if (!isset($_SESSION['usuario_id'])) {
    die("Error: no hay un usuario logueado en la sesión.");
}

$id_usuario = (int) $_SESSION['usuario_id'];

// Obtener el id del cliente asociado al usuario
$sql_cliente = "SELECT id_cliente FROM cliente WHERE usuario_id = $id_usuario LIMIT 1";
$res_cliente = mysqli_query($conexion, $sql_cliente);

if (!$res_cliente || mysqli_num_rows($res_cliente) === 0) {
    // Si no existe, creamos el cliente automáticamente
    $sql_create = "INSERT INTO cliente (usuario_id) VALUES ($id_usuario)";
    if (mysqli_query($conexion, $sql_create)) {
        $cliente_id = mysqli_insert_id($conexion);
    } else {
        die("Error: no se pudo crear el registro del cliente.");
    }
} else {
    $fila_cliente = mysqli_fetch_assoc($res_cliente);
    $cliente_id = (int) $fila_cliente['id_cliente'];
}

// Datos del pedido
$total = isset($_POST['total_final']) ? (float) $_POST['total_final'] : 0;
$estado = "Pendiente";
$fecha_actual = date('Y-m-d');
$hora_actual = date('H:i:s');
$sucursal_id = 1;

$metodo_pago_id = isset($_POST['metodo_pago_id']) ? (int) $_POST['metodo_pago_id'] : 0;
$observaciones = mysqli_real_escape_string($conexion, $_POST['observaciones'] ?? 'Sin observaciones');
$referencia_pago = mysqli_real_escape_string($conexion, $_POST['referencia_pago'] ?? '');
$detalle_pago = '';

// Validar método de pago
if ($metodo_pago_id <= 0) {
    die("Error: debe seleccionar un método de pago.");
}

// Validar referencia según el método de pago
switch ($metodo_pago_id) {
    case 1:
        $detalle_pago = 'Pago contraentrega';
        $referencia_pago = 'N/A';
        break;
    case 2:
        $detalle_pago = 'Efectivo';
        $referencia_pago = 'N/A';
        break;
    case 3:
        $detalle_pago = 'Transferencia Bre-B';
        if (empty($referencia_pago)) {
            header("Location: Carrito.php?msg=referencia_requerida");
            exit();
        }
        break;
    case 4:
        $detalle_pago = 'Nequi';
        if (empty($referencia_pago)) {
            header("Location: Carrito.php?msg=referencia_requerida");
            exit();
        }
        break;
    case 5:
        $detalle_pago = 'Daviplata';
        if (empty($referencia_pago)) {
            header("Location: Carrito.php?msg=referencia_requerida");
            exit();
        }
        break;
    default:
        die("Error: método de pago inválido.");
}

// Insertar el pedido en la base de datos
$query = "INSERT INTO pedido (
            fecha_pedido,
            hora_pedido,
            total,
            estado,
            obervaciones,
            cliente_id,
            sucursal_id,
            metodo_pago_id,
            referencia_pago,
            detalle_pago
          ) VALUES (
            '$fecha_actual',
            '$hora_actual',
            '$total',
            '$estado',
            '$observaciones',
            '$cliente_id',
            '$sucursal_id',
            '$metodo_pago_id',
            '$referencia_pago',
            '$detalle_pago'
          )";

if (mysqli_query($conexion, $query)) {
    // Obtener el id del pedido recién insertado
    $id_pedido = mysqli_insert_id($conexion);

    // Insertar los detalles del pedido (detalle_pedido)
    foreach ($_SESSION['carrito'] as $id_producto => $item) {
        $cantidad = (int) $item['cantidad'];
        $precio_unitario = (float) $item['precio'];
        $subtotal = $cantidad * $precio_unitario;

        $query_detalle = "INSERT INTO detalle_pedido (
                            pedido_id,
                            producto_id,
                            cantidad,
                            precio_unitario,
                            subtotal
                          ) VALUES (
                            $id_pedido,
                            $id_producto,
                            $cantidad,
                            $precio_unitario,
                            $subtotal
                          )";
        mysqli_query($conexion, $query_detalle);
    }

    // Limpiar el carrito
    unset($_SESSION['carrito']);

    // Redirigir con mensaje de éxito
    header("Location: Pedido_Realizado.php?id_pedido=$id_pedido&total=$total");
    exit();
} else {
    echo "Error en la base de datos: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
