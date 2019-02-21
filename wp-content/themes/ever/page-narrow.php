<?php
/**
 * Template Name: 3: Narrow
 */

get_header();

the_post(); ?>

    <div class="row">
        <div class="content-area col-md-8">
            <div class="single-content">
                <article <?php post_class(); ?>>
                    <?php
                    echo '<h2 class="page-title">' . get_the_title() . '</h2>';
                    if (has_post_thumbnail($post->ID)) {
                        echo '<div class="entry-media">';
                        echo ever_image('ever_blog_thumb');
                        echo '</div>';
                    }
                    ?>                    
                    <div class="single-padding">
                        <?php the_content(); ?>
                        <?php wp_link_pages(); ?>
                        <div class="clearfix"></div>
                    </div>
                </article>
                <div class="single-padding">
                    <?php comments_template('', true); ?>
                </div>
            </div>
        </div>
    </div>

<?php 
get_footer();