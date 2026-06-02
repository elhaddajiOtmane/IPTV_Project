<?php
	$header_wrapper = mirasat_get_pageheader_wrapper();
	$header_class = mirasat_get_pageheader_class();
	$pageheader_layout = mirasat_get_pageheader_layout();
	$navbar_layout = mirasat_get_navbar_layout();
?>
<div class="ltx-content-wrapper <?php echo esc_attr($header_wrapper.' ltx-navbar-'.$navbar_layout); ?>">
	<div class="header-wrapper <?php echo esc_attr($header_class .' ltx-pageheader-'. $pageheader_layout); ?>">
	<?php
		get_template_part( 'tmpl/navbar' );

		if ( $pageheader_layout != 'disabled' ) : ?>
		<header class="page-header">
			<?php mirasat_the_tagline_header(); ?>
		    <div class="container">
		    	<span class="ltx-before"></span>
		    	<?php
		    		mirasat_the_h1();			
					mirasat_the_breadcrumbs();
				?>	 
				<span class="ltx-after"></span>
				<div class="ltx-header-icon"></div>
			    <?php mirasat_the_social_header(); ?>
		    </div>
		</header>
		<?php endif; ?>
	</div>