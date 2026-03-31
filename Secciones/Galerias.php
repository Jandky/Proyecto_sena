<?php
session_start();
$nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Galería - Comidas Rápidas Onlyfast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css" />
</head>

<body>

    <!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        
        <a class="navbar-brand fw-bold" href="../Comidas Rapidas.php" style="color: #bc4421;">ONLYFAST</a>

        <div class="flex-grow-1 d-flex justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../Comidas Rapidas.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="Menu.php">Menú</a></li>
                <li class="nav-item"><a class="nav-link" href="Reservas.php">Reservas</a></li>
                <li class="nav-item"><a class="nav-link active fw-bold" href="Galerias.php">Galería</a></li>
                <li class="nav-item"><a class="nav-link" href="Contacto.php">Contacto</a></li>
            </ul> 
        </div>

        <div class="d-flex align-items-center">
            <a href="Carrito.php" class="icon-link position-relative me-3" style="font-size: 1.4rem; color: #bc4421;">
                <i class="bi bi-cart"></i>
                <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">0</span>
            </a>

            <?php if ($nombre_usuario): ?>
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
                        <li><a class="dropdown-item" href="Perfil.php"><i class="bi bi-person-vcard me-2"></i>Mi Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="Login.html" class="btn btn-outline-danger btn-sm fw-bold me-2">Entrar</a>
                <a href="registro.php" class="btn btn-danger">Unirme</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

    <!-- Sección Galería -->
    <div class="container my-5">
        <h2 class="text-center mb-4"
            style="color:#bc4421; font-weight:bold; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            NUESTROS CLIENTES
        </h2>
        <div class="row g-3">
            <!-- Primera fila -->
            <div class="col-md-3">
                <img src="../Imagenes\COMENSAL2.webp" alt="Cliente 1" class="img-fluid rounded shadow-sm" />
            </div>
            <div class="col-md-3">
                <img src="../Imagenes\COMENSAL1.jpg" alt="Cliente 2" class="img-fluid rounded shadow-sm" />
            </div>
            <div class="col-md-3">
                <img src="../Imagenes\COMENSAL3.webp" alt="Cliente 3" class="img-fluid rounded shadow-sm" />
            </div>
            <div class="col-md-3">
                <img src="../Imagenes\COMENSAL4.avif" alt="Cliente 4" class="img-fluid rounded shadow-sm" />
            </div>

            <!-- Segunda fila -->
            <div class="col-md-3">
                <img src="../Imagenes\COMENSAL5.webp" alt="Cliente 5" class="img-fluid rounded shadow-sm" />
            </div>
            <div class="col-md-3">
                <img src="../Imagenes\COMENSAL6.jpg" alt="Cliente 6" class="img-fluid rounded shadow-sm" />
            </div>
            <div class="col-md-3">
                <img src="../Imagenes\COMENSAL7.avif" alt="Cliente 7" class="img-fluid rounded shadow-sm" />
            </div>
            <div class="col-md-3">
                <img src="../Imagenes\COMENSAL8.jpeg" alt="Cliente 8" class="img-fluid rounded shadow-sm" />
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-light text-center text-lg-start mt-auto py-4">
        <div class="container">
            <div class="row text-start">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-uppercase fw-bold" style="color: #bc4421;">Onlyfast Comidas Rápidas</h5>
                    <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                        Disfruta los mejores platos rápidos con el sabor único de nuestra cocina casera.
                        Calidad y frescura en cada bocado.
                    </p>
                    <p><strong>Dirección:</strong> Calle 123, Cartagena, Colombia</p>
                    <p><strong>Teléfono:</strong> +57 123 456 7890</p>
                    <p><strong>Email:</strong> contacto@onlyfast.com</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-uppercase fw-bold" style="color: #bc4421;">Enlaces</h6>
                    <ul class="list-unstyled">
                        <li><a href="../Comidas Rapidas.html" class="text-decoration-none text-dark">Inicio</a></li>
                        <li><a href="../Secciones/Menu.html" class="text-decoration-none text-dark">Menú</a></li>
                        <li><a href="../Secciones/Reservas.html" class="text-decoration-none text-dark">Reservas</a>
                        </li>
                        <li><a href="../Secciones/Contacto.html" class="text-decoration-none text-dark">Contacto</a>
                        </li>
                        <li><a href="../Secciones/Galerias.html" class="text-decoration-none text-dark">Galería</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="text-uppercase fw-bold" style="color: #bc4421;">Redes Sociales</h6>
                    <a href="#" class="me-3 text-dark fs-4"><i class="bi bi-facebook">Fcb</i></a>
                    <a href="#" class="me-3 text-dark fs-4"><i class="bi bi-instagram">Ig</i></a>
                    <a href="#" class="me-3 text-dark fs-4"><i class="bi bi-twitter">X</i></a>
                    <a href="#" class="text-dark fs-4"><i class="bi bi-youtube">YT</i></a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="text-uppercase fw-bold" style="color: #bc4421;">Horarios</h6>
                    <p>Lun - Vie: 10:00 AM - 9:00 PM</p>
                    <p>Sáb - Dom: 11:00 AM - 10:00 PM</p>
                </div>
            </div>
        </div>
        <div class="text-center py-3" style="background-color: #ffe9c6;">
            © 2025 Onlyfast Comidas Rápidas. Todos los derechos reservados.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-0kNc7S5kQJvSQkoYa6jkZbbGBsFg8Zn5zZC+8LqgeboKF6L2Uv6bO0bb9Dfj3D/l"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>