<?php
/**
 * Function for adding Potenza Typer Component on vc_init hook
 */
function sam_martin_theme_functions_vc_component_sm_typer() {
	if ( function_exists( 'vc_map' ) ) {
		global $vc_gitem_add_link_param;
		vc_map( array(
			"name"                    => esc_html__( "Potenza Typer", 'smtf' ),
			"description"             => esc_html__( "Potenza Typer", 'smtf'),
			"base"                    => "sm_typer",
			"class"                   => "sm_typer",
			"controls"                => "full",
			"icon"                    => 'icon-sam-martin-vc',
			"category"                => esc_html__('Potenza', 'smtf'),
			"show_settings_on_create" => true,
			"params"                  => array(			
				array(
					'type'       => 'param_group',
					'value'      => '',
					'param_name' => 'list',
					'group'      => esc_html__( 'List', 'smtf' ),
					'callbacks' => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
					'params'     => array(
						array(
							"type"        => "textfield",
							"class"       => "",
							"heading"     => esc_html__("Typer Title", 'smtf'),
							"description" => esc_html__("Enter typing title.", 'smtf'),
							"param_name"  => "type_title",
							'holder'      => 'h1',
							'admin_label' => true,
						),
					),			
				),
			)
		) );
	}
}
add_action( 'vc_before_init', 'sam_martin_theme_functions_vc_component_sm_typer' );

/**
 * Shortcode : sm_typer
 * Function for displaying typer texts.
 *
 * @param array $atts    - the attributes of shortcode
 * @param string $content - the content between the shortcodes tags
 *
 * @return string $html - the HTML content for this shortcode.
 */
function sam_martin_theme_functions_shortcode_sm_typer( $atts ){
	
	extract( shortcode_atts( array (
		'list'=> '',
		'element_id'=>''
		), $atts ) 
	);

	$typer_items = vc_param_group_parse_atts( $list );
	$element_id=uniqid();
	ob_start();
	
	if(!empty($typer_items)){
		?>
		<div id="typer-<?php echo esc_attr($element_id);?>" class="typer-content">
			<div class="typer_data">
				<?php
				foreach( $typer_items as $item ){
					echo "<h2>".esc_html($item['type_title'])."</h2>";
				}
				?>
			</div>
		</div>
		<?php
	}
	return ob_get_clean();
}
add_shortcode( 'sm_typer', 'sam_martin_theme_functions_shortcode_sm_typer' );