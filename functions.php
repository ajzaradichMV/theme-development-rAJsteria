<?php
//* It starts here *//
use Mediavine\Trellis\Init;

// Load some styles 
wp_enqueue_style( 'style', get_stylesheet_uri() );

/* TODO: Remove Trellis CSS
 * For faster development, let's just roll with Trellis' included CSS for now. I'll want to go back and focus a lot on the base CSS for the theme
 * to be sure that I'm not going to be loading a bunch of unnecessary CSS from Trellis. 
 */

add_filter( 'mv_trellis_enqueue_main_style', '__return_false' );

// Load in some fonts
function addFonts() {
    wp_enqueue_style( 'addFonts', 'https://fonts.googleapis.com/css2?family=Fredoka+One:300italic&display=swap,400italic,700italic,400,700,300', false ); 
}
 add_action( 'wp_enqueue_scripts', 'addFonts' );

// Add in Kraken JS
wp_enqueue_script( 'kraken-theme.js', get_stylesheet_directory_uri() . '/js/kraken-theme.js');

add_filter( 'mv_trellis_settings', 'add_trellis_settings' );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int modified excerpt length.
 */
function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



           



