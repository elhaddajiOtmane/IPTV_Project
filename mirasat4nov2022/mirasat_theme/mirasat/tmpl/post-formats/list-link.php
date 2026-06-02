<?php
/**
 * Link post format
 */

$post_class = '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<div class="ltx-wrapper">
		<cite><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></cite>
		<?php
		    the_content();
		?>
	</div>
</article>