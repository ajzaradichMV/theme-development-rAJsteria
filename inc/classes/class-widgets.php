<?php

/*
*
* Add our child theme's custom widgets.
*
*/
namespace NewsTheme;

class Latest_Posts_Widget extends \WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'NewsTheme Child Post Widget',
			'description' => 'Add a widget that allows you to display a selection of handpicked posts or posts of a specific categorys.',
		);
		parent::__construct( 'recent_category_widget', 'NewsTheme Child Post Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		
		// Comment icon separated out so we can easily change this later
		$comment_icon = '<circle style="fill:#000000;" cx="256" cy="256" r="256"/>
			<path style="fill:#FFFFFF;" d="M394.768,120.616H117.232c-13.88,0-25.232,11.352-25.232,25.232v176.616  c0,13.88,11.352,25.232,25.232,25.232h132.464l94.616,75.696v-75.696h50.464c13.88,0,25.232-11.352,25.232-25.232V145.848  C420,131.968,408.648,120.616,394.768,120.616z"/>';
		
		// Create an array that will be for handpicked posts if chosen. Will also run checks to see if empty or not.
		$handpick = array();
		
		if ($instance['first_hero'] == 1) {
			
			echo '<div id="' . $this->get_field_id( 'category' ) . '" class="news-widget-wrapper first-post-hero selected-' . strtolower($instance['category']) . '-category">';
			
		}	else {
			
			echo '<div id="' . $this->get_field_id( 'category' ) . '" class="widget news-widget-wrapper selected-' . strtolower($instance['category']) . '-category">';
			
		}
		
		if ( !empty($instance['first_post'] ) || !empty($instance['second_post'] ) || !empty($instance['third_post'] ) || !empty($instance['fourth_post'] ) || !empty($instance['fifth_post'] ) ) {
			
			array_push($handpick, $instance['first_post'], $instance['second_post'], $instance['third_post'], $instance['fourth_post'], $instance['fifth_post']);
			
			$hand_count = count($handpick);
			
		}
		
		// Use the category and amounts set in the widget options to pull a list of post IDs that fit the bill.
		
		$posts = get_posts( array(
							'category'     => $instance['category'],
							'numberposts'  => $instance['amount'],
							'order'        => $instance['order'],
							'fields'       => 'ids',
						));
		
		echo '<h1 class="news-category-title">' . $instance['category'] . '</h1>';
		echo '<div class="category-wrapper">';
		
		// Output our found posts in all their glory.
		foreach ($posts as $post) {
			
			$args = 'post_thumbnail';
			
			// Need to rewrite this in a way better way that doesn't look like a baby made it.
			echo '<div class="latest-wrapper">';
			echo '<div class="latest-post">';
			echo '<div class="post-image"> <img src="' . get_the_post_thumbnail_url( $post, 'thumbnail' ) . '"></div>';
			echo '<div class="latest-post-data">';
			echo '<a href="' . get_the_permalink( $post ) . '" class="post-title"> ' . get_the_title( $post ) . '</a>';

			if ($instance['post_date'] == 1) {
				echo '<p class="post-date">' . get_the_date( 'F dS, Y', $post ) . '</p>';
			}
			
			echo '<div class="social-wrapper">';
			
			if ($instance['comment_count'] == 1) {
				echo '<div class="comments-data">';
				echo '<span class="comments-icon">';
				echo '<svg width="20" height="20" viewBox="0 0 520 520">' . $comment_icon . '</svg>';
				echo '</span>';
				echo '<div class="comment-count"><p>' . get_comments( array ( 'post_id' => $post, 'count' => true) ) . '</p></div></div>';
			}
			
			echo '</div></div></div></div>';
		}
		
		echo '</div></div>';
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		
		$cats = get_categories( array(
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => true,
			));
			
		$amount = ! empty( $instance['amount'] ) ? $instance['amount'] : esc_html__( '', 'text_domain' );
		$category = ! empty( $instance['category'] ) ? $instance['category'] : esc_html__( '', 'text_domain' );
		$post_date = ! empty( $instance['post_date'] ) ? $instance['post_date'] : esc_html__( '', 'text_domain' );
		$comment_count = ! empty( $instance['comment_cound'] ) ? $instance['comment_count'] : esc_html__( '', 'text_domain' );
		$order = ! empty( $instance['order'] ) ? $instance['order'] : esc_html__( '', 'text_domain' );
		$first_hero = ! empty( $instance['first_hero'] ) ? $instance['first_hero'] : esc_html__( '', 'text_domain' );
		$first_post = ! empty( $instance['first_post'] ) ? $instance['first_post'] : esc_html__( '', 'text_domain' );
		$second_post = ! empty( $instance['second_post'] ) ? $instance['second_post'] : esc_html__( '', 'text_domain' );
		$third_post = ! empty( $instance['third_post'] ) ? $instance['third_post'] : esc_html__( '', 'text_domain' );
		$fourth_post = ! empty( $instance['fourth_post'] ) ? $instance['fourth_post'] : esc_html__( '', 'text_domain' );
		$fifth_post = ! empty( $instance['fifth_post'] ) ? $instance['fifth_post'] : esc_html__( '', 'text_domain' );
		
		$post_loop = array();
		array_push($post_loop, 'first_post', 'second_post', 'third_post', 'fourth_post', 'fifth_post');
		$post_loop_vars = array();
		array_push($post_loop_vars, $first_post, $second_post, $third_post, $fourth_post, $fifth_post);
		
		$count = 0;
		
		?>
		<p>

			<label for="<?php echo esc_attr( $this->get_field_id( 'category') ); ?>"><?php esc_attr_e( 'Select a category:', 'text_domain' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>">

				<?php foreach ($cats as $cat) {
					$cat_name = $cat->cat_name; ?>
					<option <?php selected($instance['category'], $cat_name); ?> value="<?php echo esc_attr( $cat_name ); ?>"><?php echo $cat_name; ?></option>
				<?php } ?>
			</select>

			<hr>

			<p><strong>Handpicked Posts:</strong> Use fields below to enter handpicked posts that will be included in the widget. Not required. </p>
			<p>Enter Post IDs below:</p>
			<?php foreach ($post_loop as $pl) {  ?>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( $pl ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $pl ) ); ?>" value="<?php echo esc_attr( $post_loop_vars[$count] ); ?>"><br><br>
			<?php $count++; 
						} ?>

			<hr><br>

			<label for="<?php echo esc_attr( $this->get_field_id( 'order') ); ?>"><?php esc_attr_e( 'Sort By:', 'text_domain' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" type="text" value="<?php echo esc_attr( order ); ?>">
				<option <?php selected($instance['order'], 'asc'); ?> value="asc">Ascending</option>
				<option <?php selected($instance['order'], 'desc'); ?> value="desc">Descending</option>
			</select><br><br>

			<label for="<?php echo esc_attr( $this->get_field_id( 'amount') ); ?>"><?php esc_attr_e( 'Number of posts to show:', 'text_domain' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'amount' ) ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>">
				<option <?php selected( $instance['amount'], 3); ?> value="3">3</option>
				<option <?php selected( $instance['amount'], 4); ?> value="4">4</option>
				<option <?php selected( $instance['amount'], 5); ?> value="5">5</option>
			</select><br><br>

			<input type="checkbox" <?php checked($instance['post_date'],); ?> id="<?php echo esc_attr( $this->get_field_id( 'post_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_date' ) ); ?>" value="1">
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_date' ) ); ?>"><?php esc_attr_e( 'Display post date', 'text_domain' ); ?></label>
			<br><br>

			<input type="checkbox" <?php checked($instance['comment_count']); ?> id="<?php echo esc_attr( $this->get_field_id( 'comment_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_count' ) ); ?>" value="1">
			<label for="<?php echo esc_attr( $this->get_field_id( 'comment_count' ) ); ?>"><?php esc_attr_e( 'Display comment count', 'text_domain' ); ?></label><br><br>

			<input type="checkbox" <?php checked($instance['first_hero']); ?> id="<?php echo esc_attr( $this->get_field_id( 'first_hero' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'first_hero' ) ); ?>" value="1">
			<label for="<?php echo esc_attr( $this->get_field_id( 'first_hero' ) ); ?>"><?php esc_attr_e( 'First post hero image', 'text_domain' ); ?></label>

		</p>
		<?php 
		
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		
		$instance['amount'] = ( ! empty( $new_instance['amount'] ) ) ? sanitize_text_field( $new_instance['amount'] ) : '';
		$instance['category'] = ( ! empty( $new_instance['category'] ) ) ? sanitize_text_field( $new_instance['category'] ) : '';
		$instance['order'] = ( ! empty( $new_instance['order'] ) ) ? sanitize_text_field( $new_instance['order'] ) : '';
		$instance['post_date'] = ( ! empty( $new_instance['post_date'] ) ) ? sanitize_text_field( $new_instance['post_date'] ) : '';
		$instance['comment_count'] = ( ! empty( $new_instance['comment_count'] ) ) ? sanitize_text_field( $new_instance['comment_count'] ) : '';
		$instance['first_hero'] = ( ! empty( $new_instance['first_hero'] ) ) ? sanitize_text_field( $new_instance['first_hero'] ) : '';
		$instance['first_post'] = ( ! empty( $new_instance['first_post'] ) ) ? sanitize_text_field( $new_instance['first_post'] ) : '';
		$instance['second_post'] = ( ! empty( $new_instance['second_post'] ) ) ? sanitize_text_field( $new_instance['second_post'] ) : '';
		$instance['third_post'] = ( ! empty( $new_instance['third_post'] ) ) ? sanitize_text_field( $new_instance['third_post'] ) : '';
		$instance['fourth_post'] = ( ! empty( $new_instance['fourth_post'] ) ) ? sanitize_text_field( $new_instance['fourth_post'] ) : '';
		$instance['fifth_post'] = ( ! empty( $new_instance['fifth_post'] ) ) ? sanitize_text_field( $new_instance['fifth_post'] ) : '';
		
		return $instance;
	}
}