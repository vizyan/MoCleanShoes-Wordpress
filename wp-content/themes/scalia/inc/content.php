<?php

function scalia_home_content_builder() {
	$home_content = scalia_get_option('home_content') ? json_decode(stripslashes(scalia_get_option('home_content')), TRUE) : array();
	$block_number = 1;
	if(count($home_content)) {
		foreach($home_content as $block) {
			$block_function = 'scalia_'.$block['block_type'].'_block';
			if(function_exists($block_function)) {
				echo '<section id="'.esc_attr(!empty($block['block_id']) ? $block['block_id'] : 'home-content-block-'.$block_number).'" class="home-content-block block-'.esc_attr($block['block_type']).'">';
				$block_function($block);
				echo '</section>';
				$block_number++;
			}
		}
	} else {
?>
	<div class="block-content">
		<div class="container">
			<h1 class="page-title"><?php _e('Scalia Theme', 'scalia') ?></h1>
			<div class="inner">
				<p><?php printf(__('Log in to <a href="%s">wordpress</a> admin and set up your starting page using <a href="%s">Home Constructor</a>.', 'scalia'), admin_url(), admin_url('themes.php?page=options-framework#home_constructor')); ?></p>
				<p><?php _e('Please refer to Scalia documentation <b>(Getting Started &mdash; Setting Up Homepage)</b> in order to learn how to use Home Constructor.', 'scalia'); ?></p>
				<p><?php _e('Additionally you can use demo content included in Scalia to quickly setup a demo of your starting page.', 'scalia'); ?></p>
			</div>
		</div>
	</div>
<?php
	}
}


function scalia_content_block($params = array()) {
	$content_block_query = new WP_Query('page_id=' . $params['page']);
	if($content_block_query->have_posts()) {
		while ($content_block_query->have_posts()) {
			$content_block_query->the_post();
			get_template_part('content', 'page-content-block');
		}
	}
	wp_reset_postdata();
}

function scalia_pw_filter_widgets($sidebars_widgets) {
	if(!scalia_is_plugin_active('wp-page-widget/wp-page-widgets.php')) {
		return $sidebars_widgets;
	}
	global $post, $pagenow;
	$objTaxonomy = getTaxonomyAccess();
	if(
			(is_admin()
			&& !in_array($pagenow, array('post-new.php', 'post.php', 'edit-tags.php'))
			&& (!in_array($pagenow, array('admin.php')) && (isset($_GET['page']) && ($_GET['page'] == 'pw-front-page') || isset($_GET['page']) && $_GET['page'] == 'pw-search-page'))
			)
			|| (!is_admin() && !is_singular() && !is_search() && empty($objTaxonomy['taxonomy']) && !(is_home() && is_object($post) && $post->post_type == 'page'))
	) {

		return $sidebars_widgets;
	}


	// Search page
	if(is_search() || (is_admin() && (isset($_GET['page']) && $_GET['page'] == 'pw-search-page'))) {
		$enable_customize = get_option('_pw_search_page', true);
		$_sidebars_widgets = get_option('_search_page_sidebars_widgets', true);
	}


	// Post page
	elseif(empty($objTaxonomy['taxonomy'])) {
		//if admin alway use query string post = ID
		//Fix conflic when other plugins use query post after load editing post!

		if(is_object($post) && isset($_GET['post'])) {
			$postID = $_GET['post'];
		}
		if(is_admin() && isset($postID)) {
			if(!is_object($post)) $post = new stdClass();
				$post->ID = $postID;
		}
		if(isset($post->ID)) {
		$enable_customize = get_post_meta($post->ID, '_customize_sidebars', true);
		$_sidebars_widgets = get_post_meta($post->ID, '_sidebars_widgets', true); }
	}

	// Taxonomy page
	else {

		$taxonomyMetaData = getTaxonomyMetaData($objTaxonomy['taxonomy'], $objTaxonomy['term_id']);
		$enable_customize = $taxonomyMetaData['_customize_sidebars'];
		$_sidebars_widgets = $taxonomyMetaData['_sidebars_widgets'];
	}

	if(isset($enable_customize) && $enable_customize == 'yes' && !empty($_sidebars_widgets)) {
		if(is_array($_sidebars_widgets) && isset($_sidebars_widgets['array_version']))
			unset($_sidebars_widgets['array_version']);

		$sidebars_widgets = wp_parse_args($_sidebars_widgets, $sidebars_widgets);
	}
	global $wp_registered_widgets;
	foreach($sidebars_widgets as $sid => $sidebar) {
		if(is_array($sidebar)) {
			foreach($sidebar as $wid => $widget) {
				if(!isset($wp_registered_widgets[$widget])) {
					unset($sidebars_widgets[$sid][$wid]);
				}
			}
		}
	}
	return $sidebars_widgets;
}
add_filter('sidebars_widgets', 'scalia_pw_filter_widgets');

