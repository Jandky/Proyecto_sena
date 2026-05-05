<?php
/**
 * API DE REGISTRO - ONLYFAST
 * Funcionalidad: Inserta un nuevo usuario respetando las columnas de la tabla.
 */
header("Content-Type: application/json; charset=UTF-8");
include_once("../DB_Mysql/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura de datos
    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $telefono = $_POST['telefono'] ?? '';

    if (empty($nombres) || empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Nombres, email y contraseña son obligatorios"]);
        exit;
    }

    // Cifrado de seguridad
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Consulta con columnas específicas
    $sql = "INSERT INTO usuario (nombres, apellidos, email, password_hash, telefono) 
            VALUES ('$nombres', '$apellidos', '$email', '$password_hash', '$telefono')";

    if (mysqli_query($conexion, $sql)) {
        echo json_encode(["status" => "success", "message" => "Usuario creado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar: " . mysqli_error($conexion)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
mysqli_close($conexion);
?>