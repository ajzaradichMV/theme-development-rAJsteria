<?php
	// TODO: Add a link on the page that allows you to either select a category based index or alphabetical based index.
	// Default Category Based?

	//Category Based Index
	// Grab the categories so we can output the title later on and loop.
	$cats = get_categories( array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => false,
	));
	echo '<ul>';
	foreach ($cats as $cat) {
		$cat_name = $cat->cat_name;
		echo '<li><a href="#' . $cat_name . '">[' . $cat_name . ']</a></li>';
	}
	echo '</ul>';
	$cat_count = 0;
	// Loop through the all of the categories and output them onto the page.
	while ( $cat_count < sizeof($cats)) {
		$catid = $cats[$cat_count]->cat_ID;
		$cat_name = $cats[$cat_count]->cat_name;

		echo '<div id="' . $cat_name . '" class="index-category-container"><h2 class = "category-title">' . $cat_name . '</h2>';
		$posts = get_posts( array(
			'category'    => $catid,
			'numberposts' => -1
		));

		if (!empty($posts)) {
			// If some posts are returned by get_posts above we'll loop it through here.
			foreach ($posts as $post) {
				echo '<div class ="index-post-container"><a href="' . get_post_permalink() . '"><p class = "post-title">' . $post->post_title . '</p>';
				echo get_the_post_thumbnail() . '</a></div>';

			} //foreach $posts
		} // if $posts is empty
		echo '</div>';
		$cat_count++;
	} // while $cat_count
?>