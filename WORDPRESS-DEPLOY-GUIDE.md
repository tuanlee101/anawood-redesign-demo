# 🚀 Hướng dẫn triển khai prototype Anawood lên WordPress/WooCommerce

> **Từ:** Anawood Redesign Prototype (https://tuanlee101.github.io/anawood-redesign-demo)  
> **Cho:** Anawood.vn (WordPress + WooCommerce)  
> **Viết bởi:** Neo 🤖

---

## 1. Cấu trúc prototype hiện tại

```
anawood-system.css        ← Design system (theme, grid, buttons, animations)
anawood-system.js          ← Cart engine, theme toggle, scroll animations
anawood-redesign-prototype.html   ← Home page
anawood-product-page.html         ← Product detail page
anawood-cart-checkout.html         ← Cart + Checkout
anawood-order-confirmation.html    ← Thank You page
index.html                ← Demo index
```

---

## 2. Cách triển khai (từ nhanh -> chuyên nghiệp)

### 🅰️ Cách nhanh nhất: Dùng Page Builder + copy CSS

Anawood đang dùng **WordPress với Jetpack**. Nếu dùng thêm **Elementor**, **Gutenberg**, hoặc **WPBakery**, làm như sau:

**Bước 1:** Copy `anawood-system.css` vào:
- **Customizer → Additional CSS**
- Hoặc dùng plugin **Simple Custom CSS and JS / WPCode**
- Hoặc nhét vào `style.css` của child theme

**Bước 2:** Copy `anawood-system.js` vào:
- Dùng **WPCode** ở dạng JS snippet (footer)
- Hoặc enqueue trong `functions.php`:

```php
add_action('wp_enqueue_scripts', function() {
  wp_enqueue_script('anawood-system', get_template_directory_uri() . '/anawood-system.js', [], '1.0', true);
  wp_enqueue_style('anawood-system', get_template_directory_uri() . '/anawood-system.css', [], '1.0');
});
```

**Bước 3:** Dùng Page Builder dựng các section theo prototype:
- Hero section → row có background + heading + button
- Trust strip → row dạng flexbox, 4 cột
- Features → grid 3 cột
- Products → dùng WooCommerce shortcode: `[products limit="4" columns="4" best_selling="true"]`

**Bước 4:** Cart engine (`anawood-system.js` sẵn sàng) — nhưng trên WooCommerce thực tế bạn sẽ dùng **WooCommerce Cart API** thay vì localStorage. Code JS có thể giữ lại để làm UI layer tương tác mượt mà cho user.

### 🅱️ Cách chuyên nghiệp: Tạo WordPress Child Theme

1. **Tạo child theme** thư mục: `wp-content/themes/anawood-child/`
2. File `style.css`:

```css
/*
Theme Name: Anawood Child
Template: ten-theme-chinh
*/
```

3. File `functions.php`:

```php
<?php
add_action('wp_enqueue_scripts', function() {
  $parent_style = 'parent-style';
  wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
  wp_enqueue_style('anawood-system',
    get_stylesheet_directory_uri() . '/assets/css/anawood-system.css',
    [$parent_style], '1.0');
  wp_enqueue_script('anawood-system',
    get_stylesheet_directory_uri() . '/assets/js/anawood-system.js',
    [], '1.0', true);
});
```

4. Copy CSS/JS vào `assets/css/` và `assets/js/` trong child theme.

---

## 3. Component map: Prototype → WooCommerce

| Prototype | Triển khai trên WordPress |
|---|---|
| **Hero section** | Elementor Page Builder / Cover Block Gutenberg |
| **Trust strip** | Row gồm 4 icon + text (bằng shortcode HTML hoặc ACF) |
| **Feature cards** | Gutenberg Columns block, CSS class custom |
| **Product grid** | `[products limit="4" columns="4"]` hoặc Product Block |
| **Product page** | WooCommerce Single Product template override |
| **Gallery ảnh** | WooCommerce Product Gallery sẵn có |
| **Variant màu/kích thước** | WooCommerce Variable Product + Attributes |
| **Cart/Checkout** | WooCommerce Cart + Checkout pages mặc định |
| **Thank You** | WooCommerce Order Received page — tuỳ chỉnh bằng hook |
| **Cart badge** | WooCommerce Cart Widget sẵn có, hoặc custom AJAX |
| **Dark/Light toggle** | Giữ nguyên JS, thêm class vào `<body>` |

---

## 4. Tinh chỉnh quan trọng khi triển khai thật

### Theme toggle
`anawood-system.js` dùng `localStorage` — trên WordPress vẫn chạy bình thường. Nếu muốn thêm vào body:
```js
document.body.classList.toggle('dark-mode', document.documentElement.getAttribute('data-theme') === 'dark');
```

### Cart sync với WooCommerce
Thay vì localStorage thuần, cần gắn vào **WooCommerce AJAX Cart**:

```js
// Lấy cart từ WooCommerce
jQuery.ajax({
  url: wc_cart_params.ajax_url,
  data: { action: 'get_cart_items' },
  success: function(res) {
    updateCartBadge(res.data.count);
  }
});
```

### Breadcrumb
WordPress sẵn có WooCommerce Breadcrumb — chỉ cần style theo CSS hệ thống.

### Product variant
WooCommerce dùng `select` dropdown mặc định. Để có giao diện pill (như prototype), dùng:
- Plugin **Variation Swatches for WooCommerce**
- Hoặc tự override bằng CSS + JS chuyển đổi `<select>` thành pill buttons

---

## 5. Các plugin gợi ý hỗ trợ

| Mục đích | Plugin |
|---|---|
| Page Builder | **Elementor** (miễn phí) |
| SEO | **Rank Math SEO** (miễn phí) |
| Cache + ảnh WebP | **LiteSpeed Cache** hoặc **WP Rocket** |
| Custom CSS/JS | **WPCode** (miễn phí) |
| Variation pills | **Variation Swatches for WooCommerce** |
| Breadcrumb | **Breadcrumb NavXT** hoặc Rank Math SEO |
| Schema | **Rank Math SEO** (tích hợp sẵn) |

---

## 6. Checklist kiểm tra sau khi triển khai

- [ ] CSS theme variables được load (kiểm tra light/dark)
- [ ] Hero section hiển thị đúng trên desktop & mobile
- [ ] Product gallery thumbnails click được
- [ ] Variant pill có thể chọn và cập nhật giá
- [ ] Cart badge hiển thị số lượng
- [ ] Add to Cart có toast notification
- [ ] Checkout form submit được (WooCommerce)
- [ ] Order received page giống prototype
- [ ] Dark mode lưu được khi chuyển trang
- [ ] Animation scroll hoạt động mượt
- [ ] Kiểm tra trên điện thoại thực tế (không chỉ responsive preview)

---

## 7. Kết luận

Prototype này có thể **triển khai 80–90%** vào WordPress chỉ bằng:
- CSS/JS copy-paste vào child theme
- Elementor để dựng layout
- WooCommerce Product Settings để thêm variant

Phần cart badge + toast notification cần tích hợp thêm AJAX với WooCommerce, nhưng code trong `anawood-system.js` đã có sẵn kiến trúc, chỉ cần thay lớp dữ liệu từ localStorage → REST API.

**Thời gian ước lượng:**  
🕐 Với dev WordPress quen tay: **2–3 ngày**  
🕐 Với người mới (dùng Elementor): **4–5 ngày**

---

*Guide by Neo 🤖 – Prototype Anawood Redesign Demo*  
*GitHub: https://github.com/tuanlee101/anawood-redesign-demo*  
*Live demo: https://tuanlee101.github.io/anawood-redesign-demo/*
