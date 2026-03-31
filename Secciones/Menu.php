<?php
session_start();
$nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menú - Comidas Rápidas Onlyfast</title>

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
                <li class="nav-item"><a class="nav-link active fw-bold" href="Menu.php">Menú</a></li>
                <li class="nav-item"><a class="nav-link" href="Reservas.php">Reservas</a></li>
                <li class="nav-item"><a class="nav-link" href="Galerias.php">Galería</a></li>
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
                    <?php echo explode(" ", $nombre_usuario)[0]; ?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item" href="Perfil.php"><i class="bi bi-person-vcard me-2"></i>Mi Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
            </ul>
        </div>
    <?php else: ?>
        <a href="registro.php?tab=login" class="btn btn-outline-danger btn-sm fw-bold me-2">Entrar</a>
        <a href="registro.php?tab=registro" class="btn btn-danger btn-sm fw-bold">Unirme</a>
    <?php endif; ?>
</div>
    </div>
</nav>

    <h1 class="text-center my-4">MENÚ DE COMIDAS RÁPIDAS</h1>

    <!-- GRID DE PRODUCTOS -->
    <div class="container my-5">
        <div class="row">
            <!-- Pizza Pepperoni -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#pizza-pepperoni" class="text-decoration-none text-dark">
                        <img src="../Imagenes/Pizza Pepperoni.jpg" class="card-img-top rounded-top-4"
                            alt="Pizza Pepperoni" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Pizza Pepperoni</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 32.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart" data-product="Pizza Pepperoni"
                            data-price="32000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>

            <!-- Perro Especial -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#perro-especial" class="text-decoration-none text-dark">
                        <img src="../Imagenes/PERRO_ESPECIAL.jpg" class="card-img-top rounded-top-4"
                            alt="Perro Especial" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Perro Especial</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 18.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart" data-product="Perro Especial"
                            data-price="18000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hamburguesa Doble -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#hamburguesa-doble" class="text-decoration-none text-dark">
                        <img src="../Imagenes/HAMBURGUESA_DOBLE.jpg" class="card-img-top rounded-top-4"
                            alt="Hamburguesa Doble" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Hamburguesa Doble</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 24.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart"
                            data-product="Hamburguesa Doble" data-price="24000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>

            <!-- Cascos de Papa con Queso -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#cascos-papa" class="text-decoration-none text-dark">
                        <img src="../Imagenes/CASCOS_DE_PAPAS_CON_QUESO.png" class="card-img-top rounded-top-4"
                            alt="Cascos de Papa con Queso" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Cascos de Papa con Queso</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 15.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart"
                            data-product="Cascos de Papa con Queso" data-price="15000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Pizza Hawaiana -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#pizza-hawaiana" class="text-decoration-none text-dark">
                        <img src="../Imagenes/PIZZA_HAWUAIANA.jpg" class="card-img-top rounded-top-4"
                            alt="Pizza Hawaiana" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Pizza Hawaiana</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 30.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart" data-product="Pizza Hawaiana"
                            data-price="30000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>

            <!-- Perro Americano -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#perro-americano" class="text-decoration-none text-dark">
                        <img src="../Imagenes/PERRO_AMERICANO.jpg" class="card-img-top rounded-top-4"
                            alt="Perro Americano" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Perro Americano</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 16.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart" data-product="Perro Americano"
                            data-price="16000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hamburguesa Bacon -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#hamburguesa-bacon" class="text-decoration-none text-dark">
                        <img src="../Imagenes/HAMBURGUESA_BACON.jpg" class="card-img-top rounded-top-4"
                            alt="Hamburguesa con Bacon" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Hamburguesa Bacon</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 26.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart"
                            data-product="Hamburguesa Bacon" data-price="26000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bebidas -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#bebidas" class="text-decoration-none text-dark">
                        <img src="../Imagenes/MALTEADA.jpg" class="card-img-top rounded-top-4"
                            alt="Bebidas y Malteadas" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Bebidas y Malteadas</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 7.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart"
                            data-product="Bebidas y Malteadas" data-price="7000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>


            <!-- Combo Familiar -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <a href="#combo-familiar" class="text-decoration-none text-dark">
                        <img src="../Imagenes/COMBO_FAMILIAR.webp" class="card-img-top rounded-top-4"
                            alt="Combo Familiar" />
                    </a>
                    <div class="card-body bg-light d-flex flex-column">
                        <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Combo Familiar</h5>
                        <p class="card-text mb-2" style="color:#333; font-weight:bold;">$ 65.000 COP</p>
                        <button type="button" class="btn btn-warning mt-auto add-to-cart" data-product="Combo Familiar"
                            data-price="65000">
                            <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIONES DE INGREDIENTES -->
    <div class="container my-5">

        <!-- Pizza Pepperoni -->
        <section id="pizza-pepperoni" class="py-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <img src="../Imagenes/Pizza Pepperoni.jpg" class="img-fluid rounded-4" alt="Pizza Pepperoni" />
                </div>
                <div class="col-md-8">
                    <h2 style="color:#bc4421; font-weight:bold;">Pizza Pepperoni</h2>
                    <p><strong>Ingredientes:</strong> Masa artesanal, salsa de tomate casera, queso mozzarella,
                        rodajas de pepperoni, orégano y aceite de oliva.</p>
                    <p><strong>Tamaño:</strong> 8 porciones. <strong>Precio:</strong> $ 32.000 COP.</p>
                    <button type="button" class="btn btn-warning add-to-cart" data-product="Pizza Pepperoni"
                        data-price="32000">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Perro Especial -->
        <section id="perro-especial" class="py-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <img src="../Imagenes/PERRO_ESPECIAL.jpg" class="img-fluid rounded-4" alt="Perro Especial" />
                </div>
                <div class="col-md-8">
                    <h2 style="color:#bc4421; font-weight:bold;">Perro Especial</h2>
                    <p><strong>Ingredientes:</strong> Pan suave, salchicha americana, tocineta, queso rallado,
                        salsas especiales, papas fosforito y cebolla caramelizada.</p>
                    <p><strong>Porción:</strong> 1 unidad grande. <strong>Precio:</strong> $ 18.000 COP.</p>
                    <button type="button" class="btn btn-warning add-to-cart" data-product="Perro Especial"
                        data-price="18000">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Hamburguesa Doble -->
        <section id="hamburguesa-doble" class="py-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <img src="../Imagenes/HAMBURGUESA_DOBLE.jpg" class="img-fluid rounded-4" alt="Hamburguesa Doble" />
                </div>
                <div class="col-md-8">
                    <h2 style="color:#bc4421; font-weight:bold;">Hamburguesa Doble</h2>
                    <p><strong>Ingredientes:</strong> Doble carne de res a la parrilla, queso cheddar, lechuga,
                        tomate, pepinillos, cebolla y salsas de la casa en pan brioche.</p>
                    <p><strong>Acompañamiento:</strong> Papas a la francesa. <strong>Precio:</strong> $ 24.000 COP.</p>
                    <button type="button" class="btn btn-warning add-to-cart" data-product="Hamburguesa Doble"
                        data-price="24000">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Cascos de Papa con Queso -->
        <section id="cascos-papa" class="py-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <img src="../Imagenes/CASCOS_DE_PAPAS_CON_QUESO.png" class="img-fluid rounded-4"
                        alt="Cascos de Papa con Queso" />
                </div>
                <div class="col-md-8">
                    <h2 style="color:#bc4421; font-weight:bold;">Cascos de Papa con Queso</h2>
                    <p><strong>Ingredientes:</strong> Papas cortadas en cascos, queso fundido, tocineta crocante y salsa
                        de ajo.
                    </p>
                    <p><strong>Porción:</strong> Para 2 personas. <strong>Precio:</strong> $ 15.000 COP.</p>
                    <button type="button" class="btn btn-warning add-to-cart" data-product="Cascos de Papa con Queso"
                        data-price="15000">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Pizza Hawaiana -->
        <section id="pizza-hawaiana" class="py-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <img src="../Imagenes/PIZZA_HAWUAIANA.jpg" class="img-fluid rounded-4" alt="Pizza Hawaiana" />
                </div>
                <div class="col-md-8">
                    <h2 style="color:#bc4421; font-weight:bold;">Pizza Hawaiana</h2>
                    <p><strong>Ingredientes:</strong> Masa delgada, salsa de tomate, queso mozzarella, jamón, piña en
                        trozos y
                        toque de miel.</p>
                    <p><strong>Tamaño:</strong> 8 porciones. <strong>Precio:</strong> $ 30.000 COP.</p>
                    <button type="button" class="btn btn-warning add-to-cart" data-product="Pizza Hawaiana"
                        data-price="30000">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Perro Americano -->
        <section id="perro-americano" class="py-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <img src="../Imagenes/PERRO_AMERICANO.jpg" class="img-fluid rounded-4" alt="Perro Americano" />
                </div>
                <div class="col-md-8">
                    <h2 style="color:#bc4421; font-weight:bold;">Perro Americano</h2>
                    <p><strong>Ingredientes:</strong> Pan tradicional, salchicha americana, queso, salsa de tomate,
                        mostaza y
                        papas trituradas.</p>
                    <p><strong>Precio:</strong> $ 16.000 COP.</p>
                    <button type="button" class="btn btn-warning add-to-cart" data-product="Perro Americano"
                        data-price="16000">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Hamburguesa Bacon -->
        <section id="hamburguesa-bacon" class="py-4 border-top">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <img src="../Imagenes/HAMBURGUESA_BACON.jpg" class="img-fluid rounded-4" alt="Hamburguesa Bacon" />
                </div>
                <div class="col-md-8">
                    <h2 style="color:#bc4421; font-weight:bold;">Hamburguesa Bacon</h2>
                    <p><strong>Ingredientes:</strong> Carne de res a la parrilla, tiras de tocineta, queso cheddar,
                        lechuga,
                        tomate y salsa BBQ.</p>
                    <p><strong>Precio:</strong> $ 26.000 COP.</p>
                    <button type="button" class="btn btn-warning add-to-cart" data-product="Hamburguesa Bacon"
                        data-price="26000">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Combo Familiar -->
        <section id="combo-familiar" class="py-4 border-top mb-5">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <img src="../Imagenes/COMBO_FAMILIAR.webp" class="img-fluid rounded-4" alt="Combo Familiar" />
                </div>
                <div class="col-md-8">
                    <h2 style="color:#bc4421; font-weight:bold;">Combo Familiar</h2>
                    <p><strong>Incluye:</strong> 1 pizza grande a elección, 2 perros especiales, 2 hamburguesas
                        sencillas, cascos
                        de papa con queso y 1 gaseosa de 1.5 L.</p>
                    <p><strong>Precio:</strong> $ 65.000 COP. <strong>Porción:</strong> Para 4–5 personas.</p>
                    <button type="button" class="btn btn-warning add-to-cart" data-product="Combo Familiar"
                        data-price="65000">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </button>
                </div>
            </div>
        </section>

        <!-- Bebidas y Malteadas -->
        <section id="bebidas" class="py-5 border-top">
            <div class="container">
                <h2 class="mb-4" style="color:#bc4421; font-weight:bold;">Bebidas y Malteadas</h2>

                <div class="row g-4">

                    <!-- Gaseosas -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm rounded-4">
                            <!-- Imagen de categoría gaseosas -->
                            <img src="../Imagenes/GASEOSAS.jpg" class="card-img-top rounded-top-4" alt="Gaseosas" />
                            <div class="card-body bg-light">
                                <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Gaseosas</h5>
                                <p class="card-text small">
                                    Refrescos clásicos para acompañar tus burgers, perros y pizzas.
                                </p>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Coca‑Cola 400 ml</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Coca-Cola 400 ml" data-price="4500">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Colombiana 400 ml</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Colombiana 400 ml" data-price="4500">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Sprite 400 ml</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Sprite 400 ml" data-price="4500">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Jugos en agua -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm rounded-4">
                            <!-- Imagen jugos en agua -->
                            <img src="../Imagenes/JUGOSENAGUA.jpg" class="card-img-top rounded-top-4"
                                alt="Jugos naturales en agua" />
                            <div class="card-body bg-light">
                                <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Jugos naturales en agua
                                </h5>
                                <p class="card-text small">
                                    Frutas frescas para una opción más ligera y natural.
                                </p>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Naranja en agua</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Jugo naranja en agua" data-price="6000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Lulo en agua</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Jugo lulo en agua" data-price="6000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Maracuyá en agua</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Jugo maracuyá en agua" data-price="6000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Jugos en leche -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm rounded-4">
                            <!-- Imagen jugos en leche -->
                            <img src="../Imagenes/JUGOSENLECHE.webp" class="card-img-top rounded-top-4"
                                alt="Jugos naturales en leche" />
                            <div class="card-body bg-light">
                                <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Jugos naturales en leche
                                </h5>
                                <p class="card-text small">
                                    Cremosos y nutritivos, perfectos para los más antojados.
                                </p>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Fresa en leche</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Jugo fresa en leche" data-price="7000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Banano en leche</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Jugo banano en leche" data-price="7000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Mango en leche</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Jugo mango en leche" data-price="7000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Otras bebidas -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm rounded-4">
                            <!-- Imagen otras bebidas -->
                            <img src="../Imagenes/AGUAS.jpg" class="card-img-top rounded-top-4" alt="Otras bebidas" />
                            <div class="card-body bg-light">
                                <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Otras bebidas</h5>
                                <p class="card-text small">
                                    Opciones para todos los gustos y niveles de sed.
                                </p>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Agua en botella</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Agua en botella" data-price="3000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Agua saborizada</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Agua saborizada" data-price="3500">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Jugo de botella</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Jugo de botella" data-price="4000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Malteadas -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm rounded-4">
                            <!-- Imagen malteadas -->
                            <img src="../Imagenes/MALTEADA.jpg" class="card-img-top rounded-top-4" alt="Malteadas" />
                            <div class="card-body bg-light">
                                <h5 class="card-title" style="color:#bc4421; font-weight:bold;">Malteadas</h5>
                                <p class="card-text small">
                                    Dulces, cremosas y con topping para cerrar con broche de oro.
                                </p>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Malteada de vainilla</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Malteada vainilla" data-price="9000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Malteada de chocolate</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Malteada chocolate" data-price="9000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Malteada Oreo</span>
                                        <button type="button" class="btn btn-sm btn-warning add-to-cart"
                                            data-product="Malteada Oreo" data-price="10000">
                                            <i class="bi bi-cart-plus me-1"></i>Agregar
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <p class="mt-3 small">
                    <strong>Nota:</strong> Los precios pueden variar según el tamaño y la presentación elegida.
                </p>
            </div>
        </section>


    </div>

    <!-- Footer -->
    <footer class="footer bg-light text-center text-lg-start mt-auto py-4">
        ...
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-0kNc7S5kQJvSQkoYa6jkZbbGBsFg8Zn5zZC+8LqgeboKF6L2Uv6bO0bb9Dfj3D/l"
        crossorigin="anonymous"></script>
    <script src="../js/jsmenu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>