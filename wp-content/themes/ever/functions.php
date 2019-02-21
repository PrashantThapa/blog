<?php

$theme_obj = wp_get_theme();
$theme_name = $theme_obj->get('Name');
$theme_version = $theme_obj->get('Version');

define('EVER_THEMENAME', $theme_name);
define('EVER_THEMEVERSION', $theme_version);
define('EVER_META', 'themewaves_' . strtolower(str_replace(' ', '_', EVER_THEMENAME)) . '_options');
define('EVER_PATH', trailingslashit(get_template_directory()));
define('EVER_DIR', trailingslashit(get_template_directory_uri()));
define('EVER_STYLESHEET_DIR', trailingslashit(get_stylesheet_directory_uri()));

if (is_admin()) {
    require( EVER_PATH . 'framework/tgm-plugins.php');
    add_action('admin_print_scripts', 'ever_admin_scripts');
    add_action('admin_print_styles', 'ever_admin_styles');

    function ever_admin_scripts() {
        $pid = isset($post->ID) ? $post->ID : 0;
        wp_localize_script('jquery', 'ever_script_data', array(
            'home_uri' => esc_url(home_url('/')),
            'post_id' => esc_attr($pid),
            'nonce' => esc_attr(wp_create_nonce('themewaves-ajax')),
            'image_ids' => esc_attr(ever_metabox('gallery_image_ids')),
            'label_create' => esc_html__("Create Featured Gallery", 'ever'),
            'label_edit' => esc_html__("Edit Featured Gallery", 'ever'),
            'label_save' => esc_html__("Save Featured Gallery", 'ever'),
            'label_saving' => esc_html__("Saving...", 'ever'),
        ));
        wp_register_script('ever-admin-js', EVER_DIR . 'framework/js/waves-admin.js');
        wp_enqueue_script('ever-admin-js');
    }

    function ever_admin_styles() {
        wp_register_style('ever-admin-css', EVER_DIR . 'framework/css/waves-admin.css', false, '1.00', 'screen');
        wp_enqueue_style('ever-admin-css');
    }

}

require_once (EVER_PATH . "framework/waves_options/waves-options.php");
require_once (EVER_PATH . "framework/theme_functions.php");
require_once (EVER_PATH . "framework/blog_functions.php");
require_once (EVER_PATH . "framework/waves_widget/widget_socials.php");
require_once (EVER_PATH . "framework/waves_widget/widget_post.php");
require_once (EVER_PATH . "framework/waves_widget/widget_instagram.php");
require_once (EVER_PATH . "framework/theme_css.php");



/* ================================================================================== */
/*      Theme Supports
  /* ================================================================================== */

add_action('after_setup_theme', 'ever_setup');
if (!function_exists('ever_setup')) {

    function ever_setup() {
        add_editor_style();
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array('gallery', 'video', 'audio'));
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        load_theme_textdomain('ever', EVER_PATH . 'languages/');
        register_nav_menus(array('main' => esc_html__('Main Menu', 'ever'), 'footer' => esc_html__('Footer Menu', 'ever')));

        add_image_size('ever_single_post', 770);
        add_image_size('ever_blog_large', 1170, 500, true);
        add_image_size('ever_blog_thumb', 770, 360, true);
        add_image_size('ever_grid_thumb', 400, 250, true);
        add_image_size('ever_list_thumb', 470, 300, true);
        add_image_size('ever_large_list', 670, 420, true);
        add_image_size('ever_masonry_thumb', 400);
        add_image_size('ever_slider_thumb', 770, 500, true);
        add_image_size('ever_carousel_widget', 370, 410, true);
    }

}
if (!isset($content_width)) {
    $content_width = 960;
}



/* ================================================================================== */
/*      Enqueue Scripts
  /* ================================================================================== */

add_action('wp_enqueue_scripts', 'ever_scripts');

