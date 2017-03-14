<?php
	$item = get_post($attachment_id);
	$highlight = (bool) get_post_meta($item->ID, 'highlight', true);
	$attachment_link = get_post_meta($item->ID, 'attachment_link', true);

	$single_icon = true;

	if (!empty($attachment_link)) {
		$single_icon = false;
	}

	if ($params['type'] == 'grid') {
		$size = 'scalia-gallery-justified';
		if ($highlight) {
			$size = 'scalia-gallery-justified-double';
			if ($params['layout'] == '4x')
				$size = 'scalia-gallery-justified-double-4x';
		}
		if ($params['layout'] == '2x') {
			$size = 'scalia-gallery-justified-double';
		}
		if ($params['style'] == 'masonry')
			if ($highlight)
				$size = 'scalia-gallery-masonry-double';
			else
				$size = 'scalia-gallery-masonry';
		if ($params['style'] == 'metro')
			$size = 'scalia-gallery-metro';
	} else {
		$size = 'scalia-container';
		$thumb_image_url = wp_get_attachment_image_src($item->ID, 'scalia-post-thumb');
	}

	$small_image_url = scalia_generate_thumbnail_src($item->ID, $size);
	$full_image_url = wp_get_attachment_image_src($item->ID, 'full');

	$classes = array('gallery-item');

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '2x') {
	  $classes = array_merge($classes, array('col-lg-6', 'col-md-6', 'col-sm-6', 'col-xs-12'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '3x') {
		if ($highlight)
			$classes = array_merge($classes, array('col-lg-8', 'col-md-8', 'col-sm-12', 'col-xs-12'));
		else
			$classes = array_merge($classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '4x') {
		if ($highlight)
			$classes = array_merge($classes, array('col-lg-6', 'col-md-6', 'col-sm-8', 'col-xs-12'));
		else
			$classes = array_merge($classes, array('col-lg-3', 'col-md-3', 'col-sm-4', 'col-xs-6'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $highlight)
		$classes[] = 'double-item';
	$wrap_classes = $params['item_style'];
	if($params['item_style'] != 11 && $params['item_style'] != 12) {
		$wrap_classes .= ' rounded-corners';
	}
	if(in_array($params['item_style'], array(1, 5, 7))) {
		$wrap_classes .= ' shadow-box';
	}
?>
<li <?php post_class($classes); ?>>
	<div class="wrap <?php if($params['type'] == 'grid' && $params['item_style'] != ''): ?>sc-wrapbox-style-<?php echo esc_attr($wrap_classes); ?><?php endif; ?>">
		<?php if($params['type'] == 'grid' && $params['item_style'] == '7'): ?>
			<div class="sc-wrapbox-inner">
		<?php endif; ?>
		<?php if($params['type'] == 'grid' && $params['item_style'] == '12'): ?>
			<div class="sc-wrapbox-inner"><div class="shadow-wrap">
		<?php endif; ?>
		<div class="overlay-wrap">
			<div class="image-wrap <?php if($params['type'] == 'grid' && $params['item_style'] == '11'): ?>img-circle<?php endif; ?>">
				<img src="<?php echo esc_url($small_image_url[0]); ?>" <?php if($params['type'] == 'slider'): ?>data-thumb-url="<?php echo esc_url($thumb_image_url[0]); ?>"<?php endif; ?> <?php if($params['type'] == 'grid'): ?>width="<?php echo esc_attr($small_image_url[1]); ?>" height="<?php echo esc_attr($small_image_url[2]); ?>"<?php endif; ?> alt="">
			</div>
			<div class="overlay <?php if($params['type'] == 'grid' && $params['item_style'] == '11'): ?>img-circle<?php endif; ?>">
				<?php if($single_icon): ?>
					<a href="<?php echo esc_url($full_image_url[0]); ?>" class="gallery-item-link fancy-gallery" rel="gallery-<?php echo esc_attr($gallery_uid); ?>">
						<span class="slide-info">
							<?php if(!empty($item->post_excerpt)) : ?>
								<span class="slide-info-title">
									<?php echo $item->post_excerpt; ?>
								</span>
								<?php if(!empty($item->post_content)) : ?>
									<span class="slide-info-summary">
										<?php echo $item->post_content; ?>
									</span>
								<?php endif; ?>
							<?php endif; ?>
						</span>
					</a>
				<?php endif; ?>
				<div class="overlay-content">
					<div class="overlay-content-center">
						<div class="overlay-content-inner">
							<a href="<?php echo esc_url($full_image_url[0]); ?>" class="icon photo <?php if(!$single_icon): ?>fancy-gallery<?php endif; ?>" <?php if(!$single_icon): ?>rel="gallery-<?php echo esc_attr($gallery_uid); ?>"<?php endif; ?> >
								<?php if(!$single_icon): ?>
									<span class="slide-info">
										<?php if(!empty($item->post_excerpt)) : ?>
											<span class="slide-info-title">
												<?php echo $item->post_excerpt; ?>
											</span>
											<?php if(!empty($item->post_content)) : ?>
												<span class="slide-info-summary">
													<?php echo $item->post_content; ?>
												</span>
											<?php endif; ?>
										<?php endif; ?>
									</span>
								<?php endif; ?>
							</a>
							<?php if (!empty($attachment_link)): ?>
								<a href="<?php echo esc_url($attachment_link); ?>" target="_blank" class="icon link"></a>
							<?php endif; ?>

							<?php if(!empty($item->post_excerpt)) : ?>
								<div class="title">
									<?php echo $item->post_excerpt; ?>
								</div>
							<?php endif; ?>
							<?php if(!empty($item->post_content)) : ?>
								<div class="subtitle">
									<?php echo $item->post_content; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if($params['type'] == 'grid' && $params['item_style'] == '12'): ?>
			</div></div>
		<?php endif; ?>
		<?php if($params['type'] == 'grid' && $params['item_style'] == '7'): ?>
			</div>
		<?php endif; ?>
	</div>
</li>
