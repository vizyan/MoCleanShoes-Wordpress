<?php

$classes = array('sc-news-item');

if ($params['effects_enabled'])
	$classes[] = 'lazy-loading-item';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> <?php if(!empty($params['effects_enabled'])): ?>data-ll-effect="drop-bottom"<?php endif; ?> >
	<div class="sc-news-item-left">
		<div class="sc-news-item-image">
			<a href="<?php echo esc_url(get_permalink()); ?>"><?php scalia_post_thumbnail('scalia-news-carousel'); ?></a>
		</div>
		<div class="sc-news-item-date"><?php echo get_the_date(); ?></div>
	</div>

	<div class="sc-news-item-right">
		<?php the_title('<div class="sc-news-item-title"><a href="'.esc_url(get_permalink()).'">', '</a></div>'); ?>
		<?php if(has_excerpt()) : ?>
			<?php the_excerpt(); ?>
		<?php else : ?>
			<?php
				$item_title_data = scalia_get_sanitize_page_title_data(get_the_ID());
				echo $item_title_data['title_excerpt'];
			?>
		<?php endif; ?>
	</div>
</article>