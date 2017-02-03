<?php
/**
 * Function for adding Potenza Availability Calendar Component on vc_init hook
 */
function sam_martin_theme_functions_vc_component_sm_availability_calendar() {
	if ( function_exists( 'vc_map' ) ) {
		global $vc_gitem_add_link_param;
		vc_map( array(
			"name"                    => esc_html__( "Potenza Availability Calendar", 'smtf' ),
			"description"             => esc_html__( "Potenza Availability Calendar", 'smtf' ),
			"base"                    => "sm_availability_calendar",
			"class"                   => "availability_ca;emdar",
			"controls"                => "full",
			"icon"                    => 'icon-calendar-vc',
			"category"                => esc_html__('Potenza', 'smtf'),
			"show_settings_on_create" => true,
			"params"                  => array(
				array(
					'type'       => 'param_group',
					'value'      => '',
					'param_name' => 'list',
					'group'      => esc_html__( 'Calendar Info', 'smtf' ),
					'callbacks' => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
					'params'     => array(
						array(
							"type"       => "datepicker",
							"holder"     => "div",
							"class"      => "availability_date",
							"heading"    => esc_html__( "Date", 'smtf' ),
							"param_name" => "availability_date",
							"value"      => '',
							"description"=> esc_html__( "Enter date.", 'smtf' ),
							'admin_label'=> true,
						),
						array(
							'type'             => 'textarea',
							'heading'          => esc_html__( 'Description', 'smtf' ),
							'param_name'       => 'availability_description',
							'tooltip'          => wp_kses( __( 'Define item content. <br/>HTML markup is supported.', 'smtf' ),
								array(
									'br' => array(),
								)
							),
							'value'            => '',
							"description" => esc_html__( "Add description for what you will do on above mentioned date.", 'smtf' ),
							'edit_field_class' => 'vc_col-sm-12 vc_column',
						),
					),
				),
				array(
					'type'      => 'css_editor',
					'heading'   => esc_html__( 'CSS Box', 'smtf' ),
					'param_name'=> 'css',
					'group'     => esc_html__( 'Design Options', 'smtf' ),
				),
			)
		) );
	}
}
add_action( 'vc_before_init', 'sam_martin_theme_functions_vc_component_sm_availability_calendar' );

/**
 * Shortcode : sm_availability_calendar
 * Function for displaying availability calendar.
 *
 * @param array $atts    - the attributes of shortcode
 * @param string $content - the content between the shortcodes tags
 *
 * @return string $html - the HTML content for this shortcode.
 */
function sam_martin_theme_functions_shortcode_sm_availability_calendar($atts){

	extract( shortcode_atts( array (
		'availability_date'=> '',
		'availability_description'=> '',
		), $atts ) 
	);
	
	$availability_items = vc_param_group_parse_atts( $atts[ 'list' ] );	
	
	global $calendar_lists;		
	$calendar_events='';
	
	$uniqid=uniqid();
	$datepicker_id="datepicker_".$uniqid;
	$day_id  = 'datepicker_'.$uniqid.'_day';
	$date_id = 'datepicker_'.$uniqid.'_date';
	$month_id= 'datepicker_'.$uniqid.'_month';
	
	if(!empty($availability_items)){
		foreach($availability_items as $key=>$value){
			if(strtotime($value['availability_date'])!=strtotime(date('Y-m-d')))
				$calendar_events.='{ Title: "'.esc_html($value['availability_description']).'", Date: new Date("'.date('m/d/Y',strtotime(esc_html($value['availability_date']))).'") },';
		}
	}
	
	$calendar_lists[$uniqid]=substr($calendar_events,0,-1);
	ob_start();
	?>
	<div class="main-calendar sm_availability_calendar clearfix">
		<div class="calendar_data" style="display:none !important;">[<?php echo substr($calendar_events,0,-1);?>]</div>
		<div class="row">
			<div class="col-lg-7 col-md-7">   
				<div class="calendar-section">
					<div class="calendar-block"> 
						<div id="<?php echo esc_attr($datepicker_id);?>" class="sm_availability_calendar_datepicker"></div> 
					</div>
				</div>
			</div>				
			
			<!--Start calendar availability -->
			<div class="col-lg-5 col-md-5">  
				<div class="date-block">
					<div class="date-area">
						<span class="day" id="<?php echo esc_attr($day_id);?>"><?php echo date('l');?></span>
						<span class="date" id="<?php echo esc_attr($date_id);?>"><?php echo date('d');?></span>
						<span class="month" id="<?php echo esc_attr($month_id);?>"><?php echo date('F');?></span>
						<div class="clr"></div>
					</div>
					<div class="dateinfo">
						<div class="block"><span class="today"></span><?php esc_html_e('Today','smtf');?></div>
						<div class="block"><span class="not-ava"></span><?php esc_html_e('Sorry. I am not available on those days','smtf');?></div>
						<div class="block"><span class="available"></span><?php esc_html_e('All other days i am available','smtf'); ?> </div>
					</div>
				</div>
			</div>
			<!--End calendar availability -->
			
		</div>		
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'sm_availability_calendar', 'sam_martin_theme_functions_shortcode_sm_availability_calendar' );