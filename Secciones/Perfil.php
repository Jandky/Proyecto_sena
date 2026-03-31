<?php
session_start();
// 1. Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "onlyfast_db");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: Login.html");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// 2. BUSCAR DATOS ACTUALES PARA MOSTRARLOS EN EL FORMULARIO
$consulta = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";
$resultado = mysqli_query($conexion, $consulta);
$user = mysqli_fetch_assoc($resultado);

// 3. PROCESAR LA ACTUALIZACIÓN (UPDATE)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres    = $_POST['nombres'];
    $telefono   = $_POST['telefono'];
    $direccion  = $_POST['direccion'];
    $tipo_doc   = $_POST['tipo_documento'];
    $num_doc    = $_POST['numero_documento'];
    $ciudad     = $_POST['ciudad'];

    $sql_update = "UPDATE usuario SET 
                    nombres = '$nombres', 
                    telefono = '$telefono', 
                    direccion = '$direccion', 
                    tipo_documento = '$tipo_doc', 
                    numero_documento = '$num_doc', 
                    ciudad = '$ciudad' 
                  WHERE id_usuario = '$id_usuario'";

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<body>"; // Necesario para que SweetAlert se renderice bien

    if (mysqli_query($conexion, $sql_update)) {
        // Actualizamos el nombre en la sesión por si acaso lo cambió
        $_SESSION['usuario_nombre'] = $nombres;
        
        echo "<script>
            Swal.fire({
                title: '¡Perfil Actualizado!',
                text: 'Tus datos se guardaron correctamente.',
                icon: 'success',
                confirmButtonColor: '#bc4421'
            }).then(() => { window.location.href='../Comidas Rapidas.php'; });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'No se pudo actualizar: " . mysqli_error($conexion) . "',
                icon: 'error'
            });
        </script>";
    }
    echo "</body>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - Onlyfast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header text-white text-center" style="background-color: #bc4421;">
                    <h4 class="mb-0"><i class="bi bi-person-gear me-2"></i>Completar mi Perfil</h4>
                </div>
                <div class="card-body p-4">
                    <form action="Perfil.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nombres Completos</label>
                                <input type="text" name="nombres" class="form-control" value="<?php echo $user['nombres']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control bg-body-secondary" value="<?php echo $user['email']; ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted">Miembro desde</label>
                                <input type="text" class="form-control bg-light text-muted" 
                                    value="<?php echo date('d/m/Y', strtotime($user['fecha_registro'])); ?>" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tipo de Documento</label>
                                <select name="tipo_documento" class="form-select">
                                    <option value="CC" <?php if($user['tipo_documento'] == 'CC') echo 'selected'; ?>>Cédula de Ciudadanía</option>
                                    <option value="CE" <?php if($user['tipo_documento'] == 'CE') echo 'selected'; ?>>Cédula de Extranjería</option>
                                    <option value="TI" <?php if($user['tipo_documento'] == 'TI') echo 'selected'; ?>>Tarjeta de Identidad</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Número de Documento</label>
                                <input type="text" name="numero_documento" class="form-control" value="<?php echo $user['numero_documento']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Teléfono / WhatsApp</label>
                                <input type="text" name="telefono" class="form-control" value="<?php echo $user['telefono']; ?>" placeholder="Ej: 3001234567">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Ciudad</label>
                                <input type="text" name="ciudad" class="form-control" value="<?php echo $user['ciudad']; ?>" placeholder="Cartagena">
                            </div>
                            <div class="col-12 mb-4">
                                <label class="form-label fw-bold">Dirección de Entrega</label>
                                <input type="text" name="direccion" class="form-control" value="<?php echo $user['direccion']; ?>" placeholder="Calle, Carrera, Barrio y Apto">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning fw-bold text-white">GUARDAR CAMBIOS</button>
                            <a href="../Comidas Rapidas.php" class="btn btn-outline-secondary">Volver al Inicio</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>