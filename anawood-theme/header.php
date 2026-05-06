<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ═══ HEADER ═══ -->
<header class="site-header">
    <div class="container nav">
        <?php if (has_custom_logo()) {
            the_custom_logo();
        } else { ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><?php bloginfo('name'); ?></a>
        <?php } ?>

        <nav class="nav-menu">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                ]);
            } else { ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="active">Trang chủ</a>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Sản phẩm</a>
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>">Giỏ hàng <sup class="cart-badge">0</sup></a>
            <?php } ?>
        </nav>

        <div class="nav-actions">
            <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" aria-label="Toggle theme">🌙</button>
        </div>
    </div>
</header>
<main class="main">
