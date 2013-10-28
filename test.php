<?php
define('WP_DEBUG', true);
require './wp-load.php';

global $wpdb;

//include ('wp-admin/admin.php');
var_dump(is_admin());

echo '<pre>';

var_dump($wpdb);

echo '</pre>';