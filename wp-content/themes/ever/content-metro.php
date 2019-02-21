<?php
if (have_posts()) {
    global $ever_options;    
    $atts = $ever_options;
    
    $atts['img_size'] = 'ever_grid_thumb';
    $atts['more_text'] = $square_atts['more_text'] = $side_atts['more_text'] = false;
    
    $square_atts['media_bgimage'] = $side_atts['media_bgimage'] = true;
    $square_atts['img_size'] = $side_atts['img_size'] = 'ever_single_post';
    
    $width = 'col-md-4';
    $side_width = 'col-md-8';
    if(isset($atts['blog_sidebar']) && $atts['blog_sidebar'] == "true"){
        $width = 'col-md-6';
        $side_width = 'col-md-12';
    }

    echo '<div class="tw-blog metro-blog">';
    echo '<div class="row">';
    while (have_posts()) { the_post(); 
        $metro = ever_metabox('single_metro');
        if($metro == 'square'){
            
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-square-item '. $width); ?>>
            
            <div class="entry-post">
            <?php
                echo ever_standard_media($post, $square_atts);
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
        } else if($metro == 'side' || $metro == 'side2'){
            if($metro == 'side2'){ $side_width .= ' right-thumb'; } ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-side-item '.$side_width); ?>>
                <div class="entry-post">
                    <?php echo ever_standard_media($post, $side_atts); ?>
                    <div class="entry-post-inner">
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
                </div>
            </article>
        <?php } else { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-grid-item '.$width); ?>><?php 
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
            </article>
        <?php
        }
        $ever_options['post__not_in'][]=$post->ID;   
    }
    echo '</div>';
    echo '</div>';
    ever_pagination($atts['pagination']);
}   
