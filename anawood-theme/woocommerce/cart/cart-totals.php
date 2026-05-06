<?php
/**
 * WooCommerce Cart Totals — Anawood Override
 */
if (!defined('ABSPATH')) exit;
?>
<div class="cart-totals-panel">
    <h2>📋 Tóm tắt đơn hàng</h2>

    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        if ($_product && $_product->exists()) { ?>
            <div class="cart-item-summary">
                <span><?php echo $_product->get_name(); ?> × <?php echo $cart_item['quantity']; ?></span>
                <span><?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?></span>
            </div>
        <?php }
    } ?>

    <div class="cart-totals-rows">
        <div class="totals-row">
            <span>Tạm tính</span>
            <span><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>
        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) { ?>
            <div class="totals-row">
                <span>Giảm giá (<?php echo esc_html($code); ?>)</span>
                <span><?php wc_cart_totals_coupon_html($coupon); ?></span>
            </div>
        <?php } ?>
        <div class="totals-row">
            <span>Phí vận chuyển</span>
            <span style="color:#059669;font-weight:700">Miễn phí</span>
        </div>
        <div class="totals-row total">
            <span>Tổng cộng</span>
            <span><?php wc_cart_totals_order_total_html(); ?></span>
        </div>
    </div>

    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) { ?>
        <?php wc_cart_totals_shipping_html(); ?>
    <?php } ?>

    <?php do_action('woocommerce_proceed_to_checkout'); ?>

    <style>
    .cart-totals-panel { background: var(--card); border: 1px solid var(--line); border-radius: 18px; padding: 22px }
    .cart-totals-panel h2 { font-size: 20px; margin-bottom: 16px }
    .cart-item-summary { display: flex; justify-content: space-between; padding: 8px 0; font-size: 14px; border-bottom: 1px solid var(--line) }
    .cart-totals-rows { margin-top: 12px }
    .totals-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 15px }
    .totals-row.total { font-weight: 700; font-size: 20px; border-top: 1px solid var(--line); padding-top: 12px; color: #b45309 }
    .wc-proceed-to-checkout .checkout-button { display: block; width: 100%; padding: 16px; border-radius: 14px !important; font-size: 17px !important; background: var(--brand) !important; color: #fff !important; text-align: center }
    .wc-proceed-to-checkout .checkout-button:hover { background: var(--brand-dark) !important }
    </style>
</div>