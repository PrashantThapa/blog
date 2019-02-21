<?php

// Insert your Customization Functions. Read More - http://codex.wordpress.org/Child_Themes

add_action( 'wp_enqueue_scripts', 'ever_child_styles',15 );
function ever_child_styles() {
    wp_enqueue_style( 'ever-child-style', get_stylesheet_directory_uri() . '/style.css' );
}