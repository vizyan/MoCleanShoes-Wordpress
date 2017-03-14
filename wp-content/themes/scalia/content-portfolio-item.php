<?php

$classes = array('portfolio-item');
$classes = array_merge($classes, $slugs);

$image_classes = array('image');
$caption_classes = array('caption');

$portfolio_item_data = get_post_meta($post->ID, 'scalia_portfolio_item_data', 1);

if (empty($portfolio_item_data['types']))
	$portfolio_item_data['types'] = array();

if ($params['layout'] == '1x') {
	$classes = array_merge($classes, array('col-lg-12', 'col-md-12', 'col-sm-12', 'col-xs-12'));
	$image_classes = array_merge($image_classes, array('col-lg-5', 'col-md-5', 'col-sm-5 col-xs-12'));
	$caption_classes = array_merge($caption_classes, array('col-lg-7', 'col-md-7', 'col-sm-7 col-xs-12'));
}

if ($params['layout'] == '2x') {
	if (isset($portfolio_item_data['highlight']) && $portfolio_item_data['highlight'] && empty($params['is_slider']))
		$classes = array_merge($classes, array('col-lg-12', 'col-md-12', 'col-sm-12', 'col-xs-12'));
	else
		$classes = array_merge($classes, array('col-lg-6', 'col-md-6', 'col-sm-6', 'col-xs-12'));
}

