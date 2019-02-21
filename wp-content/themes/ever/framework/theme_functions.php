<?php
function ever_option($index, $default = ''){
    global $ever_redux;
    if ( isset( $ever_redux[ $index ]) ) {
        return $ever_redux[$index];
    } else {
        return $default;
    }
}
function ever_metabox($index, $default = ''){
    global $post;
    $metabox = !empty($post->ID) ? get_post_meta( $post->ID, EVER_META, true ) : '';
    if ( isset( $metabox[ $index ]) ) {
        return $metabox[$index];
    } else {
        return $default;
    }
}
function ever_metaboxes(){
    global $post;
    if ($post) {
        return get_post_meta( $post->ID, EVER_META, true );
    }
    return false;
}
function ever_favicon() {
    if(!function_exists('wp_site_icon') || !has_site_icon()){
        $fav = ever_option('favicon');
        if (!empty($fav['url'])) {
            $favicon = $fav['url'];
        } else {
            $favicon = EVER_DIR . 'assets/img/favicon.png';
        }
        echo '<link rel="shortcut icon" href="' . esc_url($favicon) . '" />' . "\n";
    }
}

// Print menu
//=======================================================
function ever_menu() {
    wp_nav_menu(array(
        'container' => false,
        'menu_id' => '',
        'menu_class' => 'sf-menu',
        'fallback_cb' => 'ever_nomenu',
        'theme_location' => 'main'
    ));
}
function ever_footer_menu() {
    wp_nav_menu(array(
        'container' => 'div',
        'container_class' => 'footer-menu',
        'menu_id' => '',
        'menu_class' => '',
        'fallback_cb' => '',
        'theme_location' => 'footer',
        'depth' => '1'
    ));
}

function ever_nomenu() {
    echo "<ul class='sf-menu'>";
        $howmany = 5;
        $pages=wp_list_pages(array('title_li'=>'','echo'=>0));
        preg_match_all('/(<li.*?>)(.*?)<\/li>/i', $pages, $matches);
        if(!empty($matches[0])){echo implode("\n", array_slice($matches[0],0,5));}
    echo "</ul>";
}
function ever_mobilemenu($loc = 'main') {
    wp_nav_menu(array(
        'container' => false,
        'menu_id' => '',
        'menu_class' => 'sf-mobile-menu clearfix',
        'fallback_cb' => 'ever_nomobile',
        'theme_location' => $loc)
    );
}

function ever_nomobile() {
    echo "<ul class='clearfix'>";
    wp_list_pages(array('title_li' => ''));
    echo "</ul>";
}


// Print logo
//=======================================================
function ever_logo($mobile = false) {
    $logo = ever_option("logo");
    $output = '<div class="tw-logo">';
        if ( !empty($logo['url']) ) {
            $output .= '<a class="logo" href="' . esc_url(home_url('/')) . '">';
                $output .= '<img class="logo-img" src="' . esc_url($logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '"/>';
            $output .= '</a>';
        } else {
            $output .= '<h1 class="site-name"><a class="logo" href="' . esc_url(home_url('/')) . '">';
                $output .= get_bloginfo('name');
            $output .= '</a></h1>';
        }
        if($mobile){
            $output .= '<div class="nav-icon-container"><div class="nav-icon tw-mdl-close active"><span></span><span></span><span></span></div></div>';
        }
    $output .= '</div>';
    return $output;
}
// ThemeWaves Pagination
//=======================================================
function ever_pagination($type = 'simple') { 
    global $wp_query;
    $pages = intval($wp_query->max_num_pages);
    $paged = (get_query_var('paged')) ? intval(get_query_var('paged')) : 1;
    if (empty($pages)) {
        $pages = 1;
    }
    if($type == 'simple' && 1 != $pages){
        echo '<div class="tw-pagination tw-nextprev-link">';
            echo '<div class="newer">';
                previous_posts_link('<span><i class="ion-chevron-left"></i>'.ever_option('text_newer', esc_html__( 'Newer Posts', 'ever')).'</span>');
            echo '</div><div class="older">';
                next_posts_link('<span>'.ever_option('text_older', esc_html__( 'Older Posts', 'ever')).'<i class="ion-chevron-right"></i></span>' );
            echo '</div>';
        echo '</div>';
    }elseif($type == 'number' && 1 != $pages){
        $big = 9999; // need an unlikely integer
        echo "<div class='tw-pagination'>";
        $pagination = paginate_links(
            array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'end_size' => 3,
                'mid_size' => 6,
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'type' => 'list',
                'prev_text' => '<i class="ion-chevron-left"></i>'.ever_option('text_prev', esc_html__( 'Prev', 'ever')),
                'next_text' => ever_option('text_next', esc_html__( 'Next', 'ever')).'<i class="ion-chevron-right"></i>',
            )
        );
        echo balanceTags($pagination);
        echo "</div>";
    }elseif($type == 'infinite' && 1 != $pages){
        wp_enqueue_script('waypoints');
        echo '<div class="tw-pagination tw-infinite-scroll" data-has-next="' . ($paged === $pages ? 'false' : 'true') . '">';
        echo '<div class="loading"><div class="infinte-loader"></div></div>';
        echo '<div class="older"><a class="next" href="' . esc_url(get_pagenum_link($paged + 1)) . '"><span>'.ever_option('text_loadmore', esc_html__( 'More Stories', 'ever')).'</span></a></div>';
        echo '</div>';
    }
}

