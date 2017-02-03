<?php
/**
 * Function for adding Potenza Services Component on vc_init hook
 */
function sam_martin_theme_functions_vc_component_sm_services() {
	if ( function_exists( 'vc_map' ) ) {
		vc_map( array(
			"name"                    => esc_html__( "Potenza Services", 'smtf' ),
			"description"             => esc_html__( "Potenza Services", 'smtf'),
			"base"                    => "sm_services",
			"class"                   => "services_icon",
			"controls"                => "full",
			"icon"                    => 'icon-sam-martin-vc',
			"category"                => esc_html__('Potenza', 'smtf'),
			"show_settings_on_create" => true,
			"params"                  => array(
				array(
					'type'   => 'dropdown',
					'heading'=> esc_html__( 'Icon library', 'smtf' ),
					'value'  => array(
						esc_html__( 'Font Awesome', 'smtf' )=> 'fontawesome',
						esc_html__( 'Open Iconic', 'smtf' ) => 'openiconic',
						esc_html__( 'Typicons', 'smtf' )    => 'typicons',
						esc_html__( 'Entypo', 'smtf' )      => 'entypo',
						esc_html__( 'Linecons', 'smtf' )    => 'linecons',						
						esc_html__( 'Mono Social', 'smtf' ) => 'monosocial',
					),
					'param_name'  => 'icon_type',
					'description' => esc_html__( 'Select icon library.', 'smtf' ),
				),
				array(
					'type'      => 'iconpicker',
					'heading'   => esc_html__( 'Icon', 'smtf' ),
					'param_name'=> 'icon_fontawesome',
					'value'     => 'fa fa-info-circle',
					'settings'  => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_type',
						'value'   => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'smtf' ),
				),
				array(
					'type'      => 'iconpicker',
					'heading'   => esc_html__( 'Icon', 'smtf' ),
					'param_name'=> 'icon_openiconic',
					'settings'  => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_type',
						'value'   => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'smtf' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'smtf' ),
					'param_name' => 'icon_typicons',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'smtf' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'smtf' ),
					'param_name' => 'icon_entypo',
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_type',
						'value' => 'entypo',
					),
				),
				array(
					'type'      => 'iconpicker',
					'heading'   => esc_html__( 'Icon', 'smtf' ),
					'param_name'=> 'icon_linecons',
					'settings'  => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element'=> 'icon_type',
						'value'  => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'smtf' ),
				),
				array(
					'type'      => 'iconpicker',
					'heading'   => esc_html__( 'Icon', 'smtf' ),
					'param_name'=> 'icon_monosocial',
					'value'     => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
					'settings'  => array(
						'emptyIcon'   => false, // default true, display an "EMPTY" icon?
						'type'        => 'monosocial',
						'iconsPerPage'=> 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_type',
						'value'   => 'monosocial',
					),
					'description' => esc_html__( 'Select icon from library.', 'smtf' ),
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Title", 'smtf'),
					"description" => esc_html__("Enter service title.", 'smtf'),
					"param_name"  => "title",
					'value'     => esc_html__( 'Title', 'smtf' ),
				),
				array(
					"type"        => "textarea",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Description", 'smtf'),
					"description" => esc_html__("Enter service description.", 'smtf'),
					"param_name"  => "description",
					'value'     => esc_html__( 'I am description box. Click edit button to change this text.', 'smtf' ),
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Button Text", 'smtf'),
					"description" => esc_html__("Enter button text.", 'smtf'),
					"param_name"  => "button_text",
				),
				 array(
					'type'      => 'vc_link',
					'heading'   => esc_html__( 'URL (Link)', 'smtf' ),
					'param_name'=> 'button_link',				
					'description' => esc_html__( 'Add custom link.', 'smtf' ),
				),
			)
		) );
	}
}
add_action( 'vc_before_init', 'sam_martin_theme_functions_vc_component_sm_services' );

/**
 * Shortcode : sm_services
 * Function for displaying typer texts.
 *
 * @param array $atts    - the attributes of shortcode
 * @param string $content - the content between the shortcodes tags
 *
 * @return string $html - the HTML content for this shortcode.
 */
function sam_martin_theme_functions_shortcode_sm_services( $atts ){
	$atts = shortcode_atts( array (
		'icon_type'       => 'fontawesome',
		'icon_fontawesome'=> 'fa fa-info-circle',
		'icon_openiconic' => '',
		'icon_typicons'   => '',
		'icon_entypo'     => '',
		'icon_linecons'   => '',
		'icon_pixelicons' => '',
		'icon_monosocial' => '',
		'title'           => esc_html__('Service','smtf'),
		'description'     => '',
		'button_text'     => esc_html__('Read More','smtf'),
		'button_link'     => 'url:%23|||',
	), $atts );
	
	extract( $atts );
	
	$url_vars = vc_build_link( $button_link );
	$btn_attr = sam_martin_theme_functions_vc_link_attr($url_vars);
	
	$hello = vc_icon_element_fonts_enqueue( $icon_type );
	
	if($icon_type!='fontawesome')
		$icon_fontawesome='';
	$icons=array($icon_fontawesome,$icon_openiconic,$icon_typicons,$icon_entypo,$icon_linecons,$icon_pixelicons,$icon_monosocial);
	ob_start();
	?>
	
	<div class="service-block">
   	 	<span class="vc_icon_element-icon <?php echo esc_attr(implode($icons,' '));?>"></span>
   	 	<h2><?php echo esc_html($title)?></h2>
   	 	<p><?php echo esc_html($description)?></p>
   	 	<div class="contact-button">
			<a <?php echo $btn_attr;?> class="clearfix">
				<span class="pull-left"><?php echo esc_html($button_text);?></span> 
				<span class="ti-arrow-circle-right pull-right"></span>
			</a>
		</div>
   	</div>
	<?php	
	return ob_get_clean();	
}
add_shortcode( 'sm_services', 'sam_martin_theme_functions_shortcode_sm_services' );