<?php
/**
 * Gallery post format
 */

$post_class = '';
if ( function_exists( 'FW' ) ) {

	$gallery_files = fw_get_db_post_option(get_The_ID(), 'gallery');
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<?php
		if ( !empty( $gallery_files ) ) {

			$atts['swiper_arrows'] = 'sides-tiny';
			$atts['swiper_autoplay'] = fw_get_db_settings_option( 'blog_gallery_autoplay' );
		
			echo ltx_vc_swiper_get_the_container('ltx-post-gallery', $atts, '', ' id="ltx-slide-'.get_the_ID().'" ');
			echo '<div class="swiper-wrapper">';

			foreach ( $gallery_files as $item ) {

				echo '<a href="'.esc_url(get_the_permalink()).'" class="swiper-slide">';
					echo wp_get_attachment_image( $item['attachment_id'], 'mirasat-blog-full' );
				echo '</a>';
			}

			echo '</div>
			</div>
			</div>';
		}
			else
		if ( has_post_thumbnail() ) {

			$mirasat_photo_class = 'photo';

		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($mirasat_photo_class).'">';

		    the_post_thumbnail();

		    echo '</a>';
		}

		$headline = 'date';
	?>
    <div class="description">
    	<?php

    		mirasat_get_the_post_headline();
    		
    	?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
        <?php
        	$display_excerpt = 'visible';
        ?>        
        <div class="text text-page">
			<?php
				if ( !empty( $display_excerpt ) AND $display_excerpt == 'visible' ) {

					add_filter( 'the_content', 'mirasat_excerpt' );
			    	the_excerpt();	 	
			   	}
			?>
        </div>     
    </div>    	

</article>
