<?php
get_header(); ?>
<div class="container" style="padding: 40px 0; text-align: center">
    <h1>404</h1>
    <p>Rất tiếc! Không tìm thấy trang này.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Về trang chủ</a>
</div>
<?php get_footer();
