<?php
$featured_photo = get_the_post_thumbnail(
	get_the_ID(),
	'mv_trellis_16x9_high_res',
	[ 'style' => 'display: block;' ],
	false
);

?>

<article class="article excerpt">
	<div class="excerpt-container">
		<?php mvt_entry_top(); ?>

		<?php if ( ! empty( $featured_photo ) ) { ?>
			<div class="excerpt-photo">
				<a href="<?php the_permalink(); ?>" class="excerpt-link" title="<?php the_title(); ?>"><?php echo wp_kses( $featured_photo, mv_trellis_get_wp_kses_post_with_images() ); ?></a>
			</div>
		<?php } ?>

		<div class="excerpt-post-data">
			<h2 class="excerpt-title"><a href="<?php the_permalink(); ?>" class="excerpt-link"><?php the_title(); ?></a></h2>
			<div class="excerpt-excerpt">
				<?php
				mvt_entry_excerpt_before();
				the_excerpt();
				mvt_entry_excerpt_after();
				?>
			</div>

			<a href="<?php the_permalink(); ?>" class="button article-read-more">Read More<span class="screen-reader-text"> about <?php the_title(); ?></span></a>
		</div>
		<?php mvt_entry_bottom(); ?>
	</div>
</article>

<?php
/**
 * Fires after the article excerpt
 *
 * @since 1.0.0
 */
do_action( 'mv_trellis_after_article_excerpt' );
