<?php
//Get featured image
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'home_post' );

//Get category and tags
$category = blesk_get_categories_in_loop(get_the_ID());

//Content width set
$content_entry_width = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
<?php

	if(isset($image[0])) {
		echo '<a href="'.get_the_permalink().'"  title="'.get_the_title().'" class="entry-image" style="background-image:url('.esc_url($image[0]).');"></a><!-- /.entry-image -->';
	} else {
		$content_entry_width = ' style="width: 100%; padding-left: 0;"';
	}

echo '<div class="entry-content"'.$content_entry_width.'>
		<h2 class="entry-title">
			<a href="'.get_the_permalink().'">'.get_the_title().'</a>
		</h2><!-- /.entry-title -->
		<div class="entry">
			<p>'.get_the_excerpt().'</p>
		</div><!-- /.entry -->
		<div class="entry-meta">
			<ul>';

			//Check if category exists and echo it
			if($category) {
				echo '
				<li>
					<i class="fa fa-tags"></i>
					<a href="'.esc_url($category[0][1]).'">'.esc_html($category[0][2]).'</a>
				</li>';
			}
				

		echo '<li>
					<i class="fa fa-comment"></i>
					<a href="'.get_the_permalink().'#comments">'.sprintf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'blesk' ), number_format_i18n( get_comments_number() ) )	.'</a>
				</li>
				<li>
					<time datetime="'.get_the_date('Y-j-m').'">'.get_the_date('F j, Y').'</time>
				</li>
			</ul>
		</div><!-- /.entry-meta -->
	</div><!-- /.entry-content -->
</article><!-- /.post -->';