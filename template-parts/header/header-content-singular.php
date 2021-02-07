<?php 

/* 
*
* DISABLING THIS FOR NOW. REMOVE ALL CODE THAT CALLS THIS FILE IF WE WANT IT GONE.

setup_postdata( get_the_ID() ); 

$post_id = get_the_ID();
$featured_photo = get_the_post_thumbnail( $post_id, 'mv_trellis_16x9_res', [ 'style' => 'display: block;' ], false );

?>
<div class="header-singular">
	<div class="wrapper">
		<?php
		mvt_title_before();
		mv_trellis_get_template_part( 'template-parts/article/article-meta' );
		?>
		<div class="article-featured-image">
			<?php echo wp_kses( $featured_photo, mv_trellis_get_wp_kses_post_with_images() ); ?>
		</div>
		<h1 class="article-heading"><?php the_title(); ?></h1>
		<?php mvt_title_after(); ?>
	</div>
</div> */
