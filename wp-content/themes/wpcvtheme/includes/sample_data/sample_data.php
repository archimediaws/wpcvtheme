<?php
global $sam_martin_sample_datas;

// Include Sample Import class
if(!function_exists('sam_martin_theme_sample_import_field_loader')) :
function sam_martin_theme_sample_import_field_loader($ReduxFramework) {
	$class_file = get_template_directory().'/includes/sample_data/theme_sample_import/field_tc_sample_import.php';
	$extension_class = 'ReduxFramework_tc_sample_import';
	if( !class_exists($extension_class) && file_exists($class_file) ) {
		require_once( $class_file );
	}
}
add_action("redux/extensions/".SAM_MARTIN_THEME_OPTIONS_NAME."/before", 'sam_martin_theme_sample_import_field_loader', 0);
endif;

function sam_martin_theme_sample_import_field_completed(){
	echo '<div class="admin-demo-data-notice notice-green" style="display:none;"><strong>'.esc_html__( 'Successfully installed demo data.', 'wpcvtheme' ).'</strong>' . '</div>';
	// echo '<div class="admin-demo-data-custom-notice notice-yellow" style="display:none;"><div class="admin-demo-data-custom-notice-inner"></div><div class="admin-demo-data-custom-notice-close"><i class="fa fa-close"></i></div></div>';
	echo '<div class="admin-demo-data-reload notice-red" style="display: none;"><strong>'.esc_html__( 'Please wait... reloading page to load changes.', 'wpcvtheme' ).'</strong></div>';
}
add_action( "redux/options/".SAM_MARTIN_THEME_OPTIONS_NAME."/settings/change", 'sam_martin_theme_sample_import_field_completed' );

// Dynamically add import section
if (!function_exists('sam_martin_theme_sample_import_section')) {
	function sam_martin_theme_sample_import_section($sections) {
		$sections[] = array(
			'title'  => esc_html__( 'Sample Data', 'wpcvtheme' ),
			'id'     => 'sample_data',
			'icon'   => 'fa fa-database',
			'fields' => array(
				array(
					'id'        => 'tc_sample_data_import',
					'type'      => 'tc_sample_import',
					'full_width'=> true,
				)
			)
		);
		return $sections;
	}
}
add_filter('redux/options/' . SAM_MARTIN_THEME_OPTIONS_NAME . '/sections', 'sam_martin_theme_sample_import_section', 11);

