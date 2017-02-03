<?php
if( !class_exists('acf') ) {
	function sam_martin_admin_notices_acf_inactive() {
		?>
		<div class="notice notice-error is-dismissible">
			<p><?php echo wp_kses( __( '<strong>Advanced Custom Fields PRO</strong> is not installed/activated. Please install/activate the plugin to enable complete features.', 'wpcvtheme' ),array('strong' => array()) ); ?></p>
		</div>
		<?php
	}
	add_action( 'admin_notices', 'sam_martin_admin_notices_acf_inactive' );
	return;
}

if(defined('ACF_DEV') && ACF_DEV){
	// return;
}

function sam_martin_acf_fields_loader(){
	$acf_fields_path = get_stylesheet_directory().'/includes/acf-fields/';
	if ( is_dir( $acf_fields_path ) ) {
		$acf_fields = glob($acf_fields_path."*.{php}", GLOB_BRACE);
		if( !empty($acf_fields) ){
			foreach( $acf_fields as $acf_field ) {
				include($acf_field);
			}
		}
	}
}

if( !defined('ACF_DEV') || (defined('ACF_DEV') && !ACF_DEV) ) {
	
	// 4. Hide ACF field group menu item
	add_filter('acf/settings/show_admin', '__return_false');

	sam_martin_acf_fields_loader();
	
}

add_filter('acf/load_field/type=radio', 'sam_martin_acf_load_field_page_layout');
function sam_martin_acf_load_field_page_layout( $field ) {
	
	// Return field without save image data in database
	$field_post = get_post($field['ID']);
	if( $field_post->post_type == 'acf-field' ){
		return $field;
	}
	
	$name = $field['name'];
	
	// Populate field with class
	$class = $field['wrapper']['class'];
	$classes = explode(' ', $class);
	
	if( !in_array('acf-image-radio', $classes) ){
		return $field;
	}
	
	$acf_radio_imgs = get_template_directory_uri().'/images/radio-button-imgs';
	
	$sam_martin_banners_path = get_template_directory().'/images/radio-button-imgs/'.$name.'/';
	$sam_martin_banners_url  = get_template_directory_uri().'/images/radio-button-imgs/'.$name.'/';
	
	$sam_martin_banners_new = array();
	if ( is_dir( $sam_martin_banners_path ) ) {
		$sam_martin_banners_data = glob($sam_martin_banners_path."*.{jpg,png}", GLOB_BRACE);
		if( !empty($sam_martin_banners_data) ){
			foreach( $sam_martin_banners_data as $sam_martin_banner_path ) {
				$file_data = pathinfo($sam_martin_banner_path);
				$opt_title = $file_data['filename'];
				$opt_title = ucfirst(str_replace("_", " ", $opt_title));
				
				$field['choices'][$file_data['filename']] = '<img src="'.esc_url($sam_martin_banners_url.basename($sam_martin_banner_path)).'" alt="'.esc_attr($opt_title).'" /><span class="radio_btn_title">'.esc_html($opt_title).'</span>';
			}
		}
	}
	
    return $field;
}

add_filter('acf/load_field', 'sam_martin_acf_load_field_add_field_name_class');
function sam_martin_acf_load_field_add_field_name_class( $field ) {
	$name = $field['name'];
	
	if( empty($field['wrapper']['class']) ){
		$field['wrapper']['class'] = 'acf_field_name-'.esc_html($name);
	}else{
		$field['wrapper']['class'] = $field['wrapper']['class'].' acf_field_name-'.esc_html($name);
	}
	return $field;
}

add_filter('acf/load_field/name=banner_image_bg', 'sam_martin_acf_load_field_banner_image_bg');
function sam_martin_acf_load_field_banner_image_bg( $field ) {
	
	// Return field without save image data in database
	$field_post = get_post($field['ID']);
	if( $field_post->post_type == 'acf-field' ){
		return $field;
	}
	
	if( empty($field['wrapper']['class']) ){
		$field['wrapper']['class'] = 'acf_field_name-banner_image_bg';
	}
		
	if(!empty($banner_images)){
		foreach( $banner_images as $banner_image ){
			$field['choices'][$banner_image['img']] = '<img src="'.esc_url($banner_image['img']).'" alt="'.esc_attr($banner_image['alt']).'" height="75" />';
		}
	}
	return $field;
}

/**
 * Set the page setting custom fields
 */
