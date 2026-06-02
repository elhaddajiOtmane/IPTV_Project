<?php
/**
 * Navigation Bar
 */
$navbar_logo = $navlogo_class = $navbar_affix = '';
$navbar_logo = 'white';
$navbar_layout = 'transparent';
$basket_icon = 'disabled';
$navbar_class = 'navbar-collapse collapse';
$navbar_mobile_width = '1198';

if ( function_exists( 'FW' ) ) {

	$navbar_affix = fw_get_db_settings_option( 'navbar-affix' );
	$navbar_breakpoint = fw_get_db_settings_option( 'navbar-breakpoint' );

	if ( !empty($navbar_breakpoint) ) {

		$navbar_mobile_width = $navbar_breakpoint;
	}

	// Current page layout
	$navbar_layout = mirasat_get_navbar_layout('transparent');

	if ( $navbar_layout == 'full-width' OR $navbar_layout == 'hamburger' OR $navbar_layout == 'hamburger-transparent' OR $navbar_layout == 'hamburger-left' ) {

		$navbar_mobile_width = '4000';
		$navbar_logo = 'white';
	}

	if ( $navbar_layout == 'transparent' OR $navbar_layout == 'desktop-center-transparent' ) {

		$navbar_logo = 'white';
	}	

	if ( $navbar_layout == 'white' ) {

		$navbar_logo = 'black';
	}	


	$basket_icon = fw_get_db_settings_option( 'basket-icon' );
	if ( empty($basket_icon) ) {

		$basket_icon = 'disabled';
	}	
}


if ( $navbar_layout != 'disabled' ):

	mirasat_the_topbar_block( $navbar_layout );

?>
<div id="nav-wrapper" class="navbar-layout-<?php echo esc_attr($navbar_layout);?>">
	<nav class="navbar" data-spy="<?php echo esc_attr($navbar_affix); ?>" data-offset-top="0">
		<div class="container">
			<?php
				if ( $navbar_layout == 'desktop-center' OR $navbar_layout == 'desktop-center-transparent' OR $navbar_layout == 'hamburger' ) {

					mirasat_the_navbar_social($navbar_layout);
				}
			?>				
			<div class="navbar-logo <?php echo esc_attr($navlogo_class); ?>">	
				<?php
					mirasat_the_logo($navbar_logo);
				?>
			</div>	
			<?php
				if ( $navbar_layout == 'desktop-center' OR $navbar_layout == 'desktop-center-transparent' OR $navbar_layout == 'full-width' OR $navbar_layout == 'hamburger' OR $navbar_layout == 'hamburger-transparent' ) {

					mirasat_the_navbar_icons( $navbar_layout );
				}
			?>					
			<div id="navbar" class="<?php echo esc_attr( $navbar_class ); ?>" data-mobile-screen-width="<?php echo esc_attr( $navbar_mobile_width ); ?>">
				<div class="toggle-wrap">
					<?php
						mirasat_the_logo('white');
					?>						
					<button type="button" class="navbar-toggle collapsed">
						<span class="close">&times;</span>
					</button>							
					<div class="clearfix"></div>
				</div>
				<?php
					mirasat_get_wp_nav_menu();

					if ( $navbar_layout != 'desktop-center' AND $navbar_layout != 'desktop-center-transparent' ) {

						mirasat_the_navbar_icons( $navbar_layout );
					}
				?>
				<div class="mobile-controls">
					<?php
						mirasat_the_navbar_icons( $navbar_layout, true );
					?>
				</div>				
			</div>
			<div class="navbar-controls">	
				<button type="button" class="navbar-toggle collapsed">
					<span class="icon-bar top-bar"></span>
					<span class="icon-bar middle-bar"></span>
					<span class="icon-bar bottom-bar"></span>
				</button>			
			</div>	
		</div>
	</nav>
</div>
<?php

endif;

