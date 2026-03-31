<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "onlyfast_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);

    echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body>";

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        if (password_verify($password, $usuario['password_hash'])) {
            // Guardar datos en la sesión
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nombre'] = $usuario['nombres'];

            echo "<script>
                Swal.fire({
                    title: '¡Hola de nuevo!',
                    text: 'Bienvenido, " . $usuario['nombres'] . ". Preparando tu menú...',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href='../Comidas Rapidas.php'; 
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Contraseña Incorrecta',
                    text: 'Verifica tus datos e intenta de nuevo.',
                    icon: 'warning',
                    confirmButtonColor: '#dc3545'
                }).then(() => { window.history.back(); });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Usuario no encontrado',
                text: 'El correo electrónico no está registrado.',
                icon: 'error',
                confirmButtonColor: '#dc3545'
            }).then(() => { window.history.back(); });
        </script>";
    }
    echo "</body></html>";
}
mysqli_close($conexion);
?>