function ever_get_image_by_id($id,$url=false,$size='full'){
    $lrg_img=wp_get_attachment_image_src($id,$size);
    $output='';
    if(isset($lrg_img[0])){
        if($url){
            $output.=$lrg_img[0];
        }else{
            $output.='<img src="'.esc_url($lrg_img[0]).'" />';
        }
    }
    return $output;
}

if (!function_exists('ever_image')) {
    function ever_image($size = 'full', $returnURL = false) {
        global $post;
        $attachment = get_post(get_post_thumbnail_id($post->ID));
        if(!empty($attachment)){
            if ($returnURL) {
                $lrg_img = wp_get_attachment_image_src($attachment->ID, $size);
                $url = $lrg_img[0];
                $alt0 = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
                $alt = empty($alt0)?$attachment->post_title:$alt0;
                $caption = get_post( get_post_thumbnail_id() )->post_excerpt;
                $img['url'] = $url;
                $img['alt'] = $alt;
                $img['caption'] = $caption;
                return $img;
            } else {
                return get_the_post_thumbnail($post->ID,$size);
            }
        }
    }
}

if (!function_exists('ever_single_title')) {
    function ever_single_title(){
        if(ever_option('single_cats', true)){
            echo '<div class="entry-cats">'.ever_cats().'</div>';
        }
        echo '<h1 class="entry-title">'.get_the_title().'</h1>';
        if(ever_option('single_meta', true)){
            echo '<div class="tw-meta"><span class="entry-author">'.esc_html__('by', 'ever').'&nbsp;';
                the_author_posts_link();  
                echo '</span><span class="entry-date"><a href="'.esc_url(get_permalink()).'">'.get_the_time(get_option('date_format')).'</a></span>';
                echo ever_comment_count();
            echo '</div>';
        }
    }
}
if (!function_exists('ever_single_share')) {
    function ever_single_share(){
        if(ever_option('single_share', true)){
            $post_image = ever_image('full', true);
            echo '<div class="total-shares"><em>'.ever_share_count().'</em><div class="caption">'. esc_html__('Shares', 'ever') .'</div></div>';
            echo '<div class="entry-share" data-ajaxurl="'.esc_url(home_url('/')).'" data-id="'.esc_attr(get_the_id()).'">';
                echo '<a class="facebook" href="' . esc_url(get_permalink()) . '" title="Share this"><i class="ion-social-facebook"></i><span>'. esc_html__('Share on Facebook', 'ever') .'</span></a>';
                echo '<a class="twitter" href="' . esc_url(get_permalink()) . '" title="Tweet" data-title="' . esc_attr(get_the_title()) . '"><i class="ion-social-twitter"></i><span>'. esc_html__('Share on Twitter', 'ever') .'</span></a>';
                echo '<div class="ext-share">';
                    echo '<a class="google" href="' . esc_url(get_permalink()) . '" title="Share"><i class="ion-social-googleplus"></i></a>';
                    echo '<a class="linkedin" href="' . esc_url(get_permalink()) . '" title="Share" data-title="' . esc_attr(get_the_title()) . '"><i class="ion-social-linkedin"></i></a>';
                    echo '<a class="pinterest" href="' . esc_url(get_permalink()) . '" title="Pin It" data-title="' . esc_attr(get_the_title()) . '" data-image="' . esc_attr($post_image['url']) . '"><i class="ion-social-pinterest"></i></a>';
                echo '</div>';
                echo '<div class="share-toggle header"><i class="ion-plus-round"></i><i class="ion-minus-round"></i></div>';
            echo '</div>';
        }
    }
}

