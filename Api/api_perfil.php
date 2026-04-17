<?php
/**
 * API DE CONSULTA DE PERFIL - ONLYFAST
 * Funcionalidad: Retorna todos los datos del usuario logueado.
 */
header("Content-Type: application/json; charset=UTF-8");
include_once("../DB_Mysql/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id_usuario'] ?? '';

    if (empty($id)) {
        echo json_encode(["status" => "error", "message" => "ID de usuario necesario"]);
        exit;
    }

    // Seleccionamos las columnas reales de tu tabla
    $sql = "SELECT id_usuario, nombres, apellidos, email, telefono, fecha_registro FROM usuario WHERE id_usuario = '$id'";
    $resultado = mysqli_query($conexion, $sql);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        echo json_encode([
            "status" => "success",
            "data" => $fila
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]);
    }
}
mysqli_close($conexion);
?>