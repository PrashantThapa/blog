<?php

function ever_option_styles(){
    //Body
    $body_default = array(
        'font-size'   => '16px',
        'font-family' => 'Roboto',
        'font-weight' => '400',
        'font-backup' => 'Arial, Helvetica, sans-serif',
    );
    $body_bg = ever_option('body_bg', array('background-color' => '#e6e6e6'));
    $boxed_bg = ever_option('boxed_bg', array('background-color' => '#f8f8f8'));
    $body_typography = ever_option('body_font', $body_default);
    $body_typography['font-backup'] = !empty($body_typography['font-backup']) ? $body_typography['font-backup'] : 'Arial, Helvetica, sans-serif';

    //Heading
    $heading_default = array('font-family' => 'Montserrat', 'font-weight' => '700');
    $heading_typography = ever_option('heading_font', $heading_default);    
    
    //Meta
    $meta_default = array('font-family' => 'Roboto', 'font-weight' => '400', 'font-size' => '11px', 'text-transform' => 'none');
    $meta_typography = ever_option('meta_font', $meta_default);    
    
    //Menu
    $menu_default = array('font-family' => 'Montserrat', 'font-weight' => '700', 'font-size' => '13px', 'text-transform' => 'uppercase');
    $menu_typography = ever_option('menu_font', $menu_default);    
    $submenu_default = array('font-family' => 'Montserrat', 'font-weight' => '400', 'font-size' => '11px', 'text-transform' => 'uppercase');
    $submenu_typography = ever_option('submenu_font', $submenu_default);    
    
    
    $primary_color = ever_option('primary_color', '#e22524');
    $body_color = ever_option('body_color', '#333');
    $heading_color = ever_option('heading_color', '#151515');
    $link_color = ever_option('link_color', array('regular' => '#808080', 'hover' => '#999'));
    $meta_color = ever_option('post_metacolor', '#999');
    $header_bg = ever_option('header_bgcolor', '#fff');
    $header_color = ever_option('menu_color', '#151515');
    $menu_hover = ever_option('menu_hover', '#262626');
    $submenu_bg = ever_option('submenu_bg', '#151515');
    $submenu_color = ever_option('submenu_color', '#fff');
    $submenu_hover = ever_option('submenu_hover_color', '#fff');
    $submenu_hoverbg = ever_option('submenu_hover_bg', '#262626');
    $post_bg_color = ever_option('post_bg_color', '#fff');
    $post_link = ever_option('post_link', array('regular' => '#151515', 'hover' => '#999'));
    $border_color = ever_option('border_color', '#e6e6e6');
    $input_bg = ever_option('input_bg', '#fafafa');
    $footer_color = ever_option('footer_text_color', '#999');
    $footer_link = ever_option('footer_link_color', array('regular' => '#999', 'hover' => '#151515'));
    
    $header_height = ever_option('header_height', '70');
    $logo_width = ever_option('logo_width', '200');
    $slider_height = ever_option('slider_height', '500');
    
    $h1_font_size = ever_option('h1_font', '36px');
    $h2_font_size = ever_option('h2_font', '30px');
    $h3_font_size = ever_option('h3_font', '24px');
    $h4_font_size = ever_option('h4_font', '20px');
    $h5_font_size = ever_option('h5_font', '16px');
    $h6_font_size = ever_option('h6_font', '14px');
    
    $output = '';
    $output .= 'body{';
        $output .= !empty($body_color) ? ('color: '.esc_attr($body_color).';') : '';
        $output .= !empty($body_typography['font-family']) ? ('font-family: "'.esc_attr($body_typography['font-family']).'", '.esc_attr($body_typography['font-backup']).';') : '';
        $output .= !empty($body_typography['font-size']) ? ('font-size: '.esc_attr($body_typography['font-size']).';') : '';
        $output .= !empty($body_typography['font-weight']) ? ('font-weight: '.esc_attr($body_typography['font-weight']).';') : '';
        $output .= !empty($body_bg['background-color']) ? ('background-color:'.esc_attr($body_bg['background-color']).';') : '';
    $output .= '}';
    if(ever_option('theme_layout') == 'boxed'){
        $output .= 'body.theme-boxed{';
        $output .= !empty($boxed_bg['background-color']) ? ('background-color: '.esc_attr($boxed_bg['background-color']).';') : '';
        $output .= !empty($boxed_bg['background-image']) ? ('background-image: url('.esc_attr($boxed_bg['background-image']).');') : '';
        $output .= !empty($boxed_bg['background-repeat']) ? ('background-repeat:'.esc_attr($boxed_bg['background-repeat']).';') : '';
        $output .= !empty($boxed_bg['background-size']) ? ('background-size:'.esc_attr($boxed_bg['background-size']).';') : '';
        $output .= !empty($boxed_bg['background-attachment']) ? ('background-attachment:'.esc_attr($boxed_bg['background-attachment']).';') : '';
        $output .= !empty($boxed_bg['background-position']) ? ('background-position:'.esc_attr($boxed_bg['background-position']).';') : '';            
        $output .= '}';
    }
        $output .= 'h1, h2, h3, h4, h5, h6, blockquote, .tw-pagination, aside.widget ul, body .btn, .tw-footer, .error-desc{';
            $output .= !empty($heading_typography['font-family']) ? ('font-family: "'.esc_attr($heading_typography['font-family']).'";') : '';
        $output .= '}';
        $output .= 'h1, h2, h3, h4, h5, h6, blockquote, .tw-pagination, aside.widget ul, body .btn{';
            $output .= !empty($heading_typography['font-weight']) ? ('font-weight: '.esc_attr($heading_typography['font-weight']).';') : '';
        $output .= '}';
        
        $output .= '.sf-menu > li > a{';
            $output .= !empty($menu_typography['font-family']) ? ('font-family: "'.esc_attr($menu_typography['font-family']).'";') : '';
            $output .= !empty($menu_typography['font-size']) ? ('font-size: '.esc_attr($menu_typography['font-size']).';') : '';
            $output .= !empty($menu_typography['font-weight']) ? ('font-weight: '.esc_attr($menu_typography['font-weight']).';') : '';
            $output .= !empty($menu_typography['text-transform']) ? ('text-transform: '.esc_attr($menu_typography['text-transform']).';') : '';
        $output .= '}';
        
        $output .= '.sf-menu ul{';
            $output .= !empty($submenu_typography['font-family']) ? ('font-family: "'.esc_attr($submenu_typography['font-family']).'";') : '';
            $output .= !empty($submenu_typography['font-size']) ? ('font-size: '.esc_attr($submenu_typography['font-size']).';') : '';
            $output .= !empty($submenu_typography['font-weight']) ? ('font-weight: '.esc_attr($submenu_typography['font-weight']).';') : '';
            $output .= !empty($submenu_typography['text-transform']) ? ('text-transform: '.esc_attr($submenu_typography['text-transform']).';') : '';
        $output .= '}';
        
        $output .= '.tw-meta{';
            $output .= !empty($meta_typography['font-family']) ? ('font-family: "'.esc_attr($meta_typography['font-family']).'";') : '';
            $output .= !empty($meta_typography['font-size']) ? ('font-size: '.esc_attr($meta_typography['font-size']).';') : '';
            $output .= !empty($meta_typography['font-weight']) ? ('font-weight: '.esc_attr($meta_typography['font-weight']).';') : '';
            $output .= !empty($meta_typography['text-transform']) ? ('text-transform: '.esc_attr($meta_typography['text-transform']).';') : '';
        $output .= '}';
        
        
        $output .= '::selection{
            background-color: '. esc_attr($primary_color).';
        }';
        $output .= '::moz-selection{
            background-color: '. esc_attr($primary_color).';
        }';
        $output .= 'button:hover,
            input[type="button"]:hover,
            .flip-box .side-b.button-search,
            .comment-form .flip-box input[type="submit"].side-b,
            .mc4wp-form-fields .flip-box input[type="submit"].side-b,
            .wpcf7-form input[type="submit"].side-b,
            .flip-box .side-b{
            background-color: '. esc_attr($primary_color).';
            border-color: '.esc_attr($primary_color).';
        }';
        
        $output .= '.tw-contact i,
        .entry-title a:hover,
        .tw-blog article.sticky .entry-post:before{
            color: '. esc_attr($primary_color) .';
        }';
        
        $output .= '#scroll-bar,
        .owl-theme .owl-controls .owl-dot.active span,
        .owl-theme .owl-controls.clickable .owl-dot:hover span,
        .owl-carousel-meta .owl-prev:hover,
        .owl-carousel-meta .owl-next:hover,
        .tw-mobile-menu .owl-carousel .owl-dot.active span,
        .tw-mobile-menu .owl-carousel .owl-dot:hover span{
            background-color: '. esc_attr($primary_color).';
        }';
        
        $output .= '.entry-cats a, h3.widget-title >span,
        .tw-blog article.sticky .entry-post{
            border-color: '. esc_attr($primary_color).';
        }';
        
        $output .= 'a{';
            $output .= !empty($link_color['regular']) ? ('color: '.esc_attr($link_color['regular']).';') : '';
        $output .= '}';
        $output .= 'a:hover{';
            $output .= !empty($link_color['hover']) ? ('color: '.esc_attr($link_color['hover']).';') : '';
        $output .= '}';
        
        $output .= 'h1, h2, h3, h4, h5, h6, .tw-meta .entry-author a, aside.widget ul li a, .tw-pagination a:hover{
            color: '. esc_attr($heading_color).';
        }';
        $output .= '.tw-meta, .entry-cats, .wp-caption p.wp-caption-text, .tw-pagination a, .feature-area .feature-title > p{
            color: '. esc_attr($meta_color).';
        }';
        
        $output .= 'h1{';
            $output .= !empty($h1_font_size['font-size']) ? ('font-size: '.esc_attr($h1_font_size['font-size']).';') : '';
        $output .= '}';
        $output .= 'h2{';
            $output .= !empty($h2_font_size['font-size']) ? ('font-size: '.esc_attr($h2_font_size['font-size']).';') : '';
        $output .= '}';
        $output .= 'h3{';
            $output .= !empty($h3_font_size['font-size']) ? ('font-size: '.esc_attr($h3_font_size['font-size']).';') : '';
        $output .= '}';
        $output .= 'h4{';
            $output .= !empty($h4_font_size['font-size']) ? ('font-size: '.esc_attr($h4_font_size['font-size']).';') : '';
        $output .= '}';
        $output .= 'h5{';
            $output .= !empty($h5_font_size['font-size']) ? ('font-size: '.esc_attr($h5_font_size['font-size']).';') : '';
        $output .= '}';
        $output .= 'h6{';
            $output .= !empty($h6_font_size['font-size']) ? ('font-size: '.esc_attr($h6_font_size['font-size']).';') : '';
        $output .= '}';
        
        $output .= !empty($header_bg) ? ('.header-small .tw-menu-container, .tw-menu-container, .header-area.layout-2 .tw-logo{background-color:'.esc_attr($header_bg).';}') : '';
        $output .= !empty($header_color) ? ('h1.site-name, .tw-header-meta i, .tw-menu .sf-menu{color:'.esc_attr($header_color).';} .nav-icon span{background-color:'.esc_attr($header_color).'}') : '';
        $menu_hover_selectors = '.tw-header-meta i:hover, .sf-menu > li:hover > a';
        $output .= !empty($menu_hover) ? ($menu_hover_selectors.'{color:'.esc_attr($menu_hover).';} .nav-icon:hover span{background-color:'.esc_attr($menu_hover).'}') : '';
        $output .= !empty($submenu_bg) ? ('.sf-menu ul{background-color:'.esc_attr($submenu_bg).';}') : '';
        $output .= !empty($submenu_color) ? ('.sf-menu ul, .sf-menu .sub-menu .menu-item-has-children:after{color:'.esc_attr($submenu_color).';}') : '';
        $output .= !empty($submenu_hover) ? ("\n". '.tw-menu .page_item > ul.children li:hover > a, .tw-menu .sub-menu li:hover > a, .sf-menu .sub-menu .menu-item-has-children:hover:after{color:'.esc_attr($submenu_hover).';}') : '';
        $output .= !empty($submenu_hoverbg) ? ("\n". '.tw-menu .page_item > ul.children li:hover > a, .tw-menu .sub-menu li:hover > a{background-color:'.esc_attr($submenu_hoverbg).';}') : '';
        $output .= !empty($footer_color) ? ('.tw-footer, .tw-footer .footer-menu a{color:'.esc_attr($footer_color).';}') : '';
        $output .= !empty($footer_link['regular']) ? ('.tw-footer a{color:'.esc_attr($footer_link['regular']).';}') : '';
        $output .= !empty($footer_link['hover']) ? ('.tw-footer a:hover{color:'.esc_attr($footer_link['hover']).';}') : '';
        
        if(!empty($header_height)){
            $output .= '.sf-menu > li > a{line-height: '.intval($header_height).'px;}';
            $output .= '.tw-menu-container, .header-clone, .tw-mobile-menu .tw-logo{height:'.intval($header_height).'px;}';
        }
        $output .= !empty($logo_width) ? ('.tw-header-meta{width: '.intval($logo_width).'px;}') : '';
        
        if(!empty($slider_height)){
            $output .= '.tw-slider .slider-item{height: '.intval($slider_height).'px;}';
            $output .= '.tw-slider.slider4 .col-md-4 .slider-item{height: '.((intval($slider_height) / 2) - 15).'px;}';
            $output .= '@media (max-width: 1199px){ .tw-slider .slider-item{height: '.(940*intval($slider_height) / 1170).'px;}';
            $output .= '.tw-slider.tw-slider.slider4 .col-md-4 .slider-item{height: '.(((940*intval($slider_height) / 1170) / 2) - 10).'px;}}';
        }
        
        if(!empty($border_color)){
            $rgba_border = ever_hex2rgb($border_color);
            $output .= 'table, td, th, .wp-caption p.wp-caption-text, .content-row, .comment-text, .widget ul li, .tw-footer{border-color:'.esc_attr($border_color).';}';
            $output .= '.header-area.layout-2 .tw-logo{border-color: rgba('.esc_attr($rgba_border).',0.5);}';
            $output .= 'input, input[type="tel"], input[type="date"], input[type="text"], input[type="password"], input[type="email"], textarea, select{border-color: rgba('.esc_attr($rgba_border).',0.6);}';
        }
        if(!empty($input_bg)){
            $output .= 'input, input[type="tel"], input[type="date"], input[type="text"], input[type="password"], input[type="email"], textarea, select,';
            $output .= '.tagcloud > a, .entry-tags a, .tw-author-box, .nextprev-postlink-container, .search-opened .tw-header-meta form.searchform input{background-color:'.esc_attr($input_bg).';}';
        }
        if(!empty($post_bg_color)){
            $output .= '.tw-blog article, .tw-blog.metro-blog article .entry-post, .tw-blog.grid-blog article .entry-post, .tw-blog.side-blog article .entry-post,';
            $output .= '.single-content, .sidebar-area .widget-item, .tw-pagination{background-color:'.esc_attr($post_bg_color).';}';
        }
        $output .= !empty($post_link['regular']) ? ('.page-content > p a, .entry-content > p:not(.more-link) a{color:'.esc_attr($post_link['regular']).';}') : '';
        $output .= !empty($post_link['hover']) ? ('.page-content > p a:hover, .entry-content > p:not(.more-link) a:hover{color:'.esc_attr($post_link['hover']).';}') : '';
        
        $output .= ever_option('custom_css');
        
        return $output;
}