<?php
if ( !class_exists( 'ReduxFramework' ) ) {
	return;
}

require_once get_template_directory().'/includes/pgs_redux_map/field_pgs_redux_map.php';
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "sam_martin_options";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => esc_html__( 'Theme Settings', 'wpcvtheme' ),
	'page_title'           => esc_html__( 'Theme Settings', 'wpcvtheme' ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string	
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => true,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support	

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = array(
	'id'   => 'potenza-website',
	'href' => 'http://www.potenzaglobalsolutions.com',
	'title'=> esc_html__('Potenza', 'wpcvtheme'),
);

$args['admin_bar_links'][] = array(	
	'href' => 'https://potezasupport.ticksy.com/',
	'title'=> esc_html__('Support', 'wpcvtheme'),
);

$args['admin_bar_links'][] = array(
	'id'   => 'potenza-tf-profile',
	'href' => 'https://themeforest.net/user/potenzaglobalsolutions',
	'title'=> esc_html__('Themeforest Profile', 'wpcvtheme'),
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args['share_icons'][] = array(
	'url'  => 'https://www.facebook.com/potenzasolutions',
	'title'=> 'Like us on Facebook',
	'icon' => 'el el-facebook'
);
$args['share_icons'][] = array(
	'url'  => 'https://twitter.com/PotenzaGlobal',
	'title'=> 'Follow us on Twitter',
	'icon' => 'el el-twitter'
);
$args['share_icons'][] = array(
	'url'  => 'https://plus.google.com/+Potenzaglobalsolutions/posts',
	'title'=> 'Follow us on Google+',
	'icon' => 'el el-googleplus'
);
$args['share_icons'][] = array(
	'url'  => 'http://www.linkedin.com/company/potenza-global-solutions-pvt-ltd-',
	'title'=> 'Find us on LinkedIn',
	'icon' => 'el el-linkedin'
);
$args['share_icons'][] = array(
	'url'  => 'http://www.potenzaglobalsolutions.com/blogs/',
	'title'=> 'Our Blog',
	'icon' => 'el el-quotes'
);

// Panel Intro text -> before the form
if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
	if ( ! empty( $args['global_variable'] ) ) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace( '-', '_', $args['opt_name'] );
	}
	$args['intro_text'] = sprintf( wp_kses( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'wpcvtheme' ), array('strong' => array(),'p' => array()) ), $v );
} else {
	$args['intro_text'] = wp_kses( __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'wpcvtheme' ), array('p' => array()) );
}

// Add content after the form.
$args['footer_text'] = wp_kses( __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'wpcvtheme' ), array('p' => array()) );

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */
 
