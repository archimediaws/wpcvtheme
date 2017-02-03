<?php
/**
 * Plugin Name: PGS Testimonials
 * Plugin URI:  http://www.potenzaglobalsolutions.com/
 * Description: Testimonials manager for Potenza Global Solutions Theme. This plugin allows you to manage, edit, and create new Testimonials items in an unlimited number of Testimonials.
 * Version:     1.0.1
 * Author:      Potenza Globa Solutions
 * Author URI:  http://www.potenzaglobalsolutions.com/
 * Text Domain: pgs_testimonials
 */

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function pgs_testimonials_load_textdomain() {
	load_plugin_textdomain( 'pgs_testimonials', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'pgs_testimonials_load_textdomain' );

/*
 * Register custom post type for Portfolio, testimonial
 */
add_action( 'init', 'pgs_testimonials_register_custom_post_type_init' );

function pgs_testimonials_register_custom_post_type_init() {
	/*
	 * Testimonials custom post type
	 */
	
	$labels = array(
		'name'               => esc_html_x( 'Testimonials', 'post type general name', 'pgs_testimonials' ),
		'singular_name'      => esc_html_x( 'Testimonial', 'post type singular name', 'pgs_testimonials' ),
		'menu_name'          => esc_html_x( 'Testimonials', 'admin menu', 'pgs_testimonials' ),
		'name_admin_bar'     => esc_html_x( 'Testimonial', 'add new on admin bar', 'pgs_testimonials' ),
		'add_new'            => esc_html_x( 'Add New', 'testimonials', 'pgs_testimonials' ),
		'add_new_item'       => esc_html__( 'Add New Testimonial', 'pgs_testimonials' ),
		'new_item'           => esc_html__( 'New Testimonial', 'pgs_testimonials' ),
		'edit_item'          => esc_html__( 'Edit Testimonial', 'pgs_testimonials' ),
		'view_item'          => esc_html__( 'View Testimonial', 'pgs_testimonials' ),
		'all_items'          => esc_html__( 'All Testimonials', 'pgs_testimonials' ),
		'search_items'       => esc_html__( 'Search Testimonials', 'pgs_testimonials' ),
		'parent_item_colon'  => esc_html__( 'Parent Testimonials:', 'pgs_testimonials' ),
		'not_found'          => esc_html__( 'No testimonialss found.', 'pgs_testimonials' ),
		'not_found_in_trash' => esc_html__( 'No testimonialss found in Trash.', 'pgs_testimonials' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'pgs_testimonials' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail')
	);

	register_post_type( 'testimonials', $args );
}


/*
 * Create Testimonial Custom fields
 */
add_action('init','pgs_testimonials_custom_fields',20);
function pgs_testimonials_custom_fields(){

	if( function_exists('acf_add_local_field_group') ){

		/*
		 * Testimonials post type custom fields
		 */
		acf_add_local_field_group(array (
			'key' => 'group_57a46e1723537',
			'title' => esc_html__('Testimonials', 'pgs_testimonials'),
			'fields' => array (
				array (
					'key' => 'field_57a46e3928abf',
					'label' => esc_html__('Content', 'pgs_testimonials'),
					'name' => 'content',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'acf_field_name-content',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_57a46e2a28abe',
					'label' => esc_html__('Designation', 'pgs_testimonials'),
					'name' => 'designation',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'acf_field_name-designation',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'testimonials',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'page_attributes',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
			'active' => 1,
			'description' => '',
		));
	}
}



/*
 * PGS Testimonials short code
 */
add_shortcode( 'sm_testimonials', 'pgs_testimonials_shortcode' );
function pgs_testimonials_shortcode($atts) {	
	extract( shortcode_atts( array (
			'posts_per_page' => 10,
			), $atts ) 
		);
	//
	//get the terms of
	$args=array(
		'post_type'=>'testimonials',
		'posts_per_page'=>$posts_per_page,
	);	
	$testimonials_query = new WP_Query( $args );
	ob_start();
	echo '<div id="sm-testimonials" class="sm-testimonials row">'."\r\n";
	while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); 
		if(function_exists('get_field')){
			$content    = get_field('content');
			$designation= get_field('designation');
		}
	?>
		<div class="col-lg-4 col-md-6 col-sm-6">
			<div class="testimonials-block ">
				<div class="testimonials-content">				 
					<div class="testimonials-avtar">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="testimonials-comment">
						<?php echo @$content; ?>					
					</div>
				</div>
				<div class="testimonials-name">
					<h4><?php the_title();?></h4>
					<span><?php echo @$designation; ?></span>
				</div>
			</div>
		</div>
	<?php
	endwhile;
	wp_reset_postdata();
	echo '</div>'."\r\n";
	return ob_get_clean();
}


/******************************************************************************
 *
 * Visual Composer Integration
 *
 ******************************************************************************/
if ( function_exists( 'vc_map' ) ) {
	vc_map( array(
		"name"                    => esc_html__( "Potenza Testimonials", 'pgs_testimonials' ),
		"description"             => esc_html__( "Potenza Testimonials", 'pgs_testimonials'),
		"base"                    => "sm_testimonials",
		"class"                   => "pgs-testimonials_xyz",
		"controls"                => "full",
		"icon"                    => 'icon-pgs-testimonials-vc',
		"category"                => esc_html__('Potenza', 'pgs_testimonials'),
		"show_settings_on_create" => true,
		"params"                  => array(			
			array(
				'type'            => 'sam_martin_number_min_max',
				'heading'         => esc_html__( "No. of Testimonials", 'pgs_testimonials' ),
				'param_name'      => 'posts_per_page',
				'value'           => '',
				'min'             => '1',
				'max'             => '9999',
				'description'     => esc_html__('Select count of testimonials to display.','pgs_testimonials'),
				// 'holder'          => 'div',
			),
			array(
				'type'      => 'css_editor',
				'heading'   => esc_html__( 'CSS box', 'pgs_testimonials' ),
				'param_name'=> 'css',
				'group'     => esc_html__( 'Design Options', 'pgs_testimonials' ),
			),
			array(
				'type'            => 'tab_id',
				'heading'         => esc_html__( 'Tab ID', 'pgs_testimonials' ),
				'param_name'      => 'element_id',
				'edit_field_class'=> 'hidden',
			),
		)
	) );
}