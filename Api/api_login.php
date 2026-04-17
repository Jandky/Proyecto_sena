<?php
/**
 * SERVICIO WEB DE AUTENTICACIÓN - ONLYFAST
 * Evidencia: GA7-220501096-AA5
 * Descripción: API modular que procesa el inicio de sesión utilizando conexión externa.
 */

// 1. Encabezado para respuesta JSON
header("Content-Type: application/json; charset=UTF-8");

// 2. Importar la conexión desde la carpeta DB_Mysql
include_once("../DB_Mysql/conexion.php"); 

// 3. Validar que la petición sea únicamente por método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura de datos con operador de fusión de nulidad para evitar errores
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validar que los campos no estén vacíos antes de consultar la BD
    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Campos obligatorios incompletos"]);
        exit;
    }

    // 4. Consulta a la base de datos (Usando la variable $conexion del include)
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);

    // 5. Lógica de autenticación
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Verificar la contraseña cifrada (hash)
        if (password_verify($password, $usuario['password_hash'])) {
            // ÉXITO: Respuesta requerida por la guía
            echo json_encode([
                "status" => "success",
                "message" => "Autenticación satisfactoria",
                "user" => $usuario['nombres']
            ]);
        } else {
            // ERROR: Contraseña incorrecta
            echo json_encode([
                "status" => "error", 
                "message" => "Error en la autenticación"
            ]);
        }
    } else {
        // ERROR: Correo no encontrado
        echo json_encode([
            "status" => "error", 
            "message" => "Error en la autenticación"
        ]);
    }
} else {
    // Error si el método no es POST (ejemplo: si intentan entrar por el navegador)
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}

// 6. Cerrar conexión de forma segura
if (isset($conexion)) {
    mysqli_close($conexion);
}
?>