/**
 * Start Sam Martin Theme Options
 */
 
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Header', 'wpcvtheme' ),
	'id'               => 'header',	
	'customizer_width' => '400px',
	'icon'             => 'el el-website'
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Site Logo', 'wpcvtheme' ),
	'id'         => 'header-site-logo',
	'desc'       => esc_html__( 'Upload Site Logo ', 'wpcvtheme' ) ,
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'site-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Site Logo', 'wpcvtheme' ),
			'compiler' => 'true',
			'desc'     => esc_html__( 'Upload Site Logo', 'wpcvtheme' ),			
			'default'  => array( 'url' => SAM_MARTIN_URL . '/images/logo_skin-default.png' ),
		),
		array(
			'id'       => 'site-favicon',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Favicon Icon', 'wpcvtheme' ),
			'compiler' => 'true',			
			'desc'     => esc_html__( 'Upload Site favicon icon', 'wpcvtheme' ),
			'default'  => array( 'url' => SAM_MARTIN_URL . '/images/favicon.ico' ),
		),			
		
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Site layout & Color Schemes', 'wpcvtheme' ),
	'id'         => 'header-site-layout',
	'desc'       => esc_html__( 'Which Layout options you want to use? Choose from below options.', 'wpcvtheme' ) ,
	'subsection' => true,
	'fields'     => array(
	
		array(
			'id'       => 'section-start',
			'type'     => 'section',
			'title'    => esc_html__( 'Color Schemes', 'wpcvtheme' ),
			'subtitle' => esc_html__( 'Which theme color you want to use? Here are some predefined colors.', 'wpcvtheme' ),
			'indent'   => true, // Indent all options below until the next 'section' option is set.
		),
		array(
			'id' => 'primary_color',
			'type' => 'color',
			'title' => esc_html__('Main Theme Color', 'wpcvtheme'),            
			'default' => '',			
		),
		array(
			'id' => 'secondary_color',
			'type' => 'color',
			'title' => esc_html__('Secondary Color', 'wpcvtheme'),            
			'default' => '',			
		),
		array(
			'id' => 'tertiary_color',
			'type' => 'color',
			'title' => esc_html__('Tertiary Color', 'wpcvtheme'),            
			'default' => '',			
		),		
		array(
			'id'       => 'section-layout-start',
			'type'     => 'section',
			'title'    => esc_html__( 'Site layout Option', 'wpcvtheme' ),
			'subtitle' => esc_html__( 'Which Layout options you want to use? Choose from below options.', 'wpcvtheme' ),
			'indent'   => true, // Indent all options below until the next 'section' option is set.
		),
		array(
			'id' => 'site_layout',
			'type' => 'image_select',
			'width' => '134px',
			'height' => '138px',
			'title' => esc_html__('Layout Option', 'wpcvtheme'),           
			'options' => array(
				'layout_01' => array(
					'alt' => esc_html__('Layout 01','wpcvtheme'),
					'img' => SAM_MARTIN_URL . '/images/site-layout/layout-01.png'
				),
				'layout_02' => array(
					'alt' => esc_html__('Layout 02','wpcvtheme'),
					'img' => SAM_MARTIN_URL . '/images/site-layout/layout-02.png'
				),
				'layout_03' => array(
					'alt' => esc_html__('Layout 03','wpcvtheme'),
					'img' => SAM_MARTIN_URL . '/images/site-layout/layout-03.png'
				),
			),
			'default' => 'layout_01'
		),
		
		array(
			'id'       => 'section-social-start',
			'type'     => 'section',
			'title'    => esc_html__( 'Social Link', 'wpcvtheme' ),			
			'indent'   => true, // Indent all options below until the next 'section' option is set.
			'required' => array('site_layout', '=', 'layout_01'),
		),
		
		array(
			'id' => 'facebook_url',
			'type' => 'text',
			'title' => esc_html__('Facebook', 'wpcvtheme'),
			'subtitle' => esc_html__('Enter Facebook url.', 'wpcvtheme'),
			'validate' => 'url',
			'default' => 'http://www.facebook.com/wpcvtheme',
			'required' => array('site_layout', '=', 'layout_01'),
		),
		array(
			'id' => 'twitter_url',
			'type' => 'text',
			'title' => esc_html__('Twitter', 'wpcvtheme'),
			'subtitle' => esc_html__('Enter Twitter url.', 'wpcvtheme'),
			'validate' => 'url',
			'default' => 'http://www.twitter.com/wpcvtheme',
			'required' => array('site_layout', '=', 'layout_01'),
		),
		array(
			'id' => 'linkedin_url',
			'type' => 'text',
			'title' => esc_html__('Linkedin', 'wpcvtheme'),
			'subtitle' => esc_html__('Enter Linkedin url.', 'wpcvtheme'),
			'validate' => 'url',
			'default' => 'http://www.linkedin.com/wpcvtheme',
			'required' => array('site_layout', '=', 'layout_01'),
		),
		array(
			'id' => 'copy_write',
			'type' => 'textarea',          
			'title' => esc_html__('Copy Write Text', 'wpcvtheme'),            
			'required' => array('site_layout', '=', 'layout_01'),            
			'default' => '&copy; Sam Martin<br>all rights reserved',        ),
	)
) );



