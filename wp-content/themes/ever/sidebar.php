<?php if ( is_active_sidebar( 'default-sidebar' )  ) : ?>
<div class="sidebar-area col-md-4">
    <div class="sidebar-inner">
        <?php dynamic_sidebar('default-sidebar'); ?>
    </div>
</div>
<?php endif; ?>