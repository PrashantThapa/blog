<?php 
/**
 * Template Name: 4: Row Builder
 */

global $ever_options;
$page_options = ever_metaboxes();
if(!empty($page_options['slider'])){
    $ever_options['slider'] = $page_options['slider'];
    $ever_options['slider_shortcode'] = $page_options['slider_shortcode'];
}

get_header(); ?>
<?php the_post(); 

$blog_ads = ever_option('ads-blog');
if(!empty($blog_ads)){
    echo '<div class="tw-ads ads-blog-top">';
    echo do_shortcode($blog_ads);
    echo '</div>';
} ?>
<div class="row">
    
    <div class="content-area col-md-12">
            <?php 
                $default_layout = array(
                        'sidebar' => array('true'),
                        'layout' => array('list'),
                        'row_type' => array(''),
                        'excerpt' => array(''),
                        'pagination' => array('simple'),
                        'posts_per_page' => array(intval(get_option( 'posts_per_page' ))),                    
                        'cat' => array(''),   
                );
            
                $layouts = isset($page_options['blog_layout']) ? $page_options['blog_layout'] : $default_layout;
                
                $iO=$od=false;
                $cd=true;
                foreach ($layouts['sidebar'] as $i=>$sb){
                    $layouts['sidebar-o-c'][$i]['open-sb']=false;
                    $layouts['sidebar-o-c'][$i]['close-sb']=false;
                    if($sb==='true'){
                        if($iO===false){
                           $layouts['sidebar-o-c'][$i]['open-sb']=true;
                           $od=true;
                           $cd=false;
                        }
                        $iO=$i;
                    }else{
                        if($iO!==false){
                           $layouts['sidebar-o-c'][$i-1]['close-sb']=true;
                           $iO=false;
                           $od=false;
                           $cd=true;
                        }
                    }
                }
                if($od&&!$cd&&isset($i)){
                    $layouts['sidebar-o-c'][$i]['close-sb']=true;
                }                
                
                for($i=0;$i<count($layouts['row_type']);$i++){
                    if($layouts['sidebar-o-c'][$i]['open-sb'] && !in_array($layouts['layout'][$i], array('masonry', 'masonry-full'))){
                        echo '<div class="row">';
                            echo '<div class="col-md-8">';
                    }
                    echo '<div class="blog-section">';
                        if($layouts['row_type'][$i] == 'content'){
                            $style = $width = '';
                            if(!empty($layouts['row_height'][$i])){
                                $style .= 'min-height: '.esc_attr($layouts['row_height'][$i]).';'; 
                            }
                            if(!empty($layouts['row_width'][$i])){
                                $width .= 'width: '.esc_attr($layouts['row_width'][$i]).';'; 
                            }
                            if(!empty($layouts['row_bgcolor'][$i])){
                                $style .= 'background-color: '.esc_attr($layouts['row_bgcolor'][$i]).';'; 
                            }
                            if(!empty($layouts['row_bgimage'][$i])){
                                $style .= 'background-image: url('.esc_attr($layouts['row_bgimage'][$i]).');'; 
                            }
                            echo '<div class="content-row" style="'.esc_attr($style).'">';
                                echo '<div class="content-inner" style="'.esc_attr($width).'">';
                                    echo apply_filters('the_content',$layouts['row_content'][$i]);
                                echo '</div>';
                            echo '</div>';
                        } else {
                            $ever_options['blog_layout'] = $layouts['layout'][$i];
                            $ever_options['blog_sidebar'] = $layouts['sidebar'][$i];
                            $ever_options['blog_excerpt'] = $layouts['excerpt'][$i];
                            $ever_options['pagination'] = $layouts['pagination'][$i];
                            if(!empty($ever_options['post__not_in'])){
                                $args['post__not_in'] = $ever_options['post__not_in'];
                            }
                            $args['post_type'] = 'post';
                            if(!empty($layouts['cat'][$i])){
                                $args['category_name'] = implode(",", $layouts['cat'][$i]);
                            }
                            $args['posts_per_page'] = $layouts['posts_per_page'][$i];

                            global $paged, $page, $ever_options;
                            if (is_front_page() && $page) {
                                $paged = $page;
                            }
                            $args['paged'] = $paged;



                            query_posts($args);

                            if(in_array($ever_options['blog_layout'], array('list', 'list2'))){
                                if($ever_options['blog_sidebar'] == 'true'){
                                    get_template_part("content", "list");
                                } else {
                                    get_template_part("content", "llist");
                                }
                            } elseif($ever_options['blog_layout'] == 'grid'){
                                get_template_part("content", "grid");
                            } elseif($ever_options['blog_layout'] == 'masonry'){
                                get_template_part("content", "masonry");
                            } elseif($ever_options['blog_layout'] == 'square'){
                                get_template_part("content", "square");
                            } elseif(in_array($ever_options['blog_layout'], array('side', 'side2'))){
                                get_template_part("content", "side");
                            } elseif($ever_options['blog_layout'] == 'metro'){
                                get_template_part("content", "metro");
                            } else{
                                get_template_part("content");
                            }   

                            wp_reset_query();

                        }
                    echo '</div>';
                    if($layouts['sidebar-o-c'][$i]['close-sb']){
                           echo '</div>';
                           get_sidebar();
                        echo '</div>';
                    }
                }
            ?>
            
        </div>
    </div>

<?php get_footer();