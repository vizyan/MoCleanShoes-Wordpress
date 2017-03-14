<?php
	$item_data = scalia_get_sanitize_qf_item_data(get_the_ID());
	$icon_shortcode = scalia_build_icon_shortcode(array(
		'icon' => $item_data['icon'],
		'icon_shape' => $item_data['icon_shape'],
		'icon_style' => $item_data['icon_style'],
		'icon_color' => $item_data['icon_color'],
		'icon_color_2' => $item_data['icon_color_2'],
		'icon_background_color' => $item_data['icon_background_color'],
		'icon_border_color' => $item_data['icon_border_color'],
		'icon_size' => $item_data['icon_size'],
		'icon_link' => $item_data['link'],
		'icon_link_target' => $item_data['link_target']
	));
	$quickfinder_effect = 'quickfinder-item-effect-';
	if($item_data['icon_background_color']) {
		$quickfinder_effect .= 'background-reverse';
	} elseif($item_data['icon_border_color']) {
		$quickfinder_effect .= 'border-reverse';
	} else {
		$quickfinder_effect .= 'scale';
	}
	$link_start = '<span class="quickfinder-item-link ' . ($item_data['icon_shape'] == 'circle' ? 'img-circle' : 'rounded-corners') .'">';
	$link_end = '</span>';
	if($link = scalia_get_data($item_data, 'link')) {
		$link_start = '<a href="'.esc_url($link).'" class="quickfinder-item-link ' . ($item_data['icon_shape'] == 'circle' ? 'img-circle' : 'rounded-corners') .'" target="'.esc_attr(scalia_get_data($item_data, 'link_target')).'">';
		$link_end = '</a>';
	}
?>

<div id="post-<?php the_ID(); ?>" <?php if($params['effects_enabled']) echo ' data-ll-finish-delay="200" '; ?> <?php post_class(array('quickfinder-item', $quickfinder_style == 'vertical' ? $quickfinder_item_rotation : 'col-md-3 col-sm-4 col-xs-6 inline-column', $quickfinder_effect, $params['effects_enabled'] ? 'lazy-loading' : '')); ?>>
	<?php if($quickfinder_style == 'vertical' && $quickfinder_item_rotation == 'odd') : ?>
		<div class="quickfinder-item-info <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="200" data-ll-effect="fading"<?php endif; ?>>
			<?php the_title('<div class="quickfinder-item-title">'.$link_start, $link_end.'</div>'); ?>
			<?php echo scalia_get_data($item_data, 'description', '', '<div class="quickfinder-item-text">'.$link_start, $link_end.'</div>'); ?>
		</div>
	<?php endif; ?>
	<div class="quickfinder-item-image">
		<div class="quickfinder-item-image-content <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="0" data-ll-effect="clip"<?php endif; ?>>
			<?php if($quickfinder_style == 'vertical') : ?>
				<div class="quickfinder-item-connector" style="border-color: <?php echo esc_attr($connector_color); ?>;">
					<svg width="8px" height="100%"><line x1="4" x2="4" y1="8" y2="100%" stroke="<?php echo esc_attr($connector_color); ?>" stroke-width="7" stroke-linecap="round" stroke-dasharray="1, 13"/></svg>
				</div>
			<?php endif; ?>
			<?php if($item_data['icon']) : ?>
				<?php echo do_shortcode($icon_shortcode); ?>
			<?php else : ?>
				<?php echo $link_start; ?><?php scalia_post_thumbnail('scalia-person', true, ' quickfinder-img-size-'.$item_data['icon_size']); ?><?php echo $link_end; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php if($quickfinder_style != 'vertical' || $quickfinder_item_rotation == 'even') : ?>
		<div class="quickfinder-item-info <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="200" data-ll-effect="fading"<?php endif; ?>>
			<?php the_title('<div class="quickfinder-item-title">'.$link_start, $link_end.'</div>'); ?>
			<?php echo scalia_get_data($item_data, 'description', '', '<div class="quickfinder-item-text">'.$link_start, $link_end.'</div>'); ?>
		</div>
	<?php endif; ?>
</div>
