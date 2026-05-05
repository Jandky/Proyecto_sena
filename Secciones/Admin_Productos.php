<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. SEGURIDAD: Solo Admin (Rol 1)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: Login.html");
    exit();
}

require_once '../DB_Mysql/conexion.php';

// --- LÓGICA DE PROCESAMIENTO (ACCIONES DE BASE DE DATOS) ---

// ELIMINAR PRODUCTO DEFINITIVAMENTE
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    mysqli_query($conexion, "DELETE FROM producto WHERE id_producto = $id");
    header("Location: Admin_Productos.php?msg=eliminado");
    exit();
}

// CAMBIAR ESTADO (OCULTAR / MOSTRAR)
if (isset($_GET['estado_id'])) {
    $id = intval($_GET['estado_id']);
    $nuevo_estado = intval($_GET['set']);
    mysqli_query($conexion, "UPDATE producto SET estado = $nuevo_estado WHERE id_producto = $id");
    header("Location: Admin_Productos.php?msg=estado");
    exit();
}

// GUARDAR PRODUCTO NUEVO (Maneja opciones personalizadas)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_guardar'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $precio = $_POST['precio'];
    $desc = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    
    // Si eliges "Personalizada", toma el texto del input manual
    $cat = ($_POST['categoria'] == "Personalizada") ? mysqli_real_escape_string($conexion, $_POST['categoria_nueva']) : mysqli_real_escape_string($conexion, $_POST['categoria']);
    $subcat = ($_POST['subcategoria'] == "Personalizada") ? mysqli_real_escape_string($conexion, $_POST['subcategoria_nueva']) : mysqli_real_escape_string($conexion, $_POST['subcategoria']);

    $nombre_foto = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], "../Imagenes/" . $nombre_foto);

    $sql = "INSERT INTO producto (nombre_producto, precio, descripcion, imagen, categoria, subcategoria, estado) 
            VALUES ('$nombre', '$precio', '$desc', '$nombre_foto', '$cat', '$subcat', 1)";
    
    mysqli_query($conexion, $sql);
    header("Location: Admin_Productos.php?msg=exito");
    exit();
}

// ACTUALIZAR PRODUCTO (MODAL)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_actualizar'])) {
    $id = intval($_POST['id_producto']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $precio = $_POST['precio'];
    $desc = mysqli_real_escape_string($conexion, $_POST['descripcion']);

    mysqli_query($conexion, "UPDATE producto SET nombre_producto='$nombre', precio='$precio', descripcion='$desc' WHERE id_producto=$id");

    if (!empty($_FILES['foto']['name'])) {
        $nombre_foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../Imagenes/" . $nombre_foto);
        mysqli_query($conexion, "UPDATE producto SET imagen='$nombre_foto' WHERE id_producto=$id");
    }
    header("Location: Admin_Productos.php?msg=editado");
    exit();
}

