<?php
if ( class_exists( 'ReduxFramework' ) ) {
    // Remove dashboard widget
    function ever_redux_remove_dashboard_widget() {
            remove_meta_box( 'redux_dashboard_widget', 'dashboard', 'side' );
    }
    add_action( 'wp_dashboard_setup', 'ever_redux_remove_dashboard_widget', 100 );
    // Config
    require_once ( EVER_PATH . 'framework/waves_options/theme-options.php' );
} else {
    function ever_default_fonts(){
        $font_url = add_query_arg('family', urlencode('Roboto:400,600,700|Montserrat:400,700'), "//fonts.googleapis.com/css");
        wp_enqueue_style('ever-google-font', $font_url, array(), '1.0.0');
    }
    add_action( 'wp_enqueue_scripts', 'ever_default_fonts', 20);    
}

if(is_admin()){
    require_once ( EVER_PATH . 'framework/waves_options/post-metabox.php');
    require_once ( EVER_PATH . 'framework/waves_options/metabox-render.php');
    
    require_once ( EVER_PATH . 'framework/waves_options/post-options.php' );
    require_once ( EVER_PATH . 'framework/waves_options/post-format.php' );
    require_once ( EVER_PATH . 'framework/waves_options/page-options.php' );
    require_once ( EVER_PATH . 'framework/waves_options/user-options.php' );
    require_once ( EVER_PATH . 'framework/waves_options/category-options.php' );
}