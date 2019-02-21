<?php
if (have_posts()) {
    global $ever_options;    
    $atts = $ever_options;
    
    $atts['img_size'] = 'ever_single_post';
    $atts['more_text'] = false;
    $atts['media_bgimage'] = true;
    $width = (isset($atts['blog_sidebar']) && $atts['blog_sidebar'] == "true") ? 'col-md-6' : 'col-md-4';

    echo '<div class="tw-blog square-blog">';
    echo '<div class="row">';
    while (have_posts()) { the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-square-item '. $width); ?>>
            
            <div class="entry-post">
            <?php
                echo ever_standard_media($post, $atts);
                echo '<div class="entry-cats">'.ever_cats().'</div>';
                echo '<h2 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h2>'; 
                if(ever_option('single_meta', true)){
                    echo '<div class="tw-meta"><span class="entry-author">'.esc_html__('by', 'ever').'&nbsp;';
                        the_author_posts_link();  
                        echo '</span><span class="entry-date"><a href="'.esc_url(get_permalink()).'">'.get_the_time(get_option('date_format')).'</a></span>';
                        echo ever_comment_count();
                    echo '</div>';
                }
            ?>
            </div>
        </article><?php
        $ever_options['post__not_in'][]=$post->ID;   
    }
    echo '</div>';
    echo '</div>';
    ever_pagination($atts['pagination']);
}   
