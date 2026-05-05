<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Detectar si estamos en la raíz o en la carpeta Secciones
$basePath = (strpos($_SERVER['PHP_SELF'], '/Secciones/') !== false) ? '../' : '';

// Calcular SIEMPRE el total del carrito desde la sesión
$total_productos = 0;
if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $total_productos += isset($producto['cantidad']) ? (int)$producto['cantidad'] : 1;
    }
}

// Si $nombre_usuario no existe, definimos valor por defecto
if (!isset($nombre_usuario)) {
    $nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : "Invitado";
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        
        <a class="navbar-brand fw-bold" href="<?php echo $basePath; ?>Comidas Rapidas.php" style="color: #bc4421;">
            ONLYFAST
        </a>

        <div class="flex-grow-1 d-flex justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $basePath; ?>Comidas Rapidas.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $basePath; ?>Secciones/Menu.php">Menú</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $basePath; ?>Secciones/Reservas.php">Reservas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $basePath; ?>Secciones/Galerias.php">Galería</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $basePath; ?>Secciones/Contacto.php">Contacto</a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center">
        <form class="d-flex" action="Menu.php" method="GET">
            <input 
                class="form-control me-2" 
                type="search" 
                name="buscar" 
                placeholder="Buscar..." 
                aria-label="Buscar"
            >
            <button class="btn btn-outline-warning" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

            <?php if (!isset($ocultar_carrito_nav) || $ocultar_carrito_nav !== true): ?>
                <a href="<?php echo $basePath; ?>Secciones/Carrito.php" class="icon-link position-relative me-3" style="font-size: 1.4rem; color: #bc4421;">
                    <i class="bi bi-cart"></i>
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                        <?php echo $total_productos; ?>
                    </span>
                </a>
            <?php endif; ?>

            <?php if ($nombre_usuario && $nombre_usuario !== "Invitado"): ?>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" style="color: #bc4421;">
                        <div class="user-avatar rounded-circle d-flex align-items-center justify-content-center me-2"
                             style="width: 40px; height: 40px; border: 2px solid #bc4421; background: linear-gradient(45deg, #bc4421, #ffc107);">
                            <i class="bi bi-person-fill text-white"></i>
                        </div>
                        <span class="fw-bold d-none d-md-inline">
                            <?php
                                $partes = explode(" ", $nombre_usuario);
                                echo $partes[0];
                            ?>
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li>
                            <a class="dropdown-item" href="<?php echo $basePath; ?>Secciones/Perfil.php">
                                <i class="bi bi-person-vcard me-2"></i>Mi Perfil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger fw-bold" href="<?php echo $basePath; ?>Secciones/logout.php">
                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="<?php echo $basePath; ?>Secciones/Login.html" class="btn btn-outline-danger btn-sm fw-bold me-2">Entrar</a>
                <a href="<?php echo $basePath; ?>Secciones/registro.php" class="btn btn-danger btn-sm fw-bold">Unirme</a>
            <?php endif; ?>
        </div>
    </div>
</nav>