<?php
/**
 * Function for adding Potenza List Component on vc_init hook
 */
function sam_martin_theme_functions_vc_component_sm_list() {
	if ( function_exists( 'vc_map' ) ) {
		global $vc_gitem_add_link_param;
		vc_map( array(
			"name"                    => esc_html__( "Potenza List", 'smtf' ),
			"description"             => esc_html__( "Potenza List", 'smtf'),
			"base"                    => "sm_list",
			"class"                   => "thecorps_xyz",
			"controls"                => "full",
			"icon"                    => 'icon-thecorps-vc',
			"category"                => esc_html__('Potenza', 'smtf'),
			"show_settings_on_create" => true,
			"params"                  => array(				
				array(
					'type'      => 'checkbox',
					'heading'   => esc_html__( 'Add icon?', 'smtf' ),
					'param_name'=> 'add_icon',
				),
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
					'dependency' => array(
						'element' => 'add_icon',
						'value' => 'true',
					),
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
					'type'       => 'param_group',
					'value'      => '',
					'param_name' => 'list',
					'group'      => esc_html__( 'List', 'smtf' ),
					'callbacks' => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
					'params'     => array(
						array(
							'type'             => 'textarea',
							'heading'          => esc_html__( 'Content', 'smtf' ),
							'param_name'       => 'title',
							'tooltip'          => esc_html__( 'Define item content. <br/>HTML markup is supported.', 'smtf' ),
							'value'            => '',
							'edit_field_class' => 'vc_col-sm-12 vc_column',
							'admin_label' => true,
						),
					),
				),			
			)
		) );
	}
}
add_action( 'vc_before_init', 'sam_martin_theme_functions_vc_component_sm_list' );

/**
 * Shortcode : sm_list
 * Function for displaying typer texts.
 *
 * @param array $atts    - the attributes of shortcode
 * @param string $content - the content between the shortcodes tags
 *
 * @return string $html - the HTML content for this shortcode.
 */
function sam_martin_theme_functions_shortcode_sm_list( $atts ){
	$atts = shortcode_atts( array(
		'style'           => 'style_1',
		'add_icon'        => false,
		'icon_type'       => 'fontawesome',
		'icon_fontawesome'=> 'fa fa-angle-right',
		'icon_openiconic' => '',
		'icon_typicons'   => '',
		'icon_entypo'     => '',
		'icon_linecons'   => '',
		'icon_monosocial' => '',
		'list'            => '',
			// 'title'           => '',
		'css'             => '',
	), $atts );
	extract( $atts );
	
	$list_items = vc_param_group_parse_atts( $atts[ 'list' ] );
	
	if( !is_array( $list_items ) || empty( $list_items ) ) {
		return null;
	}
	
	if( !empty($atts['add_icon']) ){
		$icon_type = $atts['icon_type'];
		$icon = $atts['icon_'.$icon_type];
		vc_icon_element_fonts_enqueue( $icon_type );
	}
	
	$css = $atts['css'];
	
	$custom_class = vc_shortcode_custom_css_class( $css, ' ' );
	
	$element_classes = array(
		'pgs_list',
		'pgs_list_'.$atts['style'],
		$custom_class,
	);
	$element_classes = implode( ' ', array_filter( array_unique( $element_classes ) ) );
	ob_start();
	?>
	<ul class="<?php echo esc_attr($element_classes);?>">
		<?php
		foreach( $list_items as $list_item ){
			?>
			<li><?php if( !empty($atts['add_icon']) ){ ?><i class="<?php echo esc_attr($icon);?>"></i> <?php } ?><?php echo esc_attr($list_item['title']);?></li>
			<?php
		}
		?>
	</ul>
	<?php
	
	return ob_get_clean();
}
add_shortcode( 'sm_list', 'sam_martin_theme_functions_shortcode_sm_list' );