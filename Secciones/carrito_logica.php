<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Verificar que lleguen los datos por POST
if (isset($_POST['id_producto']) && isset($_POST['btn_agregar'])) {
    $id = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    // Si el carrito no existe en la sesión, lo creamos como un array vacío
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Si el producto ya está en el carrito, aumentamos la cantidad
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad']++;
    } else {
        // Si no está, lo agregamos con cantidad 1
        $_SESSION['carrito'][$id] = array(
            "nombre" => $nombre,
            "precio" => $precio,
            "categoria" => $categoria,
            "cantidad" => 1
        );
    }

    // Regresamos al menú con un mensaje de éxito
    header("Location: Menu.php?msg=agregado");
    exit();
}

// Lógica para eliminar desde la tabla del carrito
if (isset($_GET['eliminar_item'])) {
    $id_res = $_GET['eliminar_item'];
    if (isset($_SESSION['carrito'][$id_res])) {
        unset($_SESSION['carrito'][$id_res]);
    }
    header("Location: Carrito.php");
    exit();
}
?>