/*Footer Section */	
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Footer', 'wpcvtheme' ),
	'id'               => 'footer',	
	'customizer_width' => '400px',
	'icon'             => 'el el-inbox',
	'fields'     => array(
		array(
		   'id'       => 'footer_google_map',
		   'type'     => 'pgs_redux_map',
		   'title'    => esc_html__( 'Google Map', 'wpcvtheme' ),
		   'desc'     => '',
		   'subtitle' => esc_html__( 'You can set your address on google map', 'wpcvtheme' ),
		   'default'  => array( 'map_address'=>'68-32 Main St, Flushing, NY 11367, USA','lat'=>'40.7324319','long'=>'-73.82480777777778' ),
		   'hint'     => array(
			'content' => esc_html__('A marker identifies a location on a map. Hold pressed and drag to move it','wpcvtheme'),
		   )
		),
		array(
			'id'       => 'map-marker',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Map Marker', 'wpcvtheme' ),
			'compiler' => 'true',			
			'desc'     => esc_html__( 'Set your own google map marker on front end google map ', 'wpcvtheme' ),
			'subtitle' => esc_html__( 'Upload Google Map Marker', 'wpcvtheme' ),
			'default'  => array( 'url' => SAM_MARTIN_URL . '/images/map-marker.png' ),
		),
		array(
			'id'       => 'google_api_key',
			'type'     => 'text',
			'url'      => true,
			'title'    => esc_html__( 'Google Map API Key', 'wpcvtheme' ),
			'compiler' => 'true',			
			'desc'     => esc_html__( 'Set your own google API Key here ', 'wpcvtheme' ),			
			'default'  => '',
		),		
		array(
			'id' => 'footre_contact_icon',
			'type' => 'button_set',
			'title' => esc_html__('Display Contact Icon In footer', 'wpcvtheme'),
			'subtitle' => '',            
			'options'  => array(
				'yes' => esc_html__('Yes','wpcvtheme'),
				'no' => esc_html__('No','wpcvtheme'),
			),
			'default'  => 'yes'
		),
		array(
			'id'       => 'contact_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Contact Title', 'wpcvtheme' ),			
			'desc'     => esc_html__( 'Enter Contact us title', 'wpcvtheme' ),
			'default'  => esc_html__('Drop me a line','wpcvtheme'),
			'required' => array('footre_contact_icon', '=', 'yes'),
		),
		array(
			'id'       => 'contact_description',
			'type'     => 'textarea',
			'title'    => esc_html__( 'Contact Description', 'wpcvtheme' ),			
			'desc'     => esc_html__( 'Enter Contact us description', 'wpcvtheme' ),
			'default'  => esc_html__('Use this form to tell me about your project goals and needs. I will be in touch within 24 hours.','wpcvtheme'),
			'required' => array('footre_contact_icon', '=', 'yes'),
		),
		array(
			'id'       => 'contact_form_7_shortcode',
			'type'     => 'text',
			'title'    => esc_html__( 'Contact Form 7 Shortcode ', 'wpcvtheme' ),			
			'desc'     => esc_html__( 'Enter Contact Form 7 shortcode for display contact us form', 'wpcvtheme' ),
			'default'  => '',
			'required' => array('footre_contact_icon', '=', 'yes'),
		),
		
	)
) );


/* ------------------------------------------------------------------------
 * 
 * Social Sharing
 * 
  ------------------------------------------------------------------------*/
Redux::setSection($opt_name, array(
	'title' => esc_html__('Social Sharing', 'wpcvtheme'),
	'id' => 'social_sharing_settings',
	'desc' => esc_html__('Enable disable sharing functionality.', 'wpcvtheme'),
	'customizer_width' => '400px',
	'icon' => 'el el-share-alt',
	'fields' => array(
		array(
			'id' => 'facebook_share',
			'type' => 'switch',
			'title' => esc_html__('Facebook Share', 'wpcvtheme'),
			'subtitle' => '',
			'desc' => esc_html__('You can share post with facebook.', 'wpcvtheme'),
			'default' => '1'// 1 = on | 0 = off
		),
		array(
			'id' => 'twitter_share',
			'type' => 'switch',
			'title' => esc_html__('Twitter Share', 'wpcvtheme'),
			'subtitle' => '',
			'desc' => esc_html__('You can share post with twitter', 'wpcvtheme'),
			'default' => '1'// 1 = on | 0 = off
		),        
		array(
			'id' => 'linkedin_share',
			'type' => 'switch',
			'title' => esc_html__('Linkedin Share', 'wpcvtheme'),
			'subtitle' => '',
			'desc' => esc_html__('You can share post with linkedin', 'wpcvtheme'),
			'default' => '1'// 1 = on | 0 = off
		),
		array(
			'id' => 'google_plus_share',
			'type' => 'switch',
			'title' => esc_html__('Google Plus Share', 'wpcvtheme'),
			'subtitle' => '',
			'desc' => esc_html__('You can share post with google plus', 'wpcvtheme'),
			'default' => '1'// 1 = on | 0 = off
		),
		array(
			'id' => 'pinterest_share',
			'type' => 'switch',
			'title' => esc_html__('Pinterest Share', 'wpcvtheme'),
			'subtitle' => '',
			'desc' => esc_html__('You can share post with pinterest', 'wpcvtheme'),
			'default' => '1'// 1 = on | 0 = off
		),
	)
));

