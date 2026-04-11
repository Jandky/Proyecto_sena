<?php
/**
 * SERVICIO WEB DE AUTENTICACIÓN - ONLYFAST
 * Evidencia: GA7-220501096-AA5-EV01
 * Descripción: API que procesa el inicio de sesión y devuelve respuestas en formato JSON.
 */

// Definir el encabezado para que el navegador/cliente sepa que recibe datos JSON
header("Content-Type: application/json; charset=UTF-8");

// Configuración de la conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "onlyfast_db");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    echo json_encode(["status" => "error", "message" => "Error de conexión al servidor"]);
    exit;
}

// El servicio solo procesa peticiones mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura de datos enviados por el cliente
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Consulta para buscar al usuario por su correo electrónico
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);

    // Validación de existencia del usuario
    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Verificación de la contraseña utilizando hash
        if (password_verify($password, $usuario['password_hash'])) {
            // RESPUESTA REQUERIDA POR LA GUÍA: Autenticación satisfactoria
            echo json_encode([
                "status" => "success",
                "message" => "Autenticación satisfactoria",
                "user" => $usuario['nombres']
            ]);
        } else {
            // RESPUESTA REQUERIDA POR LA GUÍA: Error en la autenticación
            echo json_encode([
                "status" => "error", 
                "message" => "Error en la autenticación"
            ]);
        }
    } else {
        // En caso de que el correo no exista, también devuelve error de autenticación
        echo json_encode([
            "status" => "error", 
            "message" => "Error en la autenticación"
        ]);
    }
} else {
    // Si intentan entrar por una vía que no sea POST
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}

// Cierre de la conexión
mysqli_close($conexion);
?>