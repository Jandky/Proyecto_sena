<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../DB_Mysql/conexion.php';
date_default_timezone_set('America/Bogota');

$nombre_usuario = $_SESSION['usuario_nombre'] ?? null;
$cliente_id = $_SESSION['cliente_id'] ?? null;

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_reserva = trim($_POST['fecha_reserva'] ?? '');
    $hora_reserva = trim($_POST['hora_reserva'] ?? '');
    $cantidad_personas = intval($_POST['cantidad_personas'] ?? 0);
    $observaciones = trim($_POST['observaciones'] ?? '');
    $estado = 'pendiente';
    $sucursal_id = 1;

    if ($fecha_reserva === "" || $hora_reserva === "" || $cantidad_personas <= 0) {
        $mensaje = "Debes completar fecha, hora y cantidad de personas.";
        $tipo_mensaje = "danger";
    } elseif (empty($cliente_id)) {
        $mensaje = "Debes iniciar sesión para registrar una reserva.";
        $tipo_mensaje = "warning";
    } else {
        $sql = "INSERT INTO reserva 
                (fecha_reserva, hora_reserva, cantidad_personas, estado, observaciones, cliente_id, sucursal_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "ssissii",
                $fecha_reserva,
                $hora_reserva,
                $cantidad_personas,
                $estado,
                $observaciones,
                $cliente_id,
                $sucursal_id
            );

            if (mysqli_stmt_execute($stmt)) {
                $mensaje = "¡Reserva registrada con éxito!";
                $tipo_mensaje = "success";
            } else {
                $mensaje = "Error al guardar la reserva: " . mysqli_error($conexion);
                $tipo_mensaje = "danger";
            }

            mysqli_stmt_close($stmt);
        } else {
            $mensaje = "Error al preparar la consulta SQL.";
            $tipo_mensaje = "danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - Comidas Rápidas Onlyfast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css">
</head>
<body>

    <?php include '../includes/navbar.php'; ?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="text-center fw-bold mb-4" style="color:#bc4421;">
                            Reserva tu mesa
                        </h1>

                        <?php if (!empty($mensaje)): ?>
                            <div class="alert alert-<?php echo $tipo_mensaje; ?> text-center">
                                <?php echo htmlspecialchars($mensaje); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="fecha_reserva" class="form-label fw-semibold">Fecha</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="fecha_reserva"
                                    name="fecha_reserva"
                                    value="<?php echo htmlspecialchars($_POST['fecha_reserva'] ?? ''); ?>"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="hora_reserva" class="form-label fw-semibold">Hora</label>
                                <input
                                    type="time"
                                    class="form-control"
                                    id="hora_reserva"
                                    name="hora_reserva"
                                    value="<?php echo htmlspecialchars($_POST['hora_reserva'] ?? ''); ?>"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="cantidad_personas" class="form-label fw-semibold">Cantidad de personas</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="cantidad_personas"
                                    name="cantidad_personas"
                                    min="1"
                                    max="20"
                                    value="<?php echo htmlspecialchars($_POST['cantidad_personas'] ?? '2'); ?>"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="observaciones" class="form-label fw-semibold">Observaciones</label>
                                <textarea
                                    class="form-control"
                                    id="observaciones"
                                    name="observaciones"
                                    rows="3"
                                    placeholder="Ej: mesa cerca a la ventana"><?php echo htmlspecialchars($_POST['observaciones'] ?? ''); ?></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger fw-bold py-2">
                                    Confirmar Reserva
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>