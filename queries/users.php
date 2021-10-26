<?php

/**
 * You may need to get all users based on some arguments.
 * All arguments: https://developer.wordpress.org/reference/classes/wp_user_query/prepare_query/
 *
 * Scenario: 
 * We have a site where some parts are gamified and users earn points. 
 * Points are stored in the table usermeta with key '_points'.
 * We want to get top 10 users based on those points.
 * Only Users with the Role 'member' can be listed.
 */

$users = get_users([
  'meta_key' => '_points',
  'orderby'  => 'meta_value_num',
  'order'    => 'DESC',
  'number'   => 10,
  'role'     => 'member'
]);

if ( $users ) {
 echo '<ul class="user-dashboard">';
  foreach ( $users as $user ) {
    echo '<li>' $user->display_name . '('. $user->_points . ')</li>'; // Magic method __get will check usermeta for _points.
  }
 echo '</ul>';
}
