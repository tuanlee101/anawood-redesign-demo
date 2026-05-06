<?php
/**
 * Anawood Customizer Options
 * Theme color, logo, hero settings
 */
add_action('customize_register', function($wp_customize) {

    // ── Section: Anawood Branding ──
    $wp_customize->add_section('anawood_branding', [
        'title'    => 'Anawood — Branding',
        'priority' => 30,
    ]);

    // Hero image
    $wp_customize->add_setting('anawood_hero_img');
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'anawood_hero_img', [
        'label'    => 'Ảnh Hero',
        'section'  => 'anawood_branding',
        'settings' => 'anawood_hero_img',
    ]));

    // Hero headline
    $wp_customize->add_setting('anawood_hero_headline', ['default' => 'Nội thất gỗ an toàn cho bé tự lập mỗi ngày']);
    $wp_customize->add_control('anawood_hero_headline', [
        'label'    => 'Hero Headline',
        'section'  => 'anawood_branding',
        'type'     => 'text',
    ]);

    // Hero sub
    $wp_customize->add_setting('anawood_hero_sub', ['default' => 'Gỗ plywood chuẩn E0 – Bo góc tỉ mỉ – An toàn tuyệt đối']);
    $wp_customize->add_control('anawood_hero_sub', [
        'label'    => 'Hero Mô tả',
        'section'  => 'anawood_branding',
        'type'     => 'textarea',
    ]);

    // Phone
    $wp_customize->add_setting('anawood_phone', ['default' => '0342 608 599']);
    $wp_customize->add_control('anawood_phone', [
        'label'    => 'Hotline',
        'section'  => 'anawood_branding',
        'type'     => 'text',
    ]);

    // ── Section: Colors ──
    $wp_customize->add_section('anawood_colors', [
        'title'    => 'Anawood — Màu sắc',
        'priority' => 31,
    ]);

    $wp_customize->add_setting('anawood_brand_color', ['default' => '#c98f4a']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anawood_brand_color', [
        'label'    => 'Màu thương hiệu chính',
        'section'  => 'anawood_colors',
        'settings' => 'anawood_brand_color',
    ]));

});

// ── Output CSS vars from customizer ──
add_action('wp_head', function() {
    $brand = get_theme_mod('anawood_brand_color', '#c98f4a');
    printf('<style>:root{--brand:%s}[data-theme="dark"]{--brand:%s}</style>', esc_attr($brand), esc_attr($brand));
});