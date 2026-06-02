<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$mirasat_theme_config = mirasat_theme_config();
$mirasat_sections_list = mirasat_get_sections();

$navbar_custom_assign = array();

if ( !empty( $mirasat_theme_config['navbar'] ) AND is_array($mirasat_theme_config['navbar']) AND sizeof( $mirasat_theme_config['navbar']) > 1 ) {

	$menus = get_terms('nav_menu');
	if ( !empty($menus) ) {

		$list = array();
		foreach ( $menus as $item ) {

			$list[$item->term_id] = $item->name;
		}

		foreach ( $mirasat_theme_config['navbar'] as $key => $val) {

			$navbar_custom_assign['navbar-'.$key.'-assign'] = array(
				'label' => sprintf( esc_html__( 'Navbar %s Assign', 'mirasat' ), ucwords($key) ),
				'type'    => 'select',
				'desc' => esc_html__( 'You can assign additional menus for inner navbar.', 'mirasat' ),
				'value' => 'default',
				'choices' => array('default' => esc_html__( 'Default', 'mirasat' )) + $list,
			);
		}

		$navbar_custom_assign = array();
	}
}

$options = array(
	'general' => array(
		'title'   => esc_html__( 'General', 'mirasat' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => esc_html__( 'General Settings', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(						
					'page-loader'    => array(
						'type'    => 'multi-picker',
						'picker'       => array(
							'loader' => array(
								'label'   => esc_html__( 'Page Loader', 'mirasat' ),
								'type'    => 'select',
								'choices' => array(
									'disabled' => esc_html__( 'Disabled', 'mirasat' ),
									'image' => esc_html__( 'Image', 'mirasat' ),
									'enabled' => esc_html__( 'Theme Loader', 'mirasat' ),
								),
								'value' => 'enabled'
							)
						),						
						'choices' => array(
							'image' => array(
								'loader_img'    => array(
									'label' => esc_html__( 'Page Loader Image', 'mirasat' ),
									'type'  => 'upload',
								),
							),
						),
						'value' => 'enabled',
					),	
					'google_api'    => array(
						'label' => esc_html__( 'Google Maps API Key', 'mirasat' ),
						'desc'  => esc_html__( 'Required for contacts page, also used in widget. In order to use you must generate your own API on Google Maps Platform', 'mirasat' ),
						'type'  => 'text',
					),								
				),
			),
			'logo' => array(
				'title'   => esc_html__( 'Logo and Media', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(	
					'logo-box' => array(
						'title'   => esc_html__( 'Logo', 'mirasat' ),
						'type'    => 'box',
						'options' => array(			
							'favicon'    => array(
								'html' => esc_html__( 'To change Favicon go to Appearance -> Customize -> Site Identity', 'mirasat' ),
								'type'  => 'html',
							),							
							'logo'    => array(
								'label' => esc_html__( 'Logo Black', 'mirasat' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo Black 2x', 'mirasat' ),
								'type'  => 'upload',
							),	
							'logo_white'    => array(
								'label' => esc_html__( 'Logo White', 'mirasat' ),
								'type'  => 'upload',
							),
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo White 2x', 'mirasat' ),
								'type'  => 'upload',
							),		
							'theme-icon-main'    => array(
								'label' => esc_html__( 'Headers icon', 'mirasat' ),
								'type'  => 'icon-v2',
							),								
							'widgets_bg'    => array(
								'label' => esc_html__( 'Sidebar Widgets Background', 'mirasat' ),
								'type'  => 'upload',
							),									
							'404_bg'    => array(
								'label' => esc_html__( '404 Background', 'mirasat' ),
								'type'  => 'upload',
							),						
						),
					),
				),
			),				
		),
	),
	'header' => array(
		'title'   => esc_html__( 'Header', 'mirasat' ),
		'type'    => 'tab',
		'options' => array(
			'header-box-2' => array(
				'title'   => esc_html__( 'Navbar', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'navbar-default'    => array(
						'label' => esc_html__( 'Navbar Default', 'mirasat' ),
						'type'    => 'select',
						'value' => $mirasat_theme_config['navbar-default'],
						'choices' => $mirasat_theme_config['navbar'],
					),	
					'navbar-default-force'    => array(
						'label' => esc_html__( 'Navbar Default Override', 'mirasat' ),
						'desc'   => esc_html__( 'By default every page can have unqiue navbar setting. You can override them here.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled. Every page uses its own settings', 'mirasat' ),
							'force'  => esc_html__( 'Enabled. Override all site pages and use Navbar Default', 'mirasat' ),
						),
						'value' => 'disabled',
					),						
					'navbar-affix'    => array(
						'label' => esc_html__( 'Navbar Sticked', 'mirasat' ),
						'desc'   => esc_html__( 'May not work with all navbar types', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'' => esc_html__( 'Allways Static', 'mirasat' ),
							'affix'  => esc_html__( 'Sticked', 'mirasat' ),
						),
						'value' => '',
					),
					'navbar-breakpoint'    => array(
						'label' => esc_html__( 'Navbar Mobile Breakpoint, px', 'mirasat' ),
						'desc'   => esc_html__( 'Mobile menu will be displayed in viewports below this value', 'mirasat' ),
						'type'    => 'text',
						'value' => '1198',
					),						
					$navbar_custom_assign,
				)
			),
			'header-box-topbar' => array(
				'title'   => esc_html__( 'Topbar', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'topbar-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'You can edit topbar in sections menu of dashboard', 'mirasat' ),
					),					
					'topbar'    => array(
						'label' => esc_html__( 'Topbar visibility', 'mirasat' ),
						'desc'   => esc_html__( 'You can edit topbar layout in Sections menu', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always Visible', 'mirasat' ),
							'desktop'  => esc_html__( 'Desktop Visible', 'mirasat' ),
							'desktop-tablet'  => esc_html__( 'Desktop and Tablet Visible', 'mirasat' ),
							'mobile'  => esc_html__( 'Mobile only Visible', 'mirasat' ),
							'hidden' => esc_html__( 'Hidden', 'mirasat' ),
						),
						'value' => 'hidden',
					),					
					'topbar-section'    => array(
						'label' => esc_html__( 'Topbar section', 'mirasat' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $mirasat_sections_list['top_bar'],						
						'value'	=> '',
					),						
				)
			),			
			'header-box-icons' => array(
				'title'   => esc_html__( 'Icons and Elements', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(		
					'icons-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'Icons can be displayed in topbar using shortcode: [ltx-navbar-icons]', 'mirasat' ),
					),																
					'navbar-icons' => array(
		                'label' => esc_html__( 'Navbar / Topbar Icons', 'mirasat' ),
		                'desc' => esc_html__( 'Depends on theme style', 'mirasat' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'box-options' => array(
							'type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'picker'       => array(
									'type_radio' => array(
										'label'   => esc_html__( 'Type', 'mirasat' ),
										'type'    => 'radio',
										'choices' => array(
											'search' => esc_html__( 'Search', 'mirasat' ),
											'basket'  => esc_html__( 'WooCommerce Cart', 'mirasat' ),
											'profile'  => esc_html__( 'User Profile', 'mirasat' ),
											'social'  => esc_html__( 'Social Icon', 'mirasat' ),
											'shortcode'  => esc_html__( 'Shortcode Only', 'mirasat' ),
										),
									)
								),
								'choices'      => array(
									'basket'  => array(
										'count'    => array(
											'label' => esc_html__( 'Count', 'mirasat' ),
											'type'    => 'select',
											'choices' => array(
												'show' => esc_html__( 'Show count label', 'mirasat' ),
												'hide'  => esc_html__( 'Hide count label', 'mirasat' ),
											),
											'value' => 'show',
										),											
									),
									'profile'  => array(
					                    'header' => array(
					                        'label' => esc_html__( 'Non-logged header', 'mirasat' ),
					                        'type' => 'text',
					                        'value' => '',
					                    ),										
									),
									'social'  => array(
					                    'text' => array(
					                        'label' => esc_html__( 'Header', 'mirasat' ),
					                        'type' => 'text',
					                    ),
					                    'subheader' => array(
					                        'label' => esc_html__( 'Subheader', 'mirasat' ),
					                        'type' => 'text',
					                    ),					                    
					                    'href' => array(
					                        'label' => esc_html__( 'External Link', 'mirasat' ),
					                        'type' => 'text',
					                        'value' => '#',
					                    ),											
									),		
									'shortcode'  => array(
					                    'header' => array(
					                        'label' => esc_html__( 'Shortcode to display', 'mirasat' ),
					                        'type' => 'text',
					                        'value' => '',
					                    ),										
									),									
								),
								'show_borders' => false,
							),	  														                	
							'icon-type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'value'        => array(
									'icon_radio' => 'default',
								),
								'picker'       => array(
									'icon_radio' => array(
										'label'   => esc_html__( 'Icon', 'mirasat' ),
										'type'    => 'radio',
										'choices' => array(
											'default'  => esc_html__( 'Default', 'mirasat' ),
											'fa' => esc_html__( 'FontAwesome', 'mirasat' )
										),
										'desc'    => esc_html__( 'For social icons you need to use FontAwesome in any case.',
											'mirasat' ),
									)
								),
								'choices'      => array(
									'default'  => array(
									),
									'fa' => array(
										'icon_v2'  => array(
											'type'  => 'icon-v2',
											'label' => esc_html__( 'Select Icon', 'mirasat' ),
										),										
									),
								),
								'show_borders' => false,
							),
							'icon-visible'        => array(
								'label'   => esc_html__( 'Visibility', 'mirasat' ),
								'type'    => 'radio',
								'value'    => 'hidden-mob',								
								'choices' => array(
									'hidden-mob'  => esc_html__( 'Hidden on mobile', 'mirasat' ),
									'visible-mob' => esc_html__( 'Visible on mobile', 'mirasat' )
								),
							),							
							'profile-name'        => array(
								'label'   => esc_html__( 'Profile Name', 'mirasat' ),
								'type'    => 'radio',
								'value'    => 'hidden',								
								'choices' => array(
									'hidden'  => esc_html__( 'Hidden', 'mirasat' ),
									'visible' => esc_html__( 'Visible', 'mirasat' )
								),
							),								
		                ),
                		'template' => '{{- type.type_radio }}',		                
                    ),
					'basket-icon'    => array(
						'label' => esc_html__( 'Basket icon in navbar', 'mirasat' ),
						'desc'   => esc_html__( 'As replacement for basket in topbar in mobile view', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Hidden', 'mirasat' ),
							'mobile'  => esc_html__( 'Visible on Mobile', 'mirasat' ),
						),
						'value' => 'disabled',
					),					
				),
			),
			'header-box-1' => array(
				'title'   => esc_html__( 'Page Header H1', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'pageheader-display'    => array(
						'label' => esc_html__( 'Page Header Visibility', 'mirasat' ),
						'desc'   => esc_html__( 'Status of Page Header with H1 and Breadcrumbs', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'mirasat' ),
							'disabled'  => esc_html__( 'Force Hidden on all Pages', 'mirasat' ),
						),
						'value' => 'fixed',
					),		
					'pageheader-overlay'    => array(
						'label' => esc_html__( 'Page Header Overlay', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'enabled' => esc_html__( 'Enabled', 'mirasat' ),
							'disabled'  => esc_html__( 'Disabled', 'mirasat' ),
						),
						'value' => 'enabled',
					),	
					'header_fixed'    => array(
						'label' => esc_html__( 'Background parallax', 'mirasat' ),
						'desc'   => esc_html__( 'Parallax effect requires large images', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled', 'mirasat' ),
							'fixed'  => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'fixed',
					),														
					'header_bg'    => array(
						'label' => esc_html__( 'Inner Pages Header Background', 'mirasat' ),
						'desc'  => esc_html__( 'By default header is gray, you can replace it with background image', 'mirasat' ),
						'type'  => 'upload',
					),  			
					'wc_bg'    => array(
						'label' => esc_html__( 'WooCommerce Header Background', 'mirasat' ),
						'desc'  => esc_html__( 'Used only for WooCommerce pages', 'mirasat' ),
						'type'  => 'upload',
					),  					
					'featured_bg'    => array(
						'label' => esc_html__( 'Featured Images as Background', 'mirasat' ),
						'desc'  => esc_html__( 'Use Featured Image for Page as Header Background for all the pages', 'mirasat' ),
						'type'    => 'select',						
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'mirasat' ),
							'enabled' => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'disabled',
					),	
					'header-social'    => array(
						'label' => esc_html__( 'Social icons in page header', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'mirasat' ),
							'enabled' => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'enabled',
					),	

				),
			),
		),
	),	
	'footer' => array(
		'title'   => esc_html__( 'Footer', 'mirasat' ),
		'type'    => 'tab',
		'options' => array(

			'footer-box-1' => array(
				'title'   => esc_html__( 'Widgets', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'footer-layout-default'    => array(
						'label' => esc_html__( 'Footer Default Style', 'mirasat' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before copyright. Edited in Widgets menu.', 'mirasat' ),
						'choices' => $mirasat_theme_config['footer'],
						'value' => $mirasat_theme_config['footer-default'],
					),						
					'footer_widgets'    => array(
						'label' => esc_html__( 'Enable Footer Widgets', 'mirasat' ),
						'desc'   => esc_html__( 'Widgets controled in Appearance -> Widgets. Column will be hidden, then no active widgets exists', 'mirasat' ),	
						'type'  => 'checkbox',
						'value'	=> 'true',
					),					
					'footer-parallax'    => array(
						'label' => esc_html__( 'Footer Parallax', 'mirasat' ),
						'type'    => 'select',							
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'mirasat' ),
							'enabled' => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'disabled',
					),						
					'footer_bg'    => array(
						'label' => esc_html__( 'Footer Background', 'mirasat' ),
						'type'  => 'upload',
					),		
					'footer-box-1-1' => array(
						'title'   => esc_html__( 'Desktop widgets visibility', 'mirasat' ),
						'type'    => 'box',
						'options' => array(

							'footer_1_hide'    => array(
								'label' => esc_html__( 'Footer 1', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),						
							),
							'footer_2_hide'    => array(
								'label' => esc_html__( 'Footer 2', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),	
							),
							'footer_3_hide'    => array(
								'label' => esc_html__( 'Footer 3', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),	
							),
							'footer_4_hide'    => array(
								'label' => esc_html__( 'Footer 4', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),	
							),
						)
					),
					'footer-box-1-2' => array(
						'title'   => esc_html__( 'Notebook widgets visibility', 'mirasat' ),
						'type'    => 'box',
						'options' => array(

							'footer_1__hide_md'    => array(
								'label' => esc_html__( 'Footer 1', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),						
							),
							'footer_2_hide_md'    => array(
								'label' => esc_html__( 'Footer 2', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),	
							),
							'footer_3_hide_md'    => array(
								'label' => esc_html__( 'Footer 3', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),	
							),
							'footer_4_hide_md'    => array(
								'label' => esc_html__( 'Footer 4', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),	
							),
						)
					),					
					'footer-box-1-3' => array(
						'title'   => esc_html__( 'Mobile widgets visibility', 'mirasat' ),
						'type'    => 'box',
						'options' => array(
							'footer_1_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 1', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),
							),
							'footer_2_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 2', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),
							),
							'footer_3_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 3', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),
							),
							'footer_4_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 4', 'mirasat' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'mirasat'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'mirasat'),
								),
							),														
						)
					)
				),
			),
			'footer-box-subscribe' => array(
				'title'   => esc_html__( 'Subscribe and Other', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'footer-sections'    => array(
						'html' => esc_html__( 'You can edit all items in Sections menu of dashboard.', 'mirasat' ),
						'type'  => 'html',
					),							
					'subscribe-section'    => array(
						'label' => esc_html__( 'Subscribe block', 'mirasat' ),
						'desc' => esc_html__( 'Section displayed before widgets on every page. You can hide in on certain page in page settings.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $mirasat_sections_list['subscribe'],						
						'value'	=> '',
					),
					'before-footer-section'    => array(
						'label' => esc_html__( 'Before Footer section', 'mirasat' ),
						'desc' => esc_html__( 'Section displayed under all content before subscribe/widgets.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $mirasat_sections_list['before_footer'],
						'value'	=> '',
					),					
				),
			),	
			'footer-box-2' => array(
				'title'   => esc_html__( 'Go Top', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(															
					'go_top_visibility'    => array(
						'label' => esc_html__( 'Go Top Visibility', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always visible', 'mirasat' ),
							'desktop' => esc_html__( 'Desktop Only', 'mirasat' ),
							'mobile' => esc_html__( 'Mobile Only', 'mirasat' ),
							'hidden' => esc_html__( 'Hidden', 'mirasat' ),
						),						
						'value'	=> 'visible',
					),		
					'go_top_pos'    => array(
						'label' => esc_html__( 'Go Top Position', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'floating'  => esc_html__( 'Floating', 'mirasat' ),
							'static' => esc_html__( 'Static at the footer', 'mirasat' ),
						),						
						'value'	=> 'floating',
					),		
					'go_top_img'    => array(
						'label' => esc_html__( 'Go Top Image', 'mirasat' ),
						'type'  => 'upload',
					),		
					'go_top_icon'    => array(
						'label' => esc_html__( 'Go Top Icon', 'mirasat' ),
						'type'  => 'icon-v2',
					),					
					'go_top_text'    => array(
						'label' => esc_html__( 'Go Top Text', 'mirasat' ),
						'type'  => 'text',
					),														
				),
			),
			'footer-box-3' => array(
				'title'   => esc_html__( 'Copyrights', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(																							
					'copyrights'    => array(
						'label' => esc_html__( 'Copyrights', 'mirasat' ),
						'type'  => 'wp-editor',
					),									
				),
			),					
		),
	),	
	'layout' => array(
		'title'   => esc_html__( 'Posts Layout', 'mirasat' ),
		'type'    => 'tab',
		'options' => array(

			'layout-box-1' => array(
				'title'   => esc_html__( 'Blog Posts', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(

					'blog_layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'mirasat' ),
						'desc'   => esc_html__( 'Default blog page layout.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'classic'  => esc_html__( 'One Column', 'mirasat' ),
							'two-cols' => esc_html__( 'Two Columns', 'mirasat' ),
							'three-cols' => esc_html__( 'Three Columns', 'mirasat' ),
						),
						'value' => 'classic',
					),				
					'blog_list_sidebar'    => array(
						'label' => esc_html__( 'Blog List Sidebar', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'mirasat' ),
							'left' => esc_html__( 'Left', 'mirasat' ),
							'right' => esc_html__( 'Right', 'mirasat' ),
						),
						'value' => 'right',
					),				
					'blog_post_sidebar'    => array(
						'label' => esc_html__( 'Blog Post Sidebar', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'mirasat' ),
							'left' => esc_html__( 'Left', 'mirasat' ),
							'right' => esc_html__( 'Right', 'mirasat' ),
						),
						'value' => 'right',
					),																				
					'excerpt_auto'    => array(
						'label' => esc_html__( 'Excerpt Classic Blog Size', 'mirasat' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'mirasat' ),
						'value'	=> 350,
						'type'  => 'short-text',
					),
					'excerpt_masonry_auto'    => array(
						'label' => esc_html__( 'Excerpt Masonry Blog Size', 'mirasat' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'mirasat' ),
						'value'	=> 150,
						'type'  => 'short-text',
					),
					'blog_gallery_autoplay'    => array(
						'label' => esc_html__( 'Gallery post type autoplay, ms', 'mirasat' ),
						'desc'  => esc_html__( 'Set 0 to disable autoplay', 'mirasat' ),
						'type'  => 'text',
						'value' => '4000',
					),						
				)
			),
			'layout-box-2' => array(
				'title'   => esc_html__( 'Services', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(	
					'services_list_layout'    => array(
						'label' => esc_html__( 'Services List Layout', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'classic'  => esc_html__( 'One Column', 'mirasat' ),
							'two-cols' => esc_html__( 'Two Columns', 'mirasat' ),
							'three-cols' => esc_html__( 'Three Columns', 'mirasat' ),
						),
						'value' => 'two-cols',
					),						
					'services_list_sidebar'    => array(
						'label' => esc_html__( 'Services List Sidebar', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'mirasat' ),
							'left' => esc_html__( 'Left', 'mirasat' ),
							'right' => esc_html__( 'Right', 'mirasat' ),
						),
						'value' => 'hidden',
					),				
					'services_post_sidebar'    => array(
						'label' => esc_html__( 'Services Post Sidebar', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'mirasat' ),
							'left' => esc_html__( 'Left', 'mirasat' ),
							'right' => esc_html__( 'Right', 'mirasat' ),
						),
						'value' => 'hidden',
					),					
				)
			),
			'layout-box-3' => array(
				'title'   => esc_html__( 'WooCommerce', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'shop_list_sidebar'    => array(
						'label' => esc_html__( 'WooCommerce List Sidebar', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'mirasat' ),
							'left' => esc_html__( 'Left', 'mirasat' ),
							'right' => esc_html__( 'Right', 'mirasat' ),
						),
						'value' => 'left',
					),				
					'shop_post_sidebar'    => array(
						'label' => esc_html__( 'WooCommerce Product Sidebar', 'mirasat' ),
						'desc'   => esc_html__( 'Blog Post Sidebar', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'mirasat' ),
							'left' => esc_html__( 'Left', 'mirasat' ),
							'right' => esc_html__( 'Right', 'mirasat' ),
						),
						'value' => 'hidden',
					),											
					'excerpt_wc_auto'    => array(
						'label' => esc_html__( 'Excerpt WooCommerce Size', 'mirasat' ),
						'desc'  => esc_html__( 'Automaticly cuts description for products', 'mirasat' ),
						'value'	=> 50,
						'type'  => 'short-text',
					),		
					'wc_zoom'    => array(
						'label' => esc_html__( 'WooCommerce Product Hover Zoom', 'mirasat' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Enables mouse hover zoom in single product page', 'mirasat' ),
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'mirasat' ),
							'enabled' => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'disabled',
					),
					'wc_columns'    => array(
						'label' => esc_html__( 'Columns number', 'mirasat' ),
						'desc'  => esc_html__( 'Overrides default WooCommerce settings', 'mirasat' ),
						'type'  => 'text',
						'value' => '3',
					),
					'wc_per_page'    => array(
						'label' => esc_html__( 'Products per Page', 'mirasat' ),
						'type'  => 'text',
						'value' => '6',
					),
					'wc_show_list_excerpt'    => array(
						'label' => esc_html__( 'Display Excerpt in Shop List', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'mirasat' ),
							'enabled' => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'enabled',
					),					
					'wc_show_list_rate'    => array(
						'label' => esc_html__( 'Display Rate in Shop List', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'mirasat' ),
							'enabled' => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'disabled',
					),
					'wc_show_list_attr'    => array(
						'label' => esc_html__( 'Display Attributes in Shop List', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'mirasat' ),
							'enabled' => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'disabled',
					),
					'wc_new_days'    => array(
						'label' => esc_html__( 'Number of days to display New label. Set 0 to hide.', 'mirasat' ),
						'type'  => 'text',
						'value' => '30',
					),						
				)
			),
			'layout-box-4' => array(
				'title'   => esc_html__( 'Gallery', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(													
					'gallery_layout'    => array(
						'label' => esc_html__( 'Default Gallery Layout', 'mirasat' ),
						'desc'   => esc_html__( 'Default galley page layout.', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'col-2' => esc_html__( 'Two Columns', 'mirasat' ),
							'col-3' => esc_html__( 'Three Columns', 'mirasat' ),
							'col-4' => esc_html__( 'Four Columns', 'mirasat' ),
						),
						'value' => 'col-2',
					),						
				)
			)
		)
	),
	'fonts' => array(
		'title'   => esc_html__( 'Fonts', 'mirasat' ),
		'type'    => 'tab',
		'options' => array(

			'fonts-box' => array(
				'title'   => esc_html__( 'Fonts Settings', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'font-main'                => array(
						'label' => __( 'Main Font', 'mirasat' ),
						'type'  => 'typography-v2',
						'desc'	=>	esc_html__( 'Use https://fonts.google.com/ to find font you need', 'mirasat' ),
						'value'      => array(
							'family'    => $mirasat_theme_config['font_main'],
							'subset'    => 'latin-ext',
							'variation' => $mirasat_theme_config['font_main_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-main-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'mirasat' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "800,900"', 'mirasat' ),
						'type'  => 'text',
						'value'  => $mirasat_theme_config['font_main_weights'],							
					),											
					'font-headers'                => array(
						'label' => __( 'Headers Font', 'mirasat' ),
						'type'  => 'typography-v2',
						'value'      => array(
							'family'    => $mirasat_theme_config['font_headers'],
							'subset'    => 'latin-ext',
							'variation' => $mirasat_theme_config['font_headers_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-headers-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'mirasat' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "600,800"', 'mirasat' ),
						'type'  => 'text',
						'value'  => $mirasat_theme_config['font_headers_weights'],						
					),
					'font-subheaders'                => array(
						'label' => __( 'SubHeaders Font', 'mirasat' ),
						'type'  => 'typography-v2',
						'value'      => array(
							'family'    => $mirasat_theme_config['font_subheaders'],
							'subset'    => 'latin-ext',
							'variation' => $mirasat_theme_config['font_subheaders_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-subheaders-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'mirasat' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "600,800"', 'mirasat' ),
						'type'  => 'text',
						'value'  => $mirasat_theme_config['font_subheaders_weights'],						
					),							
				),
			),
			'fontello-box' => array(
				'title'   => esc_html__( 'Fontello', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'fontello-css'    => array(
						'label' => esc_html__( 'Fontello Codes CSS', 'mirasat' ),
						'desc'  => esc_html__( 'Upload *-codes.css postfix file here', 'mirasat' ),
						'type'  => 'upload',
						'images_only' => false,
					),		
					'fontello-ttf'    => array(
						'label' => esc_html__( 'Fontello TTF', 'mirasat' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-eot'    => array(
						'label' => esc_html__( 'Fontello EOT', 'mirasat' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-woff'    => array(
						'label' => esc_html__( 'Fontello WOFF', 'mirasat' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-woff2'    => array(
						'label' => esc_html__( 'Fontello WOFF2', 'mirasat' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-svg'    => array(
						'label' => esc_html__( 'Fontello SVG', 'mirasat' ),
						'type'  => 'upload',
						'images_only' => false,
					),												
				),
			),

		),
	),	
	'social' => array(
		'title'   => esc_html__( 'Social', 'mirasat' ),
		'type'    => 'tab',
		'options' => array(
			'social-box' => array(
				'title'   => esc_html__( 'Social', 'mirasat' ),
				'type'    => 'tab',
				'options' => array(
					'target-social'    => array(
						'label' => esc_html__( 'Open social links in', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'self'  => esc_html__( 'Same window', 'mirasat' ),
							'blank' => esc_html__( 'New window', 'mirasat' ),
						),
						'value' => 'self',
					),															
		            'social-icons' => array(
		                'label' => esc_html__( 'Social Icons', 'mirasat' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'desc' => esc_html__( 'Visible in inner page header', 'mirasat' ),
		                'box-options' => array(
		                    'icon_v2' => array(
		                        'label' => esc_html__( 'Icon', 'mirasat' ),
		                        'type'  => 'icon-v2',
		                    ),
		                    'text' => array(
		                        'label' => esc_html__( 'Text', 'mirasat' ),
		                        'desc' => esc_html__( 'If needed', 'mirasat' ),
		                        'type' => 'text',
		                    ),
		                    'href' => array(
		                        'label' => esc_html__( 'Link', 'mirasat' ),
		                        'type' => 'text',
		                        'value' => '#',
		                    ),		                    
		                ),
                		'template' => '{{- text }}',		                
                    ),								
				),
			),
		),
	),	
	'colors' => array(
		'title'   => esc_html__( 'Colors Schemes', 'mirasat' ),
		'type'    => 'tab',
		'options' => array(			
			'schemes-box' => array(
				'title'   => esc_html__( 'Additional Color Schemes Settings', 'mirasat' ),
				'type'    => 'box',
				'options' => array(
					'advice'    => array(
						'html' => esc_html__( 'You also need to change the global settings in Appearance -> Customize -> Mirasat settings', 'mirasat' ),
						'type'  => 'html',
					),	
					'items' => array(
						'label' => esc_html__( 'Theme Color Schemes', 'mirasat' ),
						'type' => 'addable-box',
						'value' => array(),
						'desc' => esc_html__( 'Can be selected in page settings', 'mirasat' ),
						'box-options' => array(
							'slug' => array(
								'label' => esc_html__( 'Scheme ID', 'mirasat' ),
								'type' => 'text',
								'desc' => esc_html__( 'Required Field', 'mirasat' ),
								'value' => '',
							),							
							'name' => array(
								'label' => esc_html__( 'Scheme Name', 'mirasat' ),
								'desc' => esc_html__( 'Required Field', 'mirasat' ),
								'type' => 'text',
								'value' => '',
							),
							'logo'    => array(
								'label' => esc_html__( 'Logo White', 'mirasat' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo White 2x', 'mirasat' ),
								'type'  => 'upload',
							),
							'logo_white'    => array(
								'label' => esc_html__( 'Logo Black', 'mirasat' ),
								'type'  => 'upload',
							),		
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo Black 2x', 'mirasat' ),
								'type'  => 'upload',
							),		
							'main-color'  => array(
								'label' => esc_html__( 'Main Color', 'mirasat' ),
								'type'  => 'color-picker',
							),
							'second-color' => array(
								'label' => esc_html__( 'Second Color', 'mirasat' ),
								'type'  => 'color-picker',
							),
							'gray-color' => array(
								'label' => esc_html__( 'Gray Color', 'mirasat' ),
								'type'  => 'color-picker',
							),								
							'black-color' => array(
								'label' => esc_html__( 'Black Color', 'mirasat' ),
								'type'  => 'color-picker',
							),	
							'white-color' => array(
								'label' => esc_html__( 'White Color', 'mirasat' ),
								'type'  => 'color-picker',
							),								
						),
						'template' => '{{- name }}',
					),
				),
			),
		),
	),	
	'popup' => array(
		'title'   => esc_html__( 'Popup', 'mirasat' ),
		'type'    => 'tab',
		'options' => array(
			'popup-box' => array(
				'title'   => esc_html__( 'Popup settings', 'mirasat' ),
				'type'    => 'box',
				'options' => array(						
					'popup-status'    => array(
						'label'   => esc_html__( 'Status', 'mirasat' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled', 'mirasat' ),
							'enabled'  => esc_html__( 'Enabled', 'mirasat' ),
						),
						'value' => 'disabled'
					),						
					'popup-hours'    => array(
						'label' => esc_html__( 'Period hidden, days', 'mirasat' ),
						'type'  => 'text',
						'value'	=>	'24',
					),						
					'popup-text'    => array(
						'label' => esc_html__( 'Popup text', 'mirasat' ),
						'type'  => 'wp-editor',
					),
					'popup-bg'    => array(
						'label' => esc_html__( 'Popup Background', 'mirasat' ),
						'type'  => 'upload',
					),					
					'popup-yes'    => array(
						'label' => esc_html__( 'Yes button', 'mirasat' ),
						'type'  => 'text',
						'value'	=>	'Yes',
					),	
					'popup-no'    => array(
						'label' => esc_html__( 'No button', 'mirasat' ),
						'type'  => 'text',
						'value'	=>	'No',
					),																
					'popup-no-link'    => array(
						'label' => esc_html__( 'No link', 'mirasat' ),
						'type'  => 'text',
						'value'	=>	'https://google.com',
					),																
				),	
			),
		),
	),
);

unset($options['popup']);
unset($options['header']['header-box-topbar']);

if ( function_exists('ltx_share_buttons_conf') ) {

	$share_links = ltx_share_buttons_conf();

	$share_links_options = array();
	if ( !empty($share_links) ) {

		$share_links_options = array(

			'share_icons_hide' => array(
                'label' => esc_html__( 'Hide all share icons block', 'mirasat' ),
                'type'  => 'checkbox',
                'value'	=>	false,
            ),
		);
		foreach ( $share_links as $key => $item ) {

			$state = fw_get_db_settings_option( 'share_icon_' . $key );

			$value = false;
			if ( is_null($state) AND $item['active'] == 1 ) {

				$value = true;
			}

			$share_links_options[] =
			array(
				'share_icon_'.$key => array(
	                'label' => $item['header'],
	                'type'  => 'checkbox',
	                'value'	=>	$value,
	            ),
			);
		}
	}

	$share_links_options['share-add'] = array(

        'label' => esc_html__( 'Custom Share Buttons', 'mirasat' ),
        'type' => 'addable-box',
        'value' => array(),
        'desc' => esc_html__( 'You can use {link} and {title} variables to set url. E.g. "http://www.facebook.com/sharer.php?u={link}"', 'mirasat' ),
        'box-options' => array(
            'icon' => array(
                'label' => esc_html__( 'Icon', 'mirasat' ),
                'type'  => 'icon-v2',
            ),
            'header' => array(
                'label' => esc_html__( 'Header', 'mirasat' ),
                'type' => 'text',
            ),
            'link' => array(
                'label' => esc_html__( 'Link', 'mirasat' ),
                'type' => 'text',
                'value' => '',
            ),		  
            'color' => array(
                'label' => esc_html__( 'Color', 'mirasat' ),
                'type' => 'color-picker',
                'value' => '',
            ),		              
        ),
		'template' => '{{- header }}',		                
    );

	$options['social']['options']['share-box'] = array(
		'title'   => esc_html__( 'Share Buttons', 'mirasat' ),
		'type'    => 'tab',
		'options' => $share_links_options,
	);
}

