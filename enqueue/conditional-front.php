<?php

/**
* This shows the Conditional loading on the front.
*/

add_action( 'enqueue_scripts', 'my_enqueue_scripts' );

define( 'MAIN_PLUGIN_FILE', __FILE__ ); // This is in the main plugin file.

/**
* Enqueueing a Plugin File on Front End when matching conditions.
*/
function my_enqueue_scripts() {
  global $post;
  
  // ... Check ../front.php for enqueue code.
  
  // Shortcode: [my_shortcode_tag]
  if ( $post && has_shortcode( $post->post_content, 'my_shortcode_tag' ) ) {
    // Enqueue only if a single post (any post type) has a shortcode
  }
  
  // Block
  if ( $post && has_block( $your_block_name, $post ) ) {
    // Enqueue only if a current post has the specific block
  }
  
  if ( is_single() ) {
    // Enqueue only if on a single post type (except page or attachment)
  }
  
  if ( is_single( $post_id ) ) {
    // Enqueue only for a specific post (except page or attachment)
  }
  
  if ( is_page() ) {
    // Enqueue only for a single pages
  }
  
  if ( is_page( $page_id_or_slug ) ) {
    // Enqueue only for a specific page
  }
  
  $post_types = [ 'post', 'page' ];
  if ( is_singular( $post_types ) ) {
    // Enqueue only on single pages of post and pages
  }
  
  if ( is_post_type_archive( $post_types ) ) {
    // Enqueue if we are on an archive page of posts or pages
  } 
  
  if ( is_tax( 'category' ) {
    // Enqueue if we are on the archive page of category
  }
      
  if ( is_tax( 'category', 'books' ) {
    // Enqueue if we are on the archive page of category 'books'
  }
}
