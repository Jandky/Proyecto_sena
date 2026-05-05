<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../DB_Mysql/conexion.php';

$nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : null;

$total_articulos = 0;
if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $total_articulos += isset($item['cantidad']) ? (int)$item['cantidad'] : 1;
    }
}

$res = mysqli_query($conexion, "SELECT * FROM producto WHERE estado = 1 ORDER BY categoria ASC, subcategoria ASC, id_producto DESC");

if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $menu_organizado[$row['categoria']][] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - Onlyfast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css">
    <link rel="stylesheet" href="../Hoja_de_estilos/Menu_Estilos.css?v=2">
    <style>
        html { scroll-behavior: smooth; }
        section { scroll-margin-top: 100px; }
        .menu-card {
            border: 1px solid #f0e2d8;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(188, 68, 33, 0.12);
        }
        .menu-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .menu-card .card-body {
            display: flex;
            flex-direction: column;
            padding: 1rem;
            text-align: center;
        }
        .menu-card .precio {
            color: #bc4421;
            font-weight: 800;
            font-size: 1.15rem;
            margin: auto 0;
        }
        .menu-card .descripcion {
            color: #6c757d;
            font-size: 0.85rem;
            max-height: 80px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }
        .menu-card .btn-agregar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #bc4421;
            color: white;
            font-size: 1.5rem;
            border: none;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .menu-card .btn-agregar:hover {
            background-color: #d35400;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'compra_exitosa'): ?>
<div class="container">
    <div class="alert alert-success text-center py-3 shadow-sm mt-4">
        <i class="bi bi-check-circle-fill fs-4 me-2"></i>
        <strong class="fs-5">¡SU PEDIDO FUE REGISTRADO CON ÉXITO!</strong>
        <br>
        <small class="text-muted">Preparamos tu orden. Puedes ver el estado en tu historial.</small>
    </div>
</div>
<?php endif; ?>

<div class="sticky-categories">
    <div class="container d-flex overflow-auto gap-2 py-2">
        <?php foreach (array_keys($menu_organizado) as $cat): ?>
            <a href="#categoria-<?php echo md5($cat); ?>" class="btn-cat-pill text-decoration-none">
                <?php echo htmlspecialchars($cat); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="container pb-5">
    <?php if (empty($menu_organizado)): ?>
        <div class="alert alert-warning text-center">No hay productos disponibles.</div>
    <?php else: ?>
        <?php foreach ($menu_organizado as $categoria => $productos): ?>
            <section id="categoria-<?php echo md5($categoria); ?>" class="mb-5">
                <h2 class="fw-bold mb-4" style="color:#bc4421;">
                    <?php echo htmlspecialchars($categoria); ?>
                </h2>

                <div class="row g-4">
                    <?php foreach ($productos as $producto): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="menu-card bg-white h-100 d-flex flex-column">
                                <img src="../Imagenes/<?php echo htmlspecialchars($producto['imagen']); ?>"
                                     alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">

                                <div class="card-body">
                                    <h5 class="fw-bold mb-1" style="color:#bc4421;">
                                        <?php echo htmlspecialchars($producto['nombre_producto']); ?>
                                    </h5>

                                    <p class="text-muted small mb-2">
                                        <?php echo htmlspecialchars($producto['subcategoria']); ?>
                                    </p>

                                    <p class="descripcion flex-grow-1 mb-3">
                                        <?php echo htmlspecialchars($producto['descripcion']); ?>
                                    </p>

                                    <p class="precio mb-3">
                                        $<?php echo number_format($producto['precio'], 0, ',', '.'); ?>
                                    </p>

                                    <form method="POST" action="carrito_logica.php" class="d-grid">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                                        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                                        <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                                        <input type="hidden" name="categoria" value="<?php echo htmlspecialchars($producto['categoria']); ?>">
                                        <button type="submit" name="btn_agregar" class="btn-agregar mx-auto">
                                            +
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<footer class="bg-light text-center py-4 mt-5">
    <p class="text-muted mb-0">&copy; 2026 Onlyfast Comidas Rápidas. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>