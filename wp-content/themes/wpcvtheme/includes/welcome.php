<?php
add_action( 'after_setup_theme', 'sam_martin_welcome_screen_do_activation_redirect' );
function sam_martin_welcome_screen_do_activation_redirect() {
	global $pagenow;
	
	// Bail if no activation redirect
    if ( ! get_transient( '_sam_martin_welcome_screen_activation_redirect' ) ) {
		return;
	}
	
	// Delete the redirect transient
	delete_transient( '_sam_martin_welcome_screen_activation_redirect' );

	// Bail if activating from network, or bulk
	if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
		return;
	}
	
	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {		
		wp_redirect(admin_url("themes.php?page=sm-welcome"));
	}
}

add_action('admin_menu', 'sam_martin_welcome_screen_pages');
function sam_martin_welcome_screen_pages() {
	$themedata = wp_get_theme();
	add_theme_page(
		sprintf( esc_html__( 'Welcome to %s', 'wpcvtheme'), $themedata->Name),
		esc_html__('Sam Martin', 'wpcvtheme'),
		'read',
		'sm-welcome',
		'sam_martin_welcome_screen_content'
	);
}

function sam_martin_welcome_screen_content() {
	$themedata = wp_get_theme();
	?>
	<div class="wrap sm-welcome">
		<h1><?php echo sprintf( esc_html__( 'Welcome to %s', 'wpcvtheme'), $themedata->Name);?></h1>
		<div class="sm-welcome-about">
			<?php echo esc_html__( 'Congratulations! Your theme installtion is begun.', 'wpcvtheme' );?>
		</div>
		<div class="sm-welcome-content">
			<?php echo esc_html__( 'Sam Martin is an Elegant, Clean, Beautiful and Personal WordPress portfolio Theme crafted with love, for creatives and professionals who are looking to showcase their portfolio as well as their resume in a great modern way.', 'wpcvtheme' );?>
		</div>
		<div class="sm-welcome-content important">
			<?php echo wp_kses( __( '<strong>Note</strong> : This theme requires some plugins to be pre-installed to get all features and functionalities. Please ensure all plugin are installed and activated. Click below to proceed.', 'wpcvtheme' ), array( 'strong' => array() ) );?>
		</div>
		<?php
		$url = '';
		if( sam_martin_tgmpa_stat() ){
			$url = admin_url( 'themes.php?page=tgmpa-install-plugins' );
		}else{
			$url = admin_url( 'admin.php?page=SamMartin' );
		}
		if( !empty($url) ){
			?>
			<div class="sm-welcome-content">
				<a href="<?php echo esc_url($url);?>" class="button button-primary"><?php echo esc_html__( 'Proceed', 'wpcvtheme' );?></a>
			</div>
			<?php
		}
		?>
		<div class="wp-badge sm-welcome-logo"><?php echo sprintf( esc_html__('Version %s','wpcvtheme'), $themedata->version)?></div>
	</div>
	<?php
}

add_action( 'admin_head', 'sam_martin_welcome_screen_remove_menus' );
function sam_martin_welcome_screen_remove_menus() {
	remove_submenu_page( 'themes.php', 'sm-welcome' );
}