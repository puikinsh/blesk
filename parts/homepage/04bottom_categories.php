<?php

if(is_active_sidebar('home_page_bottom_categories')) {
	echo '
	<div class="other-articles">
		<div class="wrapper cf">
			<div class="cols cf">';

			dynamic_sidebar('home_page_bottom_categories');

	echo '</div><!-- /.cols-->
		</div><!-- /.wrapper -->
	</div><!-- /.other-articles -->';
}

?>