// js/menu.js

// ==========================================
// 1. LÓGICA DEL CARRITO (TU CÓDIGO ORIGINAL)
// ==========================================

let cart = JSON.parse(localStorage.getItem("cart")) || [];

function updateCartBadge() {
  const badge = document.getElementById("cart-count");
  if (!badge) return;
  const totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
  badge.textContent = totalQty;
}

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartBadge();
}

function addToCart(name, price) {
  const priceNum = parseInt(price, 10) || 0;
  const existing = cart.find(p => p.name === name);
  if (existing) {
    existing.quantity += 1;
  } else {
    cart.push({ name, price: priceNum, quantity: 1 });
  }
  saveCart();
}

// ==========================================
// 2. NUEVA LÓGICA PARA LOGIN Y REGISTRO
// ==========================================

// Función para cambiar entre pestañas de Login y Registro
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

    // Estética de los botones (Poner activo el que clicamos)
    const botones = document.querySelectorAll('.tab-btn');
    botones.forEach(btn => {
        btn.classList.remove('active', 'btn-dark');
        btn.classList.add('btn-outline-dark');
    });

    elemento.classList.add('active', 'btn-dark');
    elemento.classList.remove('btn-outline-dark');
}

// Función para ver/ocultar la contraseña (el ojito)
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
// 3. INICIALIZACIÓN AL CARGAR EL DOM
// ==========================================

document.addEventListener("DOMContentLoaded", () => {
  updateCartBadge();

  const buttons = document.querySelectorAll(".add-to-cart");
  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      const name = btn.getAttribute("data-product");
      const price = btn.getAttribute("data-price");
      addToCart(name, price);
    });
  });
});