function scalia_contacts($top_area = false) {
	$output = '';
	if(scalia_get_option('contacts_address')) {
		$output .= '<div class="sc-contacts-item sc-contacts-address">'.esc_html(stripslashes(scalia_get_option('contacts_address'))).'</div>';
	}
	if(scalia_get_option('contacts_phone')) {
		$output .= '<div class="sc-contacts-item sc-contacts-phone">'.(!$top_area ? __('Phone:', 'scalia') : '').' '.esc_html(stripslashes(scalia_get_option('contacts_phone'))).'</div>';
	}
	if(scalia_get_option('contacts_fax')) {
		$output .= '<div class="sc-contacts-item sc-contacts-fax">'.(!$top_area ? __('Fax:', 'scalia') : '').' '.esc_html(stripslashes(scalia_get_option('contacts_fax'))).'</div>';
	}
	if(scalia_get_option('contacts_email')) {
		$output .= '<div class="sc-contacts-item sc-contacts-email">'.(!$top_area ? __('Email:', 'scalia') : '').' '.'<a href="mailto:'.sanitize_email(scalia_get_option('contacts_email')).'">'.sanitize_email(scalia_get_option('contacts_email')).'</a></div>';
	}
	if(scalia_get_option('contacts_website') && !$top_area) {
		$output .= '<div class="sc-contacts-item sc-contacts-website">'.(!$top_area ? __('Website:', 'scalia') : '').' '.'<a href="'.esc_url(scalia_get_option('contacts_website')).'">'.esc_html(scalia_get_option('contacts_website')).'</a></div>';
	}
	if($output) {
		return '<div class="sc-contacts">'.$output.'</div>';
	}
	return ;
}

function scalia_related_posts() {
	$post_tags = wp_get_post_tags(get_the_ID());
	$post_tags_ids = array();
	foreach($post_tags as $individual_tag) {
		$post_tags_ids[] = $individual_tag->term_id;
	}
	if($post_tags_ids) {
		$args=array(
			'tag__in' => $post_tags_ids,
			'post__not_in' => array(get_the_ID()),
			'posts_per_page'=>3,
			'orderby' => 'rand'
		);
		$related_query = new WP_Query($args);
		if($related_query->have_posts()) {
?>
	<div class="post-related-posts ">
		<h3><?php _e('Related Posts', 'scalia'); ?></h3>
		<div class="post-related-posts-block bordered-box rounded-corners shadow-box">
			<div class="row">

			<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
				<div class="related-element col-md-4 col-xs-6">
					<a href="<?php echo get_permalink(); ?>"><?php scalia_post_thumbnail('scalia-post-thumb', true, ''); ?></a>
					<div class="related-element-info">
						<?php the_title('<a href="'.get_permalink().'">', '</a>'); ?>
						<div class="date"><?php echo get_the_date(); ?></div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata() ?>

			</div>
		</div>
	</div>
<?php
		}
	}
}

