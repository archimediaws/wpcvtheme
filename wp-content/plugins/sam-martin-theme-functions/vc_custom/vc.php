<?php
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$templates_path = SMTF_PATH . 'vc_custom/vc_templates';
	vc_set_shortcodes_templates_dir( $templates_path );
}

sam_martin_vc_helpers_loader();
function sam_martin_vc_helpers_loader(){
	$dir = SMTF_PATH . 'vc_custom/vc_helpers/';
	if ( is_dir( $dir ) ) {
		$helpers = glob($dir."*.{php}", GLOB_BRACE);
		if( !empty($helpers) ){
			foreach( $helpers as $helper ) {
				include($helper);
			}
		}
	}
}

sam_martin_vc_param_loader();
function sam_martin_vc_param_loader(){
	$dir = SMTF_PATH . 'vc_custom/vc_params/';
	if ( is_dir( $dir ) ) {
		$params = glob($dir."*.{php}", GLOB_BRACE);
		if( !empty($params) ){
			foreach( $params as $param ) {
				include($param);
			}
		}
	}
}

sam_martin_vc_fieldsets_loader();
function sam_martin_vc_fieldsets_loader(){
	$dir = SMTF_PATH . 'vc_custom/vc_fieldsets/';
	if ( is_dir( $dir ) ) {
		$fieldsets = glob($dir."*.{php}", GLOB_BRACE);
		if( !empty($fieldsets) ){
			foreach( $fieldsets as $fieldset ) {
				include($fieldset);
			}
		}
	}
}

function sam_martin_vc_link_attr($url_vars){
	$link_attr = '';
	if( !empty($url_vars) && is_array($url_vars) ){
		foreach($url_vars as $url_var_k => $url_var_v ){
			if( !empty($url_var_v) ){
				if( !empty($link_attr) ){
					$link_attr .= ' ';
				}
				if( $url_var_k == 'url' ){
					$link_attr .= 'href="'.esc_url($url_var_v).'"';
				}else{
					$link_attr .= $url_var_k.'="'.esc_attr($url_var_v).'"';
				}
			}
		}
	}
	return $link_attr;
}

add_action( 'admin_enqueue_scripts', 'sam_martin_admin_enqueue_scripts_vc' );
function sam_martin_admin_enqueue_scripts_vc($hook){
	if($hook == "post.php" || $hook == "post-new.php" || $hook == "edit.php"){
		wp_register_style( 'jquery-ui', SMTF_URL . 'vc_custom/assets/css/jquery-ui-admin.css' );
		wp_enqueue_style( 'vc-admin-style', SMTF_URL . 'vc_custom/assets/css/vc-admin.css', array('jquery-ui') );
		
		wp_enqueue_script('vc-imagepicker', SMTF_URL . 'vc_custom/assets/js/image-picker.jquery.min.js', array('jquery'), false, true);
	}
}

function sam_martin_get_shortcode_param_data($shortcode = ''){
	$options = array();
	if( empty($shortcode) ){
		return $options;
	}
	$images_dir = SMTF_PATH . 'vc_custom/vc_images/options/'.$shortcode.'/';
	$images_url = SMTF_URL . 'vc_custom/vc_images/options/'.$shortcode.'/';
	
	if(is_dir($images_dir)) {
		$images = glob($images_dir."*.{png}", GLOB_BRACE);
		
		if( !empty($images) ){
			foreach( $images as $image ) {
				$image_data = pathinfo($image);
				$options[$image_data['filename']] = $images_url.'/'.$image_data['basename'];
			}
		}
	}
	return $options;
}