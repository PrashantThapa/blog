<?php 
the_post();
get_header();
ever_seen_add();

global $ever_options;

$layout = ever_metabox('single_layout');
if(empty($layout)){
    $layout = ever_option('single_layout', 'right-sidebar');
}

$width = ' col-md-8';
if($layout == 'fullwidth-content'){
    $width = ' col-md-12';
}
$format = get_post_format() == "" ? "standard" : get_post_format();

$single_ads = ever_option('ads-single');
if(!empty($single_ads)){
    echo '<div class="tw-ads ads-single-top">';
    echo do_shortcode($single_ads);
    echo '</div>';
}
if($ever_options['single_media'] == 'large'){
    $atts['img_size'] = 'ever_blog_large';
    $img = ever_entry_media($format, $atts);
    echo '<div class="single-content single-large-media'.(!empty($img) ? ' with-media': '').'">';
        ever_single_title();
        ever_single_share();
        echo ($img);
    echo '</div>';
}
?>
<div class="row"> 
    <?php if($layout == 'left-sidebar'){ get_sidebar(); }?>
    <div class="content-area <?php echo esc_attr($layout.$width);?>">
        <div class="single-content">
            <article <?php post_class('single'); ?>>
                <?php 
                if($ever_options['single_media'] == 'small'){
                    ever_single_title();
                    ever_single_share();
                    $atts['img_size'] = 'ever_single_post';
                    echo ever_entry_media($format, $atts);
                }
                ?>    
                <div class="single-padding">
                    <?php
                        if($ever_options['single_media'] == 'none'){
                            ever_single_title();
                            ever_single_share();
                        }
                    ?>
                    <?php
                        if($ever_options['single_media'] == 'fullwidth'){
                            ever_single_share();
                        }
                    ?>
                    <div class="entry-content">
                        <?php 
                        if($ever_options['single_media'] == 'large2'){
                            ever_single_share();
                        }
                        
                        the_content(); 
                        
                        ?>
                        <?php wp_link_pages(); ?>
                        <div class="clearfix"></div>
                    </div>
                    <?php 
                    if(ever_option('single_tags', true)){
                        echo get_the_tag_list('<div class="entry-tags tw-meta">', '', '</div>');
                    }
                    ?>
                </div>
            </article>
            <div class="single-padding">
            <?php 
            if(ever_option('single_pagination', true)){
                $prev = get_adjacent_post(false,'',true) ;
                $next = get_adjacent_post(false,'',false) ; ?>
                <div class="nextprev-postlink-container">
                    <div class="nextprev-postlink clearfix">
                        <?php if ( isset($prev->ID) ):
                            $pid = $prev->ID; 
                            $img = wp_get_attachment_image_src( get_post_thumbnail_id($pid), 'ever_grid_thumb' );
                            $thumb = $class = '';
                            if($img['0']){
                                $thumb = ' style="background-image: url('.esc_url($img['0']).')"';
                                $class = ' with-img';
                            } ?>
                            <div class="prev-post-link<?php echo esc_attr($class); ?>">
                                <?php
                                    if(!empty($thumb)){
                                        echo '<a href="'. esc_url(get_permalink( $pid )) .'" title="'. get_the_title( $pid ) .'" class="post-thumb"'. $thumb .'></a>';
                                    }
                                ?>
                                <a href="<?php echo esc_url(get_permalink( $pid )); ?>" title="<?php echo get_the_title( $pid );?>"><?php echo ('<span class="tw-meta">'.esc_html__('Previous', 'ever').'</span><h4>'.get_the_title( $pid ).'</h4><span class="tw-meta">'.get_the_time(get_option('date_format'), $pid).'</span>'); ?></a>
                            </div>
                        <?php endif;
                        if ( isset($next->ID) ):
                            $pid = $next->ID; 
                            $img = wp_get_attachment_image_src( get_post_thumbnail_id($pid), 'ever_grid_thumb' );
                            $thumb = $class = '';
                            if($img['0']){
                                $thumb = ' style="background-image: url('.esc_url($img['0']).')"';
                                $class = ' with-img';
                            }?>
                            <div class="next-post-link<?php echo esc_attr($class); ?>">
                                <?php
                                    if(!empty($thumb)){
                                        echo '<a href="'. esc_url(get_permalink( $pid )) .'" title="'. get_the_title( $pid ) .'" class="post-thumb"'. $thumb .'></a>';
                                    }
                                ?>
                                <a href="<?php echo esc_url(get_permalink( $pid )); ?>"><?php echo ('<span class="tw-meta">'.esc_html__('Next', 'ever').'</span><h4>'.get_the_title( $pid ).'</h4><span class="tw-meta">'.get_the_time(get_option('date_format'), $pid).'</span>'); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php }
            if(ever_option('single_author', true)){
                ever_author(); 
            }
            comments_template('', true); 
            ever_related_posts(ever_option('related_posts'));?>
            </div>
        </div>
    </div>
    <?php if($layout == 'right-sidebar'){ get_sidebar(); }?>
</div>
<?php get_footer();