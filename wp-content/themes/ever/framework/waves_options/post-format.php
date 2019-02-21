<?php
/* ================================================================================== */
/*      Post Format Options   */
/* ================================================================================== */

add_action('admin_init', 'ever_post_format');
function ever_post_format() {
    
    $ever_image = array(
        array("name" => esc_html__('Insert Gallery Images', 'ever'),
            "desc" => esc_html__('If you set the Featured Image then it will be only shown on Single', 'ever'),
            "id" => "gallery_image_ids",
            "type" => 'gallery'
        )
    );
    
    $ever_audio = array(
        array("name" => esc_html__('MP3 File URL', 'ever'),
            "desc" => esc_html__('The URL to the .mp3 audio file', 'ever'),
            "id" => "format_audio_mp3",
            "type" => "text",
            'std' => ''
        ),
        array("name" => esc_html__('Embeded Code', 'ever'),
            "desc" => esc_html__('The embed code', 'ever'),
            "id" => "format_audio_embed",
            "type" => "textarea",
            'std' => ''
        )
    );
    
    $ever_video = array(
        array("name" => esc_html__('Video Link URL', 'ever'),
            "desc" => esc_html__('If you\'re not using self hosted video then you can include video link url here. (Not Embed)', 'ever'),
            "id" => "format_video_embed",
            "type" => "textarea",
            'std' => ''
        )
    );

    add_meta_box('tw-format-gallery', esc_html__('Gallery Settings', 'ever'), 'ever_postmetabox', 'post', 'normal', 'high', $ever_image);
    add_meta_box('tw-format-audio', esc_html__('Audio Settings', 'ever'), 'ever_postmetabox', 'post', 'normal', 'high', $ever_audio);
    add_meta_box('tw-format-video', esc_html__('Video Settings', 'ever'), 'ever_postmetabox', 'post', 'normal', 'high', $ever_video);
}