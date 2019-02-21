<?php
if(is_single()){    
    global $ever_options;
    if($ever_options['single_media'] == 'fullwidth'){
        $img = ever_image('full', true);
        $bgimage = $class = '';
        if(!empty($img['url'])){
            $bgimage = ' style="background-image: url('.esc_url($img['url']).');"';
            $class = ' with-img';
        }
        echo '<div class="single-media-container'.esc_attr($class).'">';
            echo '<div class="single-media"'.($bgimage).'></div>';
            echo '<div class="container">';
                echo '<div class="single-media-content">';
                    ever_single_title();
                echo '</div>';
            echo '</div>';
        echo '</div>';
    } elseif($ever_options['single_media'] == 'large2'){
        $img = ever_image('full', true);
        $bgimage = $class = '';
        if(!empty($img['url'])){
            $bgimage = ' style="background-image: url('.esc_url($img['url']).');"';
            $class = ' with-img';
        }
        echo '<div class="container single-large-media2">';
            echo '<div class="single-media-container'.esc_attr($class).'">';
                echo '<div class="single-media"'.($bgimage).'></div>';
                    echo '<div class="single-media-content">';
                        ever_single_title();
                    echo '</div>';
            echo '</div>';
        echo '</div>';
    }
} elseif (is_page()) {
    global $ever_options;
    $page_options = ever_metaboxes();
    $feature = isset($page_options['slider']) ? $page_options['slider'] : '';
    if(!empty($feature)){
        $imgsize = 'full';
        $query['ignore_sticky_posts'] = 1;
        $query['showposts'] = !empty($page_options['slider_post_count']) ? $page_options['slider_post_count'] : 3;
        if(!empty($page_options['slider_cat'])){
            $query['category_name'] = $page_options['slider_cat'];
        }
        if($feature == "custom" && !empty($page_options['slider_shortcode'])){
            echo '<div class="tw-slider-container">';
                echo '<div class="tw-slider custom-slider">';
                    echo do_shortcode($page_options['slider_shortcode']);
                echo '</div>';
            echo '</div>';
        } else {
            wp_enqueue_script('owl-carousel');
            echo '<div class="tw-slider-container">';
                if( $feature != 'slider1' ){
                    echo '<div class="container">';
                    if($feature == 'slider3'){
                        $imgsize = 'ever_slider_thumb';
                    }
                }
                echo '<div class="tw-slider '.esc_attr($feature).'">';
                    $feat_query = new WP_Query( $query );
                    if ($feat_query->have_posts()) :
                        if( $feature != 'slider4' ){
                            echo '<div class="owl-carousel">';
                        } else {
                            ob_start();
                        }
                        $slider4 = array();
                        $i = 0;
                        while ($feat_query->have_posts()) : $feat_query->the_post();

                        $ever_options['post__not_in'][]=$post->ID;   
                        $orig_image = ever_image($imgsize, true);
                        $sliderbg = '" style="background-image: url(' . esc_url($orig_image['url']) . ');';
                        $slider4[$i] = '<article class="slider-item">';
                            $slider4[$i] .= '<div class="slider-item-inner">';
                                if(!empty($sliderbg)){
                                    $slider4[$i] .= '<div class="slider-img' . ($sliderbg) . '"></div>';
                                }
                                if( $feature == 'slider1' ){
                                    $slider4[$i] .= '<div class="container">';
                                }
                                $slider4[$i] .= '<div class="slider-content">';
                                    $slider4[$i] .= '<div class="entry-cats">' . ever_cats() . '</div>';
                                    $slider4[$i] .= '<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '"><span>' . get_the_title() . '</span></a></h2>';
                                    $slider4[$i] .= '<div class="tw-meta">';
                                        $slider4[$i] .= '<span class="entry-author">'.esc_html__('by', 'ever').'&nbsp;<a href="' . esc_url(get_permalink()) . '">' . get_the_author() . '</a></span>';
                                        $slider4[$i] .= '<span class="entry-date"><a href="' . esc_url(get_permalink()) . '">' . get_the_time(get_option('date_format')) . '</a></span>';
                                        $slider4[$i] .= ever_comment_count();
                                    $slider4[$i] .= '</div>';
                                $slider4[$i] .= '</div>';
                                if( $feature == 'slider1' ){
                                    $slider4[$i] .= '</div>';
                                }
                            $slider4[$i] .= '</div>';
                        $slider4[$i] .= '</article>';
                        
                        echo $slider4[$i];
                        
                        $i++;
                        endwhile;
                        if( $feature != 'slider4' ){ 
                            echo '</div>';
                        } else {
                            ob_end_clean();
                            echo '<div class="row">';
                            if(!empty($slider4[0])){
                                echo '<div class="col-md-8">';
                                echo $slider4[0];
                                echo '</div>';
                            }
                            if(!empty($slider4[1])){
                                echo '<div class="col-md-4">';
                                echo $slider4[1] . (!empty($slider4[2]) ? $slider4[2] : '');
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                        endif; wp_reset_postdata();
                echo '</div>';  
                if( $feature != 'slider1' ){
                    echo '</div>';
                }
            echo '</div>';  
        }
    }
} elseif(is_category()){
    $title = single_cat_title("", false);
    $subtitle = esc_html__('Browsing Category', 'ever');
    $desc = category_description();
} elseif(is_tag()){
    $title = single_tag_title("", false);
    $subtitle = esc_html__('Browsing Tag', 'ever');
    $desc = tag_description();
} elseif(is_search()){ 
    $title = get_search_query();
    $subtitle = esc_html__('Search results for', 'ever');
} elseif (is_archive()) {
    if (is_day()) {
        $subtitle = esc_html__("Daily Archives", 'ever');
        $title = get_the_date();
    } elseif (is_month()) {
        $subtitle = esc_html__("Monthly Archives", 'ever');
        $title = get_the_date("F Y");
    } elseif (is_year()) {
        $subtitle = esc_html__("Yearly Archives", 'ever');
        $title = get_the_date("Y");
    } elseif(is_author()){
        $subtitle = '';
        $title = esc_html__("Author", 'ever');
    } else {
        $title = esc_html__("Blog Archives", 'ever');
        $subtitle = '';
    }
}

if(!empty($title)){ ?>
    <div class="feature-area">
        <div class="container">
            <div class="feature-title">
                <div class="entry-cats"><?php echo esc_html($subtitle);?></div>
                <h1><?php echo esc_html($title); ?></h1>
                <?php 
                if(!empty($desc)){
                    echo balanceTags($desc);
                } ?>
            </div>
        </div>
    </div>
<?php }