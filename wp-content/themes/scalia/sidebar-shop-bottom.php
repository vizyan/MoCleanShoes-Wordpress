<?php

if(!is_active_sidebar('shop-widget-area')) {
	return;
}
?>
<div id="shop-widget-area" class="row inline-row shop-widget-area" role="complementary">
		<?php dynamic_sidebar('shop-widget-area'); ?>
</div><!-- #shop-widget-area -->