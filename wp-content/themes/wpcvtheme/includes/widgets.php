<?php
require_once get_template_directory().'/includes/widgets/tag-cloud.php';
require_once get_template_directory().'/includes/widgets/recent-posts.php';
function sam_martin_register_widget() {
    register_widget('WP_SamMartin_Tag_Cloud');
	register_widget('WP_SamMartin_Recent_Posts');
	
}
add_action( 'widgets_init', 'sam_martin_register_widget' );