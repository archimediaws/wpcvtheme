<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys
 * @version     3.1.5
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_pgs_redux_map' ) ) {
	/**
	 * Main ReduxFramework_pgs_redux_map class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_pgs_redux_map extends ReduxFramework {

		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct( $field = array(), $value ='', $parent ) {


			$this->parent = $parent;
			$this->field = $field;
			$this->value = $value;

			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}

			// Set default args for this field to avoid bad indexes. Change this to anything you use.
			$defaults = array(
				'options'           => array(),
				'stylesheet'        => '',
				'output'            => true,
				'enqueue'           => true,
				'enqueue_frontend'  => true
			);
			$this->field = wp_parse_args( $this->field, $defaults );

		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {
			global $sam_martin_options;
			$map_address= ($this->value['map_address']!='')? $this->value['map_address'] : $this->field['default']['map_address'];
			$lat= ($this->value['lat']!='')? $this->value['lat'] : $this->field['default']['lat'];
			$long=($this->value['long']!='')? $this->value['long'] : $this->field['default']['long'];
			?>
			<div class="pgs-redux-map-wrapper">
				<div class="pgs-redux-map-location-wrapper">
					<label class="pgs-redux-map-location-label"><?php esc_html_e('Location','wpcvtheme');?>:</label>
					<div class="pgs-redux-map-location-address-wrapper">
						<input type="text" class="pgs-redux-map-location-address" id="<?php echo esc_attr($this->field['id']).'_address';?>"  name="<?php echo esc_attr($this->field['name']) . esc_attr($this->field['name_suffix']) . '[map_address]';?>" value="<?php echo esc_attr($map_address);?>"/>
					</div>
				</div>
				<div class="pgs-redux-map-googlemap-wrapper">
					<div id="<?php echo esc_attr($this->field['id']).'_map';?>" style="width: 100%; height: 400px;"></div>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="pgs-redux-map-data-wrapper">
					<div class="pgs-redux-map-data">
						<label class="pgs-redux-map-lat-label"><?php esc_html_e('Lat.','wpcvtheme');?>:</label>
						<div class="pgs-redux-map-data-input">
							<input type="text" name="<?php echo esc_attr($this->field['name']) . esc_attr($this->field['name_suffix']) . '[lat]';?>" class="pgs-redux-map-data-field pgs-redux-map-data-field-lat" id="<?php echo esc_attr($this->field['id']).'_lat';?>" value="<?php echo esc_attr($lat);?>"/>
						</div>
					</div>
					<div class="pgs-redux-map-data">
						<label class="pgs-redux-map-long-label"><?php esc_html_e('Long.','wpcvtheme');?>:</label>
						<div class="pgs-redux-map-data-input">
							<input type="text" name="<?php echo esc_attr($this->field['name']) . esc_attr($this->field['name_suffix']) . '[long]';?>" class="pgs-redux-map-data-field pgs-redux-map-data-field-long" id="<?php echo esc_attr($this->field['id']).'_lon';?>" value="<?php echo esc_attr($long);?>"/>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="maps_data" style="display:none !important;" data-lat="<?php echo esc_attr($lat);?>" data-long="<?php echo esc_attr($long);?>"></div>
			</div>
			<?php

		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function enqueue() {
			global $sam_martin_options;	
			$api_key=(isset($sam_martin_options['google_api_key']) && $sam_martin_options['google_api_key']!='') ? $sam_martin_options['google_api_key'] : 'AIzaSyBhtR7n5LkRkbspO-WBtQue6jSBi26j03k';
			$google_api_key=apply_filters('sam_martin_goole_api_key',$api_key);
	
			wp_enqueue_script(
				'pgs_redux_map-google-map',				
				'http://maps.google.com/maps/api/js?libraries=places&key='.esc_html($google_api_key),
				array( 'jquery' ),
				time(),
				true
			);
			
			wp_enqueue_script(
				'pgs_redux_map-locationpicker-js',
				$this->extension_url . '/locationpicker/locationpicker.jquery.min.js',
				array( 'jquery', 'pgs_redux_map-google-map' ),
				time(),
				true
			);
			
			wp_enqueue_script(
				'pgs_redux_map-js',
				$this->extension_url . '/js/pgs_redux_map.min.js',
				array( 'jquery', 'pgs_redux_map-locationpicker-js' ),
				time(),
				true
			);

			wp_enqueue_style(
				'pgs_redux_map-css',
				$this->extension_url . 'field_pgs_redux_map.css',
				time(),
				true
			);

		}
	}
}
