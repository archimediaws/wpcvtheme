<?php
if( function_exists( 'vc_add_shortcode_param' ) ) {
	vc_add_shortcode_param( 'sam_martin_number_min_max' , 'sam_martin_number_min_max_field' );
}
function sam_martin_number_min_max_field( $settings, $value ){
	$param_name = isset($settings['param_name'])? $settings['param_name']: '';
	$type       = isset($settings['type'])      ? $settings['type']      : '';
	$min        = isset($settings['min'])       ? $settings['min']       : '';
	$max        = isset($settings['max'])       ? $settings['max']       : '';
	$step       = isset($settings['step'])      ? $settings['step']      : '';
	$suffix     = isset($settings['suffix'])    ? $settings['suffix']    : '';
	$class      = isset($settings['class'])     ? $settings['class']     : '';
	$output     = '<input type="number" min="'.esc_attr($min).'" max="'.esc_attr($max).'" step="'.esc_attr($step).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="'.esc_attr($value).'" style="max-width:200px; margin-right: 10px;" />'.$suffix;
	return $output;
}