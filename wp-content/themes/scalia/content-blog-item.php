<?php

	$blog_style = isset($blog_style) ? $blog_style : 'default';

	$post_data = scalia_get_sanitize_page_title_data(get_the_ID());

	$post_item_data = scalia_get_sanitize_post_data(get_the_ID());

	if(empty($post_item_data)) {
		$post_item_data = array(
			'media_type' => 'default',
			'link' => '',
			'show_featured_image' => 0
		);
	}

	$categories = get_the_category();

	$classes = array();

	if($blog_style == 'default') {
		$classes[] = 'rounded-corners';
		if(is_sticky() && !is_paged()) {
			$classes = array_merge($classes, array('sticky', 'bordered-box', 'shadow-box'));
		} else {
			$classes[] = 'default-background';
		}
	}

	$link = '';
	if ($post_item_data['media_type'] == 'youtube') {
		$link = '//www.youtube.com/embed/'.$post_item_data['link'].'?autoplay=1';
	} elseif($post_item_data['media_type'] == 'vimeo') {
		$link = '//player.vimeo.com/video/'.$post_item_data['link'].'?autoplay=1';
	}
	if(!$link) {
		$link = get_permalink();
	}

	if (!has_post_thumbnail())
		$classes[] = 'no-image';
?>

<?php if($blog_style == '3x' || $blog_style == '4x' || $blog_style == '100%'): ?>

	<?php

		if (is_sticky())
			$classes[] = 'sticky';

		if ($blog_style == '3x') {
			if (is_sticky())
				$classes = array_merge($classes, array('col-lg-8', 'col-md-8', 'col-sm-6', 'col-xs-12'));
			else
				$classes = array_merge($classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6'));
		}

		if ($blog_style == '4x' || $blog_style == '100%') {
			if (is_sticky())
				$classes = array_merge($classes, array('col-lg-6', 'col-md-6', 'col-sm-8', 'col-xs-12'));
			else
				$classes = array_merge($classes, array('col-lg-3', 'col-md-3', 'col-sm-4', 'col-xs-6'));
		}
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
		<a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr($post_item_data['media_type']); ?>">
			<?php scalia_post_thumbnail((is_sticky() && !is_paged()) ? 'large' : 'medium', false, 'img-responsive'); ?>
		</a>
		<div class="description">
			<?php the_title('<div class="title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>'); ?>
			<?php if($categories): ?>
				<div class="tags">
					<?php foreach ($categories as $key => $category): ?>
						<?php if($key): ?><span class="sep">|</span><?php endif; ?>
						<a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s", "scalia" ), $category->name ) ); ?>"><?php echo $category->cat_name; ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif ?>
			<div class="summary">
				<?php if ( !empty( $post_data['title_excerpt'] ) ): ?>
					<?php echo $post_data['title_excerpt']; ?>
				<?php else: ?>
					<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
				<?php endif; ?>
			</div>
			<div class="info clearfix">
				<span class="date"><?php echo get_the_date(''); ?></span>
				<?php if(comments_open() && $comments_count = get_comments_number()): ?>
					<span class="sep">|</span>
					<span class="comments"><?php echo $comments_count; ?></span>
				<?php endif; ?>
				<span class="more-link <?php if($blog_style == '4x' && $comments_count > 0 && comments_open()) echo 'more-link-left'; ?>"><a href="<?php echo get_permalink(); ?>"><?php _e('Read more', 'scalia'); ?></a></span>
			</div>
		</div>
	</article>
<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
		<?php
			if(!is_single() && is_sticky() && $blog_style == 'default' && !is_paged()) {
				echo '<div class="sticky-label">'.__('Sticky', 'scalia').'</div>';
			}
		?>
		<div class="item-post-container">
			<div class="item-post clearfix">

				<?php
					if(!is_single() && is_sticky() && $blog_style == 'default' && !is_paged()) :
						the_title('<div class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>');
					endif;
				?>

				<div class="post-image">

					<?php
						$default_image = '<img src="' . get_template_directory_uri() .'/images/news-timeline-default.png" width="72" height="72" alt="" />';
						if ($blog_style == 'timeline' || $blog_style == 'styled_list1') {
							if (has_post_thumbnail()) {
								echo '<a href='.get_permalink().'>';
								scalia_post_thumbnail('scalia-post-thumb', false, '');
								echo '</a>';
							} else {
								echo $default_image;
							}
						} else if ($blog_style == 'styled_list2') {
							if (has_post_thumbnail()) {
								echo  '<a href='.get_permalink().'>';
								scalia_post_thumbnail('scalia-post-thumb', false, '');
								echo '</a>';
							} else {
								echo $default_image;
							}
						} else {
							?>
								<a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr($post_item_data['media_type']); ?>"><?php scalia_post_thumbnail('scalia-blog-default', true, 'img-responsive'); ?></a>
							<?php
						}
					?>

					<?php
					if ($blog_style == 'timeline' || $blog_style == 'styled_list1' || $blog_style == 'styled_list2') {
						echo '<div class="post-date-wrapper"><div class="post-date">';
								scalia_posted_on();
								echo '<span class="post-time"><span>';
									the_time('H:i');
								echo '</span></span>';
						echo '</div></div>';
					}
					?>

				</div>
				<div class="post-text">
					<header class="entry-header">

						<?php
							/*if (is_single()) :
								the_title('<h4 class="entry-title">', '</h4>');
							else*/ if(!is_sticky() || $blog_style != 'default' || is_paged()) :
								the_title('<div class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>');
							endif;
						?>

						<div class="entry-meta">
							<?php if($categories): ?>
								<?php if ($blog_style != 'timeline' && $blog_style != 'styled_list1' && $blog_style != 'styled_list2'): ?><?php endif; ?><span class="tag-links">
									<?php foreach ($categories as $key => $category): ?>
										<?php if($key): ?><span class="sep">|</span><?php endif; ?>
										<a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s", "scalia" ), $category->name ) ); ?>"><?php echo $category->cat_name; ?></a>
									<?php endforeach; ?>
								</span>
							<?php endif ?>
						</div>
						<!-- .entry-meta -->
					</header>
					<!-- .entry-header -->

					<?php if (is_search()) : ?>
						<div class="entry-summary">
					<?php else: ?>
						<div class="entry-content">
					<?php endif; ?>
						<?php if ( !empty( $post_data['title_excerpt'] ) ): ?>
							<?php echo $post_data['title_excerpt']; ?>
						<?php else: ?>
							<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
						<?php endif; ?>
					</div>

					<div class="clearfix entry-info">
						<?php if ($blog_style == 'timeline' || $blog_style == 'styled_list1' || $blog_style == 'styled_list2'): ?>
							<div class="styled-blog-meta">
							<?php if(comments_open() && $comments_count = get_comments_number()): ?>
								<span class="comments"><?php echo $comments_count; ?></span>
							<?php endif; ?>
						<?php else: ?>
							<?php
								if ($blog_style != 'timeline' && $blog_style != 'styled_list1' && $blog_style != 'styled_list2') {
									if ('post' == get_post_type())
										scalia_posted_on();
								}
							?>
							<?php if(comments_open() && $comments_count = get_comments_number()): ?>
								<span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'scalia'), __('1 Comment', 'scalia'), __('% Comments', 'scalia'), 'rounded-corners'); ?>	</span>
							<?php endif; ?>
						<?php endif; ?>
						<span class="read-more-link"><a href="<?php echo get_permalink(); ?>"> <?php _e('Read more', 'scalia'); ?></a></span>
						<?php if ($blog_style == 'timeline' || $blog_style == 'styled_list1' || $blog_style == 'styled_list2'): ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
<?php endif; ?>