<?php
$id_pedido = isset($_GET['id_pedido']) ? intval($_GET['id_pedido']) : 0;
$total = isset($_GET['total']) ? intval($_GET['total']) : 0;
$total_formateado = number_format($total, 0, ',', '.');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Realizado - Onlyfast</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Hoja_de_estilos/pedido_realizado.css">
</head>
<body class="onlyfast-body">

    <header class="onlyfast-topbar">
        <div class="container onlyfast-topbar-content">
            <div class="onlyfast-brand">
                <a href="../Comidas Rapidas.php" class="onlyfast-brand-link">
                    <span class="onlyfast-brand-icon">
                        <i class="bi bi-bag-heart-fill"></i>
                    </span>
                    <span class="onlyfast-brand-text">
                        <span class="onlyfast-brand-title">ONLYFAST</span>
                        <span class="onlyfast-brand-subtitle">Goza tu vida, come mientras puedas</span>
                    </span>
                </a>
            </div>

            <nav class="onlyfast-actions">
                <a href="../Comidas Rapidas.php" class="onlyfast-btn onlyfast-btn-light">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Inicio</span>
                </a>

                <a href="Menu.php" class="onlyfast-btn onlyfast-btn-light">
                    <i class="bi bi-grid-fill"></i>
                    <span>Volver al menú</span>
                </a>
            </nav>
        </div>
    </header>

    <main class="onlyfast-main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <section class="onlyfast-confirm-card">

                        <div class="onlyfast-confirm-hero">
                            <div class="onlyfast-confirm-badge">
                                <i class="bi bi-patch-check-fill"></i>
                                <span>Confirmación exitosa</span>
                            </div>

                            <h1 class="onlyfast-confirm-title">¡Tu pedido ya está en marcha!</h1>

                            <p class="onlyfast-confirm-text">
                                Gracias por elegir <strong>Onlyfast</strong>. Ya recibimos tu orden y nuestro equipo
                                está preparando todo para que disfrutes tu comida lo más pronto posible.
                            </p>

                            <div class="onlyfast-check-circle">
                                <i class="bi bi-check2"></i>
                            </div>
                        </div>

                        <div class="onlyfast-confirm-body">
                            <div class="onlyfast-confirm-intro">
                                <h2>Pedido confirmado con éxito</h2>
                                <p>
                                    Tu orden
                                    <span class="onlyfast-highlight">#<?php echo $id_pedido; ?></span>
                                    fue registrada correctamente.
                                </p>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <article class="onlyfast-info-card">
                                        <div class="onlyfast-info-icon">
                                            <i class="bi bi-receipt-cutoff"></i>
                                        </div>
                                        <div class="onlyfast-info-content">
                                            <span class="onlyfast-info-label">Número de pedido</span>
                                            <strong class="onlyfast-info-value">#<?php echo $id_pedido; ?></strong>
                                        </div>
                                    </article>
                                </div>

                                <div class="col-md-6">
                                    <article class="onlyfast-info-card">
                                        <div class="onlyfast-info-icon">
                                            <i class="bi bi-cash-stack"></i>
                                        </div>
                                        <div class="onlyfast-info-content">
                                            <span class="onlyfast-info-label">Total pagado</span>
                                            <strong class="onlyfast-info-value">$<?php echo $total_formateado; ?> COP</strong>
                                        </div>
                                    </article>
                                </div>
                            </div>

                            <section class="onlyfast-status-box">
                                <div class="onlyfast-status-badge">
                                    <i class="bi bi-fire"></i>
                                    <span>En preparación</span>
                                </div>

                                <h3>Estamos preparando tu pedido.</h3>

                                <p>
                                    Te avisaremos cuando esté listo para entrega. Mientras tanto, puedes seguir
                                    explorando el menú o revisar tu historial de pedidos.
                                </p>
                            </section>

                            <div class="onlyfast-action-buttons">
                                <a href="Menu.php" class="onlyfast-btn onlyfast-btn-primary">
                                    <i class="bi bi-basket2-fill"></i>
                                    <span>Seguir comprando</span>
                                </a>

                                <a href="Historial_compras.php" class="onlyfast-btn onlyfast-btn-outline">
                                    <i class="bi bi-clock-history"></i>
                                    <span>Ver historial</span>
                                </a>
                            </div>
                        </div>
                    </section>

                    <p class="onlyfast-footer-text">
                        Onlyfast Comidas Rápidas · Cartagena · © 2026 Todos los derechos reservados
                    </p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>