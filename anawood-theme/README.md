# Anawood WordPress Theme

Theme WordPress redesign cho [anawood.vn](https://anawood.vn) — Nội thất trẻ em, nội thất Montessori.

## Cài đặt

1. **Tải theme:** Nén thư mục `anawood-theme/` thành file `.zip`
2. **Upload lên WordPress:** Giao diện → Cài mới → Tải lên
3. **Kích hoạt theme** và cài đặt **WooCommerce** (nếu chưa có)
4. **Import demo content** (tùy chọn): Dùng WordPress Importer

## Yêu cầu

- WordPress 6.0+
- PHP 8.0+
- WooCommerce (để dùng shop/cart/checkout)

## Cấu trúc thư mục

```
anawood-theme/
├── style.css              ← Theme header (WordPress nhận diện)
├── functions.php           ← Theme setup, enqueue, WooCommerce hooks
├── header.php             ← Header template
├── footer.php             ← Footer template
├── index.php              ← Fallback template
├── front-page.php         ← Front page
├── page.php               ← Generic page
├── single.php             ← Single post
├── 404.php                ← 404 page
├── page-templates/
│   └── home.php           ← Home page template
├── assets/
│   ├── css/
│   │   └── anawood-system.css   ← Full design system (variables, components, responsive)
│   └── js/
│       └── anawood-system.js     ← Theme toggle, cart sync, animations
├── woocommerce/
│   ├── content-product.php       ← Product card override
│   ├── single-product-layout.php  ← Single product layout
│   └── cart/cart-totals.php       ← Cart totals panel
├── inc/
│   ├── customizer.php    ← Customizer options (branding, colors)
│   ├── theme-setup.php   ← Theme setup
│   └── block-styles.php  ← Gutenberg block styles
└── languages/            ← Translation files
```

## Tính năng

- ✅ **Design System hoàn chỉnh:** CSS variables, responsive, animations
- ✅ **Dark/Light mode:** Toggle + localStorage persistence
- ✅ **WooCommerce-ready:** Product, Cart, Checkout, Thank You
- ✅ **Cart Badge:** Số lượng hiển thị real-time trên menu
- ✅ **Customizer:** Logo, hero image, headline, hotline
- ✅ **Gutenberg Block Styles:** Feature cards, CTA banners
- ✅ **Mobile responsive:** Desktop → tablet → mobile

## Customizer Options

- Logo & Site Identity
- Hero Image
- Hero Headline & Description
- Hotline & Address

## Prototype Demo

Xem demo HTML prototype: https://tuanlee101.github.io/anawood-redesign-demo/

## Tác giả

Anawood Team — https://anawood.vn