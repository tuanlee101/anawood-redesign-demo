<?php
/*
Template Name: Trang chủ - Anawood
Description: Home page template with hero, features, products, trust strip
*/
get_header(); ?>

<!-- Hero -->
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-text">
            <span class="chip">🌿 Nội thất Montessori chuẩn an toàn</span>
            <h1 class="hero-title">Nội thất gỗ <span class="highlight">an toàn</span><br/>cho bé <span class="highlight">tự lập</span> mỗi ngày</h1>
            <p class="hero-desc">Gỗ plywood nhập khẩu chuẩn E0 – Bo góc tỉ mỉ – Sơn gốc nước an toàn. Thiết kế theo phương pháp giáo dục Montessori, khuyến khích bé tự lập ngay từ những năm đầu đời.</p>
            <div class="hero-actions">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-primary pulse">📦 Khám phá sản phẩm</a>
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="btn btn-outline">🛒 Mua ngay</a>
            </div>
            <div class="hero-stats">
                <div class="stat"><strong>10.000+</strong>Khách hàng</div>
                <div class="stat"><strong>24 tháng</strong>Bảo hành</div>
                <div class="stat"><strong>99%</strong>Hài lòng</div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-img-wrap">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('full');
                } else { ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-placeholder.jpg'); ?>" alt="<?php bloginfo('name'); ?>">
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<!-- Trust Strip -->
<div class="container">
    <div class="trust-strip slide-up">
        <div class="trust-item"><span>🚚</span> Giao hàng miễn phí toàn quốc</div>
        <div class="trust-item"><span>🛡️</span> Bảo hành 24 tháng</div>
        <div class="trust-item"><span>🔄</span> Đổi trả trong 7 ngày</div>
        <div class="trust-item"><span>🌿</span> Gỗ FSC thân thiện</div>
    </div>
</div>

<!-- Features -->
<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="section-label">VÌ SAO CHỌN ANAWOOD</span>
            <h2 class="section-title">Ba mẹ tin dùng bởi</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card fade-in">
                <div class="fc-icon">🟢</div>
                <h3>Gỗ plywood chuẩn E0</h3>
                <p>Đạt chứng nhận FSC & CARB P2, kiểm soát Formaldehyde ở mức thấp nhất.</p>
            </div>
            <div class="feature-card fade-in">
                <div class="fc-icon">🔵</div>
                <h3>Bo góc an toàn</h3>
                <p>Mọi góc cạnh đều được bo tròn tỉ mỉ, hạn chế va chạm khi bé vui chơi.</p>
            </div>
            <div class="feature-card fade-in">
                <div class="fc-icon">🟣</div>
                <h3>Sơn gốc nước</h3>
                <p>Đạt tiêu chuẩn FDA Hoa Kỳ, không hóa chất độc hại, thân thiện với làn da bé.</p>
            </div>
        </div>
    </div>
</section>

<!-- Products -->
<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="section-label">SẢN PHẨM NỔI BẬT</span>
            <h2 class="section-title">Best-seller được yêu thích</h2>
        </div>
        <?php if (class_exists('WooCommerce')) {
            echo do_shortcode('[products limit="4" columns="4" best_selling="true"]');
        } ?>
    </div>
</section>

<?php get_footer(); ?>
