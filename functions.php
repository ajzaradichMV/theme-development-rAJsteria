<?php
//* It starts here *//
use Mediavine\Trellis\Init;
use WP_Widget;

// Load some styles 
wp_enqueue_style( 'style', get_stylesheet_uri() );

/* TODO: Remove Trellis CSS
 * For faster development, let's just roll with Trellis' included CSS for now. I'll want to go back and focus a lot on the base CSS for the theme
 * to be sure that I'm not going to be loading a bunch of unnecessary CSS from Trellis. 
 */

add_filter( 'mv_trellis_enqueue_main_style', '__return_false' );

// Load in some fonts
function addFonts() {
	
	wp_enqueue_style( 'addFonts', 'https://fonts.googleapis.com/css2?family=Montserrat&display=swap,400italic,700italic,400,700,300', false ); 
	wp_enqueue_style( 'ptSans', 'https://fonts.googleapis.com/css2?family=Montserrat&family=PT+Sans:wght@400;700&display=swap', false ); 
	
}
 add_action( 'wp_enqueue_scripts', 'addFonts' );



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


function child_class() {
	
	if (is_home()) {
		$class[] = 'home';
	}
	
	$class[] = 'news-theme-trellis';
	
	return $class;
	
}
add_filter('body_class', 'child_class');

/**
 * Register our widget areas in the theme
 *
 */

function register_the_widget_areas($name, $description, $id, $before_widget, $after_widget, $before_title, $after_title) {

	register_sidebar( array(
		'name'          => $name,
		'description'   => $description,
		'id'            => $id,
		'before_widget' => $before_widget,
		'after_widget'  => $after_widget,
		'before_title'  => $before_title,
		'after_title'   => $after_title,
	) );

}

function add_news_widgets() {
	
	$widget_open = '';
	$widget_close = '';
	$title_open = '';
	$title_close = '';
	
	register_the_widget_areas('Below latest home top left', 'Left widget area for the homepage beneath the Latest Post/News banner', 'home_top_left', $widget_open, $widget_close, $title_open, $title_close);
	
	register_the_widget_areas('Below latest home top mid', 'Middle widget area for the homepage beneath the Latest Post/News banner', 'home_top_mid', $widget_open, $widget_close, $title_open, $title_close);
	
	register_the_widget_areas('Below latest home top right', 'Right widget area for the homepage beneath the Latest Post/News banner', 'home_top_right', $widget_open, $widget_close, $title_open, $title_close);
	
}

add_action( 'widgets_init', 'add_news_widgets' );

/**
 *
 * Register the custom widgets.
 *
 */

require_once get_stylesheet_directory() . '/inc/classes/class-widgets.php';

add_action( 'widgets_init', function(){
     register_widget( 'NewsTheme\Latest_Posts_Widget' );
});

/**
 *
 * Create our 4x3 (1200x900) portrait images.
 *
 */

function trellis_child_portrait_images() {
	add_image_size('portrait-thumb', 1200, 900, true); // Cropped images for homepage thumbnails so they're portrait :D
}
add_action( 'after_setup-theme', 'trellis_child_portrait_images');