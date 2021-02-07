<?php

$featured_photo = get_the_post_thumbnail( $post_id, 'mv_trellis_16x9_res', [ 'style' => 'display: block;' ], false );
$author_id = get_the_author_meta( 'ID' );
$avatar = get_avatar( $author_id );
$cat_list = wp_list_pluck( get_the_category(), 'cat_ID');
$last_cat = end($cat_list);

?>

<div class ="post-header">
	<div class="wrapper">
		<div class="article-categories">
			<?php foreach ( $cat_list as $cat ) { ?>
				<a href="<?php echo esc_url( get_category_link( $cat ) ) ?>"> <?php echo get_cat_name( $cat ); ?> </a>
				<?php if ( $cat !== $last_cat ) { ?> <span>&nbsp; &#8226; &nbsp;</span>
			<?php }} ?>
		</div>
		<h1 class="article-heading"> <?php echo get_the_title(); ?> </h1>
		<div class="article-meta">
			<?php if ( !empty( $avatar ) ) { echo $avatar; } ?>
			<span class="author">Written By:&nbsp;</span><?php echo get_the_author_link(); ?>
			<span> &nbsp; &#8226; &nbsp; </span>
			<span class="post-time">
				<span class="screen-reader-text">Published On: </span> <span><?php echo get_the_date( 'dS M Y' ); ?> </span>
			</span>
		</div>
		<div class="article-image">
			<?php echo wp_kses( $featured_photo, mv_trellis_get_wp_kses_post_with_images() ) ?>
		</div>
	</div>
</div>

