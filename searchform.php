<div id="blesk-search" class="search">
	<i class="open-search fa fa-search"></i>
	<i class="close-search fa fa-times"></i>
	<div class="search-input">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'blesk' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			<input type="submit" value="Search" />
			<i class="search-btn fa fa-search"></i>
		</form>
	</div><!-- /.search-input -->
</div><!-- /.search -->