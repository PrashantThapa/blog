<?php
if (!function_exists('ever_settings_blog')) {
    function ever_settings_blog($settings) {
        if (empty($settings['value'])) {
            $settings['value'] = array('layout' => array('simple'), 'cat' => array(''),'row_type'=>array('layout'));
        }
        ?>
        <div class="post-layouts-container"><?php
            for ($i = 0; $i < count($settings['value']['row_type']); $i++) {
                $rowType = isset($settings['value']['row_type'][$i]) ? $settings['value']['row_type'][$i] : 'layout'; ?>
                <div class="post-layouts-item tw-grid-container" data-row-type="<?php echo esc_attr($rowType); ?>">
                    <input class="row-type-hidden" name="<?php echo esc_attr($settings['id']); ?>[row_type][]" type="hidden" value="<?php echo esc_attr($rowType); ?>" />
                    <?php $rowContent = isset($settings['value']['row_content'][$i]) ? $settings['value']['row_content'][$i] : ''; ?>
                    <?php $rowHeight = isset($settings['value']['row_height'][$i]) ? $settings['value']['row_height'][$i] : ''; ?>
                    <?php $rowWidth = isset($settings['value']['row_width'][$i]) ? $settings['value']['row_width'][$i] : ''; ?>
                    <?php $rowImage = isset($settings['value']['row_bgimage'][$i]) ? $settings['value']['row_bgimage'][$i] : ''; ?>
                    <?php $rowColor = isset($settings['value']['row_bgcolor'][$i]) ? $settings['value']['row_bgcolor'][$i] : ''; ?>
                    <?php $postPerpage = isset($settings['value']['posts_per_page'][$i]) ? $settings['value']['posts_per_page'][$i] : ''; ?>
                    <?php $postExcerpt = isset($settings['value']['excerpt'][$i]) ? $settings['value']['excerpt'][$i] : ''; ?>
                    <div class="row-content">
                        <div class="tw-left tw-60">
                            <div class="tw-right-30">
                                <textarea placeholder="<?php esc_html_e('Custom HTML or Shortcode anythings can be inserted. Example: Use WordPress Core Editor and Button Shortcode etc.', 'ever'); ?>" name="<?php echo esc_attr($settings['id']); ?>[row_content][]"><?php echo wp_kses_post($rowContent); ?></textarea>
                                <div class="move-buttons">
                                    <a href="#" class="button post-layouts-item-remove"><span class="dashicons dashicons-trash"></span><?php esc_html_e('Delete Row', 'ever'); ?></a>
                                    <a href="#" class="button post-layouts-item-move" data-type="up"><span class="dashicons dashicons-arrow-up-alt"></span><?php esc_html_e('Up', 'ever'); ?></a>
                                    <a href="#" class="button post-layouts-item-move" data-type="down"><span class="dashicons dashicons-arrow-down-alt"></span><?php esc_html_e('Down', 'ever'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="tw-left tw-40">
                            <div class="tw-bottom-15">
                                <label class="tw-label">
                                    <strong><?php esc_html_e('Height', 'ever'); ?></strong>
                                    <span><?php esc_html_e('Row Min Height', 'ever'); ?></span>
                                </label>
                                <input type="text" placeholder="280px" name="<?php echo esc_attr($settings['id']); ?>[row_height][]" value="<?php echo wp_kses_post($rowHeight); ?>" />
                            </div>
                            <div class="tw-bottom-15">
                                <label class="tw-label">
                                    <strong><?php esc_html_e('Width', 'ever'); ?></strong>
                                    <span><?php esc_html_e('Content Width', 'ever'); ?></span>
                                </label>
                                <input type="text" placeholder="100%" name="<?php echo esc_attr($settings['id']); ?>[row_width][]" value="<?php echo wp_kses_post($rowWidth); ?>" />
                            </div>
                            <div class="tw-bottom-15">
                                <label class="tw-label">
                                    <strong><?php esc_html_e('Background Image', 'ever'); ?></strong>
                                    <span><?php esc_html_e('Insert BG Image', 'ever'); ?></span>
                                </label>
                                <input type="text" name="<?php echo esc_attr($settings['id']); ?>[row_bgimage][]" value="<?php echo wp_kses_post($rowImage); ?>" placeholder="<?php esc_html_e('Your Custom BG Image URL', 'ever'); ?>" size=""/>
                                <a href="#" class="button insert-images theme_button format tw-browseimage"><?php esc_html_e('Insert image', 'ever'); ?></a>
                            </div>
                            <div class="tw-bottom-15">
                                <label class="tw-label">
                                    <strong><?php esc_html_e('Background Color', 'ever'); ?></strong>
                                    <span><?php esc_html_e('Set your Color', 'ever'); ?></span>
                                </label>
                                <div class="color_selector">
                                    <div class="color_picker"><div style="<?php echo 'background-color: ' . esc_attr($rowColor); ?>;" class="color_picker_inner"></div></div>
                                    <input type="text" class="color_picker_value" name="<?php echo esc_attr($settings['id']); ?>[row_bgcolor][]" value="<?php echo esc_attr($rowColor); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw-left tw-60">
                        <div class="type_layout"><?php
                            $selectedLayout = isset($settings['value']['layout'][$i]) ? $settings['value']['layout'][$i] : '';
                            foreach ($settings['options']['layout'] as $key => $value) {
                                echo '<a href="#" data-value="' . esc_attr($key) . '" class="' . (strval($selectedLayout) === strval($key) ? 'active' : '') . '" title="' . esc_attr($value['text']) . '" style="background-image:url(' . esc_url($value['src']) . ');"></a>';
                            }
                            ?>
                            <input name="<?php echo esc_attr($settings['id']); ?>[layout][]" type="hidden" value="<?php echo esc_attr($selectedLayout); ?>" />
                        </div>
                        <div class="move-buttons">
                            <a href="#" class="button post-layouts-item-remove"><span class="dashicons dashicons-trash"></span><?php esc_html_e('Delete Row', 'ever'); ?></a>
                            <a href="#" class="button post-layouts-item-move" data-type="up"><span class="dashicons dashicons-arrow-up-alt"></span><?php esc_html_e('Up', 'ever'); ?></a>
                            <a href="#" class="button post-layouts-item-move" data-type="down"><span class="dashicons dashicons-arrow-down-alt"></span><?php esc_html_e('Down', 'ever'); ?></a>
                        </div>
                    </div>
                    <div class="tw-right tw-40">
                        <div class="category tw-bottom-15"><?php $selectedCat = isset($settings['value']['cat'][$i]) ? $settings['value']['cat'][$i] : ''; ?>
                            <label class="tw-label">
                                <strong><?php esc_html_e('Assign Category', 'ever'); ?></strong>
                                <span><?php esc_html_e('You can only select 1 category!', 'ever'); ?></span>
                            </label>
                            <select multiple class="selectbox" name="<?php echo esc_attr($settings['id']); ?>[cat][]" data-name="<?php echo esc_attr($settings['id']); ?>[cat][%index%][]"><?php
                                foreach ($settings['options']['cats'] as $key => $value) {
                                    echo '<option value="' . esc_attr($key) . '"' . (in_array((string)$key,(array)$selectedCat,true) ? ' selected' : '') . '>' . esc_html($value) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="pagination tw-bottom-15"><?php $selected = isset($settings['value']['pagination'][$i]) ? $settings['value']['pagination'][$i] : ''; ?>
                            <label class="tw-label">
                                <strong><?php esc_html_e('Pagination?', 'ever'); ?></strong>
                            </label>
                            <select class="selectbox" name="<?php echo esc_attr($settings['id']); ?>[pagination][]" data-value="<?php echo esc_attr($selected); ?>"><?php
                                foreach ($settings['options']['pagination'] as $key => $value) {
                                    echo '<option value="' . esc_attr($key) . '"' . ($key === $selected ? ' selected' : '') . '>' . esc_html($value) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="posts-per-page tw-bottom-15">
                            <label class="tw-label">
                                <strong><?php esc_html_e('Posts per page', 'ever'); ?></strong>
                            </label>
                            <input type="text" name="<?php echo esc_attr($settings['id']); ?>[posts_per_page][]" value="<?php echo wp_kses_post($postPerpage); ?>" placeholder="<?php echo esc_html__('Insert Only Digits here','ever'); ?>" />
                        </div>
                        <div class="excerpt tw-bottom-15">
                            <label class="tw-label">
                                <strong><?php esc_html_e('Excerpt word count', 'ever'); ?></strong>
                            </label>
                            <input type="text" name="<?php echo esc_attr($settings['id']); ?>[excerpt][]" value="<?php echo wp_kses_post($postExcerpt); ?>" placeholder="<?php echo esc_html__('Insert Only Digits here','ever'); ?>" />
                        </div>                        
                    </div>
                    <div class="both-options">
                        <div class="sidebar tw-bottom-15"><?php $selected = isset($settings['value']['sidebar'][$i]) ? $settings['value']['sidebar'][$i] : ''; ?>
                            <label class="tw-label">
                                <strong><?php esc_html_e('Sidebar?', 'ever'); ?></strong>
                            </label>
                            <select class="selectbox" name="<?php echo esc_attr($settings['id']); ?>[sidebar][]" data-value="<?php echo esc_attr($selected); ?>"><?php
                                foreach ($settings['options']['sidebar'] as $key => $value) {
                                    echo '<option value="' . esc_attr($key) . '"' . ($key === $selected ? ' selected' : '') . '>' . esc_html($value) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div><?php
            } ?>
            <div class="add-buttons">
                <a href="#" class="button post-layouts-item-add" title="Add Post Row" data-type="layout"><span class="dashicons dashicons-plus"></span><?php esc_html_e('Add Row Layout', 'ever'); ?></a>
                <a href="#" class="button post-layouts-item-add" title="You can add custom Shortcodes and custom images etc. Example: Custom Shortcode." data-type="content"><span class="dashicons dashicons-plus"></span><?php esc_html_e('Add Custom Row', 'ever'); ?></a>
            </div>
        </div><?php
    }

}
if (!function_exists('ever_settings_category')) {
    function ever_settings_category($settings){
        foreach($settings['options'] as $catSlug => $catName ){ ?>
            <div class="category">
                <input type="checkbox" id="<?php echo esc_attr($settings['id'].'-'.$catSlug); ?>" name="<?php echo esc_attr($settings['id'].'['.$catSlug.']'); ?>" value="<?php echo esc_attr($catSlug);?>" <?php echo isset($settings['value'][$catSlug])?checked($settings['value'][$catSlug], $catSlug, false):'';?> />
                <label for="<?php echo esc_attr($settings['id'].'-'.$catSlug); ?>"><?php echo esc_html($catName); ?></label>
            </div><?php
        }
    }
}
if (!function_exists('ever_settings_checkbox')) {
    function ever_settings_checkbox($settings){ ?>
        <input type="checkbox" id="<?php echo esc_attr($settings['id']); ?>" name="<?php echo esc_attr($settings['id']); ?>" value="1" <?php echo checked($settings['value'], 1, false);?> /><?php
    }
}
if (!function_exists('ever_settings_textarea')) {
    function ever_settings_textarea($settings){ ?>
                <textarea rows="5" name="<?php echo esc_attr($settings['id']); ?>" id="<?php echo esc_attr($settings['id']); ?>"><?php echo esc_attr($settings['value']); ?></textarea><?php
    }
}
if (!function_exists('ever_settings_text')) {
    function ever_settings_text($settings){ ?>
        <input type="text" name="<?php echo esc_attr($settings['id']); ?>" id="<?php echo esc_attr($settings['id']); ?>"<?php echo !empty($settings['placeholder']) ? (' placeholder="'.esc_attr($settings['placeholder']).'"') : ''; ?> value="<?php echo esc_attr($settings['value']); ?>" /><?php
    }
}
if (!function_exists('ever_settings_file')) {
    function ever_settings_file($settings){ ?>
        <input type="text" id="<?php echo esc_attr($settings['id']); ?>" name="<?php echo esc_attr($settings['id']); ?>" value="<?php echo esc_url($settings['value']); ?>" placeholder="<?php esc_html_e('Your Custom BG Image URL', 'ever');?>" size=""/>
        <a href="#" class="button insert-images theme_button format tw-browseimage"><?php esc_html_e('Insert image', 'ever'); ?></a><?php
    }
}
if (!function_exists('ever_settings_selectbox')){
    function ever_settings_selectbox($settings){
        $settings['options'] = array('' => esc_html__('Default', 'ever'), 'true' => esc_html__('True','ever'), 'false' => esc_html__('False','ever')); ?>
        <select class="selectbox" name="<?php echo esc_attr($settings['id']); ?>" data-value="<?php print esc_attr($settings['value']);?>"><?php
            foreach ($settings['options'] as $key=>$value) {
                echo '<option value="'.esc_attr($key).'">'.esc_html($value).'</option>';
            } ?>
        </select><?php
    }
}
if (!function_exists('ever_settings_layout')) {
    function ever_settings_layout($settings){ ?>
        <div class="type_layout">
            <?php 
            foreach ($settings['options'] as $val => $option) {
                echo '<a href="#" data-value="'.esc_attr($val).'"'.($val == $settings['value'] ? ' class="active"' : '').'><img src="'.esc_url($option['img']).'">'.esc_html($option['title']).'</a>';
            }
            ?>
            <input name="<?php echo esc_attr($settings['id']);?>" type="hidden" value="<?php echo esc_attr($settings['value']);?>" />
        </div><?php
    }
}
if (!function_exists('ever_settings_radio')) {
    function ever_settings_radio($settings){ ?>
        <div class="type_radio"><?php
            foreach ($settings['options'] as $option) {
                print '<input type="radio" style="margin-right:5px;" name="' . esc_attr($settings['id']) . '" value="' . $option . '" ';
                print $option == $settings['value'] ? 'checked ' : '';
                print '><span style="margin-right:20px;">' . $option . '</span><br />';
            } ?>
        </div><?php
    }
}
if (!function_exists('ever_settings_color')) {
    function ever_settings_color($settings){ ?>
        <div class="color_selector">
            <div class="color_picker"><div style="<?php echo esc_attr('background-color: '.$settings['value']); ?>;" class="color_picker_inner"></div></div>
            <input type="text" class="color_picker_value" id="<?php echo esc_attr($settings['id']); ?>" name="<?php echo esc_attr($settings['id']); ?>" value="<?php echo esc_attr($settings['value']); ?>" />
        </div><?php
    }
}
if (!function_exists('ever_settings_select')) {
    function ever_settings_select($settings){ ?>
        <div class="type_select add_item_medium">
            <select class="medium" name="<?php echo esc_attr($settings['id']); ?>" data-value="<?php print esc_attr($settings['value']);?>"><?php
                foreach($settings['options'] as $key=>$value) { 
                        echo '<option value="'.esc_attr($key).'"'.(strval($settings['value'])===strval($key)?' selected':'').'>'.esc_html($value).'</option>';
                } ?>
            </select>
        </div><?php
    }
}
if (!function_exists('ever_settings_fi')) {
    function ever_settings_fi($settings){ ?>
        <div class="type_fi add_item_medium">
            <input class="fi-handler" type="hidden" name="<?php echo esc_attr($settings['id']); ?>" value="<?php print esc_attr($settings['value']);?>"/>
            <div class="button show-fi-modal"><?php esc_html_e('Edit Icon', 'ever'); ?></div>
            <div class="fi-viewer"></div>
        </div><?php
    }
}
if (!function_exists('ever_settings_gallery')) {
    function ever_settings_gallery($settings){
        global $post;
        $meta = ever_metabox('gallery_image_ids');
        $gallery_thumbs = '';
        $button_text = ($meta) ? esc_html__('Edit Gallery', 'ever') : esc_html__('Upload Images', 'ever');
        if( $meta ) {
            $thumbs = explode(',', $meta);
            foreach( $thumbs as $thumb ) {
                if(!empty($thumb)){
                    $gallery_thumbs .= '<li>' . wp_get_attachment_image( $thumb, array(80,80) ) . '</li>';
                }
            }
        } ?>
        <input type="button" class="button" id="gallery_images_upload" value="<?php echo esc_attr($button_text); ?>" />
        <input type="hidden" name="<?php echo esc_attr(EVER_META); ?>[gallery_image_ids]" id="gallery_image_ids" value="<?php echo esc_attr($meta ? $meta : 'false'); ?>" />
        <ul class="gallery-thumbs"><?php echo balanceTags($gallery_thumbs);?></ul><?php
    }
}
if (!function_exists('ever_settings_slideshow')) {
    function ever_settings_slideshow($settings){
        global $wpdb;        
        if ( defined('MSWP_AVERTA_VERSION') ) {
            $masters = get_mastersliders();
        }        
        $layer_table = $wpdb->prefix . "layerslider";
        if($wpdb->get_results($wpdb->prepare( "SHOW TABLES LIKE %s", $layer_table ))){
            $layers = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $layer_table
                                            WHERE flag_hidden = %s AND flag_deleted = %s
                                            ORDER BY date_c ASC LIMIT 100", '0', '0' ));
        }
        $revo_table = $wpdb->prefix . "revslider_sliders";
        if($wpdb->get_results($wpdb->prepare( "SHOW TABLES LIKE %s", $revo_table ))){
            $revos = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $revo_table WHERE id <> %s",''));
        } ?>
        <select class="medium" name="<?php echo esc_attr($settings['id']); ?>" data-value="<?php print esc_attr($settings['value']);?>">
            <option value="none">None</option><?php
            if(!empty($masters)) {
                    foreach($masters as $key => $item) {
                            $name = empty($item['title']) ? ('Unnamed('.$item['ID'].')') : $item['title'];
                            echo '<option value="[masterslider id=\''.$item['ID'].'\']">'.esc_html($name).' (master)</option>';
                    }
            }
            if(!empty($layers)) {
                    foreach($layers as $key => $item) {
                            $name = empty($item->name) ? ('Unnamed('.$item->id.')') : $item->name;
                            echo '<option value="[layerslider id=\''.$item->id.'\']">'.esc_html($name).' (layer)</option>';
                    }
            }
            if(!empty($revos)) {
                    foreach($revos as $key => $item) {
                            $name = empty($item->title) ? ('Unnamed('.$item->id.')') : $item->title;
                            echo '<option value="[rev_slider '.$item->id.']">'.esc_html($name).' (revo)</option>';
                    }
            } ?>
        </select><?php
    }
}
if (!function_exists('ever_settings_menu')) {
    function ever_settings_menu($settings){ ?>
        <?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
        if ( !$menus ) {
                echo '<p>'. sprintf( wp_kses(__('No menus have been created yet. <a href="%s">Create some</a>.', 'ever'),array('a'=>array('href'=>array(),'title' => array()))), admin_url('nav-menus.php') ) .'</p>';
        } else {
            echo '<select name="'.esc_attr($settings['id']).'" data-value="'.esc_attr($settings['value']).'">';
                echo '<option value="">'. esc_html__('Default', 'ever') . '</option>';
                foreach ( $menus as $menu ) {
                        echo '<option value="' . esc_attr($menu->term_id) . '">'. esc_html($menu->name) . '</option>';
                }
            echo '</select>';
        }
    }
}
if (!function_exists('ever_settings_separator')) {
    function ever_settings_separator($settings){ ?>
        <div class="waves-separator"></div><?php
    }
}
if(!function_exists('ever_settings')){
    function ever_settings($settings){
        if(!isset($settings['id'])){$settings['id']='none';} ?>
        <tr class="<?php echo esc_attr($settings['id'].' waves-type-'.$settings['type']); ?>" data-name="<?php echo esc_attr($settings['id']); ?>"<?php if(isset($settings['dependency'])){echo ' data-dependency="'.esc_attr(json_encode($settings['dependency'])).'"';}?>>
                        
            <th>
                <label for="<?php echo esc_attr($settings['id']); ?>"><?php
                    if(!empty($settings['name'])){ ?><strong><?php echo esc_html($settings['name']); ?></strong><?php }
                    if(!empty($settings['desc'])){ ?><span><?php echo esc_html($settings['desc']); ?></span><?php } ?>
                </label>
            </th>
            <td><?php
                if(function_exists('ever_settings_' . $settings['type'])){
                    $settings['id'] = EVER_META . '[' . $settings['id'] . ']';
                    call_user_func('ever_settings_' . $settings['type'], $settings);
                } ?>
            </td>
        </tr><?php
    }
}
