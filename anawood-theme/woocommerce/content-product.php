<?php
/**
 * WooCommerce Overrides
 * Anawood Theme — Custom WooCommerce templates
 */
if (!defined('ABSPATH')) exit;
?>

<!-- ═══ WOOCOMMERCE CONTENT-PRODUCT (Loop Product Card) ═══ -->
<?php global $product; ?>
<div class="product-card fade-in">
    <a href="<?php echo esc_url($product->get_permalink()); ?>">
        <?php echo $product->get_image('woocommerce_thumbnail', ['loading' => 'lazy']); ?>
        <div class="pc-body">
            <?php
            $cats = wc_get_product_category_list($product->get_id(), ', ');
            if ($cats) echo '<span class="pc-tag">' . wp_kses_post($cats) . '</span>';
            ?>
            <strong><?php echo wp_kses_post($product->get_name()); ?></strong>
            <div class="pc-price">
                <?php echo $product->get_price_html(); ?>
            </div>
        </div>
    </a>
    <div style="padding: 0 16px 16px">
        <?php woocommerce_template_loop_add_to_cart(); ?>
    </div>
</div>