<?php
/**
 * Function for adding Potenza Social Icon Component on vc_init hook
 */
function sam_martin_theme_functions_vc_component_sm_social_icon() {
	if ( function_exists( 'vc_map' ) ) {
		vc_map( array(
			"name"                    => esc_html__( "Potenza Social Icon", 'smtf' ),
			"description"             => esc_html__( "Potenza Social Icon", 'smtf'),
			"base"                    => "sm_social_icon",
			"class"                   => "custom_social_icon",
			"controls"                => "full",
			"icon"                    => 'icon-sam-martin-vc',
			"category"                => esc_html__('Potenza', 'smtf'),
			"show_settings_on_create" => true,
			"params"                  => array(
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Facebook", 'smtf'),
					"description" => esc_html__("Enter facebook link.", 'smtf'),
					"param_name"  => "facebook_link",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Twitter", 'smtf'),
					"description" => esc_html__("Enter twitter link.", 'smtf'),
					"param_name"  => "twitter_link",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Dribbble", 'smtf'),
					"description" => esc_html__("Enter dribbble link.", 'smtf'),
					"param_name"  => "dribbble_link",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Vimeo", 'smtf'),
					"description" => esc_html__("Enter vimeo link.", 'smtf'),
					"param_name"  => "vimeo_link",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Pinterest", 'smtf'),
					"description" => esc_html__("Enter pinterest link.", 'smtf'),
					"param_name"  => "pinterest_link",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Behance", 'smtf'),
					"description" => esc_html__("Enter behance link.", 'smtf'),
					"param_name"  => "behance_link",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Linkedin", 'smtf'),
					"description" => esc_html__("Enter linkedin link.", 'smtf'),
					"param_name"  => "linkedin_link",
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => esc_html__("Github", 'smtf'),
					"description" => esc_html__("Enter github link.", 'smtf'),
					"param_name"  => "github_link",
				),
			)
		) );
	}
}
add_action( 'vc_before_init', 'sam_martin_theme_functions_vc_component_sm_social_icon' );

/**
 * Shortcode : sm_social_icon
 * Function for displaying typer texts.
 *
 * @param array $atts    - the attributes of shortcode
 * @param string $content - the content between the shortcodes tags
 *
 * @return string $html - the HTML content for this shortcode.
 */
function sam_martin_theme_functions_shortcode_sm_social_icon( $atts ){
	extract( shortcode_atts( array (
		'facebook_link' => '',
		'twitter_link'  => '',
		'dribbble_link' => '',
		'vimeo_link'    => '',
		'pinterest_link'=> '',
		'behance_link'  => '',
		'linkedin_link' => '',
		'github_link'   => '',
		), $atts )
	);
	ob_start();
	
	if($facebook_link || $twitter_link || $dribbble_link || $vimeo_link || $pinterest_link || $behance_link || $linkedin_link || $github_link):
	?>
	<div class="about-social">
		<ul>
			<?php if($facebook_link!=""):?>
				<li><a href="<?php echo esc_url($facebook_link);?>"><i class="fa fa-facebook"></i></a></li>
			<?php endif;
			
			if($twitter_link!=""):?>
				<li><a href="<?php echo esc_url($twitter_link);?>"><i class="fa fa-twitter"></i></a></li>
			<?php endif;
			
			if($dribbble_link!=""):?>
				<li><a href="<?php echo esc_url($dribbble_link);?>"><i class="fa fa-dribbble"></i> </a></li>
			<?php endif;
			
			if($vimeo_link!=""):?>
				<li><a href="<?php echo esc_url($vimeo_link);?>"><i class="fa fa-vimeo"></i> </a></li>
			<?php endif;
			
			if($pinterest_link!=""):?>
				<li><a href="<?php echo esc_url($pinterest_link);?>"><i class="fa fa-pinterest-p"></i> </a></li>
			<?php endif;
			
			if($behance_link!=""):?>
				<li><a href="<?php echo esc_url($behance_link);?>"><i class="fa fa-behance"></i> </a></li>
			<?php endif;
			
			if($linkedin_link!=""):?>
				<li><a href="<?php echo esc_url($linkedin_link);?>"><i class="fa fa-linkedin"></i> </a></li>
			<?php endif;
			
			if($github_link!=""):?>
				<li><a href="<?php echo esc_url($github_link);?>"><i class="fa fa-github"></i> </a></li>
			<?php endif;?>
		</ul>
	</div>
	<?php
	endif;
	
	return ob_get_clean();
}
add_shortcode( 'sm_social_icon', 'sam_martin_theme_functions_shortcode_sm_social_icon' );