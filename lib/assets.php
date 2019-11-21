<?php
/**
 * Theme assets
 */
function assets() {

  $arrContextOptions = array(
    "ssl" => array(
      "verify_peer" => false,
      "verify_peer_name" => false
      )
    );  

  // wp_dequeue_style('woocommerce-layout'); 
  // wp_deregister_script( 'comment-reply' );

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  $cssFilePath = glob( get_template_directory() . '/dist/css/main.*.css' );
  if( count( $cssFilePath ) > 0 ){    
    $cssFileURI = get_template_directory_uri() . '/dist/css/' . basename($cssFilePath[0]);
    wp_enqueue_style( 'site_main_css', $cssFileURI ); 
  }

  $jsFilePath = glob( get_template_directory() . '/dist/js/app.*.js' );
  if( count( $jsFilePath ) > 0 ){
    $jsFileURI = get_template_directory_uri() . '/dist/js/' . basename($jsFilePath[0]);
    wp_enqueue_script( 'main_js', $jsFileURI , null , null , true );
  }

  // $jsVendorsFilePath = glob( get_template_directory() . '/dist/js/vendors.*.js' );
  // if( count( $jsVendorsFilePath ) > 0 ){
  //   $jsVendorsFileURI = get_template_directory_uri() . '/dist/js/' . basename($jsVendorsFilePath[0]);
  //   wp_enqueue_script( 'vendors_js', $jsVendorsFileURI , null , null , true );
  // }

}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

/**
* Dequeue jQuery Migrate script in WordPress.
*/
function isa_remove_jquery_migrate( $scripts) {
  if( ! is_admin() ) {
    $scripts->remove( 'jquery');
    $scripts->add( 'jquery', false, array( 'jquery-core' ), '3.3.1' );
  }
}
add_filter( 'wp_default_scripts', __NAMESPACE__ . '\\isa_remove_jquery_migrate' );

function wp_dns_prefetch() {
  // echo '
  // <link rel="dns-prefetch" href="//www.google-analytics.com" />
  // <link rel="dns-prefetch" href="//cdninstagram.com" />
  // <link rel="preload" href="'.get_template_directory_uri().'/dist/fonts/mavenpro-regular.woff2" as="font" crossorigin="anonymous" type="font/woff2">
  // <link rel="preload" href="'.get_template_directory_uri().'/dist/fonts/mavenpro-medium.woff2" as="font" crossorigin="anonymous" type="font/woff2">
  // <link rel="preload" href="'.get_template_directory_uri().'/dist/fonts/mavenpro-bold.woff2" as="font" crossorigin="anonymous" type="font/woff2">
  // ';
}
add_action('wp_head', __NAMESPACE__ . '\\wp_dns_prefetch', 0);


function init_image_sizes(){

  // remove_image_size('medium_large');

  // add_image_size( 'small', 300, 0, false );
  // add_image_size( 'medium_large', 768, 0, false );
  // add_image_size( 'extra_large', 1440, 0, false );

}
add_action('init', __NAMESPACE__ . '\\init_image_sizes', 110);