// Prepapre Sample Data folder details
function sam_martin_theme_sample_datas(){
	global $sam_martin_sample_datas;
	
	$sam_martin_sample_datas = array();
	
	$data_dir_path = get_stylesheet_directory().'/includes/sample_data/data_files/';
	
	if ( is_dir( $data_dir_path ) ) {
		$data_dirs = glob($data_dir_path."*", GLOB_ONLYDIR);
		if( !empty($data_dirs) && is_array($data_dirs) ){
			foreach($data_dirs as $data_dir){
				
				$data_dir = trailingslashit( str_replace( '\\', '/', $data_dir ) );
				$data_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $data_dir ) );
				
				$path_parts = pathinfo($data_dir);
				extract($path_parts);
				
				$excluded_dirs = array(
					'nppBackup',
				);
				
				apply_filters('sam_martin_sample_data_excluded_dirs', $excluded_dirs);
				
				if( !in_array($basename, $excluded_dirs) ){
					
					$default_headers = array(
						'name'     => 'Name',
						'menus'    => 'Menus',
						'demo_url' => 'Demo URL',
						'home_page'=> 'Home Page',
						'blog_page'=> 'Blog Page',
					);
					
					if( file_exists($data_dir.'sample_data.ini') ){
						$sample_details = get_file_data( $data_dir.'sample_data.ini', $default_headers, 'sample_data' );
					}else{
						$sample_details = array();
					}
					
					// Name
					$sample_name = ( !empty($sample_details['name']) ) ? $sample_details['name'] : ucwords(str_replace('_', ' ', $basename));
					
					// Menus
					$sample_menu = array(); // Define default array
					
					if( !empty($sample_details['menus']) ){
						$menus_raw = array_filter(explode('|',$sample_details['menus']));
						
						$menus_array = array();
						if( !empty($menus_raw) && is_array($menus_raw) ){
							foreach( $menus_raw as $menus_raw_item ){
								
								$menus_raw_item = array_filter(explode(':',$menus_raw_item, 2));
								if( count($menus_raw_item) == 2 ){
									$menus_array[$menus_raw_item[0]] = $menus_raw_item[1];
								}
							}
						}
						if( !empty($menus_array) ){
							$sample_menu = $menus_array;
						}
					}
					
					$sam_martin_sample_datas[$basename] = array(
						'id'         => $basename,
						'name'       => $sample_name,
						'menus'      => $sample_menu,
						'demo_url'   => (isset($sample_details['demo_url'])) ? $sample_details['demo_url'] : '',
						'home_page'  => (isset($sample_details['home_page']))? $sample_details['home_page']: '',
						'blog_page'  => (isset($sample_details['blog_page']))? $sample_details['blog_page']: '',
						'data_dir'   => $data_dir,
						'data_url'   => $data_url,
						'parent_dir' => $dirname,
					);
				}
			}
		}
	}
}
sam_martin_theme_sample_datas();
add_action( 'wp_ajax_theme_import_sample', 'sam_martin_theme_import_sample' );
function sam_martin_theme_import_sample(){
	
	// First check the nonce, if it fails the function will break	
	if ( ! wp_verify_nonce( $_REQUEST['nonce'], "sample_data_security" ) ) {
		echo json_encode( array(
			'status' => esc_html__( 'Invalid sample data security credential. Please reload the page and try again.', 'wpcvtheme' ),
			'action' => ''
		) );

		die();
	}
	ob_start();
	// Nonce is checked, get the posted data and process further
	$sample_id = isset($_REQUEST['sample_id']) ? $_REQUEST['sample_id'] : '';
	
	if( empty($sample_id) ){
		$ajax_data = array(
			'status'      => false,
			'message'     => esc_html__('Invalid selection.','wpcvtheme'),
			'message_type'=> 'warning',
		);
	}else{
		global $wpdb, $sam_martin_sample_datas;
		
		if ( current_user_can( 'manage_options' ) ) {
			
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers

			if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
				$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				include $wp_importer;
			}
			
			$importer_stat = sam_martin_is_plugin_active( 'wpcvtheme-theme-functions/wpcvtheme-theme-functions.php' );
			if( ! $importer_stat ){
				echo json_encode( array(
					'status'      => true,
					'message'     => wp_kses( __( 'Please install/activate <strong>Sam Martin - Theme Functions</strong>.', 'wpcvtheme' ), array( 'strong' => array() ) ),
					'message_type'=> 'error',
				) );
				die();
			}
			$importer_path = WP_PLUGIN_DIR . '/wpcvtheme-theme-functions/wpcvtheme-importer/wpcvtheme-importer.php';
			if( file_exists( $importer_path ) ){
				require_once($importer_path);
			}
			
			if ( class_exists( 'WP_Importer' ) && class_exists( 'Sam_Martin_WP_Import' ) ) { // check for main import class and wp import class
				$sample_params =  $sam_martin_sample_datas[$sample_id];
				
				// Prepapre Data Files
				$sample_data_main_data_file     = $sample_params['data_dir'].'sample_data.xml';
				$sample_data_redux_options_file = $sample_params['data_dir'].'theme_options.json';
				$sample_data_widget_file        = $sample_params['data_dir'].'widget_data.json';
				$sample_data_rev_path           = untrailingslashit($sample_params['data_dir']).'/revsliders/';
				
				/******************************************
				 * Import Main Data
				 ******************************************/
				// Import Data
				if( file_exists($sample_data_main_data_file) ){
					$importer = new Sam_Martin_WP_Import();
					
					// Import Posts, Pages, Portfolio Content, FAQ, Images, Menus
					$importer->fetch_attachments = true;
					
					$stat = $importer->import($sample_data_main_data_file);
					
					flush_rewrite_rules();
				
					// Import Menus
					// Set imported menus to registered theme locations
					$locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
					$registered_menus = wp_get_nav_menus(); // registered menus
					
					// Assign Menu Name to Registered menus as array keys
					$registered_menus_new = array();
					foreach( $registered_menus as $registered_menu ){
						$registered_menus_new[$registered_menu->name] = $registered_menu;
					}
					
					// Assgin Menus to provided locations
					if( !empty($sample_params['menus']) && is_array($sample_params['menus']) ){
						foreach( $sample_params['menus'] as $menu_loc => $menu_nm ){
							$reg_menu_data = $registered_menus_new[$menu_nm];
							$locations[$menu_loc] = $reg_menu_data->term_id;
						}
					}
					
					set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				/******************************************
				 * Import Theme Options
				 ******************************************/
				if( file_exists($sample_data_redux_options_file) ){
					$redux_options_json = $wp_filesystem->get_contents( $sample_data_redux_options_file );
					$redux_options = json_decode( $redux_options_json, true );
					
					$replace_url = false;
					if( $replace_url ){
						global $sam_martin_array_replace_data;
						$sam_martin_array_replace_data['old'] = $sample_params['demo_url'];
						$sam_martin_array_replace_data['new'] = home_url( '/' );
						$redux_options = array_map("sam_martin_replace_array", $redux_options);
					}
					
					$redux_options_update_stat = update_option( SAM_MARTIN_THEME_OPTIONS_NAME, $redux_options );
					
					if( function_exists('sam_martin_color_customize_ajax_save') ){
						sam_martin_color_customize_ajax_save();
					}
				}
				
				/******************************************
				 * Import Widget Data
				 ******************************************/
				if( file_exists( $sample_data_widget_file ) ){
					if( !function_exists('sam_martin_import_widget_data') ){
						$widget_import = get_template_directory() . '/includes/sample_data/widget-importer-exporter/widget-import.php';
						include($widget_import);
					}
					$widget_data_json = $wp_filesystem->get_contents( $sample_data_widget_file );
					$widget_data = json_decode( $widget_data_json );
					
					$sam_martin_widget_import_results = sam_martin_import_widget_data( $widget_data );
				}
				
				/******************************************
				 * Import Revolution Sliders
				******************************************/
				// Check if "revsliders" folder exists
				if( file_exists( $sample_data_rev_path ) && is_dir( $sample_data_rev_path ) ){
					$sample_data_rev_sliders_path = glob($sample_data_rev_path."*.{zip}", GLOB_BRACE);
					if( is_array($sample_data_rev_sliders_path) && !empty($sample_data_rev_sliders_path) && class_exists('UniteFunctionsRev') ){
						$sam_martin_revslider = new RevSlider();
						foreach( $sample_data_rev_sliders_path as $sample_data_rev_slider_path ) {
							ob_start();
							$sam_martin_revslider->importSliderFromPost(true, false, $sample_data_rev_slider_path);
							ob_clean();
							ob_end_clean();
						}
					}
				}
				
				/******************************************
				 * Set Default Pages
				 ******************************************/
				// Home Page
				update_option('show_on_front', 'page');
				$home_page = get_page_by_title( $sample_params['home_page'] );
				if(isset( $home_page ) && $home_page->ID) {
					update_option('page_on_front', $home_page->ID); // Front Page
				}
				// Blog Page
				$blog_page = get_page_by_title( $sample_params['blog_page'] );
				if(isset( $blog_page ) && $blog_page->ID) {
					update_option('page_for_posts', $blog_page->ID); // Posts Page
				}
			}else{
				echo esc_html__('Something went wrong.', 'wpcvtheme');
			}
		}
	}
	$output = ob_get_clean();
	$ajax_data = array(
		'status'      => true,
		'message'     => $output,
	);
	echo json_encode($ajax_data);
	die();
}

function sam_martin_replace_array($n){
	global $sam_martin_array_replace_data;
	
	if( is_array($n) ){
		return array_map("sam_martin_replace_array", $n);
	}else{
		if( !empty($sam_martin_array_replace_data) && is_array($sam_martin_array_replace_data) && isset($sam_martin_array_replace_data['old'])&& isset($sam_martin_array_replace_data['new']) ){
			if (strpos($n, $sam_martin_array_replace_data['old']) !== false) {
				return str_replace($sam_martin_array_replace_data['old'],$sam_martin_array_replace_data['new'],$n);
			}else{
				return $n;
			}
		}else{
			return $n;
		}
	}
	return $n;
}