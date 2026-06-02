<?php
/**
 * The default template for displaying standard post format
 */

$post_class = '';
$featured = get_query_var( 'mirasat_featured_disabled' );
if ( function_exists( 'FW' ) AND empty ( $featured ) ) {

	$featured_post = fw_get_db_post_option(get_The_ID(), 'featured');
	if ( !empty($featured_post) ) {

		$post_class = 'ltx-featured-post-none';
	}
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<?php 

		if ( has_post_thumbnail() ) {

			$mirasat_photo_class = 'photo';
        	$mirasat_layout = get_query_var( 'mirasat_layout' );

			$mirasat_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_The_ID()), 'full' );

			if ($mirasat_image_src[2] > $mirasat_image_src[1]) $mirasat_photo_class .= ' vertical';
			
		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($mirasat_photo_class).'">';

	    	if ( empty($mirasat_layout) OR $mirasat_layout == 'classic'  ) {

	    		the_post_thumbnail();
	    	}
	    		else
	    	if ( $mirasat_layout == 'two-cols'  ) {	    	

	    		the_post_thumbnail();
	    	}
	    		else {


				$sizes_hooks = array( 'mirasat-blog', 'mirasat-blog-full' );
				$sizes_media = array( '1199px' => 'mirasat-blog' );

				mirasat_the_img_srcset( get_post_thumbnail_id(), $sizes_hooks, $sizes_media );
    		}

		    echo '</a>';
		}
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

				    if( strpos( $post->post_content, '<!--more-->' ) ) {

				        the_content( esc_html__( 'Read more', 'mirasat' ) );
				    }
				    	else  {

				    	the_excerpt();			    	
				    }	

				    remove_filter( 'the_content', 'mirasat_excerpt' );
				}
			?>
        </div>            
    </div>    
</article>