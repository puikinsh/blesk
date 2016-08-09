<?php 
	get_header(); 

	//Wrapper markup
	echo '<div class="main-content">
		<div class="wrapper cf">';

	//Do the markup portion
	$content_portion = '';
	if(have_posts() or !is_active_sidebar('home_page_sidebar')) {
		$content_portion = ' style="width: 100%; float: none; padding-left: 0;"';
	}

	//Check if posts exists
	if ( have_posts() )  {

		//Echo posts wrapper
		echo '<div class="posts"'.$content_portion.'>';

		//Loop posts
		while ( have_posts() ) : the_post();

			get_template_part( 'parts/content' );

		endwhile;

		echo '</div><!-- /.posts -->';

	} else {
		echo '<div class="posts">';
			get_template_part( 'parts/content-none' );
		echo '</div><!-- /.posts -->';
	}

	//Display sidebar
	if(is_active_sidebar('home_page_sidebar')) {
		echo '<aside class="sidebar"'.$content_portion.'>';
			dynamic_sidebar('home_page_sidebar');
		echo '</aside><!-- /.sidebar -->';
	}

	echo '</div><!-- /.wrapper -->
	</div><!-- /.main-content -->';

	if(paginate_links()) {
		echo '<div class="other-articles">
			<div class="wrapper cf">
			<nav class="pagination">';

		//Navigation
		echo paginate_links(array(
				'prev_text' => '<i class="fa fa-angle-left"></i>',
				'next_text' => '<i class="fa fa-angle-right"></i>'
			));

		echo '</nav><!-- /.pagination -->
			</div><!-- /.wrapper -->
		</div><!-- /.other-articles -->';
	}

	get_footer(); 
?>
