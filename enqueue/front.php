<?php

add_action( 'enqueue_scripts', 'my_enqueue_scripts' );

define( 'MAIN_PLUGIN_FILE', __FILE__ ); // This is in the main plugin file.

/**
* Enqueueing a Plugin File on Front End.
*/
function my_enqueue_scripts() {
  $path = trailingslashit( plugin_dir_url( MAIN_PLUGIN_FILE ) ) . 'assets/js/public.js';
  
  $dependencies = [ 'jquery' ]; // This plugin's javascript relies on jQuery.
  
  // Version is a file timestamp. When file changes, version changes.
  $version = filemtime( trailingslashit( plugin_dir_path( MAIN_PLUGIN_FILE ) ) . 'assets/js/public.js' );
  
   
  // A Plugin JS file, 
  wp_enqueue_script( 'my-handle', $path, $dependencies, $version, true ); // True to be enqueued in footer
  
  wp_localize_script( 'my-handle', 'myhandle', [
     'ajaxurl' => admin_url( 'admin-ajax.php' )
  ]);
  // This will make AJAX URL available in JS as myhandle.ajaxurl
}
