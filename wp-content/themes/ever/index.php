<?php get_header();
global $ever_options;
$ever_options['blog_layout'] = ever_option("blog_layout", "simple");
$ever_options['blog_excerpt'] = ever_option("blog_excerpt");
$ever_options['blog_sidebar'] = ever_option("blog_sidebar", "true");
$ever_options['pagination'] = ever_option("blog_pagination", "simple");

$width = 'col-md-8';
if($ever_options['blog_sidebar'] != 'true' || in_array($ever_options['blog_layout'], array('masonry', 'masonry-full'))){
    $width = 'col-md-12';        
}
?>
<div class="row"> 
    <div class="content-area <?php echo esc_attr($width);?>">
        <?php 
        if(in_array($ever_options['blog_layout'], array('list', 'list2', 'list-full', 'list2-full'))){
            get_template_part("content", "list");
        } elseif(in_array($ever_options['blog_layout'], array('grid', 'grid-full'))){
            get_template_part("content", "grid");
        } elseif(in_array($ever_options['blog_layout'], array('masonry', 'masonry-full'))){
            get_template_part("content", "masonry");
        } else{
            get_template_part("content");
        }        
        ?>
    </div>
    <?php 
        if($ever_options['blog_sidebar'] == 'true'){
            get_sidebar();
        }
    ?>
</div>
<?php get_footer();