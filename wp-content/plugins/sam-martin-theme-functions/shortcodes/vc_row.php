<?php
if( function_exists('is_plugin_active') && !is_plugin_active('mpc-massive/mpc-massive.php') ){
	add_action( 'init', 'sam_martin_vc_row_extend', 1000 );
}
function sam_martin_vc_row_extend(){
	if ( ! function_exists( 'vc_add_params' ) ) {
		return;
	}
	
	$params = array();
	$params_x[] = array(
		'type'            => 'ult_param_heading',
		'text'            => esc_html__('Background settings', 'smtf'),
		'param_name'      => 'bg_main',
		'class'           => '',
		'edit_field_class'=> 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
		'group'           => esc_attr__('Background options', 'smtf')
	);	
	
	$params[] =	array(
		"type"        => "dropdown",
		"class"       => "",
		"heading"     => esc_html__("Background Type", 'smtf'),				
		"param_name"  => "background_type",
		'group'       => esc_attr__('Background options', 'smtf'),		
		'value'       => array_flip(array(
			'color_overlay'=> esc_html__( 'Color Overlay', 'smtf' ),
			'gradient'     => esc_html__( 'Grdient', 'smtf' ),
		)),
	);
	$params[] = array(
		'type'       => 'sam_martin_number_min_max',
		'heading'    => esc_html__('Opacity','smtf'),
		'param_name' => 'bg_overlay_opacity',
		'value'      => '80',
		'min'        => '0',
		'max'        => '100',
		'suffix'     => '%',
		'group'      => esc_attr__('Background options', 'smtf'),		
		'description'=> esc_html__('Enter value between 0 to 100 (0 is maximum transparency, while 100 is minimum)','smtf'),		
	);
	
	$params[] = array(
		'type'       => 'colorpicker',
		'heading'    => esc_html__( 'Overlay color', 'smtf' ),
		'param_name' => 'bg_overlay_color',
		'description'=> esc_html__( 'Select overlay color.', 'smtf' ),		
		'group'      => esc_attr__('Background options', 'smtf'),
		'dependency' => array(
			'element' => 'background_type',
			'value'   => 'color_overlay',
		),
	);
	
	$params[] = array(
		'type'             => 'sm_gradient',
		'heading'          => esc_html__( 'Gradient', 'smtf' ),
		'param_name'       => 'vc_background_gradient',
		'tooltip'          =>  wp_kses( __( 'Define gradient style:<br>- choose starting and ending colors;<br>- position of both colors (smooth or sharp color transition);<br>- angle of color transition;<br>- linear or radial gradient type.<br><br>All changes are displayed in the preview box on the right.', 'smtf' ),
			array(
				'br' => array(),
			)
		),
		'value'           => '#83bae3||#80e0d4||0;100||180||linear',
		'edit_field_class'=> 'vc_col-sm-12 vc_column',     
		'group'           => esc_attr__('Background options', 'smtf'),
		'dependency'      => array(
			'element' => 'background_type',
			'value'   => 'gradient',
		),
	);
	
	
	$atts = vc_get_shortcode( 'vc_row' );
	$atts[ 'params' ] = array_merge( $atts[ 'params' ] , $params );
	unset( $atts[ 'base' ] );
	vc_map_update( 'vc_row', $atts );
}