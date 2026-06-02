<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$mirasat_choices =  array();
$mirasat_choices['default'] = esc_html__( 'Default', 'mirasat' );

$mirasat_color_schemes = fw_get_db_settings_option( 'items' );
if ( !empty($mirasat_color_schemes) ) {

	foreach ($mirasat_color_schemes as $v) {

		$mirasat_choices[$v['slug']] = esc_html( $v['name'] );
	}
}

$mirasat_theme_config = mirasat_theme_config();
$mirasat_sections_list = mirasat_get_sections();


$options = array(
	'general' => array(
		'title'   => esc_html__( 'Page settings', 'mirasat' ),
		'type'    => 'box',
		'options' => array(		
			'general-box' => array(
				'title'   => __( 'General Settings', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(

					'margin-layout'    => array(
						'label' => esc_html__( 'Content Margin', 'mirasat' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Margins control for content', 'mirasat' ),
						'choices' => array(
							'default'  => esc_html__( 'Top And Bottom', 'mirasat' ),
							'top'  => esc_html__( 'Top Only', 'mirasat' ),
							'bottom'  => esc_html__( 'Bottom Only', 'mirasat' ),
							'disabled' => esc_html__( 'Margin Removed', 'mirasat' ),
						),
						'value' => 'default',
					),			
					'topbar-layout'    => array(
						'label' => esc_html__( 'Topbar section', 'mirasat' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array('default' => 'Default') + array('hidden' => 'Hidden') + $mirasat_sections_list['top_bar'],						
						'value'	=> 'default',
					),						
					'navbar-layout'    => array(
						'label' => esc_html__( 'Navbar', 'mirasat' ),
						'type'    => 'select',
						'choices' => array( 'default'  	=> esc_html__( 'Default', 'mirasat' ) ) + $mirasat_theme_config['navbar'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'mirasat' ) ),
						'value' => $mirasat_theme_config['navbar-default'],
					),								
					'header-layout'    => array(
						'label' => esc_html__( 'Page Header', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'mirasat' ),
							'disabled' => esc_html__( 'Hidden', 'mirasat' ),
						),
						'value' => 'default',
					),						
					'subscribe-layout'    => array(
						'label' => esc_html__( 'Subscribe Block', 'mirasat' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Subscribe block before footer. Can be edited from Sections Menu.', 'mirasat' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'mirasat' ),
							'disabled' => esc_html__( 'Hidden', 'mirasat' ),
						),
						'value' => 'default',
					),		
					'before-footer-layout'    => array(
						'label' => esc_html__( 'Before Footer', 'mirasat' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Before footer sections. Edited in Sections menu.', 'mirasat' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'mirasat' ),
							'disabled' => esc_html__( 'Hidden', 'mirasat' ),
						),
						'value' => 'default',
					),	
					'footer-layout'    => array(
						'label' => esc_html__( 'Footer', 'mirasat' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before footer. Edited in Widgets menu.', 'mirasat' ),
						'choices' => $mirasat_theme_config['footer'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'mirasat' ) ),
						'value' => $mirasat_theme_config['footer-default'],
					),	
					'footer-parallax'    => array(
						'label' => esc_html__( 'Footer Parallax', 'mirasat' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block parallax effect.', 'mirasat' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'mirasat' ),
							'disabled' => esc_html__( 'Disabled', 'mirasat' ),
						),
						'value' => 'default',
					),																			
					'color-scheme'    => array(
						'label' => esc_html__( 'Color Scheme', 'mirasat' ),
						'type'    => 'select',
						'choices' => $mirasat_choices,
						'value' => 'default',
					),		
					'body-bg'    => array(
						'label' => esc_html__( 'Background Scheme', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'White', 'mirasat' ),
							'black'  => esc_html__( 'Black', 'mirasat' ),
						),
						'value' => 'default',
					),						
					'background-image'    => array(
						'label' => esc_html__( 'Background Image', 'mirasat' ),
						'type'  => 'upload',
						'desc'   => esc_html__( 'Will be used to fill whole page', 'mirasat' ),
					),												
				),											
			),	
			'cpt' => array(
				'title'   => esc_html__( 'Blog / Gallery', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(				
					'sidebar-layout'    => array(
						'label' => esc_html__( 'Blog Sidebar', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'hidden' => esc_html__( 'Hidden', 'mirasat' ),
							'left'  => esc_html__( 'Sidebar Left', 'mirasat' ),
							'right'  => esc_html__( 'Sidebar Right', 'mirasat' ),
						),
						'value' => 'hidden',
					),						
					'blog-layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'mirasat' ),
						'description'   => esc_html__( 'Used only for blog pages.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'mirasat' ),
							'classic'  => esc_html__( 'One Column', 'mirasat' ),
							'two-cols' => esc_html__( 'Two Columns', 'mirasat' ),
							'three-cols' => esc_html__( 'Three Columns', 'mirasat' ),
						),
						'value' => 'default',
					),
					'gallery-layout'    => array(
						'label' => esc_html__( 'Gallery Layout', 'mirasat' ),
						'description'   => esc_html__( 'Used only for gallery pages.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'mirasat' ),
							'col-2' => esc_html__( 'Two Columns', 'mirasat' ),
							'col-3' => esc_html__( 'Three Columns', 'mirasat' ),
							'col-4' => esc_html__( 'Four Columns', 'mirasat' ),
						),
						'value' => 'default',
					),					
				)
			)	
		)
	),
);

unset($options['general']['options']['general-box']['options']['footer-parallax']);
unset($options['general']['options']['general-box']['options']['before-footer-layout']);
unset($options['general']['options']['general-box']['options']['topbar-layout']);

