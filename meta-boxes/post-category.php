<?php

/**
 * Simple example of a metabox.
 * 
 * We have posts where we can display posts from other categories.
 * If we want that, we'll need to choose from which category to display.
 *
 * This is just the metabox snippet, not the whole solution.
 */

add_action( 'add_meta_boxes', 'my_metabox_registration' );

/**
 * Register the metabox
 */
function my_metabox_registration() {
  
  // Change 'post' to your custom post type
  add_meta_box( 'my-posts-categories', __( 'Posts Categories', 'mydomain' ), 'my_metabox_category_display', 'post' ); 
}

/**
 * Display the fields to choose categories
 *
 * @param \WP_Post $post.
 */
function my_metabox_category_display( $post ) {
  $chosen_category = get_post_meta( $post->ID, 'my_category', true );
  $all_categories  = get_categories(); // We want all categories with posts (default: hide_empty => false).
  
  // No categories? Return early.
  if ( ! $all_categories ) {
    echo '<p>' . esc_html__( 'No Categories with posts found. Please add posts to categories first.', 'mydomain' ) . '</p>';
    return;
  }
  // For security reasons.
  wp_nonce_field( 'my_post_category_nonce', 'my_category_nonce' );
  ?>
  <div class="my-field-class">
    <label for="my_post_category"><?php esc_html_e( 'Under Post Category:', 'mydomain' ); ?></p>
    <select name="my_post_category" id="my_post_category">
      <option value="0"><?php esc_html_e( 'Select a category', 'mydomain' ); ?></option>
      <?php
      foreach( $all_categories as $category ) {
        <option
          <?php selected( $category->term_id, $chosen_category, true ); ?> 
          value="<?php echo esc_attr( $category->term_id ); ?>">
          
          <?php echo esc_html( $category->name ); ?>
          
        </option>
      }
      ?>
    </select>
  </div>
  <?php
}

add_action( 'save_post', 'my_metabox_category_save', 20, 2 );

/**
 * Save Category to Post
 */
function my_metabox_category_save( $post_id, $post ) {
  if ( 'post' !== get_post_type( $post ) ) {
    return;
  }
  
  // Our nonce have not been posted.
  if ( ! isset( $_POST['my_category_nonce'] ) ) {
    return;
  }
  
  if ( ! isset( $_POST['my_post_category'] ) ) {
    return;
  }
  
  // Nonce not verified.
  if ( ! wp_verify_nonce( $_POST['my_category_nonce'], 'my_post_category_nonce' ) ) {
    return;
  }
 
  $category = absint( $_POST['my_post_category'] );
  update_post_meta( $post_id, 'my_category', $category );
}