function ever_scripts() {
    wp_enqueue_style('bootstrap', EVER_DIR . 'assets/css/bootstrap.min.css');
    wp_enqueue_style('ionicons', EVER_DIR . 'assets/css/ionicons.min.css');
    wp_enqueue_style('ever-style', EVER_DIR . 'style.css');
    wp_enqueue_style('ever-responsive', EVER_DIR . 'assets/css/responsive.css');
    wp_enqueue_style('magnific-popup', EVER_DIR . 'assets/css/magnific-popup.css');
    wp_add_inline_style('ever-responsive', ever_option_styles());
    
    wp_enqueue_script('ever-functions', EVER_DIR . 'assets/js/functions.js', false, false, false);
    wp_enqueue_script('ever-scripts', EVER_DIR . 'assets/js/scripts.js', array('jquery'), false, true);
    if (is_single() && comments_open()) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script('html5', EVER_DIR . 'assets/js/html5.js', array(), '3.6.0');
    wp_script_add_data('html5', 'conditional', 'lt IE 9');
    wp_register_script('owl-carousel', EVER_DIR . 'assets/js/owl.carousel.min.js');
    wp_enqueue_script('magnific-popup', EVER_DIR . 'assets/js/jquery.magnific-popup.min.js');
    
    /* We customized it our own and need our own Prefix */
    wp_register_script('ever-isotope', EVER_DIR . 'assets/js/jquery.waves-isotope.min.js');

    if (ever_option('sidebar_affix')) {
        wp_enqueue_script('theiastickysidebar', EVER_DIR . 'assets/js/theiaStickySidebar.js', false, false, true);
    }
    wp_enqueue_script('ever-script', EVER_DIR . 'assets/js/waves-script.js');
    wp_localize_script('jquery', 'ever_script_data', array(
        'gif_auto' => is_single() ? ever_option('gif_auto_single', '0') : ever_option('gif_auto_blog', '1'),
        'slider_auto' => ever_option('slider_auto', '0')?true:false,
        'slider_delay' => ever_option('slider_delay', '3000'),
    ));
}

/* ================================================================================== */
/*      Register Widget Sidebar
  /* ================================================================================== */

if (!function_exists('ever_widgets_init')) {

    function ever_widgets_init() {
        register_sidebar(array(
            'name' => esc_html__('Default sidebar', 'ever'),
            'id' => 'default-sidebar',
            'before_widget' => '<aside class="widget %2$s" id="%1$s"><div class="widget-item">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));
        register_sidebar(array(
            'name' => esc_html__('Mobile sidebar', 'ever'),
            'id' => 'mobile-sidebar',
            'before_widget' => '<aside class="widget %2$s" id="%1$s"><div class="widget-item">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));        
    }

}
add_action('widgets_init', 'ever_widgets_init');



/* ================================================================================== */
/*      ThemeWaves Search Form Customize
  /* ================================================================================== */

function ever_searchmenu() {
    $form = '<form method="get" class="searchform on-menu" action="' . esc_url(home_url('/')) . '" >';
    $form .= '<div class="input"><input type="text" value="' . get_search_query() . '" name="s" placeholder="' . esc_html__('Search', 'ever') . '" /><i class="ion-search"></i></div>';
    $form .= '</form>';
    return $form;
}

function ever_searchform() {

    $form = '<form method="get" class="searchform" action="' . esc_url(home_url('/')) . '" >
    <div class="input">
    <input type="text" value="' . get_search_query() . '" name="s" placeholder="' . ever_option('text_search', esc_html__('Search...', 'ever')) . '" />
        <button type="submit" class="button-search"><i class="ion-search"></i></button>
    </div>
    </form>';

    return $form;
}
add_filter('get_search_form', 'ever_searchform');

/* Exclude Category */

function ever_exclude_widget_cats($args) {
    $categories = get_categories();
    $exclude = array();
    foreach ($categories as $category) {
        $options = get_option("taxonomy_" . $category->cat_ID);
        if (isset($options['featured']) && $options['featured']) {
            $exclude[] = $category->cat_ID;
        }
    }
    $args["exclude"] = $exclude;
    return $args;
}

add_filter("widget_categories_args", "ever_exclude_widget_cats");

/* WordPress Edit Gallery */
add_filter('use_default_gallery_style', '__return_false');
add_filter('wp_get_attachment_link', 'ever_pretty_gallery', 10, 5);

function ever_pretty_gallery($content, $id, $size = 'large', $permalink) {
    if (!$permalink)
        $content = preg_replace("/<a/", "<a rel=\"prettyPhoto[gallery]\"", $content, 1);
    $content = preg_replace("/<\/a/", "<div class=\"image-overlay\"></div></a", $content, 1);
    return $content;
}

function ever_body_class($classes) {
    global $ever_options;

    if (is_single()) {
        $ever_options['single_media'] = ever_metabox('single_media');
        if (empty($ever_options['single_media'])) {
            $ever_options['single_media'] = ever_option('single_media', 'small');
        }
    }
    if (ever_option('theme_layout') == 'boxed') {
        $classes[] = 'theme-boxed';
    }
    
    if( ever_option('scroll_menu') ){
        $classes[] = 'scroll-menu';
    }

    return $classes;
}
add_filter('body_class', 'ever_body_class');
