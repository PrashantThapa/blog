<?php
if (have_posts()) {
    wp_enqueue_script('ever-isotope');
    global $ever_options;    
    $atts = $ever_options;
    
    $atts['img_size'] = 'ever_masonry_thumb';
    $atts['more_text'] = false;
    $i = 1;

    echo '<div class="tw-blog grid-blog tw-isotope-container clearfix">';
    echo '<div class="row isotope-container">';
    while (have_posts()) { the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?>><?php 
            $format = get_post_format();
            echo ever_entry_media($format, $atts);?>
            
            <div class="entry-post">
            <?php
            ob_start();
                ever_blogcontent($atts);
            $blogcontent = ob_get_clean();
            echo '<div class="entry-cats">'.ever_cats().'</div>';
            echo '<h2 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h2>'; 
                if(ever_option('single_meta', true)){
                    echo '<div class="tw-meta"><span class="entry-author">'.esc_html__('by', 'ever').'&nbsp;';
                        the_author_posts_link();  
                        echo '</span><span class="entry-date"><a href="'.esc_url(get_permalink()).'">'.get_the_time(get_option('date_format')).'</a></span>';
                        echo ever_comment_count();
                    echo '</div>';
                }
            if(!empty($blogcontent)){
                echo '<div class="entry-content clearfix">';
                    echo balanceTags($blogcontent);
                echo '</div>';
            }
            ?>
            </div>
        </article><?php
        if($i == 2 && $ever_options['blog_sidebar'] == 'true'){
            get_sidebar();
        }
        $i++;
        $ever_options['post__not_in'][]=$post->ID;   
    }
    $ever_options['blog_sidebar'] = false;
    echo '</div>';
    echo '</div>';
    ever_pagination($atts['pagination']);
}   
