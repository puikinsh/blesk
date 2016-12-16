<?php 
	get_header(); 

	//Wrapper markup
	echo '<div class="main-content">
		<div class="wrapper cf">
			<div class="single-content">';

	//Do the markup portion
	$content_portion = '';
	if(!have_posts() or !is_active_sidebar('home_page_sidebar')) {
		$content_portion = ' style="width: 100%; float: none; padding-left: 0;"';
	}

	//Check if posts exists
	if ( have_posts() )  {

		//Loop posts
		while ( have_posts() ) : the_post(); ?>


			<div id="post-<?php the_ID(); ?>" <?php post_class('single-post'); echo $content_portion;?>>
				
		<?php

			//Get featured image
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'home_post' );

			//Get category and tags
			$category = blesk_get_categories_in_loop(get_the_ID());

			//Content width set
			$content_entry_width = '';

			if(isset($image[0])) {
				echo '<div class="entry-featured-image">
						<img src="'.esc_url($image[0]).'" alt="'.get_the_title().'" />
					</div><!-- /.entry-featured-image -->';
			}

			//Echo title and post meta
			echo '
				<h1 class="entry-title">'.get_the_title().'</h1><!-- /.entry-title -->
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
						<a href="#comments">'.sprintf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'blesk' ), number_format_i18n( get_comments_number() ) )	.'</a>
					</li>
					<li>
						<time datetime="'.get_the_date('Y-j-m').'">'.get_the_date().'</time>
					</li>
				</ul>
			</div><!-- /.entry-meta -->';

			//Echo content
			echo '<div class="entry-content markup-format">';
			
			//Display content
			the_content();

			//Paginated posts
			wp_link_pages('before=<div class="cf single-tags">'.__('Pages: ', 'blesk').'&after=</div>');

			//Display tags
			the_tags('<div class="cf single-tags">', ', ','</div>');

			echo '</div><!-- /.entry-content -->';
			
			echo '</div><!-- /.single-posts -->';

			//Display author box
			echo '<div class="author-area">
					<div class="author-img">'.get_avatar( get_the_author_meta( 'ID' ), 122 ).'</div><!-- /.author-img -->
					<div class="author-info">
						<h5 class="name"><a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta( 'display_name' ).'</a></h5><!-- /.name -->
						<span class="title">'.get_the_author_meta('nickname').'</span>
						<p>'.get_the_author_meta('description').'</p>
					</div><!-- /.author-info -->
				</div><!-- /.author-area -->';

		endwhile;

		//Get comments
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	} else { ?>
		<div id="post-<?php the_ID(); ?>" class="single-post" <?php echo $content_portion;?>>

		<?php get_template_part( 'parts/content-none' );

	echo '</div>';
	}

	//Close single content markup
	echo '</div><!-- /.single-content -->';

	//Display sidebar
	if(is_active_sidebar('home_page_sidebar')) {
		echo '<aside class="sidebar"'.$content_portion.'>';
			dynamic_sidebar('home_page_sidebar');
		echo '</aside><!-- /.sidebar -->';
	}

	echo '</div><!-- /.wrapper -->
	</div><!-- /.main-content -->';
	get_footer(); 
?>
