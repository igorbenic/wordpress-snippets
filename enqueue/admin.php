<?php

add_action( 'admin_enqueue_scripts', 'my_admin_enqueue_scripts' );

define( 'MAIN_PLUGIN_FILE', __FILE__ ); // This is in the main plugin file.

/**
* Enqueueing a Plugin File on Admin.
* 
* @param string $hook Hook provided by the enqueue script on admin. Usually relates to the current page, combined with $_GET['page'] and such.
*                     Make sure to use var_dump or xdebug to find out the hook on the current page you're viewing in admin.
*/
function my_admin_enqueue_scripts( $hook ) {
  // This global is useful when checking the current post or a new post.
  global $post;
  
  // Example: We are enqueuing our scripts only on the edit page of a post type.
  if ( 'edit.php' !== $hook ) {
    return;
  }
  
  // Example: We are enqueuing our scripts only on posts.
  if ( 'post' !== get_post_type( $post ) ) {
    return;
  }
  
  $path = trailingslashit( plugin_dir_url( MAIN_PLUGIN_FILE ) ) . 'assets/js/admin.js';
  
  $dependencies = [ 'jquery' ]; // This plugin's javascript relies on jQuery.
  
  // Version is a file timestamp. When file changes, version changes.
  $version = filemtime( trailingslashit( plugin_dir_path( MAIN_PLUGIN_FILE ) ) . 'assets/js/admin.js' );
  
   
  // A Plugin JS file, 
  wp_enqueue_script( 'my-handle', $path, $dependencies, $version, true ); // True to be enqueued in footer
  
}
