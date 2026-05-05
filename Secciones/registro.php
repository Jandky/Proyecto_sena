<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "onlyfast_db");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres  = mysqli_real_escape_string($conexion, trim($_POST['nombres']));
    $email    = mysqli_real_escape_string($conexion, trim($_POST['email']));
    $password = $_POST['password'] ?? '';
    $confirmar_password = $_POST['confirmar_password'] ?? '';

    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body>";

    if ($password !== $confirmar_password) {
        echo "<script>
            Swal.fire({
                title: 'Contraseñas diferentes',
                text: 'La contraseña y su confirmación no coinciden.',
                icon: 'warning',
                confirmButtonColor: '#dc3545'
            }).then(() => { window.history.back(); });
        </script>";
        echo "</body></html>";
        exit();
    }

    $verificar = mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE email = '$email' LIMIT 1");

    if ($verificar && mysqli_num_rows($verificar) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Correo ya registrado',
                text: 'Ese correo electrónico ya está en uso.',
                icon: 'warning',
                confirmButtonColor: '#dc3545'
            }).then(() => { window.history.back(); });
        </script>";
        echo "</body></html>";
        exit();
    }

    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $fecha_hoy = date('Y-m-d');

    mysqli_begin_transaction($conexion);

    try {
        $sql_usuario = "INSERT INTO usuario (nombres, email, password_hash, activo)
                        VALUES ('$nombres', '$email', '$pass_hash', 1)";

        if (!mysqli_query($conexion, $sql_usuario)) {
            throw new Exception("No se pudo crear el usuario: " . mysqli_error($conexion));
        }

        $id_usuario_nuevo = mysqli_insert_id($conexion);

        $sql_cliente = "INSERT INTO cliente (tipo_cliente, puntos_acumulados, fecha_ultima_compra, usuario_id)
                        VALUES ('Regular', 0, '$fecha_hoy', '$id_usuario_nuevo')";

        if (!mysqli_query($conexion, $sql_cliente)) {
            throw new Exception("Usuario creado, pero no se pudo crear el cliente: " . mysqli_error($conexion));
        }

        mysqli_commit($conexion);

        echo "<script>
            Swal.fire({
                title: '¡Registro Exitoso!',
                text: 'Bienvenido a la familia Onlyfast, $nombres.',
                icon: 'success',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ir al Login'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='Login.html';
                }
            });
        </script>";

    } catch (Exception $e) {
        mysqli_rollback($conexion);

        echo "<script>
            Swal.fire({
                title: 'Error',
                text: " . json_encode($e->getMessage()) . ",
                icon: 'error',
                confirmButtonColor: '#dc3545'
            }).then(() => { window.history.back(); });
        </script>";
    }

    echo "</body></html>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Onlyfast - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css">
</head>
<body>

    <div class="login-wrapper container my-5">
        <div class="login-card d-flex flex-wrap shadow-lg rounded overflow-hidden">
            
            <div class="panel-left p-5 text-center d-none d-md-flex flex-column align-items-center justify-content-center" 
                 style="background-color: #ffc107 !important; min-height: 100%; border-radius: 15px 0 0 15px; flex: 1.1; box-shadow: -5px 5px 15px rgba(0,0,0,0.2);">
                
                <div class="emoji-food display-1">🍔</div>
                
                <div class="brand-name h2 fw-bold">Only<span class="text-danger">Fast</span></div>
                
                <p class="mt-3 mb-4 fw-medium" style="color: #333; max-width: 320px; font-size: 1.15rem; line-height: 1.4;">
                    Tu lugar favorito para pedir comida rápida en Cartagena
                </p>
                
                <button class="btn rounded-pill px-4 py-2 fw-bold text-white shadow" 
                        style="background-color: #bc4421; border: none; font-size: 1.1rem; transition: background-color 0.3s ease;">
                    🎉 Regístrate y obtén 10% OFF
                </button>
            </div>

            <div class="panel-right p-5 bg-white" style="flex: 1.2;">
                <div class="tabs-login d-flex justify-content-between align-items-center mb-4">
                    
                    <div class="titulo-registro">
                        <h2 class="fw-bold m-0" style="color: #333; font-size: 1.8rem; letter-spacing: -1px;">
                            Registrarse
                        </h2>
                        <div style="width: 40px; height: 4px; background-color: #bc4421; margin-top: 4px; border-radius: 2px;"></div>
                    </div>
                    
                    <a href="../Comidas%20Rapidas.php" class="text-decoration-none">
                        <button type="button" class="tab-btn btn btn-warning fw-bold" style="background-color: #ffc107; border: none; color: #333;">
                            Volver a inicio
                        </button>
                    </a>
                </div>

                <form action="registro.php" method="POST">
                    <div class="mb-3">
                        <label>Nombre completo</label>
                        <input type="text" name="nombres" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="confirmar_password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 py-2">Crear Cuenta</button>
                </form>
            </div>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const params = new URLSearchParams(window.location.search);
    const tab = params.get('tab');

    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    if (tab === 'login') {
        if (loginForm) loginForm.style.display = 'block';
        if (registerForm) registerForm.style.display = 'none';
    } else {
        if (loginForm) loginForm.style.display = 'none';
        if (registerForm) registerForm.style.display = 'block';
    }
});
</script>

</body>
</html>