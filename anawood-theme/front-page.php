<?php
if (is_front_page()) {
    get_template_part('page-templates/home');
} else {
    get_header(); ?>
    <div class="container" style="padding: 40px 0">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div>
    <?php
    get_footer();
}
