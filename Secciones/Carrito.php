<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Carrito de Compras - Onlyfast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold" href="../Comidas Rapidas.html" style="color:#bc4421;">Onlyfast</a>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="Menu.php">Volver al Menú</a></li>
            </ul>
            <a href="Carrito.html" class="icon-link position-relative">
                <i class="bi bi-cart"></i>
                <span id="cart-count"
                    class="cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="text-center mb-4">Carrito de Compras</h1>

        <div class="row">
            <!-- Tabla del carrito -->
            <div class="col-lg-7 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header" style="color:#bc4421; font-weight:bold;">
                        Productos seleccionados
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Precio unidad</th>
                                        <th class="text-end">Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cart-body">
                                    <!-- Filas generadas por JS -->
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <strong>Total:</strong>
                            <strong id="cart-total">$ 0 COP</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de pago Nequi / Llave Bre-B -->
            <div class="col-lg-5 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header" style="color:#bc4421; font-weight:bold;">
                        Pago por transferencia
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dirección de entrega</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Método de pago</label>
                                <select class="form-select" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="nequi">Transferencia a Nequi</option>
                                    <option value="breb">Transferencia con Llave Bre-B</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Número de comprobante</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="alert alert-warning small">
                                Realiza la transferencia a la cuenta Nequi o Llave Bre‑B del restaurante, luego ingresa
                                el número de
                                comprobante y confirma tu pedido.
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-check-circle me-1"></i>Confirmar pedido
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-light text-center text-lg-start mt-auto py-4">
        ...
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-0kNc7S5kQJvSQkoYa6jkZbbGBsFg8Zn5zZC+8LqgeboKF6L2Uv6bO0bb9Dfj3D/l"
        crossorigin="anonymous"></script>
    <script src="../js/carrito.js"></script>
</body>

</html>