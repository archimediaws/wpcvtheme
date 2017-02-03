<?php
/**
 * wpcvtheme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpcvtheme
 */
define( 'SAM_MARTIN_URL', esc_url( get_template_directory_uri() ) );     //url of the loaded
define( 'SAM_MARTIN_PATH', get_template_directory() );                    //root server path of
define( 'SAM_MARTIN_INC_PATH', SAM_MARTIN_PATH.'/includes' );          //root server path of the parent theme
$opt_name = "sam_martin_options";
if( ! defined( 'SAM_MARTIN_THEME_OPTIONS_NAME' ) ) define( 'SAM_MARTIN_THEME_OPTIONS_NAME', 'sam_martin_options' );


if ( ! function_exists( 'sam_martin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sam_martin_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wpcvtheme, use a find and replace
	 * to change 'wpcvtheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wpcvtheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'wpcvtheme' ),
		'home_menu' => esc_html__( 'Home Page Menu', 'wpcvtheme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'woocommerce' );
	
	add_image_size( 'wpcvtheme-post-thumbnails', 500, 333 );
	add_image_size( 'wpcvtheme-banner-image', 1920, 490 );
	add_image_size( 'wpcvtheme-post-images', 1170, 370 );
	add_image_size( 'wpcvtheme-portfolio-slider', 900, 900 );
	
	
	/*remove woocommerce action */
	remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
	remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
	add_filter('woocommerce_show_page_title','sam_martin_woocommerce_show_page_title');
	
	remove_action( 'wp_enqueue_scripts', 'pgs_portfolio_scripts_style' );

	// Add an editor stylesheet for the theme.
	add_editor_style( 'css/editor-styles.css' );

	// Set transient for welcome loader.
	set_transient( '_sam_martin_welcome_screen_activation_redirect', true, 30 );
}
endif;
add_action( 'after_setup_theme', 'sam_martin_setup' );

/*
 * Sam Martin Welcome Loader
 */
require_once get_template_directory().'/includes/welcome.php';

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sam_martin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sam_martin_content_width', 640 );
}
add_action( 'after_setup_theme', 'sam_martin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sam_martin_widgets_init() {
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wpcvtheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'wpcvtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	if(is_plugin_active('redux-framework/redux-framework.php')){
		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'wpcvtheme' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Add widgets here to in your footer.', 'wpcvtheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
	
}
add_action( 'widgets_init', 'sam_martin_widgets_init' );

/*
Register Google fonts for Sam Martin.
*/
function sam_martin_google_fonts_url() {
    $fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	
	/* translators: If there are characters in your language that are not supported by Open+Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'wpcvtheme' ) ) {
		$fonts[] = 'Open Sans:400,300,600,300italic,400italic,600italic,700,700italic,800,800italic';		
	}
	
	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'wpcvtheme' ) ) {
		$fonts[] = 'Raleway:400,100,100italic,200italic,200,300,300italic,400italic,500,500italic,600,600italic,700italic,900italic,900,800,700,800italic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function sam_martin_scripts() {
	global $sam_martin_options;	
	
	$color_customize_css = get_template_directory_uri()."/css/color_customize.css";
	if ( is_multisite() ) {
		global $blog_id;
		
		// Site CSS Path
		$color_customize_css_path = get_template_directory()."/css/blog/".$blog_id."-color_customize.css";
		
		// Check if site CSS exists
		if( file_exists( $color_customize_css_path ) ){
			$color_customize_css=get_template_directory_uri()."/css/blog/".$blog_id."-color_customize.css";
		}
	}
	
	// CSS
	wp_enqueue_style( 'wpcvtheme-google-fonts'   , sam_martin_google_fonts_url()                             , array(), '1.0.0' );// Google Fonts
	wp_enqueue_style( 'bootstrap'                 , get_template_directory_uri() . '/css/bootstrap.min.css'   , array(), '4.6' );  // Bootstrap
	wp_enqueue_style( 'font-awesome'              , get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6' );  // FontAwesome
	wp_enqueue_style( 'themify-icon'              , get_template_directory_uri() . "/css/themify-icons.css"   , array(), '4.6' );  // Themify Icons
	wp_enqueue_style( 'magnific-popup'            , get_template_directory_uri() . "/css/magnific-popup.css"  , array(), '4.6' );  // Magnific Popup
	wp_enqueue_style( 'owl-carousel'              , get_template_directory_uri() . "/css/owl.carousel.css"    , array(), '4.6' );  // Owl Carousel
	wp_enqueue_style( 'jquery-ui'                 , get_template_directory_uri() . "/css/jquery-ui.css"       , array(), '4.6' );  // jQuery UI
	wp_enqueue_style( 'wpcvtheme-style'          , get_stylesheet_uri() );                                                        // Main Stylesheet
	wp_enqueue_style( 'wpcvtheme-responsive'     , get_template_directory_uri() . "/css/responsive.css"      , array(), '4.6' );  // Responsive Style
	wp_enqueue_style( 'wpcvtheme-color-customize', $color_customize_css );                                                        // Color Customizer style
	
	// Javascript
	$api_key = (isset($sam_martin_options['google_api_key']) && $sam_martin_options['google_api_key']!='') ? $sam_martin_options['google_api_key'] : 'AIzaSyBhtR7n5LkRkbspO-WBtQue6jSBi26j03k';
	$google_api_key = apply_filters('sam_martin_goole_api_key',$api_key);
	$sam_martin_google_map = 'https://maps.googleapis.com/maps/api/js?key='.esc_html($google_api_key);
	
	wp_enqueue_script( 'wpcvtheme-navigation'         , get_template_directory_uri() . '/js/navigation.js'            , array('jquery'), '20151215'             , true );                       // Navigation JS
	wp_enqueue_script( 'modernizr'                     , get_template_directory_uri() . '/js/modernizr.min.js'         , array('jquery'), ''                     , true );                       // Modernizr JS
	wp_enqueue_script( 'wpcvtheme-plugins-js'         , get_template_directory_uri() . '/js/plugins.js'               , array('jquery'), ''                     , true );                       // Plugin JS
	wp_enqueue_script( 'google_map'                    , $sam_martin_google_map                                        , array('jquery') );                                                      // Google Map
	wp_enqueue_script( 'wpcvtheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js'   , array('jquery'), '20151215'             , true );                       // Sam Martin Skip Link Focus Fix
	wp_enqueue_script( 'bootstrap'                     , get_template_directory_uri() . '/js/bootstrap.min.js'         , array('jquery'), '4.6'                  , true );                       // Bootstrap JS
	wp_enqueue_script( 'matchheight_js'                , get_template_directory_uri() . '/js/jquery.matchHeight-min.js', array('jquery'), '4.6'                  , true );                       // MatchHeight
	wp_enqueue_script( 'masonry'); 
	wp_enqueue_script( 'wpcvtheme-custom-js'          , get_template_directory_uri() . '/js/custom.js'                , array('jquery' , 'wpcvtheme-plugins-js', 'matchheight_js'), '', true );// Sam Martin Custom Javascript
	wp_enqueue_script( 'wpcvtheme-functions'          , get_template_directory_uri() . '/js/functions.js'             , array('jquery'), ''                     , true );                       // Sam Martin Functions Javascript
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Google Map script */		
	$map_marker = (@$sam_martin_options['map-marker']['url']!='') ? $sam_martin_options['map-marker']['url'] : SAM_MARTIN_URL.'/images/map-marker.png';
	$footer_google_map_lat = ( @$sam_martin_options['footer_google_map']['lat'] ? @$sam_martin_options['footer_google_map']['lat'] : 40.7058316 );
	$footer_google_map_long = ( @$sam_martin_options['footer_google_map']['long'] ? @$sam_martin_options['footer_google_map']['long'] : -74.2581904 );
	
	if(isset($sam_martin_options['map-marker']['url']) && isset($sam_martin_options['footer_google_map']['lat']) && isset($sam_martin_options['footer_google_map']['long']) && !is_404()){
	@$google_map_scripts='
(function($){
   "use strict";
    function initialize_map() {
      var myLatLng = new google.maps.LatLng('.esc_js($footer_google_map_lat).','.esc_js($footer_google_map_long).');
      var mapOptions = {
          zoom: 15,
          center: myLatLng,
          draggable: true,
		  scrollwheel: false,
		  navigationControl: false,
		  mapTypeControl: false,
		  scaleControl: false,
        // How you would like to style the map.
        // This is where you would paste any style found on Snazzy Maps.
       styles: [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":1}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":-20}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}]
    };
    var mapElement = document.getElementById("map-canvas");
    var map = new google.maps.Map(mapElement, mapOptions);
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng('.esc_js($footer_google_map_lat).','.esc_js($footer_google_map_long).'),
        map: map,
		icon: "'.@$map_marker.'",
		});
    }
    google.maps.event.addDomListener(window, "load", initialize_map);
})(jQuery)';
	
	wp_add_inline_script( 'wpcvtheme-functions', @$google_map_scripts );
	}
}
add_action( 'wp_enqueue_scripts', 'sam_martin_scripts' );

