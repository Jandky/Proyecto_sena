<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "onlyfast_db");

if (!$conexion) {
    die("Fallo de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);

    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body>";

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        if (password_verify($password, $usuario['password_hash'])) {
            
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nombre'] = $usuario['nombres'];
            $_SESSION['rol'] = $usuario['rol'];

            // Buscar el id_cliente por usuario_id
            $id_usuario = $usuario['id_usuario'];
            $sql_cliente = "SELECT id_cliente FROM cliente WHERE usuario_id = '$id_usuario' LIMIT 1";
            $resultado_cliente = mysqli_query($conexion, $sql_cliente);

            if ($resultado_cliente && mysqli_num_rows($resultado_cliente) > 0) {
                $cliente = mysqli_fetch_assoc($resultado_cliente);
                $_SESSION['cliente_id'] = $cliente['id_cliente'];
            } else {
                unset($_SESSION['cliente_id']);
            }

            $url = ($usuario['rol'] == 1) ? 'Admin_Productos.php' : '../Comidas Rapidas.php';

            echo "<script>
                Swal.fire({
                    title: '¡Acceso Correcto!',
                    text: 'Bienvenido a Onlyfast',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '$url';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'La contraseña es incorrecta.',
                    icon: 'error'
                }).then(() => { window.history.back(); });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'No existe',
                text: 'El usuario no está registrado.',
                icon: 'warning'
            }).then(() => { window.history.back(); });
        </script>";
    }

    echo "</body></html>";

} else {
    header("Location: Login.html");
    exit();
}

mysqli_close($conexion);
?>