<!-- Start Header -->
<header class="header-area">
    <div class="tw-menu-container">
        <div class="tw-header-meta">
            <?php echo ever_logo(); ?>
        </div>
        
            <?php if(ever_option('header_search')){ ?>
                <nav class="tw-menu">
                    <?php ever_menu(); ?>
                </nav>
                <div class="tw-header-meta">
                        <?php echo balanceTags('<form method="get" class="searchform" action="' . esc_url(home_url('/')) . '" ><div class="input"><input type="text" value="' . get_search_query() . '" name="s" placeholder="' . ever_option('text_search', esc_html__('Search...', 'ever')) . '" /><i class="ion-search tw-search-icon"></i></div></form>'); ?>            
                    <div class="nav-icon tw-modal-btn" data-modal=".tw-mobile-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            <?php }
            else { ?>
                <nav class="tw-menu">
                    <?php ever_menu(); ?>
                    <div class="nav-icon tw-modal-btn" data-modal=".tw-mobile-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </nav>
            <?php }?>
    </div>
    <div class="header-clone"></div>
</header>