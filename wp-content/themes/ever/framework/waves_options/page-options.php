<?php

/**
 * Initialize the custom Meta Boxes. 
 */
add_action('admin_init', 'ever_page_options');

function ever_page_options() {
    
    $categories = get_categories("hide_empty=0&parent=0");
    $cats = array("0" => esc_html__("All Category", 'ever'));
    if (!empty($categories)) {
        foreach ($categories as $category) {
            $cats[$category->slug] = $category->name;
        }
    }
    
    $blog_layouts = array(
        'simple' => array('text'=>esc_html__('Simple', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_simple.png')),
        'grid' => array('text'=>esc_html__('Grid', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_grid.png')),
        'masonry' => array('text'=>esc_html__('Masonry', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_masonry.png')),
        'list' => array('text'=>esc_html__('List', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_list.png')),
        'list2' => array('text'=>esc_html__('List right thumb', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_list2.png')),
        'square' => array('text'=>esc_html__('Featured', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_featured.png')),
        'side' => array('text'=>esc_html__('Left thumb', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_box.png')),
        'side2' => array('text'=>esc_html__('Right thumb', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_box2.png')),
        'metro' => array('text'=>esc_html__('Metro', 'ever'),'src'=>esc_url(EVER_DIR . 'assets/img/blog_metro.png')),
    );

    $page_options = array(
        Array(
            'name' => esc_html__('Select slider layout?', 'ever'),
            'id' => 'slider',
            'std' => '',
            'type' => 'layout',
            'options'=>array(
                '' => array(
                    'title' => esc_html__('Slider None', 'ever'),
                    'img' => EVER_DIR . 'assets/img/slider_empty.png'
                ),
                'slider1' => array(
                    'title' => esc_html__('Slider 1', 'ever'),
                    'img' => EVER_DIR . 'assets/img/slider_1.png'
                ),
                'slider2' => array(
                    'title' => esc_html__('Slider 2', 'ever'),
                    'img' => EVER_DIR . 'assets/img/slider_2.png'
                ),
                'slider3' => array(
                    'title' => esc_html__('Slider 3', 'ever'),
                    'img' => EVER_DIR . 'assets/img/slider_3.png'
                ),
                'slider4' => array(
                    'title' => esc_html__('Slider 4', 'ever'),
                    'img' => EVER_DIR . 'assets/img/slider_4.png'
                ),
                'custom' => array(
                    'title' => esc_html__('Custom shortcode', 'ever'),
                    'img' => EVER_DIR . 'assets/img/custom_option.png'
                )
            ),
        ),
        Array(
            'name' => esc_html__('Select category?', 'ever'),
            'id' => 'slider_cat',
            'std' => '',
            'type' => 'select',
            'options'=> $cats,
            'dependency' => array(
                'element' => 'slider',
                'value' => array('slider1', 'slider2', 'slider3', 'slider4', 'slider5'),
            ),
        ),
        Array(
            'name' => esc_html__('Slider Post Count?', 'ever'),
            'id' => 'slider_post_count',
            'std' => '',
            'placeholder' => esc_html__('Insert only Digits here', 'ever'),
            'type' => 'text',
            'dependency' => array(
                'element' => 'slider',
                'value' => array('slider1', 'slider2', 'slider3', 'slider4', 'slider5'),
            ),
        ),
        Array(
            'name' => esc_html__('Custom shortcode?', 'ever'),
            'id' => 'slider_shortcode',
            'std' => '',
            'placeholder' => esc_html__('Example: [revslider id="3"]', 'ever'),
            'type' => 'text',
            'dependency' => array(
                'element' => 'slider',
                'value' => array('custom'),
            ),
        ),
        Array(
            'name' => esc_html__('Blog Layout', 'ever'),
            'id' => 'blog_layout',
            'std' => '',
            'desc' => esc_html__('Choose Row and Add Row and assign Row Layout, You can also Delete! Note: If you selected All Categories then only 1 Row will enough and delete the other styles.', 'ever'),
            'type' => 'blog',
            'options'=>array(
                'layout' => $blog_layouts,
                'cats' => $cats,
                'posts_per_page' => '',
                'excerpt' => '',
                'sidebar' => array('false' => 'False', 'true' => 'True'),
                'pagination' => array('none' => 'None', 'simple' => 'Simple', 'number' => 'Numbered', 'infinite' => 'Infinite'),
            )
        ),
    );
    
    
    add_meta_box('page_meta_settings', esc_html__('Page settings', 'ever'), 'ever_postmetabox', 'page', 'normal', 'core', $page_options);

}
