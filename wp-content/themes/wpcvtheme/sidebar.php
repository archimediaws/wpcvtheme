<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpcvtheme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area slidebar " role="complementary">
	<?php 
	sam_martin_single_post_author_info();	
	dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->