function scalia_comment($comment, $args, $depth) {
		if('div' == $args['style']) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
		<?php if('div' != $args['style']) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-inner" style="padding-left: <?php echo ($depth-1)*70?>px;">
			<div class="comment-header clearfix">
				<div class="comment-author vcard">
					<?php if(0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
					<?php printf(__('<span class="fn">%s</span>'), get_comment_author_link()); ?>
					<span class="comment-meta commentmetadata"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID, $args)); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf(__('%1$s at %2$s', 'scalia'), get_comment_date(),  get_comment_time()); ?></a><?php edit_comment_link(__('(Edit)', 'scalia'), '&nbsp;&nbsp;', '');
						?>
					</span>
				</div>
				<div class="reply">
					<?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
			</div>
			<?php if('0' == $comment->comment_approved) : ?>
			<div class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'scalia') ?></div>
			<?php endif; ?>

			<div class="comment-text"><?php comment_text(get_comment_id(), array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></div>

			<?php if('div' != $args['style']) : ?>
			</div>
			<?php endif; ?>
		</div>
<?php
		if(shortcode_exists('sc_divider')) { echo do_shortcode('[sc_divider style="1" color="'.esc_attr(scalia_get_option('divider_default_color') ? scalia_get_option('divider_default_color') : '').'"]'); }
	}

function scalia_toparea_search_form() {
?>
<form role="search" method="get" id="top-area-searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<div>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="top-area-s" />
		<button type="submit" id="top-area-searchsubmit" value="<?php echo esc_attr_x('Search', 'submit button', 'scalia'); ?>"></button>
	</div>
</form>
<?php
}

function scalia_author_info($post_id, $full = FALSE) {
	$post = get_post($post_id);
	$user_id = $post->post_author;
	$user_data = get_userdata( $user_id );
	$show = TRUE;
	if(!scalia_get_option('show_author')) {
		$show = FALSE;
	}
	?>
	<?php if ($full): ?>
		<?php if ($show): ?>
			<div class="post-author-block rounded-corners clearfix">
				<div class="post-author-avatar"><?php echo get_avatar( $user_id, 72 ); ?></div>
				<div class="post-author-info">
					<div class="name styled-subtitle"><?php echo $user_data->data->display_name; ?></div>

					<div class="date-info">
						<span class="date"><?php echo get_the_date('', $post->ID); ?> <?php _e('in', 'scalia') ?></span>
						<?php
						$cats = get_the_category( $post_id );
						$cats_echo = array();
						if($cats) {
							foreach($cats as $cat) {
								$cats_echo[] = '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'scalia' ), $cat->name ) ) . '">'.$cat->cat_name.'</a>';
							}
						}
						?>
						<?php if(count($cats_echo)) : ?>
							<span class="categories"> <?php echo implode(', ', $cats_echo) ?></span>
						<?php endif; ?>
						<div class="description"><?php echo $user_data->description; ?></div>

					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="post-info-bottom clearfix">
			<?php
			$cats = get_the_category( $post_id );
			$cats_echo = array();
			if($cats) {
				foreach($cats as $cat) {
					$cats_echo[] = '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'scalia' ), $cat->name ) ) . '">'.$cat->cat_name.'</a>';
				}
			}
			?>
			<?php if(count($cats_echo)) : ?>
				<div class="categories"><?php echo implode('<span class="sep">|</span>', $cats_echo) ?></div>
			<?php endif; ?>
			<div class="comments-count">
				<?php if($comments = wp_count_comments(get_the_ID())) : ?>
					<span class="comment-count"><?php printf( __( '<b>%d</b> comments', 'scalia' ), $comments->approved ); ?></span>
				<?php endif;?>
				<a href="<?php echo get_permalink($post->ID); ?>" class="more-link"><b>&nbsp;</b><?php _e('Read more', 'scalia'); ?></a>
			</div>
		</div>
	<?php endif; ?>
<?php
}

function scalia_socials_sharing() {
	if(scalia_get_option('show_social_icons')) {
		global $post;
		?>
		<div class="socials-sharing socials">
			<ul class="styled">
				<li class="twitter"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo urlencode(get_permalink($post->ID)); ?>" title="Twitter">Twitter</a></li>
				<li class="facebook"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>" title="Facebook">Facebook</a></li>
				<li class="googleplus"><a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink($post->ID)); ?>" title="Google Plus">Google Plus</a></li>
				<li class="linkedin"><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>" title="LinkedIn">LinkedIn</a></li>
				<li class="stumbleupon"><a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" title="StumbleUpon">StumbleUpon</a></li>
			</ul>
		</div>
		<?php
	}
}

