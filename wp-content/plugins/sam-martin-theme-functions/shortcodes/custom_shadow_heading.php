<?php
/**
 * Function for adding Potenza Custom Shadow Heading Component on vc_init hook
 */
function sam_martin_theme_functions_vc_component_sm_shadow_heading() {
	if ( function_exists( 'vc_map' ) ) {
		vc_map( array(
			"name"                    => esc_html__( "Potenza Custom Shadow Heading", 'smtf' ),
			"description"             => esc_html__( "Potenza Custom Shadow Heading", 'smtf'),
			"base"                    => "sm_shadow_heading",
			"class"                   => "custom_shadow_heading",
			"controls"                => "full",
			"icon"                    => 'icon-sam-martin-vc',
			"category"                => esc_html__('Potenza', 'smtf'),
			"show_settings_on_create" => true,
			"params"                  => array(
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Title", 'smtf'),
					"description" => esc_html__("Enter title.", 'smtf'),
					"param_name"  => "title",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Sub Title", 'smtf'),
					"description" => esc_html__("Enter Sub Title.", 'smtf'),
					"param_name"  => "sub_title",
				),
			)
		) );
	}
}
add_action( 'vc_before_init', 'sam_martin_theme_functions_vc_component_sm_shadow_heading' );

/**
 * Shortcode : sm_shadow_heading
 * Function for displaying typer texts.
 *
 * @param array $atts    - the attributes of shortcode
 * @param string $content - the content between the shortcodes tags
 *
 * @return string $html - the HTML content for this shortcode.
 */
function sam_martin_theme_functions_shortcode_sm_shadow_heading( $atts ){
	extract( shortcode_atts( array (
		'title'    => esc_html__('Title','smtf'),
		'sub_title'=> esc_html__('Sub Title','smtf'),
		), $atts )
	);
	ob_start();
	?>

	<div class="section-title">
		<div class="section-title-name">
			<?php if($sub_title)?>
			<span><?php echo esc_html($sub_title);?></span>
			<h2><?php echo esc_html($title);?></h2>
		</div>	
		<div class="title-name-gray"><strong><?php echo esc_html($title);?></strong></div>
	</div>
	<?php		
	return ob_get_clean();
}
add_shortcode( 'sm_shadow_heading', 'sam_martin_theme_functions_shortcode_sm_shadow_heading' );