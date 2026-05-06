<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        // Check if front page and if using home template
        if (is_front_page() && is_page_template('page-templates/home.php')) {
            // Already handled by template
        } else {
            the_content();
        }
    endwhile;
endif;

get_footer();
