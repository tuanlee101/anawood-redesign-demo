/**
 * Anawood Gutenberg Block Styles
 */

/* ── Product Card Block ── */
.has-product-card-style {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 18px;
    overflow: hidden;
    transition: all .25s;
}
.has-product-card-style:hover {
    border-color: var(--brand);
    transform: translateY(-4px);
    box-shadow: var(--shadow-hover);
}

/* ── Feature Block ── */
.has-feature-card-style {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 18px;
    padding: 28px;
    transition: all .25s;
}
.has-feature-card-style:hover {
    border-color: var(--brand);
    transform: translateY(-4px);
}

/* ── CTA Banner ── */
.has-cta-banner-style {
    background: linear-gradient(135deg, var(--brand-light), var(--mint));
    border-radius: 20px;
    padding: 36px 44px;
    border: 1px solid var(--line);
}

/* ── Trust Strip ── */
.has-trust-strip-style {
    background: var(--mint);
    border-radius: 16px;
    padding: 18px 32px;
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
}