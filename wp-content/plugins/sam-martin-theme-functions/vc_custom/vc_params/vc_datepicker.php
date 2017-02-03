<?php
if(function_exists('vc_add_shortcode_param')){
	vc_add_shortcode_param( 'datepicker', 'sam_martin_datepicker_field', SMTF_URL . 'vc_custom/assets/js/vc_datepicker.js');
}

function sam_martin_datepicker_field($settings, $value){
	return '<div class="datepicker_block">'
		.'<input name="'.esc_attr( $settings['param_name'] ).'" class="wpb_vc_param_value wpb-textinput vc_datepicker '.esc_attr( $settings['param_name'] ).' '.esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />'
		.'</div>'; // New button element
}