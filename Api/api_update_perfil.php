<?php
/**
 * API ACTUALIZAR DATOS - ONLYFAST
 * Funcionalidad: Modifica nombres, apellidos y celular en la tabla usuario.
 */
header("Content-Type: application/json; charset=UTF-8");
include_once("../DB_Mysql/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_usuario'] ?? '';
    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $telefono = $_POST['telefono'] ?? '';

    if (empty($id)) {
        echo json_encode(["status" => "error", "message" => "ID de usuario es obligatorio"]);
        exit;
    }

  
    $sql = "UPDATE usuario SET nombres = '$nombres', apellidos = '$apellidos', telefono = '$telefono' WHERE id_usuario = '$id'";

    if (mysqli_query($conexion, $sql)) {
        echo json_encode(["status" => "success", "message" => "Datos actualizados correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar"]);
    }
}
mysqli_close($conexion);
?>