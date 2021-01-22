<?php
// Make sure on correct page
if ( 0 !== get_query_var( 'paged' ) ) {
	return;
}

$featured_post_id = mv_trellis_get_featured_post();

if ( empty( $featured_post_id ) ) {
	return;
}

$featured_photo = mv_trellis_get_featured_image_tag( $featured_post_id, [ 'style' => 'display: block;' ], false );
?>
<section class="latest-header">
	<h1 class="latest-posts-title">Latest Posts</h1>
	<div class="wrapper-latest-header">
		<div class="featured-hero excerpt">
			<div class="wrapper wrapper-featured-hero">
				<div class="featured-hero-container excerpt-container">

					<?php if ( ! empty( $featured_photo ) ) { ?>
						<div class="featured-hero-photo excerpt-photo">
							<a href="<?php the_permalink( $featured_post_id ); ?>" class="featured-hero-link excerpt-link"
								title="<?php esc_attr( get_the_title( $featured_post_id ) ); ?>"><?php echo wp_kses( $featured_photo, mv_trellis_get_wp_kses_post_with_images() ); ?></a>
						</div>
					<?php } ?>

					<div class="featured-hero-post-data excerpt-post-data">
						<h1 class="featured-hero-title excerpt-title">
							<a href="<?php the_permalink( $featured_post_id ); ?>" class="featured-hero-link excerpt-link"><?php echo wp_kses_post( get_the_title( $featured_post_id ) ); ?></a>
						</h1>
						<div class="featured-hero-excerpt excerpt-excerpt"><?php echo wp_kses_post( apply_filters( 'the_excerpt', get_the_excerpt( $featured_post_id ) ) ); ?></div>
						<a href="<?php the_permalink( $featured_post_id ); ?>" class="featured-hero-btn btn"><?php esc_html_e( 'Read More', 'mediavine' ); ?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="latest-grid">
			<?php
			for ($count_posts = 0; $count_posts < 3; $count_posts++){
                the_post();
                    mv_trellis_get_template_part( 'template-parts/article/article-excerpt' );
                }
            ?>
		</div>
	</div>
</section>
