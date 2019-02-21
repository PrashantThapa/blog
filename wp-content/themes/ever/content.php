<?php
if (have_posts()) {
    global $ever_options;
    $atts = $ever_options;   

    $atts['more_text'] = ever_option("readmore", "Read more");
    
    $atts['img_size'] = 'ever_blog_large';
    if($ever_options['blog_sidebar'] == 'true'){
        $atts['img_size'] = 'ever_blog_thumb';
    }
    
    $class = (isset($atts['blog_excerpt']) && $atts['blog_excerpt'] == '0') ? ' no-border' : '';
    
    
    $share_count = 'ever_origshare_count';
    $share_count = 'ever_share_count';
    
    echo '<div class="tw-blog simple-blog'.esc_attr($class).'">';
    
    while (have_posts()) { the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php 
            $format = get_post_format();
            echo ever_entry_media($format, $atts);
            
            echo '<div class="entry-post">';                
               
                    ob_start();
                        ever_blogcontent($atts);
                    $blogcontent = ob_get_clean();

                    echo '<div class="entry-cats">'.ever_cats().'</div>';
                    echo '<h2 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h2>';
                        if(ever_option('single_meta', true)){
                            echo '<div class="tw-meta">';
                                if($author_link = get_the_author_link()){
                                    echo '<span class="entry-author">'.esc_html__('by', 'ever').'&nbsp;'.($author_link).'</span>';
                                }
                                echo '<span class="entry-date"><a href="'.esc_url(get_permalink()).'">'.get_the_time(get_option('date_format')).'</a></span>';
                                echo ever_comment_count();
                            echo '</div>';
                        }
                    if(!empty($blogcontent)){
                        echo '<div class="entry-content clearfix">';
                            echo balanceTags($blogcontent);
                            if ((!(bool) preg_match('/<!--more(.*?)?-->/', $post->post_content) || !empty($atts['blog_excerpt'])) && !empty($atts['more_text'])){
                                echo '<p class="more-link"><a href="'.esc_url(get_permalink()).'"><span>'.esc_html($atts['more_text']).'</span><i class="ion-ios-arrow-thin-right"></i></a></p>';
                            }
                        echo '</div>';
                    }
                    
                    
            echo '</div>';
            ?>
        </article><?php
        $ever_options['post__not_in'][]=$post->ID;   
    }
    echo '</div>';
    
    ever_pagination($atts['pagination']);
}   