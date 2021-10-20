<?php
/**
* Retrieving Regular Posts
*/
$posts = get_posts([
  'numberposts' => 10, // Get 10 posts
  'orderby'     => 'date', // by date
  'order'       => 'DESC', // newest, if searching oldest, use 'ASC'
  'post_status' => 'publish', // that are published
]);

/**
* Rendering Posts
*/
foreach( $posts as $post ) {
  // Escaping URL so we have safe URLs with esc_url()
  // Escaping post title to have only text rendered with esc_html()
  ?>
  <a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
    <?php echo esc_html( get_the_title( $post ) ); ?>
  </a>
  <?php
}
