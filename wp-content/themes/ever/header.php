<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <?php ever_favicon(); ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php $header = ever_option('header'); ?>
        <div class="tw-mobile-menu">
            <?php echo ever_logo(true); ?>
            <nav><?php ever_mobilemenu(); ?></nav>
            <?php 
                if ( is_active_sidebar( 'mobile-sidebar' )  ) :
                    dynamic_sidebar('mobile-sidebar'); 
                endif; 
            ?>
        </div>
        <div class="tw-mdl-overlay-close"></div>
        <div class="theme-layout">
            <?php
                get_template_part('header-area', ever_option('header_layout'));
                get_template_part('feature', 'area');
            ?>
            <!-- Start Main -->
            <div class="ever-container container">