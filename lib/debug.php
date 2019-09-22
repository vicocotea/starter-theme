<?php

function dump_debug( $val ){
  if( WP_ENV !== 'production' ){
    echo '<div class="debug">';
    var_dump($val);
    echo '</div>';   
  }
}

function show_debug_info(){
  global $template;
  dump_debug( $template );
  dump_debug( get_image_sizes() );
  dump_debug( get_num_queries() . ' queries in ' . timer_stop( 0 ) . ' seconds' );
}

// add_action('wp_footer', 'show_debug_info');