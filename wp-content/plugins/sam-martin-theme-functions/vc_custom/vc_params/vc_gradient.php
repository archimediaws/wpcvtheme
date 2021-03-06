<?php
/*----------------------------------------------------------------------------*\
	vc_GRADIENT Param
\*----------------------------------------------------------------------------*/

add_action('admin_init','sam_martin_vc_gradient_UI',20);
function sam_martin_vc_gradient_UI(){
	if(function_exists('vc_add_shortcode_param')){
		vc_add_shortcode_param( 'sm_gradient', 'sam_martin_gradient_settings', SMTF_URL . 'vc_custom/assets/js/vc_gradient.js' );
	}
}
function sam_martin_gradient_settings( $settings, $value ) {
	$defaults = array(
		'value'      => '#000000||#ffffff||0;100||0||linear'
	);
	$settings = wp_parse_args( $settings, $defaults );
	$value = $value == null ? $settings[ 'value' ] : $value;

	$gradient_values = explode( '||', $value );

	$type           = $gradient_values[4];
	$angle          = $gradient_values[3];
	$range          = explode( ';', $gradient_values[2] );
	$end_color      = $gradient_values[1];
	$start_color    = $gradient_values[0];

	if( count( $range ) !== 2 ) {
		$range = array( 0, 100 );
	}

	if( $type === 'radial' )
		$angle = null;

	$ie_angle       = $angle == null ? 0 : $angle;
	$ie_type        = 0;
	$ie_start_color = $start_color;
	$ie_end_color   = $end_color;

	if( 135 <= $ie_angle && $ie_angle < 225 ) {
		$ie_type = 0;
		$ie_start_color = $end_color;
		$ie_end_color   = $start_color;
	} else if( ( 0 <= $ie_angle && $ie_angle < 45 ) || ( 315 <= $ie_angle && $ie_angle < 360 ) ) {
		$ie_type = 0;
	} else if( 45 <= $ie_angle && $ie_angle < 135 ) {
		$ie_type = 1;
	} else if( 225 <= $ie_angle && $ie_angle < 315 ) {
		$ie_type = 1;
		$ie_start_color = $end_color;
		$ie_end_color   = $start_color;
	}

	$linear_gradient = 'background: ' . esc_attr($type) . '-gradient(' . ( $angle == null ? 'circle' : esc_attr($angle) . 'deg' ) . ',' . esc_attr( $start_color ) . ' ' . esc_attr( $range[ 0 ] ) .'%,' . esc_attr( $end_color ) . ' ' . esc_attr( $range[ 1 ] ) . '%);';
	$ie_gradient = 'background: filter: progid:DXImageTransform.Microsoft.gradient(GradientType=' . esc_attr( $ie_type ) . ',startColorstr=' . esc_attr( $ie_start_color ) . ', endColorstr=' . esc_attr( $ie_end_color ) . ');';

		
	
	$colors = '<div class="vc-gradient-color">';
		$colors .= '<div class="vc_col-sm-6 sm-vc-color-picker vc_wrapper-param-type-vc_gradient"><label>' . esc_html__( 'From', 'smtf' ) . '</label><input class="vc-color-picker vc-gradient-color-start vc-gradient-start" data-alpha="true" data-reset-alpha="true" type="text" value="' . esc_attr( $start_color  ). '" /></div>';
		$colors .= '<div class="vc_col-sm-6 sm-vc-color-picker vc_wrapper-param-type-vc_gradient"><label>' . esc_html__( 'To', 'smtf' ) . '</label><input class="vc-color-picker vc-gradient-color-end vc-gradient-end" data-alpha="true" data-reset-alpha="true" type="text" value="' . esc_attr( $end_color ) . '" /></div>';
	$colors .= '</div>';

	$preview = '<div class="vc-gradient-preview" style="' . esc_attr( $linear_gradient . $ie_gradient ) . '"></div>';

	$range_slider = '<div class="vc-gradient-slider vc-hide-input vc-advanced-field vc_wrapper-param-type-vc_gradient  vc-vc-slider"><label>' . esc_html__( 'Position: ', 'smtf' ) . '<em>' . esc_attr( $range[ 0 ] ) . ' - ' . esc_attr( $range[ 1 ] ) . '</em>%</label>';
		$range_slider .= '<div class="vc-slider-wrap"><div class="vc-slider vc-range-slider" data-min="0" data-max="100" data-step="1" data-start-value="' . esc_attr( $range[ 0 ] ) . '" data-end-value="' . esc_attr( $range[ 1 ] ) . '"></div></div>';
	$range_slider .= '</div>';

	$angle_slider = '<div class="vc-gradient-slider vc-hide-input vc-advanced-field vc_wrapper-param-type-vc_gradient vc-vc-slider"><label>' . esc_html__( 'Angle: ', 'smtf' ) . '<em>' . esc_attr( $angle ) . '</em>&deg;</label>';
		$angle_slider .= '<div class="vc-slider-wrap"><div class="vc-slider vc-angle-slider" data-min="0" data-max="359" data-step="1" data-value="' . esc_attr( $angle ) . '"></div></div>';
	$angle_slider .= '</div>';

	$gradient_type = '<div class="vc-gradient-type-wrap vc-advanced-field vc_wrapper-param-type-vc_gradient"><label><input type="checkbox" name="vc-gradient-type" class="vc-gradient-type" value="radial" ' . checked( 'radial', $type, false ) . ' /> ' . esc_html__( 'Radial', 'smtf' ) . '</label></div>';

	$input = '<div class="vc_wrapper-param-type-vc_gradient"><input class="vc-value vc_param_value vc-gradient-value wpb_vc_param_value wpb-input ' . esc_attr( $settings[ 'param_name' ] ) . '" name="' . esc_attr( $settings[ 'param_name' ] ) . '" value="' . esc_attr( $value ) . '" type="hidden" /></div>';

	return '<div class="vc_row"><div class="vc_col-sm-9 vc_column">' . $colors . $range_slider . $angle_slider . '</div><div class="vc_col-sm-3 vc-column vc-gradient-preview-wrap">' . $preview . $gradient_type . '</div></div>' . $input;
}