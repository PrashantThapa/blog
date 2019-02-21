<?php
function ever_postmetabox($post, $metabox){ ?>
        <input type="hidden" name="themewaves_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__));?>" />
        <table class="form-table tw-metaboxes">
            <tbody><?php
                $currID=$post->ID;
                if(!empty($metabox['fe_id'])){
                    if($metabox['fe_id']==='none'){
                        $currID=0;
                    }else{
                        $currID=$metabox['fe_id'];
                    }
                }
                $options = get_post_meta($currID, EVER_META, true);
                foreach ($metabox['args'] as $settings) {
                    $settings['value'] = isset($settings['id'])&&isset($options[$settings['id']]) ? $options[$settings['id']] : (isset($settings['std']) ? $settings['std'] : '');
                    call_user_func('ever_settings', $settings);
                } ?>
            </tbody>
        </table>
<?php 
}
add_action('save_post', 'ever_savePostMeta');
function ever_savePostMeta($post_id) {
    
    // verify nonce
    if (!isset($_POST['themewaves_meta_box_nonce']) || !wp_verify_nonce($_POST['themewaves_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
    }
    
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    if(isset($_POST[EVER_META])){
        update_post_meta($post_id, EVER_META, $_POST[EVER_META]);
    }
}



/* ================================================================================== */
/*      Save gallery images
/* ================================================================================== */

function ever_save_images() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	
        if ( !isset($_POST['ids']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'themewaves-ajax' ) ) { return; }
        
        if ( !current_user_can( 'edit_posts' ) ) { return; }
 
	$ids = strip_tags(rtrim($_POST['ids'], ','));
        
	// update thumbs
	$thumbs = explode(',', $ids);
	$gallery_thumbs = '';
	foreach( $thumbs as $thumb ) {
            if(!empty($thumb)){
		$gallery_thumbs .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
            }
	}

	echo balanceTags($gallery_thumbs);

	die();
}
add_action('wp_ajax_ever_save_images', 'ever_save_images');