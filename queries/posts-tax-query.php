<?php
/**
 * We have Post Type: books
 * Books have a taxonomy: book_category
 * Books have a taxonomy: book_tag
 * We need: 10 Books that are from category 'scifi' and have tags: 'robots' or 'artificial'
 */

/**
* Retrieving Regular Posts
* 
* All possible query attributes: https://developer.wordpress.org/reference/classes/wp_query/parse_query/
*/
$posts = get_posts([
  'post_type'   => 'books',
  'numberposts' => 10, // Get 10 books
  'post_status' => 'publish', // that are published
  'tax_query' => array(
        array(
            'taxonomy' => 'book_category', 
            'field'   => 'slug',
            'terms' => array( 'scifi' )
        ),
        array(
            'taxonomy' => 'book_tag',  
            'field'   => 'slug',
            'terms' => array( 'robots', 'artificial' )
        ),
    ) 
]);
