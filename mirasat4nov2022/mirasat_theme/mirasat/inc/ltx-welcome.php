<?php

/**
 * Theme Welcome Page
 */


/**
 * Add welcome page
 */
if ( !function_exists( 'mirasat_welcome_page_init' ) ) {

	function mirasat_welcome_page_init() {
			
		$theme = wp_get_theme();

		add_theme_page(
			$theme->name,
			$theme->name,
			'install_themes',
			'ltx_welcome',
			'ltx_welcome_output',
			'',
			100
		);
	}

	add_action( 'admin_menu', 'mirasat_welcome_page_init' );
}


if ( !function_exists( 'mirasat_welcome_page' ) ) {

	function mirasat_welcome_page() {

		update_option( 'mirasat_welcome_page', 1 );
	}

	add_action( 'after_switch_theme', 'mirasat_welcome_page', 100 );	
}

if ( !function_exists( 'mirasat_about_after_setup_theme' ) ) {

	function mirasat_about_after_setup_theme() {

		if ( get_option( 'mirasat_welcome_page' ) == 1 ) {

			update_option( 'mirasat_welcome_page', 0 );
			wp_safe_redirect( admin_url() . 'themes.php?page=mirasat_welcome' );

			exit();
		}
	}

	add_action( 'init', 'mirasat_about_after_setup_theme', 100 );
}


