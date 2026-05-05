<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("../DB_Mysql/conexion.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onlyfast - Comidas Rápidas</title>
    
    <!-- TUS HOJAS DE ESTILO ANCLADAS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css">
    <link rel="stylesheet" href="../Hoja_de_estilos/Menu_Estilos.css">
    
    <!-- Iconos para el carrito (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="Menu.php">Onlyfast</a>
            
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../Comidas Rapidas.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="Menu.php">Menú</a></li>
                    <li class="nav-item"><a class="nav-link" href="Galerias.php">Galería</a></li>
                    <li class="nav-item"><a class="nav-link" href="Reservas.php">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="Contacto.php">Contacto</a></li>
                </ul>

                <div class="d-flex align-items-center">
                    <!-- SECCIÓN DEL CARRITO (Esto es lo que te faltaba en el menú) -->
                    <a href="Carrito.php" class="text-white me-3 position-relative">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>
                        </span>
                    </a>
                    
                    <a href="Perfil.php" class="btn btn-outline-light me-2">Mi Perfil</a>
                    <a href="logout.php" class="btn btn-danger">Salir</a>
                </div>
            </div>
        </div>
    </nav>
</header>