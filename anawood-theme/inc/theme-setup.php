<?php
/**
 * Theme Setup / Custom Image Sizes
 */
add_action('after_setup_theme', function() {
    // Custom image sizes
    add_image_size('anawood-hero', 800, 600, true);
    add_image_size('anawood-thumb', 400, 300, true);

    // Theme support
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
});