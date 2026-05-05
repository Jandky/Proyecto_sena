// ==========================================
// 1. LÓGICA DEL CARRITO (Onlyfast)
// ==========================================

let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Actualiza el contador visual (el numerito sobre el icono del carrito)
function updateCartBadge() {
  const badge = document.getElementById("cart-count");
  if (!badge) return;
  const totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
  badge.textContent = totalQty;
}

// Guarda el estado del carrito en el navegador
function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartBadge();
}

// Agrega un producto al carrito
function addToCart(id, name, price) {
  const priceNum = parseInt(price, 10) || 0;
  const idNum = parseInt(id, 10);
  
  const existing = cart.find(p => p.id === idNum);
  if (existing) {
    existing.quantity += 1;
  } else {
    // Guardamos el ID para vincularlo con la base de datos después
    cart.push({ id: idNum, name, price: priceNum, quantity: 1 });
  }
  saveCart();
}

// ==========================================
// 2. LÓGICA PARA LOGIN Y REGISTRO
// ==========================================

// Cambiar entre el formulario de inicio de sesión y el de registro
function mostrarTab(tabId, elemento) {
    const loginForm = document.getElementById('form-login');
    const registroForm = document.getElementById('form-registro');

    if (tabId === 'login') {
        loginForm.classList.remove('d-none');
        registroForm.classList.add('d-none');
    } else {
        registroForm.classList.remove('d-none');
        loginForm.classList.add('d-none');
    }

    // Estética de los botones de pestañas
    const botones = document.querySelectorAll('.tab-btn');
    botones.forEach(btn => {
        btn.classList.remove('active', 'btn-dark');
        btn.classList.add('btn-outline-dark');
    });

    elemento.classList.add('active', 'btn-dark');
    elemento.classList.remove('btn-outline-dark');
}

// Función para ver/ocultar la contraseña (icono del ojito)
function togglePass(idInput, boton) {
    const input = document.getElementById(idInput);
    const icono = boton.querySelector('i');
    
    if (input.type === "password") {
        input.type = "text";
        icono.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = "password";
        icono.classList.replace('bi-eye-slash', 'bi-eye');
    }
}

// ==========================================
// 3. INICIALIZACIÓN GLOBAL (Event Listeners)
// ==========================================

document.addEventListener("DOMContentLoaded", () => {
    // Inicializar el badge al cargar la página
    updateCartBadge();

    /**
     * DELEGACIÓN DE EVENTOS PARA BOTONES DE COMPRA
     * Escucha clics en toda la página para detectar botones .add-to-cart
     * Esto funciona perfecto para los 65 productos cargados por PHP.
     */
    document.addEventListener("click", (e) => {
        // Detecta el botón incluso si se hace clic en el icono interno
        const btn = e.target.closest(".add-to-cart");

        if (btn) {
            // Capturar datos de los atributos data-
            const id = btn.getAttribute("data-id"); 
            const name = btn.getAttribute("data-product");
            const price = btn.getAttribute("data-price");

            // Ejecutar la lógica de agregado
            addToCart(id, name, price);

            // EFECTO VISUAL DE CONFIRMACIÓN
            const originalContent = btn.innerHTML;
            btn.classList.replace('btn-warning', 'btn-success');
            btn.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i>¡Agregado!';
            
            // Regresa el botón a su estado original después de 1 segundo
            setTimeout(() => {
                btn.classList.replace('btn-success', 'btn-warning');
                btn.innerHTML = originalContent;
            }, 1000);
        }
    });
});