// js/menu.js

// Cargar carrito desde localStorage o iniciar vacío
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Actualiza número del carrito
function updateCartBadge() {
  const badge = document.getElementById("cart-count");
  if (!badge) return;
  const totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
  badge.textContent = totalQty;
}

// Guarda carrito
function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartBadge();
}

// Agregar producto (si existe, suma cantidad)
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
