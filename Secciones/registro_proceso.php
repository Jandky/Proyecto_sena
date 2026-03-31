<?php
session_start();
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "onlyfast_db");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres  = $_POST['nombres'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Encriptar contraseña para seguridad
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar en la tabla 'usuario'
    $sql = "INSERT INTO usuario (nombres, email, password_hash, activo) 
        VALUES ('$nombres', '$email', '$pass_hash', 1)";

    // Incluimos SweetAlert2 para la respuesta visual
    echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body>";

    if (mysqli_query($conexion, $sql)) {
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
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'No se pudo crear la cuenta: " . mysqli_error($conexion) . "',
                icon: 'error',
                confirmButtonColor: '#dc3545'
            }).then(() => { window.history.back(); });
        </script>";
    }
    echo "</body></html>";
}
mysqli_close($conexion);
?>