<?php
/**
 * Function for adding Potenza Features Component on vc_init hook
 */
function sam_martin_theme_functions_vc_component_sm_features() {
	if ( function_exists( 'vc_map' ) ) {
		vc_map( array(
			"name"                    => esc_html__( "Potenza Features", 'smtf' ),
			"description"             => esc_html__( "Potenza Features", 'smtf'),
			"base"                    => "sm_features",
			"class"                   => "features_icon",
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
					"description" => esc_html__("Enter title.", 'smtf'),
					"param_name"  => "title",
					'value'     => esc_html__( 'Title', 'smtf' ),
				),
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Title Type", 'smtf'),				
					"param_name"  => "title_type",
					'value'     => array_flip(array(
						'h2'  => esc_html__( 'H2', 'smtf' ),
						'h3'  => esc_html__( 'H3', 'smtf' ),
						'h4'  => esc_html__( 'H4', 'smtf' ),
						'h5'  => esc_html__( 'H5', 'smtf' ),
						'h6'  => esc_html__( 'H6', 'smtf' ),
					)),
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Sub Title", 'smtf'),
					"description" => esc_html__("Enter sub title.", 'smtf'),
					"param_name"  => "sub_title",
					'value'     => '',
				),		
			)
		) );
	}
}
add_action( 'vc_before_init', 'sam_martin_theme_functions_vc_component_sm_features' );

/**
 * Shortcode : sm_features
 * Function for displaying typer texts.
 *
 * @param array $atts    - the attributes of shortcode
 * @param string $content - the content between the shortcodes tags
 *
 * @return string $html - the HTML content for this shortcode.
 */
function sam_martin_theme_functions_shortcode_sm_features( $atts ){
	extract( shortcode_atts( array (
		'icon_type'       => 'fontawesome',
		'icon_fontawesome'=> 'fa fa-info-circle',
		'icon_openiconic' => '',
		'icon_typicons'   => '',
		'icon_entypo'     => '',
		'icon_linecons'   => '',
		'icon_pixelicons' => '',
		'icon_monosocial' => '',
		'title'           => '',
		'title_type'      => 'h4',
		'sub_title'       => '',
		), $atts ) 
	);
	
	$hello=vc_icon_element_fonts_enqueue( $icon_type );
	if($icon_type!='fontawesome')
		$icon_fontawesome='';
	$icons=array($icon_fontawesome,$icon_openiconic,$icon_typicons,$icon_entypo,$icon_linecons,$icon_pixelicons,$icon_monosocial);	
	
	ob_start();
	?>
	<div class="feature_box clearfix">
		<div class="feature-icon">
			<span class="vc_icon_element-icon <?php echo esc_attr(implode($icons,' '));?>"></span>
		</div>
		<div class="feature-info">
			<?php if($title_type!=''):
				echo "<$title_type>".esc_html($title)."</$title_type>";
			else:?>
				<h4><?php echo esc_html($title);?></h4>
			<?php endif;?>
			<p><?php echo esc_html($sub_title);?></p>
		</div>
	</div>
	<?php	
	return ob_get_clean();	
}
add_shortcode( 'sm_features', 'sam_martin_theme_functions_shortcode_sm_features' );