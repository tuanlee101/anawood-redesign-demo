<?php
/**
 * Anawood Theme Functions
 */

// ── Theme Setup ──
add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('align-wide');

    register_nav_menus([
        'primary' => __('Primary Menu', 'anawood'),
        'footer'  => __('Footer Menu', 'anawood'),
    ]);
});

// ── Enqueue Assets ──
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('anawood-system',
        get_template_directory_uri() . '/assets/css/anawood-system.css',
        [], '1.0.0');

    wp_enqueue_script('anawood-system',
        get_template_directory_uri() . '/assets/js/anawood-system.js',
        [], '1.0.0', true);

    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-add-to-cart');
        wp_enqueue_script('wc-cart');
    }

    // Google Fonts
    wp_enqueue_style('anawood-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap',
        [], null);
});

// ── Admin Styles ──
add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('anawood-admin',
        get_template_directory_uri() . '/assets/css/anawood-system.css',
        [], '1.0.0');
});

// ── Cart Fragment Update ──
add_filter('woocommerce_add_to_cart_fragments', function($fragments) {
    $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    $fragments['.cart-badge'] = '<span class="cart-badge">' . $count . '</span>';
    return $fragments;
});

// ── Add Cart Badge to Menu ──
add_filter('wp_nav_menu_items', function($items, $args) {
    if ($args->theme_location === 'primary') {
        $count = class_exists('WooCommerce') && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
        $badge = $count > 0 ? '<sup class="cart-badge" style="display:inline">' . $count . '</sup>' : '<sup class="cart-badge">0</sup>';
        $items .= '<li class="menu-item"><a href="' . wc_get_cart_url() . '">🛒 Giỏ hàng' . $badge . '</a></li>';
    }
    return $items;
}, 10, 2);

// ── WooCommerce Template Overrides ──
add_filter('woocommerce_locate_template', function($template, $template_name, $template_path) {
    $theme_template = get_stylesheet_directory() . '/woocommerce/' . $template_name;
    return file_exists($theme_template) ? $theme_template : $template;
}, 10, 3);

// ── Custom Body Classes ──
add_filter('body_class', function($classes) {
    if (is_front_page()) $classes[] = 'front-page';
    if (is_product()) $classes[] = 'single-product-page';
    if (is_cart()) $classes[] = 'cart-page';
    if (is_checkout()) $classes[] = 'checkout-page';
    return $classes;
});

// ── Remove WooCommerce Default Styles ──
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// ── Breadcrumb ──
if (!function_exists('anawood_breadcrumb')) {
    function anawood_breadcrumb() {
        if (class_exists('WooCommerce') && function_exists('woocommerce_breadcrumb')) {
            woocommerce_breadcrumb([
                'delimiter'   => ' › ',
                'wrap_before' => '<nav class="breadcrumb container">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
            ]);
        }
    }
}
