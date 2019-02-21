<?php

/**
 * Initialize the custom Meta Boxes. 
 */
add_action('admin_init', 'ever_post_options');

function ever_post_options() {

    $post_options = array(     
        Array(
            'name' => esc_html__('Choose Post Single Layout', 'ever'),
            'id' => 'single_layout',
            'std' => '',
            'desc' => esc_html__('Default will follow the Theme Option setting.', 'ever'),
            'type' => 'layout',
            'options' => array(
                '' => array(
                    'title' => esc_html__('Default', 'ever'),
                    'img' => EVER_DIR . 'assets/img/default_option.png'
                ),
                'right-sidebar' => array(
                    'title' => esc_html__('Right Sidebar', 'ever'),
                    'img' => EVER_DIR . 'assets/img/single_rightsidebar.png'
                ),
                'left-sidebar' => array(
                    'title' => esc_html__('Left Sidebar', 'ever'),
                    'img' => EVER_DIR . 'assets/img/single_leftsidebar.png'
                ),
                'narrow-content' => array(
                    'title' => esc_html__('Narrow Content', 'ever'),
                    'img' => EVER_DIR . 'assets/img/single_narrow.png'
                ),
                'fullwidth-content' => array(
                    'title' => esc_html__('Fullwidth Content', 'ever'),
                    'img' => EVER_DIR . 'assets/img/single_fullwidth.png'
                ),
            ),
        ),      
        Array(
            'name' => esc_html__('Choose Featured Media Layout', 'ever'),
            'id' => 'single_media',
            'std' => '',
            'desc' => esc_html__('Default will follow the Theme Option setting.', 'ever'),
            'type' => 'layout',
            'options' => array(
                '' => array(
                    'title' => esc_html__('Default', 'ever'),
                    'img' => EVER_DIR . 'assets/img/default_option.png'
                ),
                'small' => array(
                    'title' => esc_html__('Featured area small', 'ever'),
                    'img' => EVER_DIR . 'assets/img/media_small.png'
                ),
                'large' => array(
                    'title' => esc_html__('Featured area large', 'ever'),
                    'img' => EVER_DIR . 'assets/img/media_large.png'
                ),
                'large2' => array(
                    'title' => esc_html__('Featured area large 2', 'ever'),
                    'img' => EVER_DIR . 'assets/img/media_large2.png'
                ),
                'fullwidth' => array(
                    'title' => esc_html__('Featured area full', 'ever'),
                    'img' => EVER_DIR . 'assets/img/media_fullwidth.png'
                ),
                'none' => array(
                    'title' => esc_html__('Featured area None', 'ever'),
                    'img' => EVER_DIR . 'assets/img/slider_empty.png'
                )
            ),
        ),      
        Array(
            'name' => esc_html__('Choose Layout Metro Blog', 'ever'),
            'id' => 'single_metro',
            'std' => '',
            'desc' => esc_html__('Default will follow the Theme Option setting.', 'ever'),
            'type' => 'layout',
            'options' => array(
                '' => array(
                    'title' => esc_html__('Default layout', 'ever'),
                    'img' => EVER_DIR . 'assets/img/blog_grid.png'
                ),
                'square' => array(
                    'title' => esc_html__('Featured layout', 'ever'),
                    'img' => EVER_DIR . 'assets/img/blog_featured.png'
                ),
                'side' => array(
                    'title' => esc_html__('Left Image', 'ever'),
                    'img' => EVER_DIR . 'assets/img/blog_box.png'
                ),
                'side2' => array(
                    'title' => esc_html__('Right Image', 'ever'),
                    'img' => EVER_DIR . 'assets/img/blog_box2.png'
                )
            ),
        ),      
    );
    
    
    add_meta_box('post_meta_settings', esc_html__('Post settings', 'ever'), 'ever_postmetabox', 'post', 'normal', 'core', $post_options);

}
