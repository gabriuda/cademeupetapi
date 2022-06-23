<?php 

// remove_action('rest_api_init', 'create_initial_rest_routes', 99);

add_filter('rest_endpoints', function ($endpoints) {
  unset($endpoints['/wp/v2/users']);
  unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
  return $endpoints;
});

$dirbase = get_template_directory();
require_once $dirbase . '/endpoints/user_post.php';
require_once $dirbase . '/endpoints/user_get.php';
require_once $dirbase . '/endpoints/user_put.php';

require_once $dirbase . '/endpoints/pet_post.php';
require_once $dirbase . '/endpoints/pet_delete.php';
require_once $dirbase . '/endpoints/pet_get.php';

update_option('large_size_w', 1000);
update_option('large_size_h', 1000);
update_option('large_crop', 1);

function change_api() {
  return 'json';
} 
add_filter('rest_url_prefix', 'change_api');

function expire_token() {
  return time() + (60 * 60 * 24);
}
add_action('jwt_auth_expire', 'expire_token');

?>