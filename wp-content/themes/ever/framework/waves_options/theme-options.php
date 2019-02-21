<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {return;}

    // This is your option name where all the Redux data is stored.
    $opt_name = "ever_redux";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'ever'),
        'page_title'           => esc_html__( 'Theme Options', 'ever'),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    $options_general=array(
        array(
            'id'       => 'theme_layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Theme layout', 'ever' ),
            'subtitle' => esc_html__( 'Your site will be Fullwidth or Boxed layout and If you want to edit background then Check the Color options.', 'ever' ),
            'options'  => array(
                'full' => 'Full width',
                'boxed' => 'Boxed',
            ),
            'default'  => 'full'
        ),
        array(
            'id'       => 'boxed_bg',
            'required' => array( 'theme_layout', '=', 'boxed' ),
            'type'     => 'background',
            'title'    => esc_html__( 'Background options', 'ever' ),
            'subtitle' => esc_html__( 'Your site will be Fullwidth or Boxed layout and If you want to edit background then Check the Color options.', 'ever' ),
            'default'  => ''
        ),
        array(
            'id'       => 'logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Upload Your Logo', 'ever'),
            'subtitle' => esc_html__( 'If no Logo Uploaded then Your Site Name will display your Logo section, Edit this option Settings -> General Tab', 'ever'),
            'compiler' => 'true',
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'favicon',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Upload Your Favicon', 'ever'),
            'subtitle' => esc_html__( 'Default Fav icon is located in our ever/assets/img/favicon.ico', 'ever'),
            'compiler' => 'true',
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'header_layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Header layout', 'ever' ),
            'subtitle' => esc_html__( 'Select header layout', 'ever' ),
            'options'  => array(
                '' => 'Default',
                '2' => 'Logo Center',
            ),
            'default'  => 'full'
        ),
        array(
            'id'       => 'logo_width',
            'type'     => 'text',
            'title'    => esc_html__( 'Logo width & Header Search width (px)?', 'ever'),
            'default'  => '200',
        ),
        array(
            'id'       => 'header_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Search on Header?', 'ever'),
            'subtitle' => esc_html__( 'Switching this will enable or disable search on the menu.', 'ever'),
            'default'  => 1,
        ),
        array(
            'id'       => 'header_height',
            'type'     => 'text',
            'title'    => esc_html__( 'Header menu height (px)?', 'ever'),
            'default'  => '70',
        ),
        array(
            'id'       => 'slider_height',
            'type'     => 'text',
            'title'    => esc_html__( 'Slider height (px)?', 'ever'),
            'subtitle' => esc_html__( 'this option will control the height', 'ever'),
            'default'  => '500',
        ),
        array(
            'id'       => 'slider_auto',
            'type'     => 'switch',
            'title'    => esc_html__( 'Slider Auto Play?', 'ever'),
            'subtitle' => esc_html__( 'Slider Auto Play?', 'ever'),
            'default'  => 0,
        ),
        array(
            'id'       => 'slider_delay',
            'type'     => 'text',
            'title'    => esc_html__( 'Slider Delay?', 'ever'),
            'subtitle' => esc_html__( 'Slider Delay?', 'ever'),
            'default'  => '3000',
            'required' => array( 'slider_auto', '=', 1 ),
        ),
        array(
            'id'       => 'scroll_menu',
            'type'     => 'switch',
            'title'    => esc_html__( 'Scroll Up Menu?', 'ever'),
            'subtitle'    => esc_html__( 'If you scroll up while scrolling down menu there has an Our menu is displayed and you can disable it', 'ever'),
            'default'  => 1,

        ),
    );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'ever'),
        'id'               => 'general',
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => $options_general
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'ever'),
        'id'         => 'blog',
        'icon'       => 'el el-pencil',
        'fields'     => array(
            array(
                'id'=>'blog-section-start',
                'type' => 'section',
                'title' => esc_html__('General Blog Pages & Categories Options', 'ever'),
                'indent' => true // Indent all options below until the next 'section' option is set.
                ),
                array(
                    'id'       => 'blog_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Set Blog Layout', 'ever'),
                    'subtitle' => esc_html__( 'You can set the Normal, Large Media or Fullwidth. You can override it on Blog Single section', 'ever'),
                    'options'  => array(
                            'simple' => array(
                                'alt' => esc_html__('Featured area small', 'ever'),
                                'title' => esc_html__('Featured area small', 'ever'),
                                'img' => EVER_DIR . 'assets/img/blog_simple.png'
                            ),
                            'grid' => array(
                                'alt' => esc_html__('Featured area fullwidth', 'ever'),
                                'title' => esc_html__('Featured area fullwidth', 'ever'),
                                'img' => EVER_DIR . 'assets/img/blog_grid.png'
                            ),
                            'masonry' => array(
                                'alt' => esc_html__('Featured area fullwidth', 'ever'),
                                'title' => esc_html__('Featured area fullwidth', 'ever'),
                                'img' => EVER_DIR . 'assets/img/blog_masonry.png'
                            ),
                            'list' => array(
                                'alt' => esc_html__('Featured area fullwidth', 'ever'),
                                'title' => esc_html__('Featured area fullwidth', 'ever'),
                                'img' => EVER_DIR . 'assets/img/blog_list.png'
                            ),
                            'list2' => array(
                                'alt' => esc_html__('Featured area fullwidth', 'ever'),
                                'title' => esc_html__('Featured area fullwidth', 'ever'),
                                'img' => EVER_DIR . 'assets/img/blog_list2.png'
                            )
                        ),
                    'default'  => 'simple',
                ),
                array(
                    'id'       => 'blog_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Blog sidebar', 'ever' ),
                    'subtitle' => esc_html__( 'Have a Sidebar ?', 'ever' ),
                    'options'  => array(
                        'true' => 'True',
                        'false' => 'False',
                    ),
                    'default'  => 'true'
                ),
                array(
                    'id'       => 'blog_excerpt',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Blog excerpt?', 'ever' ),
                    'subtitle' => esc_html__( 'Excerpt word count', 'ever' ),
                    'default'  => ''
                ),
                array(
                    'id'       => 'blog_pagination',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Blog pagination', 'ever' ),
                    'subtitle' => esc_html__( 'Pagination type ?', 'ever' ),
                    'options'  => array(
                        'simple' => 'Simple',
                        'number' => 'Numbered',
                        'infinite' => 'Infinite',
                        'none' => 'None',
                    ),
                    'default'  => 'simple'
                ),
                array(
                    'id'       => 'gif_auto_blog',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'GIF auto play on Row Builder?', 'ever'),
                    'subtitle'     => esc_html__( 'Gif can autoplay or Play Button on Homepage.', 'ever'),
                    'default'  => 1,
                ),
            array(
                'id'=>'blog-section-end',
                'type' => 'section', 
                'indent' => false // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'=>'blog-single-start',
                'type' => 'section',
                'title' => esc_html__('Blog Single Options', 'ever'),
                'indent' => true // Indent all options below until the next 'section' option is set.
                ),
                array(
                'id'       => 'single_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Set Blog Single Layout', 'ever'),
                'subtitle' => esc_html__( 'You can set the Normal, Large Media or Fullwidth. You can override it on Blog Single section', 'ever'),
                'options'  => array(
                        'right-sidebar' => array(
                            'alt' => esc_html__('Right Sidebar', 'ever'),
                            'title' => esc_html__('Right Sidebar', 'ever'),
                            'img' => EVER_DIR . 'assets/img/single_rightsidebar.png'
                        ),
                        'left-sidebar' => array(
                            'alt' => esc_html__('Left Sidebar', 'ever'),
                            'title' => esc_html__('Left Sidebar', 'ever'),
                            'img' => EVER_DIR . 'assets/img/single_leftsidebar.png'
                        ),
                        'fullwidth-content' => array(
                            'alt' => esc_html__('Fullwidth Content', 'ever'),
                            'title' => esc_html__('Fullwidth Content', 'ever'),
                            'img' => EVER_DIR . 'assets/img/single_fullwidth.png'
                        ),
                        'narrow-content' => array(
                            'alt' => esc_html__('Narrow Content', 'ever'),
                            'title' => esc_html__('Narrow Content', 'ever'),
                            'img' => EVER_DIR . 'assets/img/single_narrow.png'
                        )
                    ),
                    'default'  => 'right-sidebar',
                    ),
                    array(
                        'id'       => 'single_media',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Single media layout', 'ever' ),
                        'subtitle' => esc_html__( 'You can override it on Blog Single section', 'ever' ),
                        'options'  => array(
                            'small' => array(
                                'alt' => esc_html__('Featured area small', 'ever'),
                                'title' => esc_html__('Featured area small', 'ever'),
                                'img' => EVER_DIR . 'assets/img/media_small.png'
                            ),
                            'large' => array(
                                'alt' => esc_html__('Featured area large', 'ever'),
                                'title' => esc_html__('Featured area large', 'ever'),
                                'img' => EVER_DIR . 'assets/img/media_large.png'
                            ),
                            'large2' => array(
                                'alt' => esc_html__('Featured area large 2', 'ever'),
                                'title' => esc_html__('Featured area large 2', 'ever'),
                                'img' => EVER_DIR . 'assets/img/media_large2.png'
                            ),
                            'fullwidth' => array(
                                'alt' => esc_html__('Featured area fullwidth', 'ever'),
                                'title' => esc_html__('Featured area fullwidth', 'ever'),
                                'img' => EVER_DIR . 'assets/img/media_fullwidth.png'
                            ),
                            'none' => array(
                                'alt' => esc_html__('Featured area none', 'ever'),
                                'title' => esc_html__('Featured area None', 'ever'),
                                'img' => EVER_DIR . 'assets/img/slider_empty.png'
                            )
                        ),
                        'default'  => 'small'
                    ),
                    array(
                        'id'       => 'sidebar_affix',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Sidebar Affix', 'ever'),
                        'subtitle' => esc_html__( 'If you set this on Sidebar areas will be affixed.', 'ever'),
                        'default'  => 0,
                    ),
                    array(
                        'id'       => 'gif_auto_single',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'GIF auto play on blog single?', 'ever'),
                        'subtitle'     => esc_html__( 'In the Blog Single it can be autplay or Play button', 'ever'),
                        'default'  => 0,
                    ),
                    array(
                        'id'       => 'single_share',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post share on single?', 'ever'),
                        'subtitle'     => esc_html__( 'Social shares visible or not on Single Post area', 'ever'),
                        'default'  => 1,
                    ),
                    array(
                        'id'       => 'single_pagination',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Next, Prev post on single?', 'ever'),
                        'default'  => 1,
                    ),
                    array(
                        'id'       => 'single_cats',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post cats on single?', 'ever'),
                        'subtitle'     => esc_html__( 'Post categories', 'ever'),
                        'default'  => 1,
                    ),
                    array(
                        'id'       => 'single_meta',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post meta on single?', 'ever'),
                        'subtitle'     => esc_html__( 'Post date and author', 'ever'),
                        'default'  => 1,
                    ),
                    array(
                        'id'       => 'single_tags',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post tags on single?', 'ever'),
                        'subtitle'     => esc_html__( 'Tag on single', 'ever'),
                        'default'  => 1,
                    ),
                    array(
                        'id'       => 'single_author',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post author on single?', 'ever'),
                        'subtitle'     => esc_html__( 'About author on single', 'ever'),
                        'default'  => 1,
                    ),
                    array(
                        'id'       => 'related_posts',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Related Posts on Single ?', 'ever' ),
                        'options'  => array(
                            '' => 'None',
                            '2' => '2',
                            '4' => '4',
                            '6' => '6',
                        ),
                        'default'  => '4'
                    ),
                array(
                    'id'=>'blog-single-end',
                    'type' => 'section', 
                    'indent' => false // Indent all options below until the next 'section' option is set.
                ),
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Color', 'ever'),
        'id'         => 'color',
        'icon'       => 'el el-eye-open',
        'fields'     => array(
            array(
                'id'       => 'primary_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Primary Color?', 'ever'),
                'subtitle' => esc_html__('This is your main Primary Color.','ever'),   
                'default'  => '#e22524',
            ),
            array(
                'id'=>'body-section-start',
                'type' => 'section',
                'title' => esc_html__('General Color', 'ever'),
                'indent' => true // Indent all options below until the next 'section' option is set.
                ),
            array(
                'id'       => 'body_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Color?', 'ever'),
                'default'  => '#333333',
            ),
            array(         
                'id'       => 'body_bg',
                'type'     => 'background',
                'title'    => esc_html__('Body Background', 'ever'),
                'subtitle' => esc_html__('This will works whole background area. If you chosen the Boxed Layout then it will work outside of Container area. It will not work if you have chosen Full Layout', 'ever'),
                'default'  => array(
                    'background-color' => '#f5f5f5',
                )
            ),
            array(         
                'id'       => 'ex_sidebar_bg',
                'type'     => 'color',
                'title'    => esc_html__('Extended Sidebar Menu Background', 'ever'),
                'subtitle' => esc_html__('Extended Sidebar Menu Background Color', 'ever'),
                'default'  => '#151515',
                'output'   => array(
                    'background-color' => '.tw-mobile-menu'
                )
            ),
            array(
                'id'       => 'heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Heading Title Color (H1-H6)?', 'ever'),
                'default'  => '#151515',
            ),
            array(
                'id'       => 'post_metacolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Color?', 'ever'),
                'subtitle' => esc_html__( 'Post Share & Post Comment and Date?', 'ever'),
                'default'  => '#999',
            ),
            array(
                'id'       => 'link_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color?', 'ever'),
                'subtitle' => '',
                'default'  => array(
                    'regular' => '#111',
                    'hover'   => '#e22524',
                    'active'  => false,
                )
            ),
            array(
                'id'       => 'border_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Border Color?', 'ever'),
                'subtitle' => 'table, image description, post comment, widget, footer etc... ',
                'default'  => '#e6e6e6',
            ),
            array(
                'id'       => 'input_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Background Color?', 'ever'),
                'subtitle' => 'and tags, author box, next prev posts, comment form etc... ',
                'default'  => '#fafafa',
            ),
            
            
            array(
                'id'=>'body-section-end',
                'type' => 'section', 
                'indent' => false // Indent all options below until the next 'section' option is set.
            ),
            
            array(
                'id'=>'post-section-start',
                'type' => 'section',
                'title' => esc_html__('Post Area Colors', 'ever'),                           
                'indent' => true // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'post_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Post Background Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#fff',
            ),
            array(
                'id'       => 'post_link',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Post Link Color?', 'ever'),
                'subtitle' => '',
                'default'  => array(
                    'regular' => '#151515',
                    'hover'   => '#999',
                    'active'  => false,
                )
            ),
            array(
                'id'=>'post-section-end',
                'type' => 'section', 
                'indent' => false // Indent all options below until the next 'section' option is set.
            ),
            
            array(
                'id'=>'header-section-start',
                'type' => 'section',
                'title' => esc_html__('Header Area Colors', 'ever'),                           
                'indent' => true // Indent all options below until the next 'section' option is set.
                ),
            array(
                'id'       => 'header_bgcolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Header BG Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#fff',
            ),
            array(
                'id'       => 'menu_color',
                'type'     => 'color',
                'title'    => esc_html__('Header area text color?', 'ever'),
                'subtitle' => esc_html__('Note: menu,logo and search icon?', 'ever'),
                'default'  => '#151515',
            ),
            array(
                'id'       => 'menu_hover',
                'type'     => 'color',
                'title'    => esc_html__('Menu hover color?', 'ever'),
                'subtitle' => esc_html__('If you want to disable it then set the same color for Header area text color.', 'ever'),
                'default'  => '#262626',
            ),
            array(
                'id'       => 'submenu_bg',
                'type'     => 'color',
                'title'    => esc_html__('SubMenu BG color?', 'ever'),
                'subtitle' => '',
                'default'  => '#151515',
            ),
            array(
                'id'       => 'submenu_hover_bg',
                'type'     => 'color',
                'title'    => esc_html__('SubMenu Hover BG color?', 'ever'),
                'subtitle' => '',
                'default'  => '#262626',
            ),
            array(
                'id'       => 'submenu_color',
                'type'     => 'color',
                'title'    => esc_html__('SubMenu Text color?', 'ever'),
                'subtitle' => '',
                'default'  => '#fff',
            ),
            array(
                'id'       => 'submenu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__('SubMenu Hover Text color?', 'ever'),
                'subtitle' => '',
                'default'  => '#fff',
            ),
           
            array(
                'id'=>'header-section-end',
                'type' => 'section', 
                'indent' => false // Indent all options below until the next 'section' option is set.
            ),
            
            array(
                'id'=>'footer-section-start',
                'type' => 'section',
                'title' => esc_html__('Footer Area Colors', 'ever'),                           
                'indent' => true // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'footer_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Text Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#999',
            ),
            array(
                'id'       => 'footer_link_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color?', 'ever'),
                'subtitle' => '',
                'default'  => array(
                    'regular' => '#999',
                    'hover'   => '#151515',
                    'active'  => false,
                )
            ),
            array(
                'id'=>'footer-section-end',
                'type' => 'section', 
                'indent' => false // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'=>'social-icon-section-start',
                'type' => 'section',
                'title' => esc_html__('Set Social Icon Style Colors', 'ever'),                           
                'indent' => true // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'light_social_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Light Social BG Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#fff',
                'output'   => array(
                    'background-color' => '.blog-single-nav .entry-share i.side-f, .tw-social-icon.social-light i.side-f'
                )
            ),
            array(
                'id'       => 'light_social_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Light Social Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#999',
                'output'   => array(
                    'color' => '.blog-single-nav .entry-share i.side-f, .tw-social-icon.social-light i.side-f'
                )
            ),
            array(
                'id'       => 'silver_social_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Silver Social BG Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#fafafa',
                'output'   => array(
                    'background-color' => '.blog-single-nav .entry-share i.side-f, .tw-social-icon i.side-f'
                )
            ),
            array(
                'id'       => 'silver_social_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Silver Social Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#151515',
                'output'   => array(
                    'color' => '.blog-single-nav .entry-share i.side-f, .tw-social-icon i.side-f'
                )
            ),
            array(
                'id'       => 'dark_social_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Dark Social BG Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#333',
                'output'   => array(
                    'background-color' => '.blog-single-nav .entry-share.dark i.side-f, .tw-social-icon.social-dark i.side-f'
                )
            ),
            array(
                'id'       => 'dark_social_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Dark Social Color?', 'ever'),
                'subtitle' => '',
                'default'  => '#999',
                'output'   => array(
                    'color' => '.blog-single-nav .entry-share.dark i.side-f, .tw-social-icon.social-dark i.side-f'
                )
            ),
            array(
                'id'=>'social-icon-section-end',
                'type' => 'section', 
                'indent' => false // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );

    // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'ever'),
        'id'     => 'typography',
        'icon'   => 'el el-fontsize',
        'fields' => array(
            array(
                'id'       => 'body_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font', 'ever'),
                'subtitle' => esc_html__( 'Site whole Text on Body area.', 'ever'),
                'google'   => true,
                'font-style'  => true,
                'font-weight'  => true,
                'text-align'  => false,
                'color'  => false,
                'all_styles'  => true,
                'font-backup'  => true,
                'line-height'  => false,
                'default'  => array(
                    'font-size'   => '16px',
                    'font-family' => 'Roboto',
                    'font-weight' => '400',
                    'font-backup'  => 'Arial, Helvetica, sans-serif',
                ),
            ),
            array(
                'id'          => 'menu_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Main Menu Font', 'ever'),
                'google'   => true,
                'font-style'  => true,
                'font-weight'  => true,
                'text-align'  => false,
                'text-transform'  => true,
                'color'  => false,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-family' => 'Montserrat',
                    'font-size'   => '13px',
                    'font-style'  => '',
                    'text-transform'  => 'uppercase',
                    'font-weight' => '700'
                ),
            ),
            array(
                'id'          => 'submenu_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'SubMenu font size', 'ever'),
                'google'   => true,
                'font-family'  => true,
                'font-style'  => false,
                'font-weight'  => true,
                'text-transform'  => true,
                'text-align'  => false,
                'color'  => false,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-family'  => 'Montserrat',
                    'font-size'  => '11px',
                    'font-weight'  => '400',
                    'text-transform'  => 'uppercase',
                ),
            ),
            array(
                'id'          => 'meta_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Post Meta Font', 'ever'),
                'subtitle'    => esc_html__( 'Date time, comment count and share count.', 'ever'),
                'google'   => true,
                'font-style'  => true,
                'font-weight'  => true,
                'text-align'  => false,
                'color'  => false,
                'text-transform'  => true,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-family' => 'Roboto',
                    'font-weight' => '400',
                    'font-size'  => '11px',
                    'text-transform'  => 'none',
                ),
            ),
            array(
                'id'          => 'heading_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading Title Font', 'ever'),
                'subtitle'    => esc_html__( 'H1-H6 and any Post Titles.', 'ever'),
                'google'   => true,
                'font-style'  => true,
                'font-weight'  => true,
                'text-align'  => false,
                'text-transform'  => true,
                'color'  => false,
                'font-size'  => false,
                'line-height'  => false,
                'all_styles'  => true,
                'default'  => array(
                    'font-family' => 'Montserrat',
                    'font-style'  => '',
                    'text-transform'  => 'none',
                    'font-weight' => '700'
                ),
            ),
            array(
                'title' => esc_html__('Heading Title Tags Size', 'ever'),
                'id' => 'tab_typography_sub_tag_start',
                'type' => 'section',
                'indent' => true,
            ),
            
            array(
                'id'          => 'h1_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'H1', 'ever'),
                'google'   => false,
                'font-family'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
                'color'  => false,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-size'  => '36px',
                ),
            ),
            array(
                'id'          => 'h2_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'H2', 'ever'),
                'google'   => false,
                'font-family'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
                'color'  => false,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-size'  => '30px',
                ),
            ),
            array(
                'id'          => 'h3_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'H3', 'ever'),
                'google'   => false,
                'font-family'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
                'color'  => false,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-size'  => '24px',
                ),
            ),
            array(
                'id'          => 'h4_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'H4', 'ever'),
                'google'   => false,
                'font-family'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
                'color'  => false,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-size'  => '20px',
                ),
            ),
            array(
                'id'          => 'h5_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'H5', 'ever'),
                'google'   => false,
                'font-family'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
                'color'  => false,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-size'  => '16px',
                ),
            ),
            array(
                'id'          => 'h6_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'H6', 'ever'),
                'google'   => false,
                'font-family'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
                'color'  => false,
                'font-size'  => true,
                'line-height'  => false,
                'all_styles'  => false,
                'default'  => array(
                    'font-size'  => '14px',
                ),
            ),
            array(
                'id' => 'tab_typography_sub_tag_end',
                'type' => 'section',
                'indent' => false,
            ),
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'ever'),
        'id'         => 'footer',
        'icon'       => 'el el-photo',
        'fields'     => array(
            array(
                'id'       => 'footer_text',
                'type'     => 'textarea',
                'title'    => esc_html__('Footer Left Text', 'ever'),
                'subtitle' => esc_html__('You can use HTML tags on this area', 'ever'),
                'default'  => wp_kses_post(sprintf(__( '&copy; 2017 <a href="%s">Ever Magazine Theme</a>. All rights reserved.', 'ever'), 'https://themeforest.net/user/themewaves')),
            ),
            array(
                'id'       => 'footer_socials',
                'type'     => 'textarea',
                'subtitle'    => esc_html__('Enter social links. Example: facebook.com/themewaves. NOTE: Divide value sets with linebreak "Enter":', 'ever'),
                'title'    => esc_html__('Footer Socials', 'ever'),
                'default'  => '',
            ),
            array(
                'id'       => 'footer_socials_color',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Social Style', 'ever' ),
                'subtitle' => esc_html__( 'You can change the colors on Color Options Tab', 'ever' ),
                'options'  => array(
                    'silver' => 'Silver',
                    'light' => 'Light',
                    'dark' => 'Dark'
                ),
                'default'  => 'light'
            ),
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Translation', 'ever'),
        'id'         => 'translation',
        'icon'       => 'el el-globe',
        'fields'     => array(
            array(
                'id'       => 'readmore',
                'type'     => 'text',
                'title'    => esc_html__( 'Read more text on Slider', 'ever'),
                'subtitle' => '',
                'default'  => esc_html__( 'Read more', 'ever'),
            ),
            array(
                'id'       => 'text_older',
                'type'     => 'text',
                'title'    => esc_html__( 'Older posts text on Pagination', 'ever'),
                'subtitle' => '',
                'default'  => esc_html__( 'Older Posts', 'ever'),
            ),
            array(
                'id'       => 'text_newer',
                'type'     => 'text',
                'title'    => esc_html__( 'Newer posts text on Pagination', 'ever'),
                'subtitle' => '',
                'default'  => esc_html__( 'Newer Posts', 'ever'),
            ),
            array(
                'id'       => 'text_prev',
                'type'     => 'text',
                'title'    => esc_html__( 'Prev posts text on Numbered Pagination', 'ever'),
                'subtitle' => '',
                'default'  => esc_html__( 'Prev', 'ever'),
            ),
            array(
                'id'       => 'text_next',
                'type'     => 'text',
                'title'    => esc_html__( 'Next posts text on Numbered Pagination', 'ever'),
                'subtitle' => '',
                'default'  => esc_html__( 'Next', 'ever'),
            ),
            array(
                'id'       => 'text_loadmore',
                'type'     => 'text',
                'title'    => esc_html__( 'Load More on Infinite Pagination', 'ever'),
                'subtitle' => '',
                'default'  => esc_html__( 'Load More', 'ever'),
            ),
            array(
                'id'       => 'text_search',
                'type'     => 'text',
                'title'    => esc_html__( 'Search placeholder', 'ever'),
                'subtitle' => '',
                'default'  => esc_html__( 'Search...', 'ever'),
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom CSS', 'ever'),
        'id'         => 'custom_css_tab',
        'icon'       => 'el el-css',
        'fields'     => array(
            array(
                'id'       => 'custom_css',
                'type'     => 'ace_editor',
                'title'    => esc_html__('Custom CSS', 'ever'),
                'subtitle' => esc_html__('Paste your CSS code here.', 'ever'),
                'mode'     => 'css',
                'theme'    => 'chrome',
            )
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Ads management', 'ever' ),
        'id'    => 'adsense',
        'desc'  => '',
        'icon'  => 'el el-screenshot',
        'fields' => array(
            array(
                'id'       => 'ads-single',
                'type'     => 'editor',
                'title'    => esc_html__('Single Content Above', 'ever'), 
                'subtitle' => esc_html__('It will be displayed above the Single Content, You can insert anything Ad or custom image or text anything.', 'ever'),
                'desc'    => '', 
                'default'  => '',
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 5
                )
            ),
            array(
                'id'       => 'ads-blog',
                'type'     => 'editor',
                'title'    => esc_html__('Blog Page Above', 'ever'), 
                'subtitle' => esc_html__('It will be displayed above the Blog Page, You can insert anything Ad or custom image or text anything.', 'ever'),
                'desc'    => '', 
                'default'  => '',
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 5
                )
            ),
        )
    ));
