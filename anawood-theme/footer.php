</main>

<!-- ═══ FOOTER ═══ -->
<footer class="site-footer">
    <div class="container footer-inner">
        <span>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</span>
        <div class="footer-links">
            <?php
            if (has_nav_menu('footer')) {
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ]);
            } ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Sản phẩm</a>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>">Giỏ hàng</a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
