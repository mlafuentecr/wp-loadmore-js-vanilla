<?php 
// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory();

$understrap_includes = array(
'/inc/functions/load-more-fetching.php',
);

foreach ($understrap_includes as $file) {
require_once $understrap_inc_dir . $file;
}



?>
