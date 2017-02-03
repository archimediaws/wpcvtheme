<?php
global $sam_martin_options;
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpcvtheme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr(get_bloginfo( 'charset' )); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="loading">
	<div id="loading-center">
		<div id="loading-center-absolute">
			<div class="object" id="object_one"></div>
			<div class="object" id="object_two"></div>
			<div class="object" id="object_three"></div>
			<div class="object" id="object_four"></div>
		</div>
	</div>
</div>
<?php
if($sam_martin_options['site_layout']=='layout_02'){
	$header_id='site';
}elseif($sam_martin_options['site_layout']=='layout_03'){
	$header_id='center';
}else{
	$header_id='left';
}

?>
<div id="page" class="site page-scroll-setting <?php echo esc_attr($header_id);?>-header">

	<?php if(!isset($sam_martin_options['site_layout']) || $sam_martin_options['site_layout']=='layout_01'):?>	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wpcvtheme' ); ?></a>
	<div class="menu-responsive">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><b><?php echo esc_html(get_bloginfo( 'name' ));?></b></a> 
		<a id="menu-icon" class="but" href="#"><i class="fa fa-bars" aria-hidden="true"></i> </a>
	</div>
	<?php endif; ?>
	
	<header id="<?php echo esc_attr($header_id);?>-header" class="header site-header" role="banner">
		<div class="site-branding">
			<?php
			$site_logo=(!empty($sam_martin_options['site-logo'])) ? $sam_martin_options['site-logo']['url'] : '';
			?>
			<div class="site-title navbar-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title">
				<?php if($site_logo!=''):?>
					<img alt="" src="<?php echo esc_url($site_logo);?>" id="logo_img">
				<?php else:?>
					<?php esc_html(get_bloginfo( 'name' )); ?>
				<?php endif;?>
				</a>			
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation collapse navbar-collapse navbar-ex1-collapse" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'wpcvtheme' ); ?></button>
			<?php
			if ( has_nav_menu( 'home_menu' ) && is_front_page() ) {
				wp_nav_menu( array( 
									'theme_location' => 'home_menu', 
									'menu_id' => 'navbar',
									'menu_class'=> 'nav navbar-nav',
									'container_class' => 'main-menu-container',
									'container_id'    => 'main-menu-container',
									'fallback_cb'=> 'sam_martin_wp_bootstrap_navwalker::fallback',
									'walker' => new sam_martin_wp_bootstrap_navwalker(),
									'depth'  => 2
									) ); 
			}else{
				wp_nav_menu( array( 
									'theme_location' => 'primary', 
									'menu_id' => 'navbar',
									'menu_class'=> 'nav navbar-nav',
									'container_class' => 'main-menu-container',
									'container_id'    => 'main-menu-container',
									'fallback_cb'=> 'sam_martin_wp_bootstrap_navwalker::fallback',
									'walker' => new sam_martin_wp_bootstrap_navwalker(),
									'depth'  => 2
									) ); 
			}
			?>
		</nav><!-- #site-navigation -->
		
		<?php if($sam_martin_options['site_layout']=='layout_01'):?>
		<div class="menu-footer">
		
			<?php if($sam_martin_options['facebook_url'] || $sam_martin_options['twitter_url'] || $sam_martin_options['linkedin_url']):?>	
			<div class="social">
				<ul>
					<?php if($sam_martin_options['facebook_url'])?>
					<li><a href="<?php echo esc_url($sam_martin_options['facebook_url']);?>"><i class="fa fa-facebook"></i></a></li>
					<?php if($sam_martin_options['twitter_url'])?>
					<li><a href="<?php echo esc_url($sam_martin_options['twitter_url']);?>"><i class="fa fa-twitter"></i></a></li>
					<?php if($sam_martin_options['linkedin_url'])?>
					<li><a href="<?php echo esc_url($sam_martin_options['linkedin_url']);?>"><i class="fa fa-linkedin"></i> </a></li>
				</ul>
			</div>
			<?php endif;?>
			
			<?php if($sam_martin_options['copy_write'])?>
				<div class="copyright"><p><?php echo ($sam_martin_options['copy_write']);?></p></div>
		 </div>
		<?php endif;?>
		
	</header><!-- #masthead -->	
	
	<?php if($sam_martin_options['site_layout']=='layout_01' || !isset($sam_martin_options['site_layout'])):?>
		<section id="content" class="site-content content-scroller">
	<?php endif;?>
	
	<?php get_template_part( 'template-parts/content', 'header' );?>