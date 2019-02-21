<!-- Start Header -->
<header class="header-area layout-2">
    <?php echo ever_logo(); ?>
    <div class="tw-menu-container">
        <div class="container">
            <nav class="tw-menu">
                <?php ever_menu(); ?>
                <?php if (ever_option('header_search')) { ?>
                    <div class="tw-header-meta with-search">
                        <div class="nav-icon tw-modal-btn" data-modal=".tw-mobile-menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <?php echo balanceTags('<form method="get" class="searchform" action="' . esc_url(home_url('/')) . '" ><div class="input"><input type="text" value="' . get_search_query() . '" name="s" placeholder="' . ever_option('text_search', esc_html__('Search...', 'ever')) . '" /><i class="ion-search tw-search-icon"></i></div></form>'); ?>            
                    </div>
                <?php } else { ?>
                    <div class="tw-header-meta">
                        <div class="nav-icon tw-modal-btn" data-modal=".tw-mobile-menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                <?php } ?>
            </nav>
        </div>
    </div>
    <div class="header-clone"></div>
</header>