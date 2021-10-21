<?php
/**
 * We have Post Type: books
 * Books have number of ratings (example: 30 users rated a book) -> meta_key => _ratings
 * Books have average rating (example: 4/5 stars -> 4) -> meta_key => _avg_rating
 * We need: 10 Books that have more than or equal to 20 ratings with a rating of 4 or 5
 */

/**
* Retrieving Regular Posts
* 
* All possible query attributes: https://developer.wordpress.org/reference/classes/wp_query/parse_query/
*/
$posts = get_posts([
  'post_type'   => 'books',
  'numberposts' => 20, // Get 20 books
  'post_status' => 'publish', // that are published
  'meta_query' => array(
        array(
            'key'     => '_ratings', // That have more or equal to 20 ratings
            'value'   => 20,
            'compare' => '=>',
        ),
        array(
            'key'     => '_avg_rating', // That have more or equal to 4 in average rating
            'value'   => 4,
            'compare' => '=>',
        ),
   ),
  'meta_key'    => '_avg_rating', // This is used for orderby
  'orderby'     => 'meta_value_num', // ordered by _avg_rating as a numeric value
  'order'       => 'DESC', // From highest to lowest rating
  
]);
