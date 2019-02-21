<?php
if (!current_user_can('edit_posts') && !current_user_can('edit_pages')){return;}
if (get_user_option('rich_editing') == 'true'){
    add_filter('mce_external_plugins', 'ever_tinymce_external');
    add_filter('mce_buttons', 'ever_tinymce_button');
}
function ever_tinymce_external($plugin_array) {
    $plugin_array['twshortcodegenerator']    = EVER_CORE_DIR . 'assets/js/admin-waves-shortcode.js';
    $plugin_array['evershortcodeauthorlist']   = EVER_CORE_DIR . 'assets/js/admin-waves-shortcode.js';
    $plugin_array['evershortcodedropcap']   = EVER_CORE_DIR . 'assets/js/admin-waves-shortcode.js';
    return $plugin_array;
}
function ever_tinymce_button($buttons) {
    array_push($buttons, "twshortcodegenerator");
    array_push($buttons, "evershortcodeauthorlist");
    array_push($buttons, "evershortcodedropcap");
    return $buttons;
}
function ever_refresh_mce($ver) {$ver += 3;return $ver;}
add_filter('tiny_mce_version', 'ever_refresh_mce');