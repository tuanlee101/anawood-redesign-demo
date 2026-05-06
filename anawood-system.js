/* ══════════════════════════════════════
   ANAWOOD DESIGN SYSTEM — Shared JS
   Theme toggle, IntersectionObserver animations
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

  // Export to global
  window.toggleTheme = toggleTheme;

  // Restore saved theme
  const saved = localStorage.getItem('anawood-theme');
  if (saved) document.documentElement.setAttribute('data-theme', saved);

  // Update button text on load
  const btn = document.getElementById('themeBtn');
  if (btn) {
    const theme = document.documentElement.getAttribute('data-theme') || 'light';
    btn.textContent = theme === 'light' ? '🌙' : '☀️';
  }

  /* ── Scroll Animations (IntersectionObserver) ── */
  function initAnimations() {
    const els = document.querySelectorAll('.fade-in, .slide-up');
    if (!els.length || !('IntersectionObserver' in window)) return;

    const obs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    els.forEach(el => obs.observe(el));
  }

  // Run after DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAnimations);
  } else {
    initAnimations();
  }
})();
