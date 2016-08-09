<?php 
	get_header(); 


	//Wrapper markup
	echo '<div class="main-content">
		<div class="wrapper cf">';

	//Do the markup portion
	$content_portion = '';
	if(!have_posts() or !is_active_sidebar('home_page_sidebar')) {
		$content_portion = ' style="width: 100%; float: none; padding-left: 0;"';
	}

	//Check if posts exists
	if ( have_posts() )  {
		?>


			<div id="post-<?php the_ID(); ?>" <?php post_class('posts'); echo $content_portion;?>>
				
		<?php

		//Loop posts
		while ( have_posts() ) : the_post();

			//Page title
			echo '<h1 class="page-title">'.get_the_title().'</h1>';

			//Display content
			echo '<div class="entry-content markup-format">';
			the_content();
			echo '</div><!-- /.entry-content -->';

		endwhile;

		echo '</div><!-- /.posts -->';

	} else {
		get_template_part( 'parts/content-none' );
	}

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
