// js/carrito.js

let cart = JSON.parse(localStorage.getItem("cart")) || [];

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartBadge();
  renderCartTable();
}

function updateCartBadge() {
  const badge = document.getElementById("cart-count");
  if (!badge) return;
  const totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
  badge.textContent = totalQty;
}

function formatCOP(value) {
  return `$ ${value.toLocaleString("es-CO")} COP`;
}

function renderCartTable() {
  const tbody = document.getElementById("cart-body");
  const totalSpan = document.getElementById("cart-total");
  if (!tbody || !totalSpan) return;

  tbody.innerHTML = "";
  let total = 0;

  cart.forEach((item, index) => {
    const subtotal = item.price * item.quantity;
    total += subtotal;

    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${item.name}</td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-secondary btn-minus" data-index="${index}">-</button>
        <span class="mx-2">${item.quantity}</span>
        <button class="btn btn-sm btn-outline-secondary btn-plus" data-index="${index}">+</button>
      </td>
      <td class="text-end">${formatCOP(item.price)}</td>
      <td class="text-end">${formatCOP(subtotal)}</td>
      <td class="text-end">
        <button class="btn btn-sm btn-outline-danger btn-remove" data-index="${index}">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  totalSpan.textContent = formatCOP(total);

  // Eventos para +, -, eliminar
  tbody.querySelectorAll(".btn-plus").forEach(btn => {
    btn.addEventListener("click", () => {
      const i = parseInt(btn.getAttribute("data-index"), 10);
      cart[i].quantity += 1;
      saveCart();
    });
  });

  tbody.querySelectorAll(".btn-minus").forEach(btn => {
    btn.addEventListener("click", () => {
      const i = parseInt(btn.getAttribute("data-index"), 10);
      cart[i].quantity -= 1;
      if (cart[i].quantity <= 0) {
        cart.splice(i, 1);
      }
      saveCart();
    });
  });

  tbody.querySelectorAll(".btn-remove").forEach(btn => {
    btn.addEventListener("click", () => {
      const i = parseInt(btn.getAttribute("data-index"), 10);
      cart.splice(i, 1);
      saveCart();
    });
  });
}

document.addEventListener("DOMContentLoaded", () => {
  updateCartBadge();
  renderCartTable();
});
