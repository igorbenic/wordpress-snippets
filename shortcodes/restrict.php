<?php

/**
 * Restrict Content with Shortcode
 * You can use such shortcode in the editor as:
 * "Regular content is here that is shown always, but here is the content for visitors:
 *
 * [my_restrict_content role=visitor]Visit link: link.com and join our club[/my_restrict_content]
 *
 * [my_restrict_content role=member]Here is your membership content[/my_restrict_content]
 *
 * And this the end of content."
 */

add_action( 'init', 'register_my_shortcode' );

/**
 * Register the shortcode
 */
function register_my_shortcode() {
      add_shortcode( 'my_restrict_content', 'my_restrict_content_function' );
}

/**
 * Function that'll restrict the content
 * 
 * @param array $atts Shortcode arguments
 * @param string $content Content.
 *
 * @return string
 */
function my_restrict_content_function( $atts, $content ) {
   global $post;
  
   // Default Subscriber
   $attributes = shortcode_atts( array(
        'role' => 'subscriber',
    ), $atts );
 
    // If 'role' set to 'visitor' and user not logged-in, show it.
    if ( ! is_user_logged_in() && 'visitor' === $attributes['role'] ) {
      return $content;
    }
    
    $user = wp_get_current_user();
    // Current user author of the post, show the content.
    if ( $post && $post->post_author === $user->ID ) {
      return $content;
    }
    
    // Editor or administrator, show the content.
    if ( current_user_can( 'edit_others_posts' ) ) {
      return $content;
    }
  
    $user = wp_get_current_user();
    if ( in_array( $attributes['role'], (array) $user->roles ) ) {
        return $content;
    }
  
    return '';
    
}
