<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Theme Welcome Page
 */

if ( !function_exists( 'mirasat_welcome_page_init' ) ) {

	function mirasat_welcome_page_init() {
			
		if ( !mirasat_plugin_is_active('lt-ext') ) {

			$theme = wp_get_theme();

			add_theme_page(
				$theme->name,
				$theme->name,
				'install_themes',
				'mirasat_welcome',
				'mirasat_welcome_output'
			);
		}
	}

	add_action( 'admin_menu', 'mirasat_welcome_page_init' );
}

if ( !function_exists( 'mirasat_welcome_page_activate' ) ) {

	function mirasat_welcome_page_activate() {

		update_option( 'mirasat_welcome_page', 1 );
	}

	add_action( 'after_switch_theme', 'mirasat_welcome_page_activate', 100 );	
}

if ( !function_exists( 'mirasat_welcome_page_open' ) ) {

	function mirasat_welcome_page_open() {

		if ( get_option( 'mirasat_welcome_page' ) == 1 && !mirasat_plugin_is_active('lt-ext') ) {

			update_option( 'mirasat_welcome_page', 0 );

			wp_safe_redirect( admin_url() . 'themes.php?page=mirasat_welcome' );
			exit;
		}
	}

	add_action( 'init', 'mirasat_welcome_page_open', 100 );
}


/**
 * Generating output of welcome screen
 */
if ( !function_exists( 'mirasat_welcome_output' ) ) {

	function mirasat_welcome_output() {

		$theme = wp_get_theme();
		echo '<div class="wrap">';

			echo '<h1>'.esc_html__( 'Welcome to', 'mirasat' ).' '.esc_html($theme->name).'</h1>';
			echo '<div class="ltx-admin-section">';

			echo '<h2>'.esc_html($theme->name).' '.esc_html($theme->version).'</h2>';

			echo wp_kses_post(
				sprintf('<p>%1$s <a href="%2$s">%3$s</a>.</p>',
					esc_html__( 'In order to get the full functionality of the theme, we recommend you to install all required ', 'mirasat' ),
					esc_url( admin_url() . 'plugins.php' ),
					esc_html__( 'plugins', 'mirasat' )
				)
			);			

		echo '</div>
		</div>';
	}
}