Redux::setSection($opt_name, array(
	'title' => esc_html__('Default Header Setting', 'wpcvtheme'),
	'id' => 'default_header_settings',
	'desc' => esc_html__('You can set the default header setting', 'wpcvtheme'),
	'customizer_width' => '400px',
	'icon' => 'el el-website',
	'fields' => array(
		array(
			'id' => 'header_banner_type',
			'type' => 'button_set',
			'title' => esc_html__('Header Banner Type', 'wpcvtheme'),
			'subtitle' => '',            
			'options'  => array(
				'image' => esc_html__('Image','wpcvtheme'),
				'color' => esc_html__('Color','wpcvtheme'),
			),
			'default'  => 'image'
		),
		array(
			'id' => 'header_banner_image',
			'type'     => 'media',
			'url'      => true,
			'title' => esc_html__('Banner (Image)', 'wpcvtheme'),
			'subtitle' => '',            
			'default'  => array( 'url' => SAM_MARTIN_URL . '/images/default_banner.jpg' ),
			'required' => array('header_banner_type', '=', 'image'),
		),
		array(
			'id'       => 'header_background_color_opacity',
			'type'     => 'color',
			'output'   => array( '.site-title' ),
			'title'    => esc_html__( 'Background Opacity Color (Custom Color)', 'wpcvtheme' ),
			'subtitle' => esc_html__( 'Pick a background opacity color for the header (default: #000).', 'wpcvtheme' ),
			'default'  => '#000000',
			'required' => array('header_banner_type', '=', 'image'),
		),
		array(
			'id'            => 'header_background_opacity',
			'type'          => 'slider',
			'title'         => esc_html__( 'Background Opacity Color (Custom Opacity)', 'wpcvtheme' ),
			'subtitle'      => esc_html__( 'This example displays float values', 'wpcvtheme' ),
			'desc'          => esc_html__( 'Slider description. Min: 0, max: 1, step: .1, default value: .5', 'wpcvtheme' ),
			'default'       => .5,
			'min'           => 0,
			'step'          => .1,
			'max'           => 1,
			'resolution'    => 0.1,
			'display_value' => 'text',
			'required' => array('header_banner_type', '=', 'image'),
		),
		array(
			'id'       => 'header_background_color',
			'type'     => 'color',			
			'title'    => esc_html__( 'Banner (Color)', 'wpcvtheme' ),
			'subtitle' => esc_html__( 'Pick a backgroundcolor for the header (default: #000).', 'wpcvtheme' ),
			'default'  => '#000000',
			'required' => array('header_banner_type', '=', 'color'),
		),
		
	)
));

/* End Same Martin Theme Options */

