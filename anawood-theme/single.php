<?php
get_header(); ?>
<div class="container" style="padding: 40px 0">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_title('<h1>', '</h1>');
            echo '<div class="entry-content">';
            the_content();
            echo '</div>';
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        endwhile;
    endif;
    ?>
</div>
<?php get_footer();
