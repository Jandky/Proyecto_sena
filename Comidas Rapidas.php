<?php
session_start();
// Eliminamos la expulsión automática (header Location) para que cualquier persona pueda ver el inicio.
// Solo verificamos si la sesión existe para mostrar el nombre y la carita.
$nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Comidas Rápidas - OnlyFast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="Hoja_de_estilos/Stilo.css">
    
    <style>
        /* Estilo para la carita del usuario */
        .user-avatar {
            transition: all 0.3s ease;
            background: linear-gradient(45deg, #bc4421, #ffc107);
            cursor: pointer;
        }
        .user-avatar:hover {
            transform: scale(1.1);
            filter: brightness(1.1);
        }
        .dropdown-item:hover {
            background-color: #ffe9c6;
            color: #bc4421;
        }
        /* Ajuste para que el nombre no se pegue al borde en móviles */
        @media (max-width: 768px) {
            .navbar-brand img { height: 70px !important; }
        }
    </style>
</head>

<body>

    <h1 class="text-center py-3" style="color: #bc4421; font-weight: bold; font-size: 1.5rem;">GOZA TU VIDA, COME MIENTRAS PUEDAS EN ONLYFAST</h1>

    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <a href="Comidas Rapidas.php" class="navbar-brand">
                <img src="Imagenes/LOGO.png" alt="Logo Onlyfast" style="height: 90px;" />
            </a>

            <div class="collapse navbar-collapse flex-grow-1 justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active fw-bold" href="Comidas Rapidas.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="Secciones/Menu.php">Menú</a></li>
                    <li class="nav-item"><a class="nav-link" href="Secciones/Reservas.php">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="Secciones/Galerias.php">Galería</a></li>
                    <li class="nav-item"><a class="nav-link" href="Secciones/Contacto.php">Contacto</a></li>
                </ul> 
            </div> 

            <div class="d-flex align-items-center">
                
                <form class="d-flex me-2 d-none d-sm-flex" role="search">
                    <input class="form-control form-control-sm me-1" type="search" placeholder="Buscar..." aria-label="Buscar">
                    <button class="btn btn-outline-warning btn-sm" type="submit"><i class="bi bi-search"></i></button>
                </form>

                <a href="Secciones/Carrito.php" class="icon-link position-relative me-3" title="Ver carrito"
                    style="font-size: 1.4rem; color: #bc4421;">
                    <i class="bi bi-cart"></i>
                    <span id="cart-count"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 0.6rem;">0</span>
                </a>

                <?php if ($nombre_usuario): ?>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" style="color: #bc4421;">
                            <div class="user-avatar rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 42px; height: 42px; border: 2px solid #bc4421;">
                                <i class="bi bi-person-fill text-white" style="font-size: 1.3rem;"></i>
                            </div>
                            <span class="fw-bold d-none d-md-inline">
                                <?php 
                                    $partes = explode(" ", $nombre_usuario);
                                    echo $partes[0]; // Muestra solo "Jesus"
                                ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser">
                            <li><p class="dropdown-header fw-bold text-dark">Mi Cuenta</p></li>
                            <li><a class="dropdown-item" href="Secciones/Perfil.php"><i class="bi bi-person-vcard me-2"></i>Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="Secciones/MisPedidos.php"><i class="bi bi-bag-check me-2"></i>Mis Pedidos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger fw-bold" href="Secciones/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                        </ul>
                    </div>
            <?php else: ?>
                <a href="Secciones/Login.html" class="btn btn-outline-danger btn-sm fw-bold me-2">Entrar</a>
                <a href="Secciones/registro.php" class="btn btn-danger">Unirme</a>
            <?php endif; ?>

                <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div id="carouselPublicidad" class="carousel slide shadow-sm rounded-4 overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-inner" style="max-height: 350px;">
                <div class="carousel-item active">
                    <img src="Imagenes/HAMBURGUESA.jpg" class="d-block w-100" alt="Hamburguesa" style="object-fit:cover; height:350px;">
                </div>
                <div class="carousel-item">
                    <img src="Imagenes/MALTEADA.jpg" class="d-block w-100" alt="Malteada" style="object-fit:cover; height:350px;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselPublicidad" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselPublicidad" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-4" style="color:#bc4421; font-weight:bold;">NUESTRAS CATEGORÍAS</h2>
        <div class="row justify-content-center">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="Imagenes/HAMBURGUESA_DOBLE.jpg" class="card-img-top" alt="Burgers">
                    <div class="card-body text-center">
                        <h5 class="fw-bold" style="color:#bc4421;">Burgers Premium</h5>
                    </div>
                </div>
            </div>
            </div>
    </div>

    <footer class="footer bg-light text-center mt-5 py-4 border-top">
        <div class="container">
            <p class="fw-bold mb-1" style="color: #bc4421;">Onlyfast Comidas Rápidas</p>
            <p class="text-muted small">Calle 123, Cartagena, Colombia | +57 123 456 7890</p>
        </div>
        <div class="py-2" style="background-color: #ffe9c6; font-size: 0.85rem;">
            © 2026 Onlyfast Comidas Rápidas. Todos los derechos reservados.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const badge = document.getElementById("cart-count");
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
            if (badge) badge.textContent = totalQty;
        });
    </script>
</body>
</html>