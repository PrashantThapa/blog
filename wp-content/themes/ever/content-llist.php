<?php
if (have_posts()) {
    global $ever_options;    
    $atts = $ever_options;
    
    $atts['img_size'] = 'ever_large_list';
    $atts['media_bgimage'] = true;
    $atts['more_text'] = ever_option("readmore", "Read more");
    
    $class = '';
    if($ever_options['blog_layout'] == 'list2' || $ever_options['blog_layout'] == 'list2-full'){
        $class = ' right-thumb';
    }
    $share_count = 'ever_origshare_count';
    $share_count = 'ever_share_count';

    echo '<div class="tw-blog list-blog list-blog-large'.esc_attr($class).'">';
    while (have_posts()) { the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
            $media = ever_standard_media($post, $atts);
            if($media){
                echo balanceTags($media);
                echo '<div class="entry-post">';
            } else {
                echo '<div class="entry-post no-media">';
            }                           
                
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
                        if ((!(bool) preg_match('/<!--more(.*?)?-->/', $post->post_content) || !empty($atts['blog_excerpt'])) && !empty($atts['more_text'])){
                            echo '<p class="more-link"><a href="'.esc_url(get_permalink()).'">'.esc_html($atts['more_text']).'</a></p>';
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
