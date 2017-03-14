<?php
	$item_data = scalia_get_sanitize_testimonial_data(get_the_ID());
	$position = array();
	if($item_data['position']) {
		$position[] = $item_data['position'];
	}
	if($item_data['company']) {
		$position[] = $item_data['company'];
	}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('sc-testimonial-item'); ?>>
	<div class="sc-testimonial-image">
		<?php scalia_post_thumbnail('scalia-testimonial'); ?>
	</div>
	<blockquote class="sc-testimonial-text">
		<?php the_content(); ?>
	</blockquote>
	<?php echo scalia_get_data($item_data, 'name', '', '<div class="sc-testimonial-name">', '</div>'); ?>
	<?php if(count($position)) : ?><div class="sc-testimonial-position"><?php echo implode(', ', $position); ?></div><?php endif; ?>
</div>