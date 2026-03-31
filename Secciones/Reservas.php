<?php
session_start();
// Verificamos si hay una sesión activa para mostrar el nombre y la carita
$nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reservas - Comidas Rápidas Onlyfast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css" />
    
    <style>
        .user-avatar {
            transition: all 0.3s ease;
            background: linear-gradient(45deg, #bc4421, #ffc107);
            cursor: pointer;
        }
        .user-avatar:hover { transform: scale(1.1); }
        .dropdown-item:hover { background-color: #ffe9c6; color: #bc4421; }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            
            <a class="navbar-brand fw-bold" href="../Comidas Rapidas.php" style="color: #bc4421;">ONLYFAST</a>

            <div class="flex-grow-1 d-flex justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../Comidas Rapidas.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Secciones/Menu.php">Menú</a></li>
                    <li class="nav-item"><a class="nav-link active fw-bold" href="Reservas.php">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Secciones/Galerias.php">Galería</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Secciones/Contacto.php">Contacto</a></li>
                </ul> 
            </div>

            <div class="d-flex align-items-center">
                <form class="d-flex me-2" role="search">
                    <input class="form-control form-control-sm me-1" type="search" placeholder="Buscar..." aria-label="Buscar">
                    <button class="btn btn-outline-warning btn-sm" type="submit" title="Buscar"><i class="bi bi-search"></i></button>
                </form>

                <a href="../Secciones/Carrito.php" class="icon-link position-relative me-3" title="Ver carrito"
                    style="font-size: 1.4rem; color: #bc4421;">
                    <i class="bi bi-cart"></i>
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 0.6rem;">0</span>
                </a>

                <?php if ($nombre_usuario): ?>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" style="color: #bc4421;">
                            <div class="user-avatar rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; border: 2px solid #bc4421;">
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
                            <li><a class="dropdown-item" href="../Secciones/Perfil.php"><i class="bi bi-person-vcard me-2"></i>Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger fw-bold" href="../Secciones/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="../Secciones/registro.php" class="btn btn-outline-danger btn-sm fw-bold me-2">Entrar</a>
                    <a href="../Secciones/registro.php?tab=registro" class="btn btn-danger btn-sm fw-bold">Unirme</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <h1 class="text-center my-5" style="color: #bc4421; font-weight: bold;">Reserva tu mesa</h1>

    <div class="container mb-5">
        <form class="mx-auto shadow p-4 rounded-4 bg-white" style="max-width: 600px;">
            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" value="<?php echo $nombre_usuario; ?>" placeholder="Tu nombre completo" required />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="nombre@ejemplo.com" required />
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label fw-bold">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" placeholder="Número de teléfono" required />
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <label for="fecha" class="form-label fw-bold">Fecha</label>
                    <input type="date" class="form-control" id="fecha" required />
                </div>
                <div class="col">
                    <label for="hora" class="form-label fw-bold">Hora</label>
                    <input type="time" class="form-control" id="hora" required />
                </div>
            </div>
            <div class="mb-3">
                <label for="personas" class="form-label fw-bold">Número de Personas</label>
                <input type="number" class="form-control" id="personas" min="1" max="20" value="2" required />
            </div>
            <button type="submit" class="btn btn-danger w-100 fw-bold py-2 shadow-sm" style="background-color: #bc4421;">Confirmar Reserva</button>
        </form>
    </div>

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