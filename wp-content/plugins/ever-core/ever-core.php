<?php
/**
 * Plugin Name: Ever Core
 * Plugin URI:  http://www.themewaves.com/
 * Description: Themewaves Core Plugin
 * Version:     1.0.2
 * Author:      Themewaves
 * Author URI:  http://www.themewaves.com/
 * Text Domain: waves
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 * 
 *  
 * @package   ever-core
 * @author    Themewaves
 * @license   GPL-2.0+
 * @link      themewaves.com
 * @copyright 2016 Themewaves
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define('EVER_CORE_DIR', trailingslashit(plugin_dir_url( __FILE__ )));
add_action('admin_init', 'ever_elements_include');
function ever_elements_include(){
    require_once 'waves-shortcode.php';
}

add_action('init', 'ever_core_init');
function ever_core_init(){
    add_shortcode( 'tw_posts','ever_post_carousel' );
    add_shortcode( 'tw_author_list', 'ever_authors' );
    add_shortcode( 'tw_dropcap', 'ever_dropcap' );
}
function ever_post_carousel($atts){
    $atts = shortcode_atts( array(
        'layout' => '',
        'title' => '',
        'cats' => '',
        'posts_per_page' => '6',
    ), $atts, 'tw_carousel' );
    $class = !empty($atts['layout']) ? (' layout-'.$atts['layout']) : '';
    
    global $post, $ever_options;

    $query = Array(
        'post_type' => 'post',
        'posts_per_page' => $atts['posts_per_page'],
        'ignore_sticky_posts' => 1,
    );
    $cats = $atts['cats'];
    if (!empty($cats)) {
        $query['tax_query'] = Array(Array(
                'taxonomy' => 'category',
                'terms' => explode(',',$cats),
                'field' => 'slug'
            )
        );
    }
    
    if(!empty($ever_options['post__not_in'])){
        $query['post__not_in'] = $ever_options['post__not_in'];
    }
    
    wp_enqueue_script('owl-carousel');
    
    $output = '<div class="tw-post-carousel">';
    $output .= !empty($atts['title']) ? ('<h3 class="tw-element-title">'.esc_html($atts['title']).'</h3>') : '';
    $output .= '<div class="owl-carousel'.esc_attr($class).'">';

            query_posts($query);
                if($atts['layout'] == '2'){
                    while (have_posts()){the_post();
                        $ever_options['post__not_in'][]=$post->ID;   
                        $img='';
                        if (has_post_thumbnail($post->ID)) {
                            $img = ever_image('ever_carousel_2');
                        }
                        $output .= '<div class="tw-owl-item">';
                            $output .= '<div class="post-thumb tw-thumbnail"><a href="'.esc_url(get_permalink()).'">'.($img);
                            $cats = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "<span class='cat-item'>$2</span>", ever_cats());
                            $output .= '<div class="carousel-content"><div class="entry-cats">'.($cats).'</div>';
                            $output .= '<h3 class="carousel-title">' . get_the_title() . '</h3>';
                            $output .= '<div class="tw-meta"><span class="date">'.get_the_time(get_option('date_format')).'</span></div>';
                            $output .= '</div></a></div>';
                        $output .= "</div>";
                    }
                }else{
                    while (have_posts()){the_post();
                        $ever_options['post__not_in'][]=$post->ID;   
                        $img='';
                        if (has_post_thumbnail($post->ID)) {
                            $img = '<a href="'.get_permalink().'">'.ever_image('ever_carousel_1').'</a>';
                        }
                        $output .= '<div class="tw-owl-item">';
                            $output .= '<div class="post-thumb tw-thumbnail">'.($img).'</div>';
                            $output .= '<div class="carousel-content">';
                                    $output .= '<h3 class="carousel-title"><a href="'.esc_url(get_permalink()).'">' . get_the_title() . '</a></h3>';
                                    $output .= '<div class="tw-meta"><span class="date">'.get_the_time(get_option('date_format')).'</span></div>';
                            $output .= '</div>';
                        $output .= "</div>";
                    }
                }
            wp_reset_query();
            
    $output .= '</div>';
    $output .= '</div>';
    return $output;    
}

function ever_dropcap( $atts , $content ){
    $output = '';
    if(!empty($content)){
        $output = '<span class="tw-dropcap">'.$content.'</span>';
    }
    return $output;
}

function ever_authors( $atts ){
    $atts = shortcode_atts( array(
        'names' => ''
    ), $atts, 'tw_button' );
    
    $output = '';
    if(!empty($atts['names'])){
        $names = explode(",", $atts['names']);
        foreach($names as $name){
            $user_data = get_user_by('slug', $name);
            if(!empty($user_data)){
                $output .= '<div class="tw-author-box">';
                    $output .= '<div class="author-box">';
                $output .= get_avatar($user_data->ID, $size = '100');
                $output .= '<h3>'.$user_data->display_name.'</h3>';
                $output .= '<p>'.$user_data->description.'</p>';
                $socials = get_the_author_meta('user_social', $user_data->ID);
                if(!empty($socials)){
                    $output .= '<div class="author-entry-share">';
                    $social_links=explode("\n",$socials);
                    foreach($social_links as $social_link){
                        $icon = ever_social_icon(esc_url($social_link));
                        $output .= '<a href="'.esc_url($social_link).'"><i class="'.esc_attr($icon).'"></i></a>';
                    }
                    $output .= '</div>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
        }
    }
    
    return $output;
}