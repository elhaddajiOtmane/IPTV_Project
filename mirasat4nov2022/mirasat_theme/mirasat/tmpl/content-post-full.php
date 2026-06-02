<?php
/**
 * Full blog post
 */

if ( function_exists( 'FW' ) ) {

	$gallery_files = fw_get_db_post_option(get_The_ID(), 'gallery');
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content clearfix" id="entry-div">
	<?php
		if ( !empty( $gallery_files ) ) {

			echo '
			<div class="swiper-container ltx-post-gallery" data-autoplay="4000">
				<div class="swiper-wrapper">';

			foreach ( $gallery_files as $item ) {

				echo '<a href="'.esc_url(get_the_permalink()).'" class="swiper-slide">';
					echo wp_get_attachment_image( $item['attachment_id'], 'mirasat-featured' );
				echo '</a>';
			}

			echo '</div>
				<div class="arrows">
					<a href="#" class="arrow-left fa fa-arrow-left"></a>
					<a href="#" class="arrow-right fa fa-arrow-right"></a>
				</div>
				<div class="swiper-pages"></div>
			</div>';
		}
			else	
		if ( has_post_thumbnail() ) {

			echo '<div class="image">';
				
				the_post_thumbnail( 'mirasat-post' );

			echo '</div>';
		}
	?>
    <div class="blog-info blog-info-post-top">
		<?php

            echo '<div class="blog-info-left">';

				mirasat_get_the_cats_archive();

				echo '<a href="'. esc_url( get_the_permalink() ) .'" class="ltx-date"><span class="fa fa-clock-o"></span><span class="dt">'.get_the_date().'</span></a>';


            echo '</div>';

            echo '<div class="blog-info-right">';
		  
				if ( function_exists( 'pvc_post_views' ) ) {

					$count = (int)(strip_tags( pvc_post_views(get_the_ID(), false) ));

					echo '
					<span class="icon-fav">
						<span class="fa fa-eye"></span>
						<i>' . esc_html( $count ) . '</i></span>';
				}

			    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			    	echo '<span class="icon-comments"><span class="fa fa-commenting"></span><a href="'. esc_url( get_the_permalink() ) .'">';

			    	echo get_comments_number();

			    	echo '</a></span>';
			    }

            echo '</div>';

        ?>
    </div>
    <div class="description">
        <div class="text text-page">
			<?php

				the_content();

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mirasat' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
			<div class="clear"></div>
        </div>
    </div>	    
    <div class="clearfix"></div>
    <?php if ( has_tag() OR shortcode_exists('ltx-share-icons') OR (in_array( 'category', get_object_taxonomies( get_post_type() ) ) && mirasat_categorized_blog() && sizeof(get_the_category()) > 3 )) : ?>
    <div class="blog-info-post-bottom">
		<?php
			if ( has_tag() OR shortcode_exists('ltx-share-icons') ) {

				$tags_many_class = '';
				if ( has_tag() AND sizeof( wp_get_post_tags( get_The_ID() ) ) > 5 ) {

					$tags_many_class = ' tags-many-wrapper';
				}

				echo '<div class="tags-line'.esc_attr($tags_many_class).'">';

					echo '<div class="tags-line-left">';
						if ( has_tag() AND sizeof( wp_get_post_tags( get_The_ID() ) ) <= 5 ) {

							echo '<span class="tags">';
								echo '<span class="tags-header">'.esc_html__( 'Tags:', 'mirasat' ).'</span>';
								the_tags( '<span class="tags-short">', '', '</span>' );
							echo '</span>';
						}		
							else
						if ( has_tag() AND sizeof( wp_get_post_tags( get_The_ID() ) ) > 5 ) {
							
							echo '<span class="tags tags-many">';
								the_tags( '<span class="tags-short">', '', '</span>' );
							echo '</span>';
						}	

					echo '</div>';
					echo '<div class="tags-line-right">';

						if ( shortcode_exists('ltx-share-icons') ) {

							echo do_shortcode( '[ltx-share-icons header="'.esc_html__( 'Share', 'mirasat' ).'"]' );
						}

					echo '</div>';

				echo '</div>';
			}

			if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && mirasat_categorized_blog() && sizeof(get_the_category()) > 3 ) {

				echo '<div class="ltx-cats cats-many">';
					echo '<span class="cats-many-header">'.esc_html__( 'Categories:', 'mirasat' ).'</span>';
					echo get_the_category_list( esc_html_x( ' | ', 'Used between list items, there is a space after the comma.', 'mirasat' ) );
				echo '</div>';
			}				

		?>	
    </div>	
	<?php endif; ?>
    <?php 
		mirasat_author_bio();

		mirasat_related_posts(get_the_ID());
    ?>
    </div>
</article>
