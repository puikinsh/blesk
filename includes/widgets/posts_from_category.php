<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

class CategoryPosts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'CategoryPosts', // Base ID
			__( '[Blesk] Category Posts', 'blesk' ), // Name
			array( 'description' => __( 'Display posts from a specific category', 'blesk' ), ) // Args
		);

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = ( !empty( $instance['title'] ) ? esc_html( $instance['title'] ) : '' );
		$count = ( !empty( $instance['count'] ) ? esc_html( $instance['count'] ) : '5' );
		$icon = ( !empty( $instance['icon'] ) ? esc_html( $instance['icon'] ) : '' );
		$category = ( !empty( $instance['category'] ) ? esc_html( $instance['category'] ) : '' );

		echo $args['before_widget'];

		//Echo widget title
		echo $args['before_title'];

		if($icon) {
			echo '<i class="fa '.esc_html($icon).'"></i>';
		}

		echo esc_html($title) . $args['after_title'];

		// WP_Query arguments
		$query_args = array(
			'posts_per_page'         => $count,
			'ignore_sticky_posts'    => true,
		);

		if($category) {
			$query_args['cat'] = $category;
		}

		// The Query
		$query = new WP_Query( $query_args );

		// The Loop
		if ( $query->have_posts() ) {

			echo '<div class="articles cf">';

			while ( $query->have_posts() ) {
				$query->the_post();

				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'home_post' );
				$content_wrapper = '';
				$fix_class = '';

				if(!isset($image[0])) {
					$content_wrapper = ' style="padding: 15px 30px 30px 30px;"';
					$fix_class = ' fixclass';
				}
				
				echo '<article class="post'.esc_attr($fix_class).'"'.$content_wrapper.'>';

				if(isset($image[0])) {
					echo '<a href="'.get_the_permalink().'" class="entry-image" style="background-image:url('.esc_url($image[0]).')"></a><!-- /.entry-image -->';
				} else {
					$content_wrapper = ' style="padding-left: 10px;"';
				}
				
				echo '<h4 class="entry-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4><!-- /.entry-title -->
						<div class="entry-meta">
							<ul>
								<li>
									<i class="fa fa-comment"></i>
									<a href="'.get_the_permalink().'#comments">'.sprintf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'blesk' ), number_format_i18n( get_comments_number() ) )	.'</a>
								</li>
								<li>
									<time datetime="'.get_the_date('Y-j-m').'">'.get_the_date('F j, Y').'</time>
								</li>
							</ul>
						</div><!-- /.entry-meta -->
					</article><!-- /.post -->';
			}

			echo '</div><!-- /.articles -->';

		} else {
			echo '<p>'.__('No posts found.', 'blesk').'</p>';
		}

		// Restore original Post Data
		wp_reset_postdata();

		echo $args['after_widget'];

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$fa_icons = blesk_get_fontawesome_icons();
		$categories = get_terms('category', array('fields' => 'id=>name'));


		$title = ! empty( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
		$count = ! empty( $instance['count'] ) ? sanitize_text_field( $instance['count'] ) : '5';
		$icon = ! empty( $instance['icon'] ) ? sanitize_text_field( $instance['icon'] ) : '';
		$category = ! empty( $instance['category'] ) ? sanitize_text_field( $instance['category'] ) : '';

		echo '
		<p>
            <label for="'.esc_attr($this->get_field_id( 'title' )).'">'.__( 'Title:', 'blesk' ).'</label>
            <input class="widefat" id="'.esc_attr($this->get_field_id( 'title' )).'" name="'.esc_attr($this->get_field_name( 'title' )).'" type="text" value="'.esc_attr( $title ).'">
        </p>';

        echo '<p>
            <label for="'.$this->get_field_id( 'icon' ).'">'.__( 'Title Icon:', 'blesk' ).'</label>
            <select class="widefat" id="'.$this->get_field_id( 'icon' ).'" name="'.$this->get_field_name( 'icon' ).'">
                <option value="all-font-awesome-icons">'. __( 'No Icon', 'blesk' ).'</option>';
                foreach( $fa_icons as $key => $icon_fa ) {
                    echo '<option value="'.esc_attr( $key ).'"'.selected( $icon, $key ).'>'.esc_html( $icon_fa ).'</option>';
                }
               
        echo '</select>
        </p>';

        echo '<p>
            <label for="'.$this->get_field_id( 'category' ).'">'.__( 'Category:', 'blesk' ).'</label>
            <select class="widefat" id="'.$this->get_field_id( 'category' ).'" name="'.$this->get_field_name( 'category' ).'">';
                foreach( $categories as $key => $cat ) {
                    echo '<option value="'.esc_attr( $key ).'"'.selected( $category, $key ).'>'.esc_html( $cat ).'</option>';
                }
               
        echo '</select>
        </p>';

        echo '
		<p>
            <label for="'.esc_attr($this->get_field_id( 'count' )).'">'.__( 'Posts Count:', 'blesk' ).'</label>
            <input class="widefat" id="'.esc_attr($this->get_field_id( 'count' )).'" name="'.esc_attr($this->get_field_name( 'count' )).'" type="text" value="'.esc_attr( $count ).'">
        </p>';

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['count'] = ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '5';
        $instance['icon'] = ( !empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';
        $instance['category'] = ( !empty( $new_instance['category'] ) ) ? strip_tags( $new_instance['category'] ) : '';

		return $instance;
	}

} // class CategoryPosts

add_action( 'widgets_init', function(){
     register_widget( 'CategoryPosts' );
});