if (!function_exists('ever_author')) {
    function ever_author(){ 
        $description = get_the_author_meta('description');
        if ($description != ''){ ?>
        <div class="tw-author-box">
            <div class="author-box">
                <?php
                $tw_author_email = get_the_author_meta('email');
                echo get_avatar($tw_author_email, $size = '100');
                ?>
                <h3><?php
                    if (is_author()){
                        the_author();
                    }else{
                        the_author_posts_link();
                    } ?>
                </h3>
                <?php
                echo '<p>';
                    echo esc_html($description);
                echo '</p>';
                $socials = get_the_author_meta('user_social');
                if(!empty($socials)){
                    echo '<div class="author-entry-share">';
                    $social_links=explode("\n",$socials);
                    foreach($social_links as $social_link){
                        $icon = ever_social_icon(esc_url($social_link));
                        echo '<a href="'.esc_url($social_link).'"><i class="'.esc_attr($icon).'"></i></a>';
                    }
                    echo '</div>';
                } ?>
            </div>
        </div><?php
        }
    }
}

if (!function_exists('ever_comment_form')) {
    function ever_comment_form($fields) {
        global $id, $post_id;
        if (null === $post_id)
            $post_id = $id;
        else
            $id = $post_id;

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ( $req ? " aria-required='true'" : '' );

        $fields = array(
            'author' => '<p class="comment-form-author">' .
            '<input id="author" name="author" placeholder="' . esc_html__('Name *', 'ever') . '" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />' . '</p>',
            'email' => '<p class="comment-form-email">' .
            '<input id="email" name="email" placeholder="' . esc_html__('Email *', 'ever') . '" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />' . '</p>',
            'url' => '<p class="comment-form-url">' .
            '<input id="url" name="url" placeholder="' . esc_html__('Website', 'ever') . '" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />' . '</p><div class="clearfix"></div>',
        );
        return $fields;
    }
    add_filter('comment_form_default_fields', 'ever_comment_form');
}

if (!function_exists('ever_comment')) {
    function ever_comment($comment, $args, $depth){
        $GLOBALS['comment'] = $comment;?>
        <div <?php comment_class();?> id="comment-<?php comment_ID(); ?>">
            <div class="comment-author">
                <?php echo get_avatar($comment, $size = '60'); ?>
            </div>
            <div class="comment-text">
                <h3 class="author"><?php echo get_comment_author_link(); ?></h3>
                <span class="tw-meta"><?php echo get_comment_date('F j, Y'); ?></span>
                <?php comment_text() ?>
                <h6 class="reply"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></h6>
            </div><?php
    }
}

if (!function_exists('ever_comment_count')) {
    function ever_comment_count() {
        if (comments_open()) {
            $comment_count = get_comments_number('0', '1', '%');
            if ($comment_count == 0) {
                $comment_trans = esc_html__('no comment', 'ever');
            } elseif ($comment_count == 1) {
                $comment_trans = esc_html__('1 comment', 'ever');
            } else {
                $comment_trans = $comment_count . ' ' . esc_html__('comments', 'ever');
            }
            return "<span class='comment-count'><a href='" . esc_url(get_comments_link()) . "' title='" . esc_attr($comment_trans) . "'>" . esc_html($comment_trans) . "</a></span>";
        }
    }
}
function ever_cats($sep = ', '){
    $cats = '';
    foreach((get_the_category()) as $category) {
        $options = get_option("taxonomy_".$category->cat_ID);
        if (!isset($options['featured']) || !$options['featured']){
            $cats .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( 'View all posts in %s', 'ever' ), $category->name ) . '" ' . '>'  . $category->name.'</a><span>'.$sep.'</span>';
        }
    }
    if(!$cats && is_search()){
        $cats = '<a href="' . get_permalink() . '">' . esc_html__('Page', 'ever') . '</a>';
    }
    return $cats;
}
if (!function_exists('hosugar_categories_postcount')){
	function hosugar_categories_postcount($variable) {
		$pos = strpos($variable, '<option');
		if (!$pos) {
			$variable = str_replace('(', '<span class="post-count">(', $variable);
			$variable = str_replace(')', ')</span>', $variable);
		}
		return $variable;
	}
}
add_filter('wp_list_categories', 'hosugar_categories_postcount');
add_filter('get_archives_link', 'hosugar_categories_postcount');

