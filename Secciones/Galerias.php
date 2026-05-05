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
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css"/>
</head>

<body>

    <!-- Barra de navegación -->
<?php include '../includes/navbar.php'; ?>

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