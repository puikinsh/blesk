<?php

//Get banner
$banner = get_theme_mod('blesk_gome_central_ad');

echo '<section id="home_wide_ad">';

//If banner exists, echo the banner section
if($banner) {
	echo '<div class="central-ad"><div class="ads-panel">'.$banner.'</div><!-- /.ads-panel --></div><!-- /.central-ad -->';
}

echo '</section><!-- /#home_wide_ad  -->';