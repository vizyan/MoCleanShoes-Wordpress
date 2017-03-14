<?php

if(!is_active_sidebar('footer-widget-area')) {
	return;
}
?>

<div class="row inline-row footer-widget-area" role="complementary">
	<?php dynamic_sidebar('footer-widget-area'); ?>
</div><!-- .footer-widget-area -->
