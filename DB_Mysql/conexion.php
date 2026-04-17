<?php
// Datos de tu servidor local
$host = "localhost";
$user = "root";
$pass = "";
$db   = "onlyfast_db"; 

$conexion = mysqli_connect($host, $user, $pass, $db);

// Verificación para ayudar a detectar errores
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>