// Consulta para mostrar la lista
$resultado_productos = mysqli_query($conexion, "SELECT * FROM producto ORDER BY id_producto DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - Onlyfast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --main-red: #bc4421; }
        body { background-color: #f8f9fa; }
        .btn-main { background-color: var(--main-red); color: white; font-weight: bold; }
        .btn-main:hover { background-color: #a33a1c; color: white; }
        .img-table { width: 55px; height: 55px; object-fit: cover; border-radius: 8px; }
        .oculto { opacity: 0.5; filter: grayscale(1); }
        .card-admin { border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 12px; }
        .extra-input { display: none; margin-top: 5px; border-left: 3px solid var(--main-red); }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="Menu.php">ONLYFAST - PANEL CONTROL</a>
        <span class="text-white small">Admin: <?php echo $_SESSION['usuario_nombre']; ?></span>
    </div>
</nav>

<div class="container pb-5">
    <div class="row g-4">
        <!-- FORMULARIO DE REGISTRO -->
        <div class="col-lg-4">
            <div class="card card-admin p-4">
                <h4 class="fw-bold mb-3" style="color: var(--main-red);">Nuevo Producto</h4>
                <form method="POST" enctype="multipart/form-data">
                    
                    <label class="small fw-bold">Categoría Principal</label>
                    <select name="categoria" id="catSel" class="form-select mb-2" required onchange="cambiarCategoria()">
                        <option value="">Seleccione...</option>
                        <option value="Hamburguesas">Hamburguesas</option>
                        <option value="Perros Calientes">Perros Calientes</option>
                        <option value="Pizzas">Pizzas</option>
                        <option value="Salchipapas">Salchipapas</option>
                        <option value="Bebidas">Bebidas</option>
                        <option value="Personalizada">-- Crear Nueva Categoría --</option>
                    </select>
                    <input type="text" name="categoria_nueva" id="catInput" class="form-control mb-2 extra-input" placeholder="Nombre de la nueva categoría">

                    <label class="small fw-bold">Subcategoría / Tamaño</label>
                    <select name="subcategoria" id="subSel" class="form-select mb-2" required onchange="cambiarSubcategoria()">
                        <option value="">Primero elija categoría...</option>
                    </select>
                    <input type="text" name="subcategoria_nueva" id="subInput" class="form-control mb-2 extra-input" placeholder="Nombre de la subcategoría">

                    <hr>
                    <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre comercial" required>
                    <input type="number" name="precio" class="form-control mb-2" placeholder="Precio de venta $" required>
                    <label class="small fw-bold">Imagen del producto</label>
                    <input type="file" name="foto" class="form-control mb-2" required>
                    <textarea name="descripcion" class="form-control mb-3" placeholder="Descripción o ingredientes..."></textarea>
                    
                    <button type="submit" name="btn_guardar" class="btn btn-main w-100 py-2">REGISTRAR EN EL MENÚ</button>
                </form>
            </div>
        </div>

        <!-- TABLA DE GESTIÓN -->
        <div class="col-lg-8">
            <div class="card card-admin overflow-hidden">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Vista</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($p = mysqli_fetch_assoc($resultado_productos)): ?>
                        <tr class="<?php echo ($p['estado'] == 0) ? 'oculto' : ''; ?>">
                            <td><img src="../Imagenes/<?php echo $p['imagen']; ?>" class="img-table"></td>
                            <td>
                                <div class="fw-bold"><?php echo $p['nombre_producto']; ?></div>
                                <div class="text-muted small"><?php echo $p['categoria']; ?> - <?php echo $p['subcategoria']; ?></div>
                            </td>
                            <td class="fw-bold">$<?php echo number_format($p['precio'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <!-- Editar -->
                                <button class="btn btn-sm btn-outline-warning mb-1" data-bs-toggle="modal" data-bs-target="#edit<?php echo $p['id_producto']; ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <!-- Ocultar/Mostrar -->
                                <a href="Admin_Productos.php?estado_id=<?php echo $p['id_producto']; ?>&set=<?php echo ($p['estado']==1)?'0':'1'; ?>" 
                                   class="btn btn-sm mb-1 <?php echo ($p['estado']==1)?'btn-outline-secondary':'btn-success'; ?>">
                                    <i class="bi <?php echo ($p['estado']==1)?'bi-eye-slash':'bi-eye'; ?>"></i>
                                </a>

                                <!-- Eliminar -->
                                <button class="btn btn-sm btn-outline-danger mb-1" onclick="confirmarEliminar(<?php echo $p['id_producto']; ?>)">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- MODAL DE EDICIÓN PARA CADA FILA -->
                        <div class="modal fade" id="edit<?php echo $p['id_producto']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title">Editar: <?php echo $p['nombre_producto']; ?></h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="id_producto" value="<?php echo $p['id_producto']; ?>">
                                            <div class="mb-2">
                                                <label class="small fw-bold">Nombre</label>
                                                <input type="text" name="nombre" class="form-control" value="<?php echo $p['nombre_producto']; ?>" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="small fw-bold">Precio</label>
                                                <input type="number" name="precio" class="form-control" value="<?php echo $p['precio']; ?>" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="small fw-bold">Descripción</label>
                                                <textarea name="descripcion" class="form-control" rows="3"><?php echo $p['descripcion']; ?></textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label class="small fw-bold">Actualizar Imagen (Opcional)</label>
                                                <input type="file" name="foto" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" name="btn_actualizar" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Configuración dinámica de opciones
    const opcionesSub = {
        "Hamburguesas": ["Sencilla", "Especial", "Doble", "Personalizada"],
        "Perros Calientes": ["Sencillo", "Especial", "Suizo", "Personalizada"],
        "Pizzas": ["Pequeña", "Mediana", "Familiar", "Personalizada"],
        "Salchipapas": ["Sencilla", "Especial", "Trifásica", "Personalizada"],
        "Bebidas": ["Gaseosa 350ml", "Litro", "Jugo Natural", "Personalizada"],
        "Personalizada": ["Personalizada"]
    };

    function cambiarCategoria() {
        const cat = document.getElementById("catSel").value;
        const subSel = document.getElementById("subSel");
        const catInput = document.getElementById("catInput");

        // Mostrar campo de texto si elige personalizar categoría
        catInput.style.display = (cat === "Personalizada") ? "block" : "none";

        // Llenar subcategorías según la elección
        subSel.innerHTML = '<option value="">Seleccione...</option>';
        if (cat && opcionesSub[cat]) {
            opcionesSub[cat].forEach(t => {
                let opt = document.createElement("option");
                opt.value = t; opt.text = t;
                subSel.appendChild(opt);
            });
        }
        cambiarSubcategoria();
    }

    function cambiarSubcategoria() {
        const subVal = document.getElementById("subSel").value;
        const subInput = document.getElementById("subInput");
        // Mostrar campo de texto solo si elige "Personalizada" en la lista
        subInput.style.display = (subVal === "Personalizada") ? "block" : "none";
    }

    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Eliminar permanentemente?',
            text: "Esta acción borrará el producto de la base de datos.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "Admin_Productos.php?eliminar=" + id;
            }
        });
    }

    // Alertas de confirmación por URL
    const params = new URLSearchParams(window.location.search);
    if(params.get('msg') === 'exito') Swal.fire('Éxito', 'Producto agregado.', 'success');
    if(params.get('msg') === 'editado') Swal.fire('Actualizado', 'Cambios guardados.', 'success');
    if(params.get('msg') === 'eliminado') Swal.fire('Borrado', 'Producto eliminado de la DB.', 'info');
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>