function scalia_post_tags() {
	$post_tags = wp_get_post_tags(get_the_ID());
	$post_tags_ids = array();
	foreach($post_tags as $individual_tag) {
		$post_tags_ids[] = $individual_tag->term_id;
	}
	if ($post_tags_ids) {
		$args=array(
			'tag__in' => $post_tags_ids,
			'post__not_in' => array(get_the_ID()),
			'posts_per_page'=>3,
			'orderby' => 'rand'
		);
		$related_query = new WP_Query( $args );
	}

	echo '<div class="block-tags">';
	echo '<div class="block-date">';
	echo get_the_date();
	echo '</div>';

	if ($post_tags_ids) {
		echo '<span class="sep">|</span>';
	}
	$tag_list = get_the_tag_list( '', __( '<span class="sep">|</span>', 'scalia' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}
	echo '</div>';
}

function scalia_blog($params = array()) {
	$params = array_merge(array(
		'blog_style' => 'default',
		'blog_post_per_page' => '',
		'blog_categories' => '',
		'blog_post_types' => '',
		'blog_pagination' => '',
		'blog_ignore_sticky' => 0,
		'is_ajax' => false,
		'paged' => -1,
		'effects_enabled' => false
	), $params);

	$params['blog_pagination'] = scalia_check_array_value(array('normal', 'more', 'disable'), $params['blog_pagination'], 'normal');

	$paged = get_query_var('paged') ? intval(get_query_var('paged')) : (get_query_var('page') ? intval(get_query_var('page')) : 1);

	if ($params['blog_pagination'] == 'disable' || $params['blog_style'] == 'grid_carousel')
		$paged = 1;

	if ($params['paged'] != -1)
		$paged = $params['paged'];

	$params['blog_style'] = scalia_check_array_value(array('default', 'timeline', '3x', '4x', '100%', 'grid_carousel', 'styled_list1', 'styled_list2'), $params['blog_style'], 'default');
	$params['blog_post_per_page'] = intval($params['blog_post_per_page']) > 0 ? intval($params['blog_post_per_page']) : 5;

	if(!is_array($params['blog_categories']) && $params['blog_categories']) {
		$params['blog_categories'] = explode(',', $params['blog_categories']);
	}

	$params['blog_post_types'] = is_array($params['blog_post_types']) ? $params['blog_post_types'] : array('post');

	$args = array(
		'post_type' => $params['blog_post_types'],
		'posts_per_page' => $params['blog_post_per_page'],
		'post_status' => 'publish',
		'ignore_sticky_posts' => $params['blog_ignore_sticky'],
		'paged' => $paged
	);
	if(!empty($params['blog_categories']) && !in_array('--all--', $params['blog_categories'])) {
		$args['tax_query'] = array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $params['blog_categories']
			),
			array(
				'taxonomy' => 'scalia_news_sets',
				'field' => 'slug',
				'terms' => $params['blog_categories']
			),
		);
	}

	$posts = new WP_Query($args);

	if($params['blog_pagination'] == 'more') {
		if($posts->max_num_pages > $paged)
			$next_page = $paged + 1;
		else
			$next_page = 0;
	}


	$blog_style = $params['blog_style'];

	wp_enqueue_style('scalia-blog');

	if($blog_style == '3x' || $blog_style == '4x' || $blog_style == '100%') {
		wp_enqueue_script('scalia-imagesloaded');
		wp_enqueue_script('scalia-isotope');
	}
	wp_enqueue_script('scalia-blog');

	$localize = array_merge(
		array('data' => $params),
		array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('blog_ajax-nonce')
		)
	);
	wp_localize_script('scalia-blog', 'blog_ajax', $localize);

	if($posts->have_posts()) {
		if ($params['blog_style'] == 'grid_carousel') {
			wp_enqueue_script('scalia-news-carousel');
			echo '<div class="preloader"></div>';
			echo '<div class="sc-news sc-news-type-carousel clearfix ' . ($params['effects_enabled'] ? 'lazy-loading' : '') . '" ' . ($params['effects_enabled'] ? 'data-ll-item-delay="0"' : '') . '>';
			while($posts->have_posts()) {
				$posts->the_post();
				include(locate_template('content-news-carousel-item.php'));
			}
			echo '</div>';
		} else {
			if($params['is_ajax']) {
				echo '<div data-page="' . $paged . '" data-next-page="' . $next_page . '">';
			} else {
				if ($blog_style == '3x' || $blog_style == '4x' || $blog_style == '100%')
					echo '<div class="preloader"></div>';
				echo '<div class="blog blog-style-'.str_replace('%', '', $blog_style).($blog_style == 'styled_list1' || $blog_style == 'styled_list2' ? ' blog-style-timeline ' : '').' clearfix '.($blog_style == '3x' || $blog_style == '4x' || $blog_style == '100%' ? 'blog-style-masonry ' : '').($blog_style == '100%' ? 'fullwidth-block' : '').'">';
			}

			while($posts->have_posts()) {
				$posts->the_post();
				include(locate_template('content-blog-item.php'));
			}
			echo '</div>';
			if ($params['blog_pagination'] == 'normal' && !$params['is_ajax'])
				scalia_pagination($posts);

			?>

			<?php if($params['blog_pagination'] == 'more' && !$params['is_ajax'] && $posts->max_num_pages > $paged): ?>
				<div class="blog-load-more">
					<div class="inner">
						<div class="sc-button-with-separator">
							<div class="sc-button-sep-holder">
								<div class="sc-button-separator sc-button-separator-double">

								</div>
							</div>
							<div class="sc-button-sep-button">
								<div class="centered-box">
									<button class="sc-button">
										<?php _e('Load more', 'scalia'); ?>
									</button>
								</div>
							</div>
							<div class="sc-button-sep-holder">
								<div class="sc-button-separator sc-button-separator-double">

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php
		}
	}
	wp_reset_postdata();
}


