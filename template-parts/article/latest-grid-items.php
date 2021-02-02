<?php

$featured_photo = get_the_post_thumbnail( $featured_post_id, 'mv_trellis_4x3_low_res', [ 'style' => 'display: block;' ], false );

?>

<article class="article excerpt">
	<div class="excerpt-container">
		<?php mvt_entry_top(); ?>
		<a href="<?php the_permalink(); ?>" class="excerpt-link" title="<?php the_title(); ?>">
			<div class="excerpt-post-data">
				<h2 class="excerpt-title"><?php the_title(); ?></h2>
				<div class="excerpt-excerpt">
						<?php
							the_excerpt();
						?>
				</div>
			</div>
		
		<?php if ( ! empty( $featured_photo ) ) { ?>
			<div class="excerpt-photo">
				<?php echo wp_kses( $featured_photo, mv_trellis_get_wp_kses_post_with_images() ); ?>
				<div class="category-marker">
						<?php $cat_name = get_cat_name( get_the_category( get_the_ID() ) ); ?><span><?php echo $cat_name; ?></span>
				</div>
				
			</div>
			
		<?php } ?>

		</a>
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