add_filter( 'redux/options/sam_martin_options/ajax_save/response','sam_martin_color_customize_ajax_save', 11 );
function sam_martin_color_customize_ajax_save( $response = '' ){
	global $sam_martin_options,$wp_filesystem;
	
	if ( empty( $wp_filesystem ) ) {
		require_once ( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}
	
	$redux = new ReduxFramework;
	$redux->args = $args;
	
	if ( $args['database'] === "transient" ) {
		$sam_martin_options = get_transient( 'sam_martin_options' . '-transient' );
	} else if ( $args['database'] === "theme_mods" ) {
		$sam_martin_options = get_theme_mod( 'sam_martin_options' . '-mods' );
	} else if ( $args['database'] === 'theme_mods_expanded' ) {
		$sam_martin_options = get_theme_mods();
	} else if ( $args['database'] === 'network' ) {
		$sam_martin_options = get_site_option( 'sam_martin_options', array() );
		$sam_martin_options = json_decode( stripslashes( json_encode( $result ) ), true );
	} else {
		$sam_martin_options = get_option( 'sam_martin_options' );
	}
	
	$primary_color  = esc_html($sam_martin_options['primary_color']);
	$secondary_color= esc_html($sam_martin_options['secondary_color']);
	$tertiary_color = esc_html($sam_martin_options['tertiary_color']);
	
	$primary_color_customize='/*background*/
.vc_general.vc_btn3, .section-title-name span, .about-social, .service-block .contact-button, .skill .bar, .portfolio-item .item-info .item-link a, .woocommerce ul.products li.product .onsale, .woocommerce ul.products li.product .button, .ui-datepicker-today, .date-area, .dateinfo .block > .today, .blog-block .blog-image .blog-date span, .button-small a, .button-large a, .contact-toggle span, input[type="submit"], .page-numbers li span.page-numbers.current, .page-numbers li span:focus, .page-numbers li a:hover, .tags-2 li a:hover, .widget .slidebar-tag ul li a:hover, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce a.button.alt, .woocommerce #payment #place_order, .woocommerce a.button, .woocommerce input[type="submit"], .woocommerce div.product form.cart .button, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #respond input#submit,#wp-calendar a{ background: '.$primary_color.' !important; }

/*color*/
.feature_box .feature-info h4, .main-navigation li.active a, .main-navigation li a:hover, .navbar-nav>li>.dropdown-menu li a:hover, .navbar-nav>li>.dropdown-menu li a:focus, .feature_box .feature-info h3, ul.pgs_list.pgs_list_style_1 li i, .isotope-filters  button.active, .isotope-filters  button:hover, .portfolio-item .item-info a:hover, .portfolio-item .item-info span, .portfolio-item .item-info a:hover span, .woocommerce ul.products li.product h3:hover, .woocommerce .star-rating:before, .woocommerce .star-rating span:before, .date-area > .date, .blog-info .blog-meta p a:hover, .blog-info .blog-content a.recent-post-title:hover, .blog-bottom .social ul li a.recent-post-title:hover, .testimonials-name h4, .contact .social ul li a:hover, .menu-footer .social ul li a:hover, .contact-form h4, .port-meta li b, .port-post-social a:hover, .nav-previous a, .comments-1 .comments-info h4, .comments-1 .comments-info a, .logged-in-as a, .author-details .author-name b, .slidebar-share ul li a, .widget.widget_recent_entries h3, .slidebar-post .post a:hover, .slidebar h3, ul#recentcomments li a:hover, .widget ul li a:hover, .shop_table .cart_item a, .woocommerce-info:before, .woocommerce .woocommerce-info a, .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-MyAccount-navigation ul li a:hover, .woocommerce-MyAccount-content a, .woocommerce-LostPassword.lost_password a, .vc_wp_tagcloud .tagcloud a, .social ul li a, .woocommerce-product-rating a, .product .product_meta a, .woocommerce p.stars a, #site-header.site-header .main-navigation li.active a, #site-header.site-header .main-navigation li a:hover, #site-header.site-header .navbar-nav>li>.dropdown-menu li a:hover, #center-header.site-header .main-navigation li.active a, #center-header.site-header .main-navigation li a:hover, #center-header.site-header .navbar-nav>li>.dropdown-menu li a:hover, .widget_rss .widgettitle a, .sample-page a, .navigation.post-navigation .nav-next a, .sample-page a, .navigation.post-navigation .nav-next a, .widget_rss .widget-title a, .widget_tag_cloud .tagcloud a { color: '.$primary_color.' !important; }

/*border color*/
.main-navigation li.active a, .main-navigation li a:hover, .skill-content blockquote, .contact-form input:focus, .contact-form .wpcf7-form-control-wrap input:focus, .contact-form .wpcf7-form-control-wrap textarea:focus, .blog-single blockquote, blockquote, textarea:focus, input:focus, input[type="search"], .widget ul li a:hover, .widget .slidebar-tag ul li a:hover, .woocommerce form .form-row.woocommerce-validated .select2-container, .woocommerce form .form-row.woocommerce-validated input.input-text, .woocommerce form .form-row.woocommerce-validated select, .woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus, #site-header.site-header .main-navigation li.active a, #site-header.site-header .main-navigation li a:hover, #center-header.site-header .main-navigation li.active a, #center-header.site-header .main-navigation li a:hover { border-color: '.$primary_color.' !important; }

/*box shadow*/
.main-navigation li.active a, .main-navigation li a:hover { box-shadow: 15px 0px 0px 0px '.$primary_color.' inset; }
.woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-MyAccount-navigation ul li a:hover { box-shadow: 3px 0px 0px '.$primary_color.' inset; }
/*white important color*/
.blog-bottom .button-small a { color: #ffffff !important; }
';
	
	
	if($primary_color==''){
		$primary_color_customize='';
	}
	
	$secondary_color_customize='/*====================== Secondory color ====================== */
	/*color*/
body, h1, h2, h3, h4, h5, h6, .section-title-name h2, .about-block p b, .isotope-filters  button, ul.pgs_list.pgs_list_style_1 li, .woocommerce ul.products li.product h3, .woocommerce .price span, .ui-widget-content, .ui-widget-header a, .ui-widget-header, .blog-info .blog-meta p a, .testimonials-name span, .blog-info .blog-content a, .woocommerce-MyAccount-navigation ul li a, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .shop_table .cart_item a:hover, .woocommerce-MyAccount-content a:hover, legend, .woocommerce-info, .woocommerce ul.products li.product .price, #site-header.site-header .navbar-nav>li>.dropdown-menu li a, #center-header.site-header .navbar-nav>li>.dropdown-menu li a, .navbar-nav>li>.dropdown-menu li a{ color: '.$secondary_color.'; }

/*background*/
#left-header, .menu-footer, .vc_general.vc_btn3:hover, .woocommerce ul.products li.product .button:hover, .button-small a:hover, .service-block .contact-button:hover, .portfolio-item .item-info, .woocommerce a.button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce .cart input.button:hover, .button-large a:hover, .woocommerce #payment #place_order:hover, .woocommerce input[type="submit"]:hover, input[type="submit"]:hover, #center-header.sticky, .contact-content, #site-header.sticky, .about-social ul li a:hover{ background: '.$secondary_color.' !important; }';
	
	if($secondary_color==''){
		$secondary_color_customize='';
	}
	
	$tertiary_color_customize='/*====================== Tertiary Color ====================== */
/*color*/
p, .feature_box .feature-info p, .skill-content b, .skill li, .skill .pct, .skill-chart .skill-chart-expand .expand p, .chart-bar h3, .percent, .woocommerce ul.products li.product .price del span, .blog-info .blog-meta span, .feature_box .feature-icon  span, .service-block span, .blog-bottom .social ul li a, .widget ul li a, .slidebar-post .post a, ul#recentcomments li, .widget.widget_text .textwidget, .dateinfo .block, .page-numbers li span, .page-numbers li a { color: '.$tertiary_color.' !important; }';
	
	if($tertiary_color==''){
		$tertiary_color_customize='';
	}
	
	
	$color_customize=$primary_color_customize.$secondary_color_customize.$tertiary_color_customize;

	/* Check Multisite is enable*/
	if ( is_multisite() ) {
		global $blog_id;
		
		$style_blog_dir=get_template_directory()."/css/blog";
		
		/*Check Blog Directort created or not */
		if (!is_dir($style_blog_dir)) {			
			wp_mkdir_p( $style_blog_dir );
		}
		
		$wp_filesystem->put_contents(
			$style_blog_dir.'/'.$blog_id.'-color_customize.css',
			$color_customize,
			FS_CHMOD_FILE // predefined mode settings for WP files
		);
		
	}else{				
		$wp_filesystem->put_contents(
			trailingslashit(get_template_directory())."css/color_customize.css",
			$color_customize,
			FS_CHMOD_FILE // predefined mode settings for WP files
		);
	}
	return $response;
}

/*
 * Removing Demo Mode and Notices
 * https://docs.reduxframework.com/core/the-basics/removing-demo-mode-and-notices/
 * 
 * */
function sam_martin_removeDemoModeLink() { // Be sure to rename this function to something more unique
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	}
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
	}
}
add_action('init', 'sam_martin_removeDemoModeLink');

/*
 * remove redux menu under the tools
 * https://hasin.me/2015/04/24/getting-rid-of-redux-framework-annoyances/
 * */
add_action( 'admin_menu', 'sam_martin_remove_redux_menu',12 );
function sam_martin_remove_redux_menu() {
	remove_submenu_page('tools.php', 'redux-about');
}