function scalia_get_search_form($form) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url('/')) . '">
				<div>
					<input type="text" value="' . get_search_query() . '" name="s" id="s" />
					 <button class="sc-button" type="submit" id="searchsubmit" value="' . esc_attr_x('Search', 'submit button') . '">'.esc_attr_x('Search', 'submit button').'</button>
				</div>
			</form>';
	return $form;
}
add_filter('get_search_form', 'scalia_get_search_form');

if(!function_exists('scalia_video_background')) {
function scalia_video_background($video_type, $video, $aspect_ratio = '16:9', $headerUp = false, $color = '', $opacity = '') {
	$output = '';
	$video_type = scalia_check_array_value(array('', 'youtube', 'vimeo', 'self'), $video_type, '');
	if($video_type && $video) {
		$video_block = '';
		if($video_type == 'youtube' || $video_type == 'vimeo') {
			$link = '';
			if($video_type == 'youtube') {
				$link = '//www.youtube.com/embed/'.$video.'?playlist='.$video.'&autoplay=1&controls=0&loop=1&fs=0&showinfo=0&autohide=1&iv_load_policy=3&rel=0&disablekb=1&wmode=transparent';
			}
			if($video_type == 'vimeo') {
				$link = '//player.vimeo.com/video/'.$video.'?autoplay=1&controls=0&loop=1&title=0&badge=0&byline=0&autopause=0';
			}
			$video_block = '<iframe src="'.esc_url($link).'" frameborder="0"></iframe>';
		} else {
			$video_block = '<video autoplay="autoplay" controls="" loop="loop" src="'.$video.'" muted="muted"></video>';
		}
		$overlay_css = '';
		if($color) {
			$overlay_css = 'background-color: '.$color.'; opacity: '.floatval($opacity).';';
		}
		$output = '<div class="sc-video-background" data-aspect-ratio="'.esc_attr($aspect_ratio).'"'.($headerUp ? ' data-headerup="1"' : '').'><div class="sc-video-background-inner">'.$video_block.'</div><div class="sc-video-background-overlay" style="'.$overlay_css.'"></div></div>';
	}
	return $output;
}
}
