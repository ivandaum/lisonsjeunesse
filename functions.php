<?php


require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/config/config.php');

new Lisonsjeunesse\Core\Ajax();

add_theme_support( 'post-thumbnails' );

register_nav_menus([
    'header' => 'Header',
    'footer' => 'Footer',
]);

add_image_size( '1x1', 1, 1 );
add_image_size( 'phone-xs', 360, 0 );
add_image_size( 'phone-s', 500, 0 );
add_image_size( 'phone', 768, 0 );
add_image_size( 'desktop', 1000, 0 );
add_image_size( 'widescreen', 1280, 0 );
add_image_size( 'max', 1600, 0 );

add_filter('jpeg_quality', function($arg) {
    return 100;
});

add_filter('upload_mimes', function($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
});

function debug($var) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    die;
}

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


add_action('wp_enqueue_scripts', function() {
    wp_deregister_script('jquery');
}); 


add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}