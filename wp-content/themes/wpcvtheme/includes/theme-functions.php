<?php
function sam_martin_images_options($img_folder_type,$image_path = true){
	$sam_martin_banners_path = get_template_directory().'/images/'.$img_folder_type.'/';
	$sam_martin_banners_url  = get_template_directory_uri().'/images/'.$img_folder_type.'/';
	$sam_martin_banners_new = array();
	if ( is_dir( $sam_martin_banners_path ) ) {
		
		$sam_martin_banners_data = glob($sam_martin_banners_path."*.{jpg,png}", GLOB_BRACE);
		if( !empty($sam_martin_banners_data) ){
			foreach( $sam_martin_banners_data as $sam_martin_banner_path ) {
				if( $image_path ){
					$sam_martin_banners_new[$sam_martin_banners_url.basename($sam_martin_banner_path)] = array(
						'alt'   => basename($sam_martin_banner_path),
						'img'   => $sam_martin_banners_url.basename($sam_martin_banner_path),
						'height'=> 25,
						'width' => 100,
					);
				}else{
					$sam_martin_banners_new[] = array(
						'alt'   => basename($sam_martin_banner_path),
						'img'   => $sam_martin_banners_url.basename($sam_martin_banner_path),
						'height'=> 25,
						'width' => 100,
					);
				}
			}
		}
	}
	if( !$image_path ){
		array_unshift($sam_martin_banners_new, null);
		unset($sam_martin_banners_new[0]);
	}
	return $sam_martin_banners_new;
}

function sam_martin_images_options_default($img_folder_type){
	$imgs = sam_martin_images_options($img_folder_type);
	foreach($imgs as $img => $img_data){
		return $img;
	}
}

// Check if required plugins are activated?
function sam_martin_is_plugin_active( $plugin_name ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	$plugin_path = WP_PLUGIN_DIR . '/' . $plugin_name;
	
	return file_exists( $plugin_path ) && is_plugin_active( $plugin_name );
}