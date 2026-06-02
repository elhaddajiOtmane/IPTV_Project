<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Theme Configuration and Custom CSS initializtion
 */

/**
 * Global theme config for header/footer/sections/colors/fonts
 */
if ( !function_exists('mirasat_theme_config') ) {

	add_filter( 'ltx_get_theme_config', 'mirasat_theme_config', 10, 1 );
	function mirasat_theme_config() {

	    return array(
	    	'navbar'	=>	array(
				'transparent'  => esc_html__( 'Default transparent. Black Background', 'mirasat' ),		
				'hamburger'  => esc_html__( 'Desktop with Hamburger', 'mirasat' ),						
				'white'  	=> esc_html__( 'White Background', 'mirasat' ),
			),
			'navbar-default' => 'transparent',

			'footer' => array(
				'default'  => esc_html__( 'Default', 'mirasat' ),		
				'copyright'  => esc_html__( 'Copyright Only', 'mirasat' ),		
				'copyright-transparent'  => esc_html__( 'Copyright Transparent', 'mirasat' ),		
			),
			'footer-default' => 'default',

			'color_main'	=>	'#D6111E',
			'color_second'	=>	'#DDC76D',
			'color_black'	=>	'#171422',
			'color_gray'	=>	'#F4F2E9',
			'color_white'	=>	'#FFFFFF',
			'color_red'		=>	'#D6111E',
			'color_main_header'	=>	esc_html__( 'Red', 'mirasat' ),

			'logo_height'		=>	60,
			'navbar_dark'		=>	'rgba(0,0,0,0.75)',

			'font_main'					=>	'Mulish',
			'font_main_var'				=>	'regular',
			'font_main_weights'			=>	'400,400i,600,700',
			'font_headers'				=>	'Heebo',
			'font_headers_var'			=>	'regular',
			'font_headers_weights'		=>	'800,900',
			'font_subheaders'			=>	'Heebo',
			'font_subheaders_var'		=>	'regular',
			'font_subheaders_weights'	=>	'800,900',
		);
	}
}

/**
 *  Editor Settings
 */
function mirasat_editor_settings() {

	$cfg = mirasat_theme_config();

    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'Main', 'mirasat' ),
            'slug' => 'main-theme',
            'color' => $cfg['color_main'],
        ),
        array(
            'name' => esc_html__( 'Gray', 'mirasat' ),
            'slug' => 'gray',
            'color' => $cfg['color_gray'],
        ),
        array(
            'name' => esc_html__( 'Black', 'mirasat' ),
            'slug' => 'black',
            'color' => $cfg['color_black'],
        ),
        array(
            'name' => esc_html__( 'Red', 'mirasat' ),
            'slug' => 'red',
            'color' => $cfg['color_red'],
        ),        
    ) );

	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => esc_html__( 'small', 'mirasat' ),
			'shortName' => esc_html__( 'S', 'mirasat' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => esc_html__( 'regular', 'mirasat' ),
			'shortName' => esc_html__( 'M', 'mirasat' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => esc_html__( 'large', 'mirasat' ),
			'shortName' => esc_html__( 'L', 'mirasat' ),
			'size'      => 24,
			'slug'      => 'large'
		),
	) );    
}
add_action( 'after_setup_theme', 'mirasat_editor_settings', 10 );

/**
 * Get Google default font url
 */
if ( !function_exists('mirasat_font_url') ) {

	function mirasat_font_url() {

		$cfg = mirasat_theme_config();
		$q = array();
		foreach ( array('font_main', 'font_headers', 'font_subheaders') as $item ) {

			if ( !empty($cfg[$item]) ) {

				$w = '';
				if ( !empty($cfg[$item.'_weights']) ) {

					$w .= ':'.$cfg[$item.'_weights'];
				}
				$q[] = $cfg[$item].$w;
			}
		}

		$query_args = array( 'family' => implode('|', $q), 'subset' => 'latin' );

		$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		return esc_url( $font_url );
	}
}

/**
 * Config used for lt-ext plugin to set Visual Composer configuration
 */
if ( !function_exists('mirasat_vc_config') ) {

	add_filter( 'ltx_get_vc_config', 'mirasat_vc_config', 10, 1 );
	function mirasat_vc_config( $value ) {

	    return array(
	    	'sections'	=>	array(
				esc_html__("Overflow visible section", 'mirasat') 	=> "displaced-top",				
			),
			'background' => array(
				esc_html__( "Main", 'mirasat' ) => "theme_color",	
				esc_html__( "Second", 'mirasat' ) => "second",	
				esc_html__( "Gray", 'mirasat' ) => "gray",
				esc_html__( "White", 'mirasat' ) => "white",
				esc_html__( "Black", 'mirasat' ) => "black",			
			),
			'overlay'	=> array(
				esc_html__( "Black Overlay (80%)", 'mirasat' ) => "black",
				esc_html__( "White Overlay", 'mirasat' ) => "white",
			),
		);
	}
}


