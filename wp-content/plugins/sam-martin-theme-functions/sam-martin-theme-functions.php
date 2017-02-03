<?php
/**
 * Plugin Name:       Sam Martin - Theme Functions
 * Plugin URI:        http://www.potenzaglobalsolutions.com/
 * Description:       This plugin contains important functions for Sam Martin theme to make it run properly.
 * Version:           1.0.1
 * Author:            Potenza Globa Solutions
 * Author URI:        ttp://www.potenzaglobalsolutions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smtf
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( ! defined( 'SMTF_PATH' ) ) define( 'SMTF_PATH', plugin_dir_path( __FILE__ ) );
if( ! defined( 'SMTF_URL' ) ) define( 'SMTF_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function sam_martin_theme_functions_activate() {
	
	// Display admin notice if Visual Composer is not activated.
	add_action( 'admin_notices', 'sam_martin_theme_functions_is_vc_active' );
}

/**
 * The code that runs during plugin deactivation.
 */
function sam_martin_theme_functions_deactivate() {
}

register_activation_hook( __FILE__, 'sam_martin_theme_functions_activate' );
register_deactivation_hook( __FILE__, 'sam_martin_theme_functions_deactivate' );

add_action( 'init', 'sam_martin_theme_functions_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function sam_martin_theme_functions_load_textdomain() {
	load_plugin_textdomain( 'smtf', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

// Display admin notice if Visual Composer is not activated.
function sam_martin_theme_functions_is_vc_active() {

	// checking if visual composer is active
	if ( ! is_plugin_active( 'js_composer/js_composer.php' ) ) {
		?>
		<div class="notice notice-error">
			<p><?php echo wp_kses( __( '<strong>Visual Composer</strong> is not installed or activated. Please install/activate <strong>Visual Composer</strong>, and try again.', 'smtf' ),array(
				'strong' => array(),
			));?></p>
		</div>
		<?php
	}
}

// Display admin notice if Visual Composer is not activated.
add_action( 'admin_notices', 'sam_martin_theme_functions_is_vc_active' );

require_once SMTF_PATH  . 'vc_custom/vc.php';
require_once SMTF_PATH  . 'sam-martin-importer/sam-martin-importer.php';

/**
 * Shortcodes loader.
 */
function sam_martin_theme_functions_shortcodes_loader(){
	$dir = plugin_dir_path( __FILE__ ) . 'shortcodes/';
	if ( is_dir( $dir ) ) {
		
		$files = glob($dir."*.{php}", GLOB_BRACE);
		if( is_array( $files ) && !empty($files) ){
			foreach ( $files as $file ) {
				if ( is_file( $file ) ) {
					require_once $file;
				}
			}
		}
	}
}
add_action('init','sam_martin_theme_functions_shortcodes_loader',0); 