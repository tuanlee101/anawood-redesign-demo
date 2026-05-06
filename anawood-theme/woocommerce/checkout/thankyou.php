<?php
/**
 * Anawood Order Confirmation Override
 * File: woocommerce/checkout/thankyou.php
 */
if (!defined('ABSPATH')) exit;
?>

<div class="thankyou-page">
    <div class="thankyou-icon">🎉</div>
    <h1>Đặt hàng <span>thành công!</span></h1>
    <p class="thankyou-sub">Cảm ơn ba mẹ đã tin chọn Anawood. Đội ngũ sẽ liên hệ xác nhận trong <strong>15–30 phút</strong>.</p>

    <!-- Order details -->
    <?php do_action('woocommerce_thankyou', $order->get_id()); ?>
</div>

<style>
.thankyou-page { text-align: center; max-width: 640px; margin: 0 auto; padding: 40px 0 }
.thankyou-icon { font-size: 72px; margin-bottom: 20px; animation: bounceIn .6s ease }
.thankyou-page h1 { font-size: 30px; font-weight: 900; margin-bottom: 10px }
.thankyou-page h1 span { color: var(--brand) }
.thankyou-sub { color: var(--muted); font-size: 15px; margin-bottom: 28px }

@keyframes bounceIn {
    0%   { transform: scale(.3); opacity: 0 }
    50%  { transform: scale(1.08) }
    70%  { transform: scale(.96) }
    100% { transform: scale(1); opacity: 1 }
}
</style>