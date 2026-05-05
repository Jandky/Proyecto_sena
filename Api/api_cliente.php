<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../DB_Mysql/conexion.php';

// Consultamos al usuario 13
$id_buscado = 13; 

/**
 * EXPLICACIÓN DE LA CONSULTA:
 * 1. Traemos datos de la tabla cliente (c)
 * 2. Unimos con usuario (u) para el email
 * 3. Unimos con rol_usuario (r) para saber qué significa el id_rol
 */
$query = "SELECT 
            c.id_cliente, 
            c.puntos_acumulados, 
            c.tipo_cliente, 
            u.email, 
            r.nombre_rol 
          FROM cliente c
          INNER JOIN usuario u ON c.usuario_id = u.id_usuario
          INNER JOIN rol_usuario r ON u.rol_id = r.id_rol
          WHERE u.id_usuario = $id_buscado";

$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $datos = mysqli_fetch_assoc($resultado);
    echo json_encode([
        "status" => "success",
        "data" => $datos
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No se encontró el perfil completo."
    ]);
}
?>