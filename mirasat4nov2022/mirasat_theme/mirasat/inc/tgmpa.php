<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * TGM Plugin Activation
 */

require_once get_template_directory() . '/tgm-plugin-activation/class-tgm-plugin-activation.php';

if ( !function_exists('mirasat_action_theme_register_required_plugins') ) {

	function mirasat_action_theme_register_required_plugins() {

		$config = array(

			'id'           => 'mirasat',
			'menu'         => 'mirasat-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => false,
			'is_automatic' => false,
		);

		tgmpa( array(

			array(
				'name'      => esc_html__('Unyson', 'mirasat'),
				'slug'      => 'unyson',
				'source'   	=> 'http://updates.like-themes.com/plugins/unyson/unyson-fork.zip',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('LT Extension', 'mirasat'),
				'slug'      => 'lt-ext',
				'source'   	=> get_template_directory() . '/inc/plugins/lt-ext.zip',
				'version'   => '2.2.1',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('WPBakery Page Builder', 'mirasat'),
				'slug'      => 'js_composer',
				'source'   	=> 'http://updates.like-themes.com/plugins/js_composer/js_composer.zip',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('Envato Market', 'mirasat'),
				'slug'      => 'envato-market',
				'source'   	=> get_template_directory() . '/inc/plugins/envato-market.zip',
				'required'  => false,
			),													
			array(
				'name'      => esc_html__('Breadcrumb-navxt', 'mirasat'),
				'slug'      => 'breadcrumb-navxt',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('Contact Form 7', 'mirasat'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
			array(
				'name'       => esc_html__('MailChimp for WordPress', 'mirasat'),
				'slug'       => 'mailchimp-for-wp',
				'required'   => false,
			),		
			array(
				'name'       => esc_html__('WooCommerce', 'mirasat'),
				'slug'       => 'woocommerce',
				'required'   => false,
			),
			array(
				'name'      => esc_html__('Post-views-counter', 'mirasat'),
				'slug'      => 'post-views-counter',
				'required'  => false,
			),			
			array(
				'name'      => esc_html__('User Profile Picture', 'mirasat'),
				'slug'      => 'metronet-profile-picture',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('The Events Calendar', 'mirasat'),
				'slug'      => 'the-events-calendar',
				'required'  => false,
			),							
			
		), $config);
	}
}

add_action( 'tgmpa_register', 'mirasat_action_theme_register_required_plugins' );

