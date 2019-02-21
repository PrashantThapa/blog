<?php

/* ================================================================================== */
/*      Blog Shortcode
  /* ================================================================================== */

function ever_standard_media($post, $atts) {
    if (has_post_thumbnail($post->ID)) {
        $thumb = ever_image($atts['img_size'], true);
        $output = '<div class="entry-media">';
        if(!empty($atts['media_bgimage'])){
            $output .= '<div class="tw-thumbnail" style="background-image: url('.esc_url($thumb['url']).');">';
        }else{
            $output .= '<div class="tw-thumbnail">';
            $output .= '<img src="'.esc_url($thumb['url']).'" alt="'.esc_attr($thumb['alt']).'">';
        }
        if (is_single($post)) {
            $output = '<div class="entry-media single-media-thumb"><div class="tw-thumbnail">';
            $fullimg = ever_image('full', true);
            $img = ever_image($atts['img_size'], true);
            $output .= '<div class="image-overlay">';
            $output .= '<a href="' . esc_url($fullimg['url']) . '" title="' . esc_html(get_the_title()) . '" class="overlay-icon">';
            $output .= '<img src="'.esc_url($img['url']).'" alt="'.esc_attr($img['alt']).'">';
            $output .= '</a></div>';
            $output .= '<span class="featured-image-caption">'.esc_attr($img['caption']).'</span>';
        } else {
            $format = get_post_format();
            if($format == 'video' &&($embed = trim(ever_metabox('format_video_embed')))){
                $output .= '<a href="'. $embed .'" class="video-format-icon"><i class="ion-ios-play"></i></a>';
            }
            $output .= '<div class="image-overlay tw-middle"><div class="image-overlay-inner"><a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '" class="overlay-icon"></a></div></div>';
        }
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
}

function ever_entry_media($format, $atts) {
    global $post;
    $output = '';
    if (!is_single() && has_post_thumbnail($post->ID)) {
        return ever_standard_media($post, $atts);
    }
    switch ($format) {

        case 'gallery':
            $images = explode(',', ever_metabox('gallery_image_ids'));
            if ($images) {
                wp_enqueue_script('owl-carousel');
                $output .= '<div class="entry-media">';
                $output .= '<div class="owl-carousel">';
                    foreach ($images as $image) {                        
                        if($image){
                            $origimg = wp_get_attachment_image_src($image, 'full');
                            $output .= '<a href="' . esc_url($origimg[0]) . '" /><img src="' . esc_url($origimg[0]) . '" /></a>';
                        }
                    }
                    $output .= '</div>';
                $output .= '</div>';
                break;
            } else {
                $output = ever_standard_media($post, $atts);
                break;
            }

        case 'video':

            $embed = ever_metabox('format_video_embed');

            if (wp_oembed_get($embed)) {
                $output .= '<div class="entry-media">';
                $output .= wp_oembed_get($embed);
                $output .= '</div>';
                break;
            } elseif (!empty($embed)) {
                $output .= '<div class="entry-media">';
                $output .= apply_filters("the_content", htmlspecialchars_decode($embed));
                $output .= '</div>';
                break;
            } else {
                $output = ever_standard_media($post, $atts);
                break;
            }

        case 'audio':

            $mp3 = ever_metabox('format_audio_mp3');
            $embed = ever_metabox('format_audio_embed');
            if ($mp3) {
                $output .= '<div class="entry-media">';
                $output .= apply_filters("the_content", '[audio src="' . esc_url($mp3) . '"]');
                $output .= '</div>';
                break;
            } elseif (wp_oembed_get($embed)) {
                $output .= '<div class="entry-media">';
                $output .= wp_oembed_get($embed);
                $output .= '</div>';
                break;
            } elseif (!empty($embed)) {
                $output .= '<div class="entry-media">';
                $output .= apply_filters("the_content", htmlspecialchars_decode($embed));
                $output .= '</div>';
                break;
            } else {
                $output = ever_standard_media($post, $atts);
                break;
            }

        default :
            $output = ever_standard_media($post, $atts);
    }
    return $output;
}

function ever_blogcontent($atts) {
    global $more;
    $more = 0;
    if (has_excerpt()) {
        the_excerpt();
    } elseif (isset($atts['blog_excerpt']) && $atts['blog_excerpt'] != "") {
        $more = 1;
        echo apply_filters("the_content", ever_excerpt(strip_shortcodes(wp_strip_all_tags(get_the_content(), true)), $atts['blog_excerpt']));
    } else {
        the_content($atts['more_text']);
    }
}

function ever_excerpt($str, $length) {
    $str = explode(" ", strip_tags($str));
    return implode(" ", array_slice($str, 0, $length));
}

add_filter('the_content_more_link', 'ever_read_more_link', 10, 2);
function ever_read_more_link($output, $read_more_text) {
    $output = '<p class="more-link"><a href="' . esc_url(get_permalink()) . '">' . $read_more_text . '</a></p>';
    return $output;
}

/* One Click other */

function ever_import_files() {
    return array(
        array(
            'import_file_name' => esc_html__('All Dummy Data', 'ever'),
            'import_file_url' => EVER_DIR . '/dummy-data/all-dummy.xml',
            'import_widget_file_url' => EVER_DIR . '/dummy-data/widgets.json',
            'import_preview_image_url' => EVER_DIR . '/dummy-data/screenshot.jpg',
            'import_redux' => array(
                array(
                    'file_url' => EVER_DIR . '/dummy-data/all-dummy.json',
                    'option_name' => 'ever_redux',
                ),
            ),
            'import_notice' => esc_html__('After you imported demo then set the Main menu and Edit Main Categories and enable the Customize options.', 'ever'),
        ),
    );
}

add_filter('pt-ocdi/import_files', 'ever_import_files');

function ever_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Menu', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        'main' => $main_menu->term_id,
            )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title('Home');

    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
}

add_action('pt-ocdi/after_import', 'ever_after_import_setup');
