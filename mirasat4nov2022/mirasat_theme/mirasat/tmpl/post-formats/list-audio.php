<?php
/**
 * Audio Post Format
 */

$post_class = '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<div class="ltx-wrapper">
		<?php

		if ( has_post_thumbnail() ) {

			$mirasat_photo_class = 'photo';

		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($mirasat_photo_class).'">';

			    the_post_thumbnail();

		    echo '</a>';
		}

		$mp3 = mirasat_find_http(get_the_content());

		echo wp_audio_shortcode(
			array('src'	=>	esc_url($mp3))
		);

		$headline = 'inline';

		?>
	</div>
    <div class="description">
    	<?php

    		mirasat_get_the_post_headline();
    		
    	?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
    </div>    	    	
</article>