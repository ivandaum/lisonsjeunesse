<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/config/config.php');

add_theme_support( 'post-thumbnails' );

add_filter('acf/settings/save_json', function( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
});

add_filter('acf/settings/load_json', function( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

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


function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


// array_sort_by_column($array, 'order');

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

new Lisonsjeunesse\Core\Ajax();