<?php
/**
 * Video Post Format
 */

$post_class = '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>	
	<?php
	if ( has_post_thumbnail() ) {

		$mirasat_photo_class = 'photo swipebox';

		echo '<div class="ltx-wrapper">';
		    echo '<a href="'.esc_url(mirasat_find_http(get_the_content())).'" class="'.esc_attr($mirasat_photo_class).'">';

			    the_post_thumbnail();
			    echo '<span class="ltx-icon-video"></span>';

		    echo '</a>';
		echo '</div>';
	}
		else {

		if ( !empty(wp_oembed_get(mirasat_find_http(get_the_content()))) ) {

			echo '<div class="ltx-wrapper">';
				echo wp_oembed_get(mirasat_find_http(get_the_content()));	
			echo '</div>';
		}
	}


	$headline = 'date';

	?>
    <div class="description">
    	<?php

    		mirasat_get_the_post_headline();
    		
    	?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>         
    </div>    	
</article>