if (!function_exists('ever_post_share')) {
    function ever_post_share() {
        $output = '<div class="tw_post_sharebox clearfix">';
            $output .= '<span class="share-text">'.esc_html__('Share this Post', 'ever').'</span>';
            $post_title = get_the_title();
            $output .= '<div class="sharebox-icons">';
                $output .= '<div class="google"><a href="' . esc_url(get_permalink()) . '" title="Share this"><i class="ion-social-googleplus"></i></a></div>';
                $output .= '<div class="twitter-share"><a href="' . esc_url(get_permalink()) . '" title="Tweet" data-title="' . esc_attr($post_title) . '"><i class="ion-social-twitter"></i></a></div>';
                $output .= '<div class="facebook-share"><a href="' . esc_url(get_permalink()) . '" title="Share this"><i class="ion-social-facebook"></i></a></div>';
            $output .= '</div>';
        $output .= '</div>';
        echo balanceTags($output);
    }
}

if(!function_exists('ever_origshare_count')){
    function ever_origshare_count($socials = array('facebook', 'twitter', 'pinterest')){
        $count = 0;
        foreach($socials as $social){
            if($social == 'facebook'){
                $url = get_permalink();
                $contents=false;
                try {
                    $contents = wp_remote_get('http://graph.facebook.com/?id='.$url);
                } catch(Exception $e) {
                    $s_count = 0;
                }
                if(is_array($contents)&&isset($contents['body'])) {
                        $json = json_decode($contents['body']);
                        $s_count = isset($json->share->share_count) ? $json->share->share_count : 0;
                } else {
                        $s_count = 0;
                }
            } elseif($social == 'pinterest') {
                $contents=false;
                $url = get_permalink();
                try {
                    $contents = wp_remote_get('http://widgets.pinterest.com/v1/urls/count.json?source=6&url='.$url);
                } catch(Exception $e) {
                    $s_count = 0;
                }
                if(is_array($contents)&&isset($contents['body'])) {
                        $contents['body']=str_replace(array('receiveCount(',')'),'',$contents['body']);
                        $json = json_decode($contents['body']);
                        $s_count = isset($json->count) ? $json->count : 0;
                } else {
                        $s_count = 0;
                }
            } elseif($social == 'twitter'){
                global $post;
                $s_count = get_post_meta($post->ID, 'post_twitter', true);
            }
            $count += intval($s_count, 10);
        }
        return $count;
    }
}

if (!function_exists('ever_share_count')){

    function ever_share_count($socials = array('facebook', 'twitter', 'pinterest')){
        global $post;       
        $count = 0;
        foreach($socials as $social){
            $s_count = get_post_meta($post->ID, 'post_' . $social, true);
            $count += intval($s_count, 10);
        }
        return intval($count, 10);
    }

}
if (isset($_REQUEST['social_pid']) && isset($_REQUEST['social_name'])){
    $pid = intval($_REQUEST['social_pid']);
    update_post_meta($pid, 'post_' . $_REQUEST['social_name'], get_post_meta($pid, 'post_' . $_REQUEST['social_name'], true) + 1);
    die;
}

function ever_social_link($social){
    if(!empty($social)){
        $icon = ever_social_icon(esc_url($social));
        return '<a href="'.esc_url($social).'"><i class="'.esc_attr($icon).'"></i></a>';
    }    
}

