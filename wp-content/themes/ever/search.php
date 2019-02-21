<?php get_header();
global $ever_options;
$ever_options['blog_layout'] = ever_option("blog_layout", "simple");
$ever_options['blog_excerpt'] = ever_option("blog_excerpt");
$ever_options['blog_sidebar'] = ever_option("blog_sidebar", "true");
$ever_options['pagination'] = ever_option("blog_pagination", "simple");
?>

<div class="row">
    <div class="content-area col-md-8">
        <?php
        if (have_posts ()) {
            $ever_options['excerpt_count'] = 15;
            $ever_options['pagination'] = "simple";
            get_template_part('content');
        } else { ?>
                <div class="search-result">
                    <h3><?php esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'ever');?></h3>
                    <?php get_search_form(); ?>
                    <br/>

                    <div class="error-msg"><p><?php esc_html_e('For best search results, mind the following suggestions:', 'ever');?></p>
                        <ul class="borderlist">
                            <li><?php esc_html_e('Always double check your spelling.', 'ever');?></li>
                            <li><?php esc_html_e('Try similar keywords, for example: tablet instead of laptop.', 'ever');?></li>
                            <li><?php esc_html_e('Try using more than one keyword.', 'ever');?></li>
                        </ul>
                    </div>
                </div><?php
        } ?>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>