<?php
/**
	Testimonials Single Item
 */

$class = '';
if ( function_exists( 'FW' ) ) {

	$subheader = fw_get_db_post_option(get_The_ID(), 'subheader');
	$rate = fw_get_db_post_option(get_The_ID(), 'rate');	
	$short = fw_get_db_post_option(get_The_ID(), 'short');	

	if ( !empty($short)) {

		$class = ' ltx-short';
	}
}

?>
<div class="col-lg-6 item">
	<article class="inner <?php echo esc_attr($class); ?>">
	<?php

		if ( empty($short)) {

			echo '<div class="image">';
				the_post_thumbnail('mirasat-tiny');
			echo '</div>';
		}

		echo '<div class="header">'. get_the_title() .'</div>';
		if (!empty($subheader) ) {
			echo '<div class="subheader">'. wp_kses_post($subheader) .'</div>';
		}

		echo '<div class="rate">';
		for ($x = 1; $x<= (int)($rate); $x++) {

			echo '<span class="fa fa-star"></span>';
		}
		echo '</div>';

		echo '<div class="text">';
			echo '<p>'. get_the_content() .'</p>
		</div>';
	?>
	</article>
</div>
