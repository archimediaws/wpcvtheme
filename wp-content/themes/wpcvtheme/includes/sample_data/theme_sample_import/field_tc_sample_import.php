<?php
	/**
	 * Redux Framework is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 2 of the License, or
	 * any later version.
	 * Redux Framework is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	 * GNU General Public License for more details.
	 * You should have received a copy of the GNU General Public License
	 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
	 *
	 * @package     ReduxFramework
	 * @author      Dovy Paukstys
	 * @version     3.1.5
	 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_tc_sample_import' ) ) {

	/**
	 * Main ReduxFramework_tc_sample_import class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_tc_sample_import{

		/**
		 * Field Constructor.
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct( $field = array(), $value = '', $parent ) {

			$this->parent   = $parent;
			$this->field    = $field;
			$this->value    = $value;
			//$this->is_field = @$this->parent->extensions['tc_sample_import']->is_field;
			
			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', realpath(get_template_directory().'/includes/sample_data/theme_sample_import') ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}
			
			// Set default args for this field to avoid bad indexes. Change this to anything you use.
			$defaults    = array(
				'options'          => array(),
				'stylesheet'       => '',
				'output'           => true,
				'enqueue'          => true,
				'enqueue_frontend' => true
			);
			$this->field = wp_parse_args( $this->field, $defaults );

		}

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {

			$secret = md5( md5( AUTH_KEY . SECURE_AUTH_KEY ) . '-' . $this->parent->args['opt_name'] );

			// No errors please
			$defaults = array(
				'full_width' => true,
				'overflow'   => 'inherit',
			);

			$this->field = wp_parse_args( $this->field, $defaults );

			$bDoClose = false;
			
			$id = $this->parent->args['opt_name'] . '-' . $this->field['id'];
			
			global $sam_martin_sample_datas;
			
			$nonce    = wp_create_nonce( "sample_data_security");
			
			$importer_stat = sam_martin_is_plugin_active( 'wpcvtheme-theme-functions/wpcvtheme-theme-functions.php' );			
			
			if( $importer_stat ){
				if( !empty($sam_martin_sample_datas) && is_array($sam_martin_sample_datas) ){
					?>
					<div class="sample-data-items">
						<?php
						foreach( $sam_martin_sample_datas as $sam_martin_sample_data ){
							?>
							<div class="sample-data-item sample-data-item-<?php echo esc_attr($sam_martin_sample_data['id']);?>">
								<?php
								if( file_exists($sam_martin_sample_data['data_dir'].'preview.jpg') ){
									?>
									<div class="sample-data-item-screenshot">
										<img src="<?php echo esc_url($sam_martin_sample_data['data_url']);?>/preview.jpg" alt="<?php echo esc_attr($sam_martin_sample_data['name']);?>"/>
									</div>
									<?php
								}else{
									?>
									<div class="sample-data-item-screenshot blank"></div>
									<?php
								}
								?>
								<span class="sample-data-item-details"><?php echo esc_attr($sam_martin_sample_data['name']);?></span>
								<h2 class="sample-data-item-name"><?php echo esc_attr($sam_martin_sample_data['name']);?></h2>
								<div class="sample-data-item-actions">
									<a href="#" class="button button-primary import-this-sample hide-if-no-customize" data-id="<?php echo esc_attr($sam_martin_sample_data['id']);?>" data-nonce="<?php echo esc_attr($nonce); ?>" ><?php esc_html_e('Install', 'wpcvtheme');?></a>
								</div>
							</div>
							<?php
						}					
						?>
					</div>
					<?php
				}
			}else{
				echo sprintf( wp_kses( __( 'Please install/activate <strong>Sam Martin - Theme Functions</strong> to import sample data. Click <a href="%s">here</a> to proceed.', 'wpcvtheme' ),
				array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'strong' => array()
				)), admin_url( 'themes.php?page=tgmpa-install-plugins' ) );
			}
		}

		/**
		 * Enqueue Function.
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function enqueue() {

			wp_enqueue_script(
				'redux-tc-import-export',
				$this->extension_url . 'field_tc_sample_import' . Redux_Functions::isMin() . '.js',
				array( 'jquery' ),
				time(),
				true
			);
			
			wp_localize_script( 'redux-tc-import-export', 'sample_data_import_object', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			));
			
			wp_enqueue_style(
				'redux-tc-import-export',
				$this->extension_url . 'field_tc_sample_import.css',
				time(),
				true
			);
			
		}	
	}
}