<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once '../DB_Mysql/conexion.php';

// Calcular el total para mostrarlo en el formulario de pago
$total_final = 0;
if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $total_final += ($item['precio'] * $item['cantidad']);
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Carrito de Compras - Onlyfast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../Hoja_de_estilos/Stilo.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<?php
$ocultar_carrito_nav = true;
include '../includes/navbar.php';
?>


    <div class="container my-5">
        <h1 class="text-center mb-4">Carrito de Compras</h1>

        <div class="row">
            <!-- Tabla del carrito dinámica -->
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
                                        <th class="text-center">Cant.</th>
                                        <th class="text-end">Precio</th>
                                        <th class="text-end">Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($_SESSION['carrito'])): ?>
                                        <?php foreach ($_SESSION['carrito'] as $id => $producto): 
                                            $subtotal = $producto['precio'] * $producto['cantidad'];
                                        ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo $producto['nombre']; ?></strong><br>
                                                <small class="text-muted"><?php echo $producto['categoria']; ?></small>
                                            </td>
                                            <td class="text-center"><?php echo $producto['cantidad']; ?></td>
                                            <td class="text-end">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></td>
                                            <td class="text-end fw-bold">$<?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <a href="carrito_logica.php?eliminar_item=<?php echo $id; ?>" class="text-danger">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="5" class="text-center py-4">Tu carrito está vacío</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mt-3 border-top pt-2">
                            <strong class="fs-5">Total:</strong>
                            <strong class="fs-5" style="color:#bc4421;">$ <?php echo number_format($total_final, 0, ',', '.'); ?> COP</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de pago conectado a Finalizar_Pedido.php -->
            <div class="col-lg-5 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header" style="color:#bc4421; font-weight:bold;">
                        Confirmar Pedido y Pago
                    </div>
                    <div class="card-body">
                        <form action="Finalizar_Pedido.php" method="POST">
                            <!-- Input oculto para el total -->
                            <input type="hidden" name="total_final" value="<?php echo $total_final; ?>">

                            <div class="mb-3">
    <label class="form-label fw-bold">Dirección de entrega</label>
    <input type="text" name="direccion_entrega" class="form-control" placeholder="Ej: Calle 5 #10-20" required>
</div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Método de pago</label>
                    <select name="metodo_pago_id" id="metodo_pago_id" class="form-select" required>
                        <option value="">Selecciona una opción</option>
                        <option value="1">Pago contraentrega</option>
                        <option value="2">Efectivo</option>
                        <option value="3">Transferencia Bre-B</option>
                        <option value="4">Nequi</option>
                        <option value="5">Daviplata</option>
                    </select>
                </div>

                <div class="mb-3" id="contenedor_referencia" style="display:none;">
                    <label class="form-label fw-bold">Número de referencia de pago</label>
                    <input type="text" name="referencia_pago" id="referencia_pago" class="form-control" placeholder="Ingresa la referencia del pago">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Observaciones (Opcional)</label>
                    <textarea name="observaciones" class="form-control" rows="3" placeholder="Ej: Sin cebolla, portería..."></textarea>
                </div>

                            <div class="alert alert-warning small py-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Al confirmar, el pedido se registrará en nuestro sistema para despacho inmediato.
                            </div>

                            <button type="submit" class="btn btn-success w-100 fw-bold" <?php echo empty($_SESSION['carrito']) ? 'disabled' : ''; ?>>
                                <i class="bi bi-check-circle me-1"></i>CONFIRMAR PEDIDO
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center py-4 mt-5">
        <p class="text-muted mb-0">&copy; 2026 Onlyfast Cartagena. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const metodoPago = document.getElementById("metodo_pago_id");
            const contenedorReferencia = document.getElementById("contenedor_referencia");
            const referenciaInput = document.getElementById("referencia_pago");

            metodoPago.addEventListener("change", function () {
                const valor = this.value;

                if (valor === "3" || valor === "4" || valor === "5") {
                    contenedorReferencia.style.display = "block";
                    referenciaInput.required = true;
                } else {
                    contenedorReferencia.style.display = "none";
                    referenciaInput.required = false;
                    referenciaInput.value = "";
                }
            });
        });
    </script>
    
</body>
</html>