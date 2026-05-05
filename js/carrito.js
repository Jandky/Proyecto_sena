// js/carrito.js

function formatCOP(value) {
  return `$ ${value.toLocaleString("es-CO")} COP`;
}

function renderCartTable() {
  const tbody = document.getElementById("cart-body");
  const totalSpan = document.getElementById("cart-total");

  if (!tbody || !totalSpan) return;

  // Si la tabla del carrito real la renderiza PHP, este archivo no debe sobreescribirla.
  // Por ahora no hacemos nada aquí para no romper la lógica basada en sesión.
}

document.addEventListener("DOMContentLoaded", () => {
  renderCartTable();
});

async function confirmarPedido() {
  alert("La confirmación del pedido debe hacerse con el carrito manejado por PHP y sesión.");
}