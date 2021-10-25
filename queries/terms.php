<?php

/**
 * We have a site of Books with taxonomy 'book_tag'.
 * We want to list all tags of books in order of number of books a tag has.
 * Why? People might want to see most popular books by tags
 *
 * All parameters: https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
 */

$terms = get_terms([
  'taxonomy' => 'book_tag',
  'hide_empty' => true // True by default
  'orderby' => 'count', // Order by book count
  'order'   => 'DESC', // from higher to lower count
  'number'  => 10, // Return just 10 most used tags
]);

if ( $terms ) {
  echo '<ul>';
  foreach( $terms as $term ) {
    echo '<li>';
    
      // Provide a link to the archive page of this tag.
      echo '<a href="' . esc_url( get_term_link( $term ) ) . '">'; 
    
      // Show the Term Title
      echo esc_html( $term->name ); 
    
      // Show the book count for this tag.
      echo '<span class="book-count">' . esc_html( $term->count ) . '</span>';
    
      echo '</a>';
    echo '</li>';
  }
  echo '</ul>';
}
