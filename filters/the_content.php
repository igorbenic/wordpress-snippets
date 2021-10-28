<?php

/**
 * Showing custom content below the post
 * Scenario: We need to display posts from a category below the post's content.
 */

add_filter( 'the_content', 'show_category_posts_below_content', 99 );

function show_category_posts_below_content( $content ) {

  // Only on single post pages.
  if ( ! is_singular( 'post' ) ) {
    return $content;
  }
  
  // Getting the current gueried object, in case we are inside a custom loop
  $current_main_object = get_queried_object();
  
  if ( ! is_a( $current_main_object, 'WP_Post' ) ) {
    return $content;
  }
  
  $current_post = get_post();
  
  if ( $current_post->ID !== $current_main_object->ID ) {
    return $content; // We are inside of a custom loop, and this is not the content we want.
  } 
  
  $category_terms = get_the_terms( $current_post, 'category' );
  
  if ( ! $category_terms ) {
    return $content;
  }
  
  $term_ids = wp_list_pluck( $category_terms, 'term_id' ); // Get array of Term IDs.
  $related_posts = get_posts(array(
    'post_status' => 'publish',
    'post_type'   => 'post',
    'numberposts' => 3, // 3 Related posts
    'category'    => implode( ',', $term_ids ), // Convert array to string, example: 1,2,3
  ));
  
  if ( ! $related_posts ) {
    return $content;
  }
  
  // This is a dummy function here. This function should return html, not echo it.
  $content .= your_function_to_render_posts_and_return_html( $related_posts );
  
  return $content;
}
