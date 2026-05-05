<?php
session_start();

// Calculamos cuántos productos hay en la sesión del carrito
$total_productos = 0;
if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $total_productos += $producto['cantidad'];
    }
}

// Variable para el nombre (Invitado por defecto)
$nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : "Invitado";
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

<?php include 'includes/navbar.php'; ?>

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


</body>
</html>