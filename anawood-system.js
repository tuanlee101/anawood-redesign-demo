/* ══════════════════════════════════════
   ANAWOOD DESIGN SYSTEM — Shared JS
   Theme toggle, Cart state (localStorage),
   Scroll animations (IntersectionObserver)
   ══════════════════════════════════════ */

(function() {
  'use strict';

  /* ── Theme Toggle ── */
  function toggleTheme() {
    const html = document.documentElement;
    const cur = html.getAttribute('data-theme') || 'light';
    const next = cur === 'light' ? 'dark' : 'light';
    html.setAttribute('data-theme', next);
    localStorage.setItem('anawood-theme', next);
    const btn = document.getElementById('themeBtn');
    if (btn) btn.textContent = next === 'light' ? '🌙' : '☀️';
  }
  window.toggleTheme = toggleTheme;

  /* Restore theme */
  const savedTheme = localStorage.getItem('anawood-theme');
  if (savedTheme) document.documentElement.setAttribute('data-theme', savedTheme);
  const themeBtn = document.getElementById('themeBtn');
  if (themeBtn) {
    const theme = document.documentElement.getAttribute('data-theme') || 'light';
    themeBtn.textContent = theme === 'light' ? '🌙' : '☀️';
  }

  /* ── Cart System (localStorage) ── */
  const CART_KEY = 'anawood_cart';

  function getCart() {
    try { return JSON.parse(localStorage.getItem(CART_KEY) || '[]'); }
    catch { return []; }
  }

  function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
    updateCartBadge();
  }

  function updateCartBadge() {
    const cart = getCart();
    const total = cart.reduce((s, i) => s + (i.qty || 1), 0);
    document.querySelectorAll('.cart-badge').forEach(el => {
      el.textContent = total;
      el.style.display = total > 0 ? 'flex' : 'none';
    });
  }

  /* Add item to cart */
  window.addToCart = function(product) {
    const cart = getCart();
    const existing = cart.find(i => i.id === product.id);
    if (existing) {
      existing.qty = (existing.qty || 1) + (product.qty || 1);
    } else {
      cart.push(Object.assign({ qty: 1 }, product));
    }
    saveCart(cart);
    showToast(`✓ Đã thêm "${product.name}" vào giỏ hàng!`);
  };

  /* Remove item */
  window.removeFromCart = function(id) {
    let cart = getCart().filter(i => i.id !== id);
    saveCart(cart);
  };

  /* Update quantity */
  window.updateCartQty = function(id, delta) {
    const cart = getCart();
    const item = cart.find(i => i.id === id);
    if (!item) return;
    item.qty += delta;
    if (item.qty < 1) { window.removeFromCart(id); return; }
    saveCart(cart);
    renderCartPage();
  };

  /* Render cart page (called by cart-checkout.html) */
  window.renderCartPage = function() {
    const cart = getCart();
    const cartItemsEl = document.getElementById('cartItems');
    const subtotalEl = document.getElementById('subtotal');
    const totalEl = document.getElementById('total');
    const countEl = document.getElementById('cartCount');

    if (!cartItemsEl) return;

    if (cart.length === 0) {
      cartItemsEl.innerHTML = `
        <div style="text-align:center;padding:48px 24px;background:var(--card);border:1px solid var(--line);border-radius:16px">
          <div style="font-size:48px;margin-bottom:12px">🛒</div>
          <h3 style="margin-bottom:8px">Giỏ hàng trống</h3>
          <p style="color:var(--muted);margin-bottom:16px">Hãy thêm sản phẩm yêu thích vào giỏ hàng nhé!</p>
          <a href="anawood-product-page.html" class="btn btn-primary">🛍️ Khám phá sản phẩm</a>
        </div>`;
      if (countEl) countEl.textContent = 'Giỏ hàng (0)';
      if (subtotalEl) subtotalEl.textContent = '0 ₫';
      if (totalEl) totalEl.textContent = '0 ₫';
      return;
    }

    let subtotal = 0;
    const fmt = n => n.toLocaleString('vi-VN') + ' ₫';

    cartItemsEl.innerHTML = cart.map(item => {
      const price = typeof item.price === 'number' ? item.price : parseFloat(String(item.price || '0').replace(/[^\d]/g, ''));
      subtotal += price * (item.qty || 1);
      return `
        <div class="item" data-id="${item.id}">
          <img src="${item.img}" alt="${item.name}">
          <div><div class="item-name">${item.name}</div><div class="item-meta">${item.meta || ''}</div></div>
          <div style="text-align:right">
            <div class="qty" style="justify-content:flex-end">
              <button onclick="updateCartQty('${item.id}',-1)">−</button>
              <strong style="min-width:22px;text-align:center">${item.qty || 1}</strong>
              <button onclick="updateCartQty('${item.id}',1)">+</button>
              <span class="remove-btn" onclick="removeFromCart('${item.id}')" title="Xóa">✕</span>
            </div>
            <div style="font-weight:700;color:#b45309;margin-top:4px">${fmt(price * (item.qty || 1))}</div>
          </div>
        </div>`;
    }).join('');

    if (countEl) countEl.textContent = `Giỏ hàng (${cart.reduce((s,i)=>s+(i.qty||1),0)}) sản phẩm`;
    if (subtotalEl) subtotalEl.textContent = fmt(subtotal);
    if (totalEl) totalEl.textContent = fmt(subtotal);
  };

  /* Toast notification */
  window.showToast = function(msg) {
    let t = document.getElementById('toast');
    if (!t) {
      t = document.createElement('div');
      t.id = 'toast';
      t.style.cssText = 'position:fixed;bottom:24px;right:24px;z-index:9999;background:#1a1a2e;color:#fff;padding:14px 20px;border-radius:12px;font-weight:600;font-size:14px;box-shadow:0 8px 24px rgba(0,0,0,.3);transition:opacity .3s;pointer-events:none;max-width:320px';
      document.body.appendChild(t);
    }
    t.textContent = msg;
    t.style.opacity = '1';
    clearTimeout(t._timer);
    t._timer = setTimeout(() => { t.style.opacity = '0'; }, 2800);
  };

  /* Init cart badge on every page */
  updateCartBadge();

  /* ── Scroll Animations ── */
  function initAnimations() {
    const els = document.querySelectorAll('.fade-in, .slide-up');
    if (!els.length || !('IntersectionObserver' in window)) {
      document.querySelectorAll('.fade-in, .slide-up').forEach(el => el.classList.add('visible'));
      return;
    }
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    els.forEach(el => obs.observe(el));
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAnimations);
  } else {
    initAnimations();
  }
})();