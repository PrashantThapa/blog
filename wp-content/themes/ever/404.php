<?php
get_header();
?>

<div class="row">
    <div class="content-area col-md-12">
        <div class="entry-content error-404">
            <h1 class="error-title"><?php esc_html_e('404', 'ever');?></h1>
            <h3><?php esc_html_e('Page not found.', 'ever');?></h3>
            <p class="error-desc"><?php esc_html_e('It Seems We Can\'t Find What You\'re Looking For. Perhaps Searching Can Help.', 'ever');?></p>
            <?php echo '<p class="more-link"><a href="'.esc_url(home_url('/')).'">'.esc_html__('Back Home', 'ever').'</a></p>'; ?>
        </div>
    </div>
</div>

<?php
get_footer();