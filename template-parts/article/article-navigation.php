<?php
// We don't want this displayed on pages
if ( is_page() ) {
	return;
}

mvt_entry_navigation_before();
?>
<section class="article-navigation">
	<?php
	$direction = [
		'prev' => [
			'function' => 'previous',
			'title'    => __( 'Prev', 'mediavine' ),
		],
		'next' => [
			'function' => 'next',
			'title'    => __( 'Next', 'mediavine' ),
		],
	];

	foreach ( $direction as $name => $info ) {
		$get_post_function = "get_{$info['function']}_post";
		$nav_post          = $get_post_function();

		// Only display link if it exists
		if ( is_a( $nav_post, 'WP_Post' ) ) {
			$nav_post_url = get_the_permalink( $nav_post->ID );
			$nav_post_img = get_post_thumbnail_id( $nav_post );
			?>

			<a href="<?php echo esc_url( $nav_post_url ); ?>" class="article-navigation-link article-navigation-<?php echo esc_attr( $name ); ?>">
				<?php
					if ( ! empty( $nav_post_img ) ) {
						$image_attributes = [
							'data-pin-nopin' => 'true',
							'class'          => [
								'article-navigation-img',
							],
						];
						?>
					<div class="article-navigation-svg-<?php echo esc_attr ( $name ); ?>">
						<svg viewBox="0 -4 30 40" height="100%" width="100%" preserveAspectRatio="xMidYMid meet">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 21 47.5" version="1.1" x="0px" y="0px" fill="#F0F0F0"><path d="M3.08,1.28 C2.48898049,0.729282279 1.56798056,0.745532248 0.996756402,1.3167564 C0.425532248,1.88798056 0.409282279,2.80898049 0.96,3.4 L16.96,19.4 L0.96,34.84 C0.409282279,35.4310195 0.425532248,36.3520194 0.996756402,36.9232436 C1.56798056,37.4944678 2.48898049,37.5107177 3.08,36.96 L20.92,19.4 L3.08,1.28 Z"/></svg>
						</svg>
					</div>
					<div class="article-navigation-img-wrap">
						<?php mv_trellis_the_attachment_image_tag( $nav_post_img, 'mv_trellis_3x4', $image_attributes, 'low' ); ?>
					</div>
				<?php } ?>
				<div class="article-navigation-text">
					<div class="article-navigation-direction title-alt"><?php echo esc_html( $info['title'] ); ?></div>
					<div class="article-navigation-title-wrap"><span class="article-navigation-title h3"><?php echo wp_kses_post( $nav_post->post_title ); ?></span></div>
				</div>
			</a>

		<?php
		}
	}
	?>
</section>
<?php
mvt_entry_navigation_after();
