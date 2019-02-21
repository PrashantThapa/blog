<?php
if (have_posts()) {
    global $ever_options;    
    $atts = $ever_options;
    
    $atts['img_size'] = 'ever_masonry_thumb';
    $atts['more_text'] = false;
    $atts['media_bgimage'] = true;
    $width = 'col-md-6';
    $class = '';
    if($ever_options['blog_layout'] == 'side2'){
        $width .= ' right-thumb';
    }
    if($ever_options['blog_sidebar'] == 'true'){
        $width .= ' small-thumb';
    }

    echo '<div class="tw-blog side-blog'.esc_attr($class).'">';
    echo '<div class="row">';
    while (have_posts()) { the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-side-item '.$width); ?>>
            <div class="entry-post">
                <?php echo ever_standard_media($post, $atts); ?>
                <div class="entry-post-inner">
                <?php     
                    ob_start();
                        ever_blogcontent($atts);
                    $blogcontent = ob_get_clean();
                    echo '<div class="entry-cats">'.ever_cats().'</div>';
                    echo '<h2 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h2>'; 
                    
                    if(!empty($blogcontent) && $ever_options['blog_sidebar'] != 'true'){
                        echo '<div class="entry-content clearfix">';
                            echo balanceTags($blogcontent);
                        echo '</div>';
                    }
                    
                    if(ever_option('single_meta', true)){
                        echo '<div class="tw-meta"><div class="entry-author">'.esc_html__('by', 'ever').'&nbsp;';
                            the_author_posts_link();  
                            echo '</div><div><a href="'.esc_url(get_permalink()).'">'.get_the_time(get_option('date_format')).'</a></div>';
                        echo '</div>';
                    }
                ?>
                </div>
            </div>
        </article><?php
        $ever_options['post__not_in'][]=$post->ID;   
    }
    echo '</div>';
    echo '</div>';
    ever_pagination($atts['pagination']);
}   
