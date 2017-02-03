<?php
/**
 * Plugin Name: PGS Portfolio
 * Plugin URI:  http://www.potenzaglobalsolutions.com/
 * Description: Portfolio manager for Potenza Global Solutions Theme. This plugin allows you to manage, edit, and create new portfolio items in an unlimited number of portfolios.
 * Version:     1.0.1
 * Author:      Potenza Globa Solutions
 * Author URI:  http://www.potenzaglobalsolutions.com/
 * Text Domain: pgs_portfolio
 */

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function pgs_portfolio_load_textdomain() {
	load_plugin_textdomain( 'pgs_portfolio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'pgs_portfolio_load_textdomain' );

/*
 * Register custom post type for Portfolio, testimonial
 */
add_action( 'init', 'pgs_portfolio_register_custom_post_type_init' );

function pgs_portfolio_register_custom_post_type_init() {
	
	add_image_size( 'portfolio-slider', 900, 900 );
	
	$labels = array(
		'name'               => esc_html_x( 'Portfolios', 'post type general name', 'pgs_portfolio' ),
		'singular_name'      => esc_html_x( 'Portfolio', 'post type singular name', 'pgs_portfolio' ),
		'menu_name'          => esc_html_x( 'Portfolios', 'admin menu', 'pgs_portfolio' ),
		'name_admin_bar'     => esc_html_x( 'Portfolio', 'add new on admin bar', 'pgs_portfolio' ),
		'add_new'            => esc_html_x( 'Add New', 'portfolios', 'pgs_portfolio' ),
		'add_new_item'       => esc_html__( 'Add New Portfolio', 'pgs_portfolio' ),
		'new_item'           => esc_html__( 'New Portfolio', 'pgs_portfolio' ),
		'edit_item'          => esc_html__( 'Edit Portfolio', 'pgs_portfolio' ),
		'view_item'          => esc_html__( 'View Portfolio', 'pgs_portfolio' ),
		'all_items'          => esc_html__( 'All Portfolios', 'pgs_portfolio' ),
		'search_items'       => esc_html__( 'Search Portfolios', 'pgs_portfolio' ),
		'parent_item_colon'  => esc_html__( 'Parent Portfolios:', 'pgs_portfolio' ),
		'not_found'          => esc_html__( 'No portfolioss found.', 'pgs_portfolio' ),
		'not_found_in_trash' => esc_html__( 'No portfolioss found in Trash.', 'pgs_portfolio' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => esc_html__( 'Description.', 'pgs_portfolio' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'portfolios', $args );

        // Add new taxonomy, NOT hierarchical (like tags)
	$portfolio_category_labels = array(
		'name'                       => esc_html__( 'Portfolio Categories', 'pgs_portfolio' ),
		'singular_name'              => esc_html__( 'Portfolio Category', 'pgs_portfolio' ),
		'search_items'               => esc_html__( 'Search portfolio Categories', 'pgs_portfolio' ),
		'popular_items'              => esc_html__( 'Popular portfolio Categories', 'pgs_portfolio' ),
		'all_items'                  => esc_html__( 'All portfolio Categories', 'pgs_portfolio' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => esc_html__( 'Edit Category', 'pgs_portfolio' ),
		'update_item'                => esc_html__( 'Update Category', 'pgs_portfolio' ),
		'add_new_item'               => esc_html__( 'Add New Category', 'pgs_portfolio' ),
		'new_item_name'              => esc_html__( 'New Category Name', 'pgs_portfolio' ),
		'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'pgs_portfolio' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove Categories', 'pgs_portfolio' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used Categories', 'pgs_portfolio' ),
		'not_found'                  => esc_html__( 'No categories found.', 'pgs_portfolio' ),
		'menu_name'                  => esc_html__( 'Categories', 'pgs_portfolio' ),
	);

	$portfolio_category_args = array(
		'hierarchical'          => true,
		'labels'                => $portfolio_category_labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'portfolio-category' ),
	);	
	register_taxonomy( 'portfolio-category', 'portfolios', $portfolio_category_args );
	
	$portfolio_tag_args =  array(
		'hierarchical' => true,
		'label'        => esc_html__("Tags", 'pgs_portfolio'),
		'singular_name'=> esc_html__("Tag", 'pgs_portfolio'),
		'show_admin_column'     => true,
		'rewrite'      => true,
		'query_var'    => true
	);
	register_taxonomy('portfolio_tag', 'portfolios', $portfolio_tag_args );
	
	$portfolio_skills_args =  array(
		'hierarchical' => true,
		'label'        => esc_html__("Skills", 'pgs_portfolio'),
		'singular_name'=> esc_html__("Skill", 'pgs_portfolio'),
		'show_admin_column'     => true,
		'rewrite'      => true,
		'query_var'    => true
	);
	register_taxonomy('portfolio_skills', 'portfolios', $portfolio_skills_args );
}

/*
 * Create Testimonial Custom fields
 */
add_action('init','pgs_portfolio_custom_fields',20);
function pgs_portfolio_custom_fields(){
	
	if( function_exists('acf_add_local_field_group') ){
		/*Portfolio post type custom fields */
		acf_add_local_field_group(array (
			'key' => 'group_575a597a5deb4',
			'title' => esc_html__('Portfolio Details', 'pgs_portfolio'),
			'fields' => array (
				array (
					'key' => 'field_575a5c2ad0db9',
					'label' => esc_html__('Details', 'pgs_portfolio'),
					'name' => '',
					'type' => 'tab',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'acf_field_name-',
						'id' => '',
					),
					'placement' => 'top',
					'endpoint' => 0,
				),
				array (
					'key' => 'field_575a5996a4b48',
					'label' => esc_html__('Release', 'pgs_portfolio'),
					'name' => 'release',
					'type' => 'date_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'acf_field_name-release',
						'id' => '',
					),
					'display_format' => 'd/m/Y',
					'return_format' => 'Ymd',
					'first_day' => 1,
				),
				array (
					'key' => 'field_575a5abfa2ff8',
					'label' => esc_html__('Client Name', 'pgs_portfolio'),
					'name' => 'client_name',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'acf_field_name-client_name',
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
				array (
					'key' => 'field_575a5b4463109',
					'label' => esc_html__('Project Url', 'pgs_portfolio'),
					'name' => 'project_url',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'acf_field_name-project_url',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),		
				array (
					'key' => 'field_575a5c67a77c8',
					'label' => esc_html__('Portfolio Image', 'pgs_portfolio'),
					'name' => 'portfolio_image_',
					'type' => 'tab',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'acf_field_name-portfolio_image_',
						'id' => '',
					),
					'placement' => 'top',
					'endpoint' => 0,
				),
				array (
					'key' => 'field_575a5c34d0dba',
					'label' => esc_html__('Portfolio Images', 'pgs_portfolio'),
					'name' => 'portfolio_images',
					'type' => 'gallery',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'acf_field_name-portfolio_images',
						'id' => '',
					),
					'min' => '',
					'max' => '',
					'preview_size' => 'thumbnail',
					'insert' => 'append',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => 'jpg, png, jpeg',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'portfolios',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
	}
}

add_action('init','pgs_portfolio_admin_init_shortcodes_loader',10); 
function pgs_portfolio_admin_init_shortcodes_loader(){
	add_shortcode( 'sm_portfolio', 'pgs_portfolio_shortcode' );
	if ( function_exists( 'vc_map' ) ) {
	vc_map( array(
		"name"                    => esc_html__( "Potenza Portfolio", 'pgs_portfolio' ),
		"description"             => esc_html__( "Potenza Portfolio", 'pgs_portfolio'),
		"base"                    => "sm_portfolio",
		"class"                   => "portfolios",
		"controls"                => "full",
		"icon"                    => 'icon-pgs-portfolio-vc',
		"category"                => esc_html__('Potenza', 'pgs_portfolio'),
		"show_settings_on_create" => true,
		"params"                  => array(
			array(
				   'type'      => 'checkbox',
				   'heading'   => esc_html__('Categories', 'pgs_portfolio'),
				   'param_name'=> 'categories',
				   'description'=> esc_html__('Select categories to limit result from. you want to display all categories then uncheck all categories', 'pgs_portfolio'),
				   'value'     => pgs_portfolio_get_terms(array( // You can pass arguments from get_terms (except hide_empty)
					'taxonomy'  => 'portfolio-category',
				   )),
			),			
		)
	) );
}

}
/**  
 * Shortcode : sm_shadow_heading  
 */

function pgs_portfolio_shortcode($atts){
	
	extract( shortcode_atts( array (
			'categories'=> '',
			'no_of_posts'=> '8',
			), $atts ) 
		);
	
	if($categories!='')
		$categories= explode(',',$categories) ;
	
	$args = array('post_type'      => 'portfolios',
				  'post_status'    => 'publish',
                  'posts_per_page' => $no_of_posts,
            );
	if(!empty($categories) && $categories!=''){		
		$args['tax_query']= array(  
					array(  
						'taxonomy' => 'portfolio-category',  
						'field' => 'id',  
						'terms' => $categories
					) 
				);
	}
	
	$portfolio_query = new WP_Query( $args );		
	
	ob_start();
	$terms = get_terms( array(	'taxonomy' => 'portfolio-category','include' => $categories) );
	$term_count=sizeof($terms);
	if($portfolio_query->have_posts()):?>
		<div class="isotope-filters text-left">
			<button data-filter="" class="active"><?php esc_html_e( 'All', 'pgs_portfolio' );?><span>/</span></button>
			<?php $i=1; foreach($terms as $term): 
			
				if($categories!='' && !empty($categories) &&!in_array($term->term_id,$categories)) 
					continue; 
				
				?>
				<button data-filter=".<?php echo esc_attr($term->slug); ?>">
				<?php echo esc_attr($term->name); ?> 
				<?php if($i!=$term_count):?><span>/</span><?php endif;?>
				</button>
			<?php $i++; endforeach; ?>
		</div>
	
		<div class='isotope popup-portfolio full-screen'>
		<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()),'large' );
			$attachment_id=get_post_thumbnail_id( get_the_ID());
			$attachment = get_post($attachment_id);			
			if ( trim(strip_tags( $attachment->post_excerpt ))!='' )
				$thumbnail_src_alt = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption
			if (trim(strip_tags( $attachment->post_title ))!='' )
				$thumbnail_src_alt = trim(strip_tags( $attachment->post_title )); // Finally, use the title

			$term_list = wp_get_post_terms(get_the_ID(), 'portfolio-category');
			$slugs=array();
			foreach($term_list as $term)
				$slugs[]=$term->slug;
		?>
			<div class="grid-item <?php echo implode(' ',$slugs); ?>">
				<div class="portfolio-item">
					<div class="item">
						<div class="item-hover">
							<div class="item-inner"><img class="img-responsive" src="<?php echo esc_url($thumbnail_src[0]);?>" alt='<?php echo esc_attr($thumbnail_src_alt);?>'></div>
							<div class="item-info">
								<a href="<?php echo esc_url(get_permalink());?>"><?php the_title();?></a>
								<span><?php echo sprintf( esc_html__( 'By %s', 'pgs_portfolio' ), get_the_author() );?></span>
								<div class="item-link">
								   <a class="portfolio-img" href="<?php echo esc_url($thumbnail_src[0]);?>"><span class="ti-plus"></span></a>
								   <a href="<?php echo esc_url(get_permalink());?>"><span class="ti-link"></span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile;
		echo "</div>"."\r\n";		
		wp_reset_postdata();
	endif;	
	
	return ob_get_clean();	
}

/*
 * Load portfolio category 
 */
function pgs_portfolio_get_terms($args = array(), $args2 = ''){
	$return_data = array();
	
	if( !empty($args2) ){
		$result = get_terms( $args, $args2 );
	}else{
		$args['hide_empty'] = false;
		$result = get_terms( $args );
	}
	
	if ( is_wp_error( $result ) ) {
		return $return_data;
	}
	
	if ( !is_array( $result ) || empty( $result ) ) {
		return $return_data;
	}
	
	foreach ( $result as $term_data ) {
		if ( is_object( $term_data ) && isset( $term_data->name, $term_data->term_id ) ) {
			$return_data[ $term_data->name ] = $term_data->term_id;
		}
	}
	return $return_data;
}



/*
 * This function will return the template for detail page
 */ 
add_filter( "single_template", "pgs_portfolio_get_single_template",13) ;
function pgs_portfolio_get_single_template($single_template)
{	
	global $wpdb,$wp_query,$post;	
	if(get_post_type()=='portfolios')
	{
		/* auto detect mobile devices */	
		$template = '/single-portfolios.php';
		
		if ( file_exists(STYLESHEETPATH . $template)) {

			$single_template = STYLESHEETPATH . $template;

		} else if ( file_exists(TEMPLATEPATH . $template) ) {

			$single_template = TEMPLATEPATH . $template;

		}else{
			$single_template =  plugin_dir_path( __FILE__ ) . 'templates/single-portfolios.php';			
		}
	}
    return $single_template;
}


/*
 * call js and css file for portfolio
 */
add_action( 'wp_enqueue_scripts', 'pgs_portfolio_scripts_style' );
function pgs_portfolio_scripts_style(){
	
	/* Portfolio js */
	wp_enqueue_script( 'pgs-portfoli-modernizr', plugin_dir_url( __FILE__ ). 'js/modernizr.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'pgs-portfoli-plugins', plugin_dir_url( __FILE__ ). 'js/plugins.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'pgs-portfoli-isotop', plugin_dir_url( __FILE__ ). 'js/isotop.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'pgs-portfoli-magnific', plugin_dir_url( __FILE__ ). 'js/magnific-popup.js', array('jquery'), '20151215', true );	
	wp_enqueue_script( 'pgs-portfoli-carousel', plugin_dir_url( __FILE__ ). 'js/owl-carousel.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'pgs-portfoli-js', plugin_dir_url( __FILE__ ). 'js/pgs_portfolio.js', array('jquery'), '20151215', true );
	
	/* Portfolio css*/
	wp_enqueue_style( 'pgs-bootstrap', plugin_dir_url( __FILE__ )."css/bootstrap.min.css" , array(), '4.6' );	
	wp_enqueue_style( 'pgs-themify-icons', plugin_dir_url( __FILE__ )."css/themify-icons.css" , array(), '4.6' );	
	wp_enqueue_style( 'pgs-magnific-popup', plugin_dir_url( __FILE__ )."css/magnific-popup.css" , array(), '4.6' );	
	wp_enqueue_style( 'pgs-carousel', plugin_dir_url( __FILE__ )."css/owl.carousel.css" , array(), '4.6' );	
	wp_enqueue_style( 'pgs-portfolio-css', plugin_dir_url( __FILE__ )."css/style.css" , array(), '4.6' );	
}
