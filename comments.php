<?php
if ( post_password_required() )
	return;
?>
<div id="comments">

	<?php 

	if(get_comments_number() >= 1) {
		echo '<h2>'.sprintf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'blesk' ), number_format_i18n( get_comments_number() )) .'</h2>';
		
	}

	?>
	
	<ol class="comments-list">
		<?php
			
			//List comments
			wp_list_comments( array(
				'style'       => 'ol',
				'max_depth'   => '4',
				'avatar_size' => 0
			) );

			//List comments navigation
			the_comments_navigation();
		?>
	</ol><!-- / .comments-list -->
	<?php comment_form(); ?>
</div><!-- /#comments  -->