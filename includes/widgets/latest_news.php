<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

class Blesk_Custom_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	function __construct() {
		parent::__construct(
			'customRecentPosts', // Base ID
			__( '[Blesk] Custom Recent Posts', 'blesk' ), // Name
			array( 'description' => __( 'Custom recent posts with featured images', 'blesk' ), ) // Args
		);
	}
	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? sanitize_text_field($instance['title']) : __( 'Recent Posts', 'blesk' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :

		echo $args['before_widget'];

		echo $args['before_title'];
		echo $title;
		echo $args['after_title'];

		?>
		
		<?php while ( $r->have_posts() ) : $r->the_post(); 
    	
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'home_post' );

    	$post_content_width = '';
    	$post_content_width_extra = '';

    	if(!isset($image[0])) {
    		$post_content_width = ' style="width: 100%; float: none;"';
    		$post_content_width_extra = ' style="padding-left: 0;"';
    	}
		?>
			
			<article class="post"<?php echo $post_content_width_extra; ?>>
				<?php 
					if(isset($image[0])) {
						echo '<a href="'.get_the_permalink().'" class="entry-image" style="background-image:url('.esc_url($image[0]).')"></a>';
					}
				
				?>
				<div class="entry"<?php echo $post_content_width; ?>>
					<h3 class="entry-title"><?php the_excerpt(); ?></h3><!-- /.entry-title -->
					<a href="<?php the_permalink(); ?>" class="read-more"><?php _e('Read More', 'blesk'); ?></a>
				</div><!-- /.entry -->
			</article><!-- /.post -->

		<?php endwhile; 

		echo $args['after_widget'];

		?>

		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = absint($new_instance['number']);
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'blesk' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of posts to show:', 'blesk' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

<?php
	}
}
add_action( 'widgets_init', function(){
     register_widget( 'Blesk_Custom_Widget_Recent_Posts' );
});