function ever_social_name($url){
    if(strpos($url,'twitter.com') > -1) { return 'twitter';}
    if(strpos($url,'linkedin.com') > -1){ return 'linkedin';}
    if(strpos($url,'facebook.com') > -1){ return 'facebook';}
    if(strpos($url,'delicious.com') > -1){ return 'delicious';}
    if(strpos($url,'codepen.io') > -1){ return 'codepen';}
    if(strpos($url,'github.com') > -1){ return 'github';}
    if(strpos($url,'wordpress.org') > -1 || strpos($url,'wordpress.com') > -1){ return 'wordpress';}
    if(strpos($url,'youtube.com') > -1){ return 'youtube';}
    if(strpos($url,'behance.net') > -1){ return 'behance';}
    if(strpos($url,'pinterest.com') > -1){ return 'pinterest';}
    if(strpos($url,'foursquare.com') > -1){ return 'foursquare';}
    if(strpos($url,'soundcloud.com') > -1){ return 'soundcloud';}
    if(strpos($url,'dribbble.com') > -1){ return 'dribbble';}
    if(strpos($url,'instagram.com') > -1){ return 'instagram';}
    if(strpos($url,'plus.google') > -1){ return 'googleplus';}
    if(strpos($url,'vine.co') > -1){ return 'vine';}
    if(strpos($url,'twitch.tv') > -1){ return 'twitch';}
    if(strpos($url,'telegram.com') > -1){ return 'telegram';}
    if(strpos($url,'tumblr.com') > -1){ return 'tumblr';}
    if(strpos($url,'trello.com') > -1){ return 'trello';}
    if(strpos($url,'spotify.com') > -1){ return 'spotify';}
    
    return 'newsfeed';
}
function ever_social_icon($url){
    if(strpos($url,'twitter.com') > -1) { return 'ion-social-twitter';}
    if(strpos($url,'linkedin.com') > -1){ return 'ion-social-linkedin';}
    if(strpos($url,'facebook.com') > -1){ return 'ion-social-facebook';}
    if(strpos($url,'delicious.com') > -1) { return 'fa-delicious';}
    if(strpos($url,'codepen.io') > -1){ return 'ion-social-codepen';}
    if(strpos($url,'github.com') > -1){ return 'ion-social-github';}
    if(strpos($url,'wordpress.org') > -1 || strpos($url,'wordpress.com') > -1){ return 'ion-social-wordpress';}
    if(strpos($url,'youtube.com') > -1){ return 'ion-social-youtube';}
    if(strpos($url,'behance.net') > -1) { return 'fa-behance';}
    if(strpos($url,'pinterest.com') > -1){ return 'ion-social-pinterest';}
    if(strpos($url,'foursquare.com') > -1){ return 'ion-social-foursquare';}
    if(strpos($url,'soundcloud.com') > -1) { return 'fa-soundcloud';}
    if(strpos($url,'dribbble.com') > -1){ return 'ion-social-dribbble';}
    if(strpos($url,'instagram.com') > -1){ return 'ion-social-instagram';}
    if(strpos($url,'plus.google') > -1){ return 'ion-social-googleplus';}
    if(strpos($url,'vine.co') > -1) { return 'fa-vine';}
    if(strpos($url,'twitch.tv') > -1){ return 'ion-social-twitch';}
    if(strpos($url,'telegram.com') > -1){ return 'ion-paper-airplane';}
    if(strpos($url,'tumblr.com') > -1){ return 'ion-social-tumblr';}
    if(strpos($url,'apple.com') > -1){ return 'ion-social-apple';}
    if(strpos($url,'google.com') > -1){ return 'ion-social-android';}
    if(strpos($url,'microsoft.com') > -1){ return 'ion-social-windows';}
    if(strpos($url,'spotify.com') > -1) { return 'fa-spotify';}
    if(strpos($url,'snapchat.com') > -1) { return 'ion-social-snapchat';}
    
    return 'ion-social-rss';
}
function ever_social_name_from_url($social_link,$option){
    return trim(str_replace(array_merge(array('https:','http:','www.','/'),$option), '',$social_link));
}
function ever_social_icons(){
    $socials = ever_option("socials");
    if(!empty($socials)){
        $output = '<div class="social-icons">';
        foreach($socials as $social){ $output .= ever_social_link(esc_url($social)); }
        $output .= '</div>';
        return $output;
    }
}