/*
* Adding additional TinyMCE options
*/
if ( !function_exists('mirasat_mce_before_init_insert_formats') ) {

	add_filter('mce_buttons_2', 'mirasat_wpb_mce_buttons_2');
	function mirasat_wpb_mce_buttons_2( $buttons ) {

	    array_unshift($buttons, 'styleselect');
	    return $buttons;
	}

	add_filter( 'tiny_mce_before_init', 'mirasat_mce_before_init_insert_formats' );
	function mirasat_mce_before_init_insert_formats( $init_array ) {  

	    $style_formats = array(

	        array(  
	            'title' => esc_html__('Main Color', 'mirasat'),
	            'block' => 'span',  
	            'classes' => 'color-main',
	            //'wrapper' => true,
	        ),  
	        array(  
	            'title' => esc_html__('White Color', 'mirasat'),
	            'block' => 'span',  
	            'classes' => 'color-white',
	            'wrapper' => true,   
	        ),
	        array(  
	            'title' => esc_html__('Medium Text', 'mirasat'),
	            'block' => 'span',  
	            'classes' => 'text-md',
	            'wrapper' => true,
	        ),    	        
	        array(  
	            'title' => esc_html__('Large Text', 'mirasat'),
	            'block' => 'span',  
	            'classes' => 'text-lg',
	            'wrapper' => true,
	        ),    
	        array(  
	            'title' => 'List Checkbox',
	            'selector' => 'ul',
	            'classes' => 'check',
	        ),     
	        array(  
	            'title' => 'List Bullets',
	            'selector' => 'ul',
	            'classes' => 'disc',
	        ),     	        
	        array(  
	            'title' => 'Multi-Column List',
	            'selector' => 'ul',
	            'classes' => 'multicol',
	        ),	          
	    );  
	    $init_array['style_formats'] = json_encode( $style_formats );  
	     
	    return $init_array;  
	} 
}


/**
 * Register widget areas.
 *
 */
if ( !function_exists('mirasat_action_theme_widgets_init') ) {

	add_action( 'widgets_init', 'mirasat_action_theme_widgets_init' );
	function mirasat_action_theme_widgets_init() {

		$span_class = 'widget-icon';

		$header_class = $theme_icon = '';
		if ( function_exists('FW') ) {

			if ( !empty($theme_icon['icon-class']) ) $header_class = 'hasIcon';
		}


		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Default', 'mirasat' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'mirasat' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar WooCommerce', 'mirasat' ),
			'id'            => 'sidebar-wc',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'mirasat' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'mirasat' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'mirasat' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'mirasat' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'mirasat' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'mirasat' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'mirasat' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'mirasat' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'mirasat' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );			

	}
}



/**
 * Additional styles init
 */
if ( !function_exists('mirasat_css_style') ) {

	add_action( 'wp_enqueue_scripts', 'mirasat_css_style', 10 );
	function mirasat_css_style() {

		global $wp_query;

		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', array(), '1.0' );

		wp_enqueue_style( 'mirasat-plugins', get_template_directory_uri() . '/assets/css/plugins.css', array(), wp_get_theme()->get('Version') );

		wp_enqueue_style( 'mirasat-theme-style', get_stylesheet_uri(), array( 'bootstrap', 'mirasat-plugins' ), wp_get_theme()->get('Version') );

		wp_style_add_data( 'mirasat-theme-style', 'rtl', 'replace' );
	}
}


/**
 * Wp-admin styles and scripts
 */
if ( !function_exists('mirasat_admin_init') ) {

	add_action( 'after_setup_theme', 'mirasat_admin_init' );
	function mirasat_admin_init() {

		add_action("admin_enqueue_scripts", 'mirasat_admin_scripts');
	}

	function mirasat_admin_scripts() {

		if ( function_exists('fw_get_db_settings_option') ) {

			$fontello['css'] = fw_get_db_settings_option( 'fontello-css' );
			$fontello['eot'] = fw_get_db_settings_option( 'fontello-eot' );
			$fontello['ttf'] = fw_get_db_settings_option( 'fontello-ttf' );
			$fontello['woff'] = fw_get_db_settings_option( 'fontello-woff' );
			$fontello['woff2'] = fw_get_db_settings_option( 'fontello-woff2' );
			$fontello['svg'] = fw_get_db_settings_option( 'fontello-svg' );

			if ( !empty($fontello['css']) AND !empty( $fontello['eot']) AND  !empty( $fontello['ttf']) AND  !empty( $fontello['woff']) AND  !empty( $fontello['woff2']) AND  !empty( $fontello['svg']) ) {

				wp_enqueue_style(  'mirasat-fontello',  $fontello['css']['url'], array(), wp_get_theme()->get('Version') );

				$randomver = wp_get_theme()->get('Version');
				$css_content = "@font-face {
				font-family: 'mirasat-fontello';
				  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."');
				  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."#iefix') format('embedded-opentype'),
				       url('". esc_url ( $fontello['woff2']['url']. "?" . $randomver )."') format('woff2'),
				       url('". esc_url ( $fontello['woff']['url']. "?" . $randomver )."') format('woff'),
				       url('". esc_url ( $fontello['ttf']['url']. "?" . $randomver )."') format('truetype'),
				       url('". esc_url ( $fontello['svg']['url']. "?" . $randomver )."#" . pathinfo(wp_basename( $fontello['svg']['url'] ), PATHINFO_FILENAME)  . "') format('svg');
				  font-weight: normal;
				  font-style: normal;
				}";

				wp_add_inline_style( 'mirasat-fontello', $css_content );
			}

			wp_enqueue_script( 'mirasat-theme-admin', get_template_directory_uri() . '/assets/js/scripts-admin.js', array( 'jquery' ) );
		}
	}
}




