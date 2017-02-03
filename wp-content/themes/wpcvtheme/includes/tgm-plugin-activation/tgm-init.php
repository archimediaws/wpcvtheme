<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
require_once ( get_template_directory().'/includes/tgm-plugin-activation/core/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'sam_martin_register_required_plugins' );

global $tgmpa_plugin_list;

/*
 * Array of plugin arrays. Required keys are name and slug.
 * If the source is NOT from the .org repo, then source is also required.
 */
$tgmpa_plugin_list = array(

	// This is an example of how to include a plugin bundled with a theme.
	array(
		'name'              => esc_html__('Sam Martin - Theme Functions','wpcvtheme'),
		'slug'              => 'wpcvtheme-theme-functions',
		'source'            => get_template_directory_uri() . '/includes/plugins/wpcvtheme-theme-functions.zip',
		'required'          => true,
		'version'           => '1.0.1',
		'force_activation'  => false,
		'force_deactivation'=> false,
		'external_url'      => '',
		'is_callable'       => '',
	),
	array(
		'name'              => esc_html__('Visual Composer','wpcvtheme'),                                                 // The plugin name.
		'slug'              => 'js_composer',                                                     // The plugin slug (typically the folder name).
		'source'            => get_template_directory_uri() . '/includes/plugins/js_composer.zip',// The plugin source.
		'required'          => true,                                                              // If false, the plugin is only 'recommended' instead of required.
		'version'           => '5.0.1',                                                                // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
		'force_activation'  => false,                                                             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		'force_deactivation'=> false,                                                             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		'external_url'      => '',                                                                // If set, overrides default API URL and points to an external URL.
		'is_callable'       => '',                                                                // If set, this callable will be be checked for availability to determine if a plugin is active.
	),
	array(
		'name'              => esc_html__('Redux Framework','wpcvtheme'),
		'slug'              => 'redux-framework',		
		'required'          => true,
		'version'           => '',
		'force_activation'  => false,
		'force_deactivation'=> false,
		'external_url'      => '',
		'is_callable'       => '',
	),
	array(
		'name'              => esc_html__('PGS Portfolio','wpcvtheme'),
		'slug'              => 'pgs_portfolio',
		'source'            => get_template_directory_uri() . '/includes/plugins/pgs_portfolio.zip',
		'required'          => true,
		'version'           => '1.0.1',
		'force_activation'  => false,
		'force_deactivation'=> false,
		'external_url'      => '',
		'is_callable'       => '',
	),
	array(
		'name'              => esc_html__('PGS Testimonials','wpcvtheme'),
		'slug'              => 'pgs_testimonials',
		'source'            => get_template_directory_uri() . '/includes/plugins/pgs_testimonials.zip',
		'required'          => true,
		'version'           => '1.0.1',
		'force_activation'  => false,
		'force_deactivation'=> false,
		'external_url'      => '',
		'is_callable'       => '',
	),
	array(
		'name'              => esc_html__('Advanced Custom Fields PRO','wpcvtheme'),
		'slug'              => 'advanced-custom-fields-pro',
		'source'            => get_template_directory_uri() . '/includes/plugins/advanced-custom-fields-pro.zip',
		'required'          => true,
		'version'           => '5.5.5',
		'force_activation'  => false,
		'force_deactivation'=> false,
		'external_url'      => '',
		'is_callable'       => '',
	),
	array(
		'name'              => esc_html__('Contact Form 7','wpcvtheme'),
		'slug'              => 'contact-form-7',
		'required'          => true,
	),	

	// This is an example of the use of 'is_callable' functionality. A user could - for instance -
	// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
	// 'wordpress-seo-premium'.
	// By setting 'is_callable' to either a function from that plugin or a class method
	// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
	// recognize the plugin as being installed.
	array(
		'name'              => esc_html__('WooCommerce','wpcvtheme'),
		'slug'              => 'woocommerce',			
	),

);

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function sam_martin_register_required_plugins() {
	global $tgmpa_plugin_list;
	$plugins = $tgmpa_plugin_list;

	$tgmpa_id = 'sammartin'.'_recommended_plugins';

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => $tgmpa_id,               // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => SAM_MARTIN_INC_PATH.'/plugins',  // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		
	);

	tgmpa( $plugins, $config );
}

/*
 * 
 */
function sam_martin_tgmpa_stat(){
	global $tgmpa_plugin_list;
	
	$plugins = $tgmpa_plugin_list;
	
	$tgmpax = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	foreach ( $plugins as $plugin ) {
		call_user_func( array( $tgmpax, 'register' ), $plugin );
	}
	$pluginx = $tgmpax->plugins;
	
	$pluginy = array(
		'all'      => array(), // Meaning: all plugins which still have open actions.
		'install'  => array(),
		'update'   => array(),
		'activate' => array(),
	);

	foreach ( $tgmpax->plugins as $slug => $plugin ) {
		if ( $tgmpax->is_plugin_active( $slug ) && false === $tgmpax->does_plugin_have_update( $slug ) ) {
			// No need to display plugins if they are installed, up-to-date and active.
			continue;
		} else {
			$pluginy['all'][ $slug ] = $plugin;

			if ( ! $tgmpax->is_plugin_installed( $slug ) ) {
				$pluginy['install'][ $slug ] = $plugin;
			} else {
				if ( false !== $tgmpax->does_plugin_have_update( $slug ) ) {
					$pluginy['update'][ $slug ] = $plugin;
				}

				if ( $tgmpax->can_plugin_activate( $slug ) ) {
					$pluginy['activate'][ $slug ] = $plugin;
				}
			}
		}
	}
	if( count($pluginy['all']) > 0 ){
		return true;
	}else{
		return false;
	}
}