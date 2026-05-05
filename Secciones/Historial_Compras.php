<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../DB_Mysql/conexion.php';
date_default_timezone_set('America/Bogota');

$cliente_id = $_SESSION['cliente_id'] ?? null;
$usuario_nombre = $_SESSION['usuario_nombre'] ?? 'Cliente';

$compras = [];
$mensaje = "";

if (empty($cliente_id)) {
    $mensaje = "Debes iniciar sesión para ver tu historial de compras.";
} else {
    $sql = "SELECT 
                p.id_pedido,
                p.fecha_pedido,
                p.total,
                p.estado
            FROM pedido p
            WHERE p.cliente_id = ?
            ORDER BY p.fecha_pedido DESC";

    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $cliente_id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $compras[] = $fila;
        }

        mysqli_stmt_close($stmt);

        if (empty($compras)) {
            $mensaje = "Aún no tienes compras registradas.";
        }
    } else {
        $mensaje = "No se pudo consultar el historial de compras.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras - Onlyfast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold" style="color:#bc4421;">Historial de Compras</h1>
        <p class="text-muted mb-0">Consulta tus pedidos realizados en Onlyfast, <?php echo htmlspecialchars($usuario_nombre); ?>.</p>
    </div>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-warning text-center">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($compras)): ?>
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th># Pedido</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($compras as $compra): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($compra['id_pedido']); ?></td>
                                    <td><?php echo htmlspecialchars($compra['fecha_pedido']); ?></td>
                                    <td>$<?php echo number_format($compra['total'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="badge bg-danger">
                                            <?php echo htmlspecialchars($compra['estado']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../Comidas Rapidas.php" class="btn btn-outline-dark rounded-pill px-4">
            <i class="bi bi-arrow-left"></i> Volver al inicio
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>