if ($params['layout'] == '3x') {
	if (isset($portfolio_item_data['highlight']) && $portfolio_item_data['highlight'] && empty($params['is_slider']))
		$classes = array_merge($classes, array('col-lg-8', 'col-md-8', 'col-sm-12', 'col-xs-12'));
	else
		$classes = array_merge($classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6'));
}

if ($params['layout'] == '4x') {
	if (isset($portfolio_item_data['highlight']) && $portfolio_item_data['highlight'] && empty($params['is_slider']))
		$classes = array_merge($classes, array('col-lg-6', 'col-md-6', 'col-sm-8', 'col-xs-12'));
	else
		$classes = array_merge($classes, array('col-lg-3', 'col-md-3', 'col-sm-4', 'col-xs-6'));
}

if (isset($portfolio_item_data['highlight']) && $portfolio_item_data['highlight'] && empty($params['is_slider']))
	$classes[] = 'double-item';

$size = 'scalia-portfolio-justified';
if ($params['layout'] != '1x') {
	if ($params['style'] == 'masonry') {
		$size = 'scalia-portfolio-masonry';
		if (isset($portfolio_item_data['highlight']) && $portfolio_item_data['highlight'] && empty($params['is_slider']))
			$size = 'scalia-portfolio-masonry-double';
	} else {
		if (isset($portfolio_item_data['highlight']) && $portfolio_item_data['highlight'] && empty($params['is_slider'])) {
			$size = 'scalia-portfolio-double-' . $params['layout'];

			if ($params['display_titles'] == 'hover')
				$size .= '-hover';

			if ($params['no_gaps'])
				$size .= '-no-gaps';
		}
	}
} else {
	$size = 'scalia-portfolio-1x';
}

if ($params['effects_enabled'])
	$classes[] = 'lazy-loading-item';

$small_image_url = scalia_generate_thumbnail_src(get_post_thumbnail_id(), $size);
$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$has_self_video = false;

?>

<div <?php post_class($classes); ?> <?php if($params['effects_enabled']): ?>data-ll-effect="fading"<?php endif; ?>>
	<div class="wrap clearfix">
		<div <?php post_class($image_classes); ?>>
			<div class="image-inner">
				<img src="<?php echo esc_attr($small_image_url[0]); ?>" width="<?php echo esc_attr($small_image_url[1]); ?>" height="<?php echo esc_attr($small_image_url[2]); ?>" alt="<?php the_title(); ?>" />
			</div>
			<?php if (!$params['disable_socials']): ?>
				<span class="button"><span class="button-corner"><span></span><b></b></span></span>
				<div class="share">
					<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>">&#xe601;</a>
					<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo urlencode(get_permalink($post->ID)); ?>">&#xe603;</a>
					<a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink($post->ID)); ?>">&#xe602;</a>
					<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php echo urlencode($large_image_url[0]); ?>&description=<?php echo urlencode(get_the_title()); ?>">&#xe605;</a>
					<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>">&#xe604;</a>
					<a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>">&#xe606;</a>
				</div>
			<?php endif; ?>
			<div class="overlay">
				<?php if (count($portfolio_item_data['types']) == 1): ?>
					<?php
						$ptype = reset($portfolio_item_data['types']);
						if($ptype['type'] == 'full-image') {
							$link = $large_image_url[0];
						} elseif($ptype['type'] == 'self-link') {
							$link = get_permalink($post->ID);
						} elseif($ptype['type'] == 'youtube') {
							$link = '//www.youtube.com/embed/'.$ptype['link'].'?autoplay=1';
						} elseif($ptype['type'] == 'vimeo') {
							$link = '//player.vimeo.com/video/'.$ptype['link'].'?autoplay=1';
						} else {
							$link = $ptype['link'];
						}
						if(!$link) {
							$link = '#';
						}
						if($ptype['type'] == 'self_video')
							$has_self_video = true;

					?>
					<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($ptype['link_target']); ?>" class="portolio-item-link <?php echo esc_attr($ptype['type']); ?> <?php if($ptype['type'] == 'full-image') echo 'fancy'; ?>"></a>
				<?php endif; ?>
				<div class="links-wrapper">
					<div class="links">
						<?php foreach($portfolio_item_data['types'] as $ptype): ?>
							<?php
								if($ptype['type'] == 'full-image') {
									$link = $large_image_url[0];
								} elseif($ptype['type'] == 'self-link') {
									$link = get_permalink($post->ID);
								} elseif($ptype['type'] == 'youtube') {
									$link = '//www.youtube.com/embed/'.$ptype['link'].'?autoplay=1';
								} elseif($ptype['type'] == 'vimeo') {
									$link = '//player.vimeo.com/video/'.$ptype['link'].'?autoplay=1';
								} else {
									$link = $ptype['link'];
								}
								if(!$link) {
									$link = '#';
								}
								if($ptype['type'] == 'self_video')
									$has_self_video = true;
							?>
							<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($ptype['link_target']); ?>" class="icon <?php echo esc_attr($ptype['type']); ?> <?php if($ptype['type'] == 'full-image' && count($portfolio_item_data['types']) > 1) echo 'fancy'; ?>"></a>
						<?php endforeach; ?>
						<div class="overlay-line"></div>
						<?php if($params['display_titles'] == 'hover' && $params['layout'] != '1x'): ?>
							<div class="caption">
								<div class="title">
									<?php if(!empty($portfolio_item_data['overview_title'])) : ?>
										<?php echo $portfolio_item_data['overview_title']; ?>
									<?php else : ?>
										<?php the_title(); ?>
									<?php endif; ?>
								</div>
								<div class="description">
									<?php if(has_excerpt()) : ?><div class="subtitle"><?php the_excerpt(); ?></div><?php endif; ?>
									<?php if($params['show_info']): ?>
										<div class="info">
											<?php if($params['layout'] == '1x'): ?>
												<?php echo apply_filters('get_the_date', mysql2date('j F, Y', $post->post_date), 'j F, Y'); ?>&nbsp;
												<?php
													foreach ($slugs as $k => $slug)
														if (isset($terms_set[$slug]))
															echo '<span class="separator">|</span><a data-slug="'.$terms_set[$slug]->slug.'">'.$terms_set[$slug]->name.'</a>';
												?>
											<?php else: ?>
												<?php echo apply_filters('get_the_date', mysql2date('j F, Y', $post->post_date), 'j F, Y'); ?> <?php if(count($slugs) > 0): ?>in<?php endif; ?>&nbsp;
												<?php
													$index = 0;
													foreach ($slugs as $k => $slug)
														if (isset($terms_set[$slug])) {
															echo ($index > 0 ? '<span class="sep">,</span> ': '').'<a data-slug="'.$terms_set[$slug]->slug.'">'.$terms_set[$slug]->name.'</a>';
															$index++;
														}
												?>
											<?php endif; ?>
										</div>
									<?php endif ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php if($has_self_video) : ?>
				<div class="videoblock" style="display: none;"><?php echo scalia_selfvideoerror(); ?></div>
			<?php endif; ?>
		</div>
		<?php if($params['display_titles'] == 'page' || $params['layout'] == '1x'): ?>
			<div <?php post_class($caption_classes); ?>>
				<div class="title">
					<?php if(!empty($portfolio_item_data['overview_title'])) : ?>
						<?php echo $portfolio_item_data['overview_title']; ?>
					<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</div>
				<?php if(has_excerpt() && $params['layout'] != '1x') : ?><div class="subtitle"><?php the_excerpt(); ?></div><?php endif; ?>
				<?php if($params['show_info']): ?>
					<div class="info">
						<?php if($params['layout'] == '1x'): ?>
							<?php echo apply_filters('get_the_date', mysql2date('j F, Y', $post->post_date), 'j F, Y'); ?>&nbsp;
							<?php
								foreach ($slugs as $k => $slug)
									if (isset($terms_set[$slug]))
										echo '<span class="separator">|</span><a data-slug="'.$terms_set[$slug]->slug.'">'.$terms_set[$slug]->name.'</a>';
							?>
						<?php else: ?>
							<?php echo apply_filters('get_the_date', mysql2date('j F, Y', $post->post_date), 'j F, Y'); ?> <?php if(count($slugs) > 0): ?>in<?php endif; ?>&nbsp;
							<?php
								$index = 0;
								foreach ($slugs as $k => $slug)
									if (isset($terms_set[$slug])) {
										echo ($index > 0 ? '<span class="sep">,</span> ': '').'<a data-slug="'.$terms_set[$slug]->slug.'">'.$terms_set[$slug]->name.'</a>';
										$index++;
									}
							?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if(has_excerpt() && $params['layout'] == '1x') : ?><div class="subtitle"><?php the_excerpt(); ?></div><?php endif; ?>
				<?php if($params['layout'] == '1x') : ?>
					<div class="clearfix entry-info col-lg-7 col-md-7 col-sm-7 col-xs-12">
						<?php if(comments_open() && $comments_count = get_comments_number()): ?>
							<span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'scalia'), __('1 Comment', 'scalia'), __('% Comments', 'scalia')); ?>	</span>
						<?php endif; ?>
						<span class="read-more-link"><a href="<?php echo get_permalink(); ?>"> <?php _e('Read more', 'scalia'); ?></a></span>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
