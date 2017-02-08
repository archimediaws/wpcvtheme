<?php
/**
 * Function for adding Potenza Skill Bar Component on vc_init hook
 */
function sam_martin_theme_functions_vc_component_sm_skillsbar() {
	if ( function_exists( 'vc_map' ) ) {
		global $vc_gitem_add_link_param;
		vc_map( array(
			"name"                    => esc_html__( "Potenza Skill Bar", 'smtf' ),
			"description"             => esc_html__( "Potenza Skill Bar", 'smtf'),
			"base"                    => "sm_skillsbar",
			"class"                   => "sam-martin_xyz",
			"controls"                => "full",
			"icon"                    => 'icon-sam-martin-vc',
			"category"                => esc_html__('Potenza', 'smtf'),
			"show_settings_on_create" => true,
			"params"                  => array(			
				
				array(
					'type'            => 'dropdown',
					'heading'         => esc_html__( 'Select Skils Style', 'smtf' ),
					'param_name'      => 'skill_style',
					'description'     => esc_html__( 'Select skils style.', 'smtf' ),
					'value'     => array(
						esc_html__( 'Skil Bar', 'smtf' )    => 'skil_bar',
						esc_html__( 'Skill Circle', 'smtf' )=> 'skil_circle',
					    esc_html__( 'Skill autre', 'smtf' )=> 'skil_autre',
					),
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
							"type"        => "textfield",
							"class"       => "",
							"heading"     => esc_html__("Bar Label", 'smtf'),
							"description" => esc_html__("Enter bar label.", 'smtf'),
							"param_name"  => "bar_label",
							'holder'      => 'h1',
							'admin_label' => true,
						),
						array(
							'type'            => 'sam_martin_number_min_max',
							'heading'         => esc_html__( "Bar Percent", 'smtf' ),
							'param_name'      => 'bar_percent',
							'value'           => '',
							'min'             => '1',
							'max'             => '100',
							'suffix'          => '%',
							'description'     => esc_html__('Enter value for graph (Note: choose range from 0 to 100). ','smtf'),
							'holder'          => 'span',
						),
					),
				),
				array(
					'type'      => 'css_editor',
					'heading'   => esc_html__( 'CSS box', 'smtf' ),
					'param_name'=> 'css',
					'group'     => esc_html__( 'Design Options', 'smtf' ),
				),
				array(
					'type'            => 'tab_id',
					'heading'         => esc_html__( 'Tab ID', 'smtf' ),
					'param_name'      => 'element_id',
					'edit_field_class'=> 'hidden',
				),
			)
		) );
	}
}
add_action( 'vc_before_init', 'sam_martin_theme_functions_vc_component_sm_skillsbar' );

/**
 * Shortcode : sm_skillsbar
 * Function for displaying typer texts.
 *
 * @param array $atts    - the attributes of shortcode
 * @param string $content - the content between the shortcodes tags
 *
 * @return string $html - the HTML content for this shortcode.
 */
function sam_martin_theme_functions_shortcode_sm_skillsbar( $atts ){
	global $sam_martin_options;
	extract( shortcode_atts( array(				
				'list'           => '',
				'css'            => '',
				'skill_style'    => 'skil_bar',
				'element_id'     => uniqid('sam_martin_testimonials_'),
			), $atts ) 
		);
	extract( $atts );
	
	$list_items = vc_param_group_parse_atts( $atts[ 'list' ] );
	
	if( !is_array( $list_items ) || empty( $list_items ) ) {
		return null;
	}
	
	$css = (isset($atts['css'])) ? $atts['css']:'';	
	$custom_class = vc_shortcode_custom_css_class( $css, ' ' );
	
	$element_classes = array(
		'pgs_skillbar',
		'skills-2',
		'skill',
		$custom_class,
	);
	$element_classes = implode( ' ', array_filter( array_unique( $element_classes ) ) );
	ob_start();
	
	if($skill_style=='skil_bar'){
	?>	
		<div class="<?php echo esc_attr($element_classes);?>">
			<ul>
				<?php
				$delay = 0;
				$with_delay = true;
				foreach( $list_items as $list_item ){
					if( isset($list_item['bar_label']) && isset($list_item['bar_percent'])){
						?>
						<li class="clearfix">
							<?php echo esc_attr($list_item['bar_label']);?>
							<div class="bar_container">
								<span class="bar" data-bar='{ "color": "<?php echo (isset($atts[ 'color' ]))? esc_attr($atts[ 'color' ]): ''?>"<?php echo ($with_delay && $delay > 0) ? ', "delay": "1200"' : '';?>}'>
									<span class="pct"><?php echo esc_html($list_item['bar_percent']);?>%</span>
								</span>
							</div>
						</li>
						<?php
						$delay = $delay+600;
					}
				}
				?>
			</ul>
			<div class="skill-chart">
				<div class="skill-chart-expand clearfix">
					<div class="expand expand-left"><p><?php esc_html_e('Newbie','smtf');?></p></div>
					<div class="expand expand-left"><p><?php esc_html_e('Decent','smtf');?></p></div>
					<div class="expand expand-right"><p><?php esc_html_e('Pretty Good','smtf');?></p></div>
					<div class="expand expand-right"><p><?php esc_html_e('Master','smtf');?></p></div>
				</div>
			</div>		
		</div>
	<?php }else{?>
	
		<div class="row language-skills">
			<?php foreach( $list_items as $list_item ){?>
			<div class="col-lg-3 col-md-3 col-sm-3">
				<div class="chart-bar">  
					<div data-percent="<?php echo esc_attr($list_item['bar_percent']);?>" class="chart3" data-barcolor='<?php echo esc_attr($sam_martin_options['primary_color']); ?>'>
						<span class="percent"></span>
					</div>
					<h3><?php echo esc_html($list_item['bar_label']);?></h3>
				</div> 
			</div>
			<?php }?>
		</div>





	<?php
	}
	return ob_get_clean();
}
add_shortcode( 'sm_skillsbar', 'sam_martin_theme_functions_shortcode_sm_skillsbar' );