function sam_martin_admin_enqueue_scripts( $hook ){
	wp_enqueue_style( 'wpcvtheme-admin-style', get_template_directory_uri().'/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'sam_martin_admin_enqueue_scripts' );

/**
 * Enqueue admin styles.
 */
add_action('admin_head','sam_martin_admin_head');
function sam_martin_admin_head(){
	wp_register_style( 'jquery-ui', get_template_directory_uri()."/css/jquery-ui-admin.css" );
	wp_enqueue_style( 'jquery-ui' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6' );
}

if(is_admin()){
/*
 * Load sample data file
 */
require_once get_template_directory() . '/includes/sample_data/sample_data.php';	
}

/*
 * Load supported plugin activate files
 */
require_once get_template_directory() . '/includes/tgm-plugin-activation/tgm-init.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/navwalker.php';
/**
 * Load Theme Functions.php
 */
require_once get_template_directory().'/includes/theme-functions.php';

/**
 * Load Redux Framework file
 */
require_once get_template_directory().'/includes/redux-options.php';
/*
 * Load Theme Widgets file
 */
require_once get_template_directory().'/includes/theme-widgets.php';
/*
 * Load Theme widget file
 */
require_once get_template_directory().'/includes/widgets.php';
/*
 * Load Theme breadcrumbs file
 */
require_once get_template_directory().'/includes/theme-breadcrumbs.php';
/*
 * Load acf file
 */
require_once get_template_directory() . '/includes/acf.php';                     // Advaced Custom Fields

/* Social share icon and script */
add_action('sam_martin_social_share','sam_martin_social_share');
function sam_martin_social_share($post_id){
	global $post;
	?>
	<div class="social pull-right">
		<ul class="single-share-box mk-box-to-trigger">
			<?php
			global $sam_martin_options;
			$facebook_share = $sam_martin_options['facebook_share'];
			$twitter_share = $sam_martin_options['twitter_share'];						
			$linkedin_share = $sam_martin_options['linkedin_share'];
			$google_plus_share = $sam_martin_options['google_plus_share'];
			$pinterest_share = $sam_martin_options['pinterest_share'];
			if($facebook_share){?>
				<li>
					<a href="#" class="facebook-share" data-title="<?php echo esc_attr(get_the_title());?>" data-url="<?php echo esc_url(get_permalink());?>"><i class="fa fa-facebook"></i></a>
				</li>
			<?php }
			if($twitter_share){?>
				<li><a href="#"  data-title="<?php echo esc_attr(get_the_title());?>" data-url="<?php echo esc_url(get_permalink());?>" class="twitter-share"><i class="fa fa-twitter"></i></a></li>
			<?php }?>
			<?php
			if($linkedin_share){?>
				<li><a href="#" data-title="<?php echo esc_attr(get_the_title())?>" data-url="<?php echo esc_url(get_permalink());?>" class="linkedin-share"><i class="fa fa-linkedin"></i></a></li>
			<?php }?>
			<?php
			if($google_plus_share){?>
				<li><a href="#" data-title="<?php echo esc_attr(get_the_title());?>" data-url="<?php echo esc_url(get_permalink());?>" class="googleplus-share"><i class="fa fa-google-plus"></i></a></li>
			<?php }?>
			<?php
			if($pinterest_share){?>
				<li><a href="#" data-title="<?php echo esc_attr(get_the_title())?>" data-url="<?php echo esc_url(get_permalink());?>" class="pinterest-share"><i class="fa fa-pinterest"></i></a></li>
			<?php }?>
		</ul>
	</div>
	<?php
	
}


// Convert hexdec color string to rgb(a) string
// Source : https://support.advancedcustomfields.com/forums/topic/color-picker-values/
function sam_martin_hex2rgba($color = '', $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
		return $default;

	//Sanitize $color if "#" is provided
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if (strlen($color) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	//Convert hexadec to rgb
	$rgb =  array_map('hexdec', $hex);

	//Check if opacity is set(rgba or rgb)
	if($opacity){
		if(abs($opacity) > 1)
			$opacity = 1.0;
		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	} else {
		$output = 'rgb('.implode(",",$rgb).')';
	}

	//Return rgb(a) color string
	return esc_html($output);
}

/* add filter comment_form_fields for rearrange comment fields */
add_filter('comment_form_fields','sam_martin_comment_form_fields');
function sam_martin_comment_form_fields($comment_fields){
	$new_comment_fields['author']=$comment_fields['author'];
	$new_comment_fields['email']=$comment_fields['email'];
	if(isset($comment_fields['url'])){
		$new_comment_fields['url']=$comment_fields['url'];
	}
	$new_comment_fields['comment']=$comment_fields['comment'];
	return $new_comment_fields;
}

	
if ( ! function_exists( 'sam_martin_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sam_martin_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function sam_martin_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php esc_html_e( 'Pingback:', 'wpcvtheme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'wpcvtheme' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class('comments-'.esc_attr($depth)); ?> id="li-comment-<?php comment_ID(); ?>">		
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comments-photo">
				<?php echo get_avatar( $comment, 44 );?>
			</div>
			<div class="comments-info">
				<h4 class="text-blue"><?php printf( '%1$s %2$s',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' .  esc_html__( 'Post author', 'wpcvtheme' ) . '</span>' : ''
					);
					printf( '<span><time datetime="%1$s">%2$s</time></span>',						
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf(  esc_html__( '%1$s at %2$s', 'wpcvtheme' ), get_comment_date(), get_comment_time() )
					);?></h4>
				<div class="reply port-post-social pull-right">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'wpcvtheme' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<section class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link( esc_html__( 'Edit', 'wpcvtheme' ), '<p class="edit-link">', '</p>' ); ?>
				</section><!-- .comment-content -->
			</div>			

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wpcvtheme' ); ?></p>
			<?php endif; ?>			
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/*
 * Return post taxonomy array
 * This function only get the assign post taxonomy array
 */
function sam_martin_post_taxonomy($post_id,$post_type){
	
	$taxonomies = get_object_taxonomies( (object) array( 'post_type' => $post_type,'public'   => true, '_builtin' => true ));
	if(!empty($taxonomies)){
		return get_the_terms( $post_id ,$taxonomies[0]);
	}else{
		return '';
	}
}

function sam_martin_posts_pagination(){
	
	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 )
		return;
	?>
	<div class="row">
		<nav class="navigation pagination clearfix col-lg-12 col-md-12 text-center">
			<?php
				echo paginate_links( apply_filters( 'sam_martin_pagination_args', array(
					'base'         => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', htmlspecialchars_decode( get_pagenum_link( 999999999 ) ) ) ) ),
					'format'       => '',
					'current'      => max( 1, get_query_var( 'paged' ) ),
					'total'        => $wp_query->max_num_pages,
					'prev_text' => '<span class="icon-arrow-left">&laquo;</span>',
					'next_text' => '<span class="icon-arrow-right">&raquo;</span>',
					'type'         => 'list',
					'end_size'     => 3,
					'mid_size'     => 3
				) ) );
			?>
		</nav>
	</div>
	<?php
}

/*
 * This function display the post authro info
 */
function sam_martin_authro_infobox(){
	global $wpdb,$post;
	$user_id=$post->post_author;
	$user_info = get_userdata($user_id);	
	
	$description=get_user_meta($user_id,'description',true);
	$twitter_url=get_user_meta($user_id,'twitter_url',true);
	$pintrest_url=get_user_meta($user_id,'pintrest_url',true);
	$facebook_url=get_user_meta($user_id,'facebook_url',true);
	if(!empty($user_info) && $user_id!=''):
	?>
		<div class="row">
			<div class="col-ld-12 col-md-12">
				<div class="port-post clearfix">
					<div class="port-post-photo">					
						<?php echo get_avatar( $user_id, 250 ); ?>
					</div>
					<div class="port-post-info">
						<h3 class="text-blue"><span><?php esc_html_e('Posted by : ','wpcvtheme');?></span><?php echo get_the_author();?></h3>
						
						<?php if($facebook_url!='' || $twitter_url!='' || $pintrest_url!='' ):?>
						<div class="port-post-social pull-right">
							<strong><?php esc_html_e('Follow on:','wpcvtheme');?></strong>
							<?php if($facebook_url)?>
								<a href="<?php echo esc_url($facebook_url);?>"><i class="fa fa-facebook"></i></a>
							<?php if($twitter_url)?>
								<a href="<?php echo esc_url($twitter_url);?>"><i class="fa fa-twitter"></i></a>
							<?php if($pintrest_url)?>
								<a href="<?php echo esc_url($pintrest_url)?>"><i class="fa fa-pinterest-p"></i></a>
						</div>
						<?php endif;?>
						
						<?php if($description)?>
							<p><?php echo esc_html($description);?></p>
						
					</div>
				</div>
			</div>
		</div>
	<?php
	endif;
	
}

/*
 *
 */
function sam_martin_single_post_author_info(){
	
	global $wpdb,$post,$sam_martin_options;
	$user_id=$post->post_author;
	$user_info = get_userdata($user_id);
	
	if(is_single() && get_post_type()=='post' && !empty($user_info) && $user_id!=''):
		$description      = get_user_meta($user_id,'description',true);
		$user_designation = get_user_meta($user_id,'user_designation',true);
		
		$facebook_share   = $sam_martin_options['facebook_share'];
		$twitter_share    = $sam_martin_options['twitter_share'];
		$linkedin_share   = $sam_martin_options['linkedin_share'];
		$google_plus_share= $sam_martin_options['google_plus_share'];
		$pinterest_share  = $sam_martin_options['pinterest_share'];
	?>		
		<div class="author">
            <div class="author-details">
                <div class="author-avtar">
					<?php echo get_avatar( $user_id, 250 ); ?>
                </div>
                <div class="author-name">
					<h4><?php echo get_the_author();?></h4>				
					<?php
					if($user_designation!=''):
						echo "<b>".$user_designation."</b>";
					endif;
					?>
				
                </div>
            </div>			
			<?php if($description):?>
				<div class="author-content">
					<p><?php echo esc_html($description);?></p>
				</div>
			<?php endif;?>
		</div>
		<?php if($facebook_share || $twitter_share || $linkedin_share || $google_plus_share || $pinterest_share):?>
		<div class="slidebar-share single-post-social-share">
			<h4><?php esc_html_e('share post :','wpcvtheme');?> </h4>
			<?php do_action('sam_martin_social_share',get_the_ID());?>
		</div>
		<?php endif;/*Social share off */
	endif;
	
}

/* Remove front end edit visual composer link on admin bar*/
add_action('wp_head','sam_martin_remove_visual_composer_edit_link');
add_action('vc_after_init','sam_martin_remove_visual_composer_edit_link');
function sam_martin_remove_visual_composer_edit_link(){
	
	/* if js composer plugin activate then disable frontend editor*/
	if( function_exists('is_plugin_active') && is_plugin_active('js_composer/js_composer.php') ){	
	
		$post_types=apply_filters('remove_visual_composer_editor_posts',array('post','portfolios','testimonials'));		
		
		foreach($post_types as $post_type){
			if(get_post_type() == $post_type || (isset($_REQUEST['post_type']) && $_REQUEST['post_type']==$post_type)){
				vc_disable_frontend(); // this will disable frontend editor
				remove_filter( 'edit_post_link', array( vc_frontend_editor(), 'renderEditButton' ) );
				
			}
		}
	}
}

/*Hide woocommerce page title */
function sam_martin_woocommerce_show_page_title(){
	return false;
}
/* Theme by default display 15 excerpt length */
function sam_martin_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'sam_martin_excerpt_length' );

/* allow permission for upload ico formate file */
add_filter('upload_mimes','sam_martin_upload_mimes');
function sam_martin_upload_mimes($mimes) {
	$mimes['ico'] ='image/x-icon';
	return $mimes;
}

/*
 * Set Sam martin favicon icon.
 */
add_action( 'wp_head','sam_martin_site_icon',98);
function sam_martin_site_icon(){
	global $sam_martin_options;
	
	if(function_exists('wp_site_icon')){
		
		$site_icon_id = get_option( 'site_icon' );
		/* if user upload favicon icon from backend then we will update site_icon option  */	
		if($site_icon_id==0 && isset($sam_martin_options['site-favicon']['id']) && $sam_martin_options['site-favicon']['id']!=''){
			update_option('site_icon',$sam_martin_options['site-favicon']['id']);
		}
		
		if(!empty($sam_martin_options['site-favicon']) && !isset($sam_martin_options['site-favicon']['id']) && $site_icon_id==0):
			echo sprintf( '<link rel="shortcut icon" href="%s" sizes="32x32" />', esc_url( $sam_martin_options['site-favicon']['url'] ) ) ."\n";
		endif;
	}else{
		echo sprintf( '<link rel="shortcut icon" href="%s" sizes="32x32" />', esc_url( $sam_martin_options['site-favicon']['url'] ) ) ."\n";		
	}
}

/* Set ico file mime type extension */
add_filter('getimagesize_mimes_to_exts','sam_martin_getimagesize_mimes_to_exts');
function sam_martin_getimagesize_mimes_to_exts($mime_to_ext){	
	$mime_to_ext[ 'image/vnd.microsoft.icon' ] = "ico";
    $mime_to_ext[ 'image/x-icon' ]             = "ico";
    $mime_to_ext[ 'image/ico' ]                = "ico";
	return $mime_to_ext;
}
add_filter( 'upload_mimes', 'sam_martin_add_ico_ext', 99999 );
/*Add Ico File Extension to Allowed Mimes*/
function sam_martin_add_ico_ext( $site_mimes ) {
    if (isset($site_mimes['ico']) === false) $site_mimes['ico'] = 'image/vnd.microsoft.icon';
    return $site_mimes;
}