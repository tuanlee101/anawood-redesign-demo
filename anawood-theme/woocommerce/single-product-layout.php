<?php
/**
 * Anawood WooCommerce Single Product Template Override
 */
if (!defined('ABSPATH')) exit;
wc_get_template('single-product/product-image.php');
?>

<!-- Anawood Custom Product Info Panel -->
<div class="anawood-product-info">
    <?php
    global $product;
    $brand_terms = wp_get_post_terms($product->get_id(), 'product_cat', ['fields' => 'names']);
    ?>
    <div class="info-chips">
        <?php if ($product->is_on_sale()) echo '<span class="chip">🔥 Đang giảm giá</span>'; ?>
        <span class="chip">🌿 Gỗ an toàn E0</span>
        <?php if (!empty($brand_terms)) echo '<span class="chip">' . esc_html($brand_terms[0]) . '</span>'; ?>
    </div>

    <h1 class="product-title"><?php the_title(); ?></h1>

    <?php
    if (class_exists('WC_WooGP_SDR')) {
        // Nếu dùng plugin đánh giá
        do_action('woocommerce_product_star_rating');
    } else {
        echo '<div class="product-rating">';
        echo wc_get_rating_html($product->get_average_rating(), $product->get_rating_count());
        echo ' <span>(' . $product->get_rating_count() . ' đánh giá)</span>';
        echo '</div>';
    }
    ?>

    <div class="product-price">
        <?php woocommerce_template_single_price(); ?>
    </div>

    <div class="product-excerpt">
        <?php the_excerpt(); ?>
    </div>

    <?php woocommerce_template_single_add_to_cart(); ?>

    <div class="trust-row">
        <span>🚚 Miễn phí ship</span>
        <span>🛡️ BH 24 tháng</span>
        <span>🔄 Đổi trả 7 ngày</span>
        <span>🌿 Gỗ FSC</span>
    </div>
</div>

<style>
.anawood-product-info {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 20px;
    padding: 28px;
}
.info-chips { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px }
.chip { background: var(--mint); padding: 5px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; color: #0f766e }
.product-title { font-size: 36px; font-weight: 900; margin-bottom: 6px }
.product-rating { color: #f59e0b; margin-bottom: 10px }
.product-excerpt { color: var(--muted); font-size: 15px; line-height: 1.7; margin: 12px 0 }
.trust-row { display: flex; gap: 14px; flex-wrap: wrap; font-size: 13px; color: var(--muted); border-top: 1px solid var(--line); padding-top: 14px; margin-top: 14px }
.trust-row span { display: flex; align-items: center; gap: 4px }
</style>