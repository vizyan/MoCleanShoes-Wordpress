<?php
	$item_data = scalia_get_sanitize_client_data(get_the_ID());
	$item_data['link'] = $item_data['link'] ? $item_data['link'] : '#';

	$classes = array('sc-client-item');
	
	if (!empty($params['effects_enabled']))
		$classes[] = 'lazy-loading-item';
?>

<div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> style="width: <?php echo esc_attr(100/$cols); ?>%;" <?php if(!empty($params['effects_enabled'])): ?>data-ll-effect="drop-bottom"<?php endif; ?>>
	<a href="<?php echo esc_url($item_data['link']); ?>" target="<?php echo esc_attr($item_data['link_target']); ?>" class="grayscale grayscale-hover rounded-corners">
		<?php scalia_post_thumbnail('scalia-person', true, 'img-responsive'); ?>
	</a>
</div>