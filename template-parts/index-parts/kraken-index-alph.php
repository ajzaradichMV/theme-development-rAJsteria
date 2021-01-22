<?php
	$cats = get_categories( array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => false,
	));
	$letters = range("a", "z");
	foreach( $letters as $letter) {
		echo "<p>" . $letter . "</p>";
	}
	$letter_count = 0;
	while( $letter_count < sizeof($letters)) {
		echo '<div id="' . $letters[$letter_count] . '">' . $letters[$letter_count] . '</div>';

		$alph_posts = get_posts( array(
			"orderby"        => "name",
			"numberposts"    => -1
		));

		foreach( $alph_posts as $alph_post ) {
			$first_letter = substr($alph_post->post_name, 0, 1);
			if ($first_letter == $letters[$letter_count]) {
				echo '<p>' . $alph_post->post_title . '</p>';
			}
		}
		$letter_count++;
	}
?>