if( function_exists( 'acf_add_local_field_group' ) ):
acf_add_local_field_group(array (
	'key' => 'group_57501ad11cf25',
	'title' => esc_html__('Page Settings', 'wpcvtheme'),
	'fields' => array (
		array (
			'key' => 'field_575b8aa2183cd',
			'label' => esc_html__('General', 'wpcvtheme'),
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'acf_field_name-',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_57501afdd09e3',
			'label' => esc_html__('Subtitle', 'wpcvtheme'),
			'name' => 'subtitle',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'acf_field_name-subtitle',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5768e785aa1b1',
			'label' => esc_html__('Show Header Banner', 'wpcvtheme'),
			'name' => 'show_header_banner',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'acf_field_name-show_header_banner',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_575b89a55beeb',
			'label' => esc_html__('Enable Custom Banner', 'wpcvtheme'),
			'name' => 'enable_custom_banner',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_5768e785aa1b1',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => 'acf_field_name-enable_custom_banner acf_field_name-enable_custom_banner',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_575aac608d83a',
			'label' => esc_html__('Banner', 'wpcvtheme'),
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_5768e785aa1b1',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_575b89a55beeb',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => 'acf_field_name- acf_field_name-',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_575aac9c8d83b',
			'label' => esc_html__('Banner Type', 'wpcvtheme'),
			'name' => 'banner_type',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_575b89a55beeb',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => 'acf_field_name-banner_type',
				'id' => '',
			),
			'choices' => array (
				'image' => 'Image',
				'color' => 'Color',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
		),
		array (
			'key' => 'field_575aade28d83c',
			'label' => esc_html__('Banner (Image)', 'wpcvtheme'),
			'name' => 'banner_image_bg',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_575aac9c8d83b',
						'operator' => '==',
						'value' => 'image',
					),
					array (
						'field' => 'field_575b89a55beeb',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => 'acf_field_name-banner_image_bg acf_field_name-banner_image_bg acf_field_name-banner_image_bg',
				'id' => '',
			),
			'choices' => array (
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
		),		
		array (
			'key' => 'field_575abd19e7d39',
			'label' => esc_html__('Background Opacity Color (Custom Color)', 'wpcvtheme'),
			'name' => 'banner_image_opacity_custom_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_575aac9c8d83b',
						'operator' => '==',
						'value' => 'image',
					),					
					array (
						'field' => 'field_575b89a55beeb',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => 'acf_field_name-banner_image_opacity_custom_color',
				'id' => '',
			),
			'default_value' => '#000000',
		),
		array (
			'key' => 'field_575ac40722619',
			'label' => esc_html__('Background Opacity Color (Custom Opacity)', 'wpcvtheme'),
			'name' => 'banner_image_opacity_custom_opacity',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_575aac9c8d83b',
						'operator' => '==',
						'value' => 'image',
					),					
					array (
						'field' => 'field_575b89a55beeb',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => 'acf_field_name-banner_image_opacity_custom_opacity',
				'id' => '',
			),
			'default_value' => '.8',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => 1,
			'step' => '0.01',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_575ac52c6e6cd',
			'label' => esc_html__('Banner (Color)', 'wpcvtheme'),
			'name' => 'banner_image_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_575aac9c8d83b',
						'operator' => '==',
						'value' => 'color',
					),
					array (
						'field' => 'field_575b89a55beeb',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => 'acf_field_name-banner_image_color',
				'id' => '',
			),
			'default_value' => '#191919',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
endif;

/*Post Gallery Meta Box field */
if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group(array (
	'key' => 'group_57ad597cb4392',
	'title' => esc_html__('Post Gallery', 'wpcvtheme'),
	'fields' => array (
		array (
			'key' => 'field_57ad59df82685',
			'label' => esc_html__('Images', 'wpcvtheme'),
			'name' => 'images',
			'type' => 'gallery',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'preview_size' => 'thumbnail',
			'insert' => 'append',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
endif;

/* User Custom fields */
if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group(array (
	'key' => 'group_57b2eb3e44e55',
	'title' => esc_html__('User More Info', 'wpcvtheme'),
	'fields' => array (
		array (
			'key' => 'field_57b2eb5dc6575',
			'label' => esc_html__('User Designation', 'wpcvtheme'),
			'name' => 'user_designation',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_57b2eb5dc6578',
			'label' => esc_html__('Facebook Url', 'wpcvtheme'),
			'name' => 'facebook_url',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_57b2eb6bc6579',
			'label' => esc_html__('Twitter Url', 'wpcvtheme'),
			'name' => 'twitter_url',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array (
			'key' => 'field_57b2eb7cc657a',
			'label' => esc_html__('Pintrest Url', 'wpcvtheme'),
			'name' => 'pintrest_url',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'user_role',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
endif;