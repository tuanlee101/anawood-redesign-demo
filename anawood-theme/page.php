<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div class="container" style="padding: 40px 0">
            <h1><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile;
endif;

get_footer();