function ever_footer_socials($sub = false){
    $socials = ever_option("socials");
    if(!empty($socials)){
        $output = '<div class="entry-share clearfix">';
        if($sub){
            foreach($socials as $social){ 
                if(!empty($social['href']) && !empty($social['name'])){
                    $icon = ever_social_icon(esc_url($social['href']));
                    $text = !empty($social['subtext'])  ? ('</span><span>'.esc_attr($social['subtext'])) : '';
                    $output .= '<div class="social-item"><a class="tw-meta" href="'.esc_url($social['href']).'"><i class="'.esc_attr($icon).'"></i><span>'.esc_attr($social['name']).$text.'</span></a></div>';
                }     
            }
        } else {
            foreach($socials as $social){ 
                if(!empty($social['href']) && !empty($social['name'])){
                    $icon = ever_social_icon(esc_url($social['href']));
                    $output .= '<div class="social-item"><a class="tw-meta '.str_replace('ion-', '', esc_attr($icon)).'" href="'.esc_url($social['href']).'"><i class="'.esc_attr($icon).'"></i><span>'.esc_attr($social['name']).'</span></a></div>';
                }     
            }
        }
        
        $output .= '</div>';
        return $output;
    }
}

function ever_related_posts($posts_per_page) {
    global $post;
    
    if (!empty($posts_per_page) && $categories = get_the_category($post->ID)) {
        $category_ids = array();

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => $posts_per_page, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1
	);
        $atts['img_size'] = 'ever_grid_thumb';
        $my_query = new wp_query( $args );
	if( $my_query->have_posts() ) { ?>
            <div class="related-posts">
                <h4><?php esc_html_e('Related posts', 'ever'); ?></h4>
                <div class="row">
		<?php while( $my_query->have_posts() ) {
			$my_query->the_post();?>
                        <div class="col-md-6">
                            <div class="related-item">
                                <?php 
                                    $format = get_post_format();
                                    echo ever_entry_media($format, $atts);
                                    
                                    echo '<div class="entry-cats">'.ever_cats().'</div>';
                                    echo '<h2 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h2>'; 
                                    if(ever_option('single_meta', true)){
                                        echo '<div class="tw-meta"><span class="entry-author">'.esc_html__('by', 'ever').'&nbsp;';
                                            the_author_posts_link();  
                                            echo '</span><span class="entry-date"><a href="'.esc_url(get_permalink()).'">'.get_the_time(get_option('date_format')).'</a></span>';
                                            echo ever_comment_count();
                                        echo '</div>';
                                    }
                                    
                                ?>
                            </div>
                        </div>
		<?php
		}
		echo '</div>';
            echo '</div>';
	}
        wp_reset_postdata();
    }
}

function ever_seen_add(){
    global $post;
    $seen = get_post_meta($post->ID,'post_seen',true);
    $seen = intval($seen)+1;
    update_post_meta($post->ID,'post_seen',$seen);
}
function ever_seen_count(){
    global $post;
    $seen = get_post_meta($post->ID,'post_seen',true);
    return (empty($seen)?0:$seen);    
}

// Hex To RGB
function ever_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    return implode(",", $rgb); // returns the rgb values separated by commas
}

add_filter( 'wp_get_attachment_image_attributes', 'ever_image_attr',10,3);
function ever_image_attr($attr,$attachment,$size){
    global $_wp_additional_image_sizes;
    if (!empty($attachment->post_mime_type) && $attachment->post_mime_type === 'image/gif' && isset($attachment->guid)){
        $width=$height=0;
        if(is_array($size)){
            list($width,$height)=$size;
        }elseif(is_string($size)&&isset($_wp_additional_image_sizes[$size])){
            $width=$_wp_additional_image_sizes[$size]['width'];
            $height=$_wp_additional_image_sizes[$size]['height'];
        }else{
            $width =get_option($size.'_size_w');
            $height=get_option($size.'_size_h');
        }
        $attr['data-animated_src'] = $attachment->guid;
        $attr['data-width']  = $width;
        $attr['data-height'] = $height;
        $attr['onload'] = 'loadGifImage(this)';
        $attr['class'].=' ever-gif';        
        if($attr['src']===$attachment->guid){
            $img=wp_get_attachment_image_src($attachment->ID,'thumb');
            if(isset($img[0])){
                $attr['src']=$img[0];
            }
        }
    }
    return $attr;
}