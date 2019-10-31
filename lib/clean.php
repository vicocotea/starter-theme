<?php

add_action( 'after_setup_theme', function() {

    remove_action('rest_api_init',          'wp_oembed_register_route');
    remove_filter('oembed_dataparse',       'wp_filter_oembed_result', 10);
    remove_action('wp_head',                'wp_oembed_add_discovery_links');
    remove_action('wp_head',                'wp_oembed_add_host_js');
    remove_action('wp_head',                'wlwmanifest_link');
    remove_action('wp_head',                'wp_shortlink_wp_head');
    remove_action('wp_head',                'rsd_link');
    remove_action('wp_head',                'wp_resource_hints', 2 );
    
    add_theme_support('soil-clean-up');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-relative-urls');
    add_theme_support('soil-disable-asset-versioning');
    add_theme_support('soil-disable-trackbacks');
    // add_theme_support('soil-google-analytics', 'UA-XXXXXX-Y');
    // add_theme_support('soil-js-to-footer');
  
}, 99 );


/**
* Remove hentry from post_class
*/
function isa_remove_hentry_class( $classes ) {
    $classes = array_diff( $classes, array( 'hentry' ) );
    return $classes;
}
add_filter( 'post_class', 'isa_remove_hentry_class' );

add_filter('show_admin_bar', '__return_false');