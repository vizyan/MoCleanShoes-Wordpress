<?php
/**
 * The template used for displaying page content on home page
 */

	$page_data = array(
		'title' => scalia_get_sanitize_page_title_data(get_the_ID()),
		'effects' => scalia_get_sanitize_page_effects_data(get_the_ID()),
		'slideshow' => scalia_get_sanitize_page_slideshow_data(get_the_ID()),
		'quickfinder' => scalia_get_sanitize_page_quickfinder_data(get_the_ID()),
		'portfolio' => scalia_get_sanitize_page_portfolio_data(get_the_ID()),
		'gallery' => scalia_get_sanitize_page_gallery_data(get_the_ID()),
		'sidebar' => scalia_get_sanitize_page_sidebar_data(get_the_ID())
	);
	if(get_post_type() == 'page') {
		$page_data['blog'] = scalia_get_sanitize_page_blog_data(get_the_ID());
	}
	$no_margins_block = '';
	if($page_data['effects']['effects_no_bottom_margin']) {
		$no_margins_block = ' no-bottom-margin';
	}

	$panel_classes = array('panel', 'row');
	$center_classes = 'panel-center';
	$sidebar_classes = '';
	if(is_active_sidebar('page-sidebar') && $page_data['sidebar']['sidebar_position']) {
		$panel_classes[] = 'panel-sidebar-position-'.$page_data['sidebar']['sidebar_position'];
		$panel_classes[] = 'with-sidebar';
		$center_classes .= ' col-lg-9 col-md-9 col-sm-12';
		if($page_data['sidebar']['sidebar_position'] == 'left') {
			$center_classes .= ' col-md-push-3 col-sm-push-0';
			$sidebar_classes .= ' col-md-pull-9 col-sm-pull-0';
		}
	} else {
		$center_classes .= ' col-xs-12';
	}
	if($page_data['sidebar']['sidebar_sticky']) {
		$panel_classes[] = 'panel-sidebar-sticky';
	}
?>

<?php
	if($page_data['quickfinder']['quickfinder_position'] == 'above') {
		scalia_quickfinder_block(array(
			'quickfinder' => $page_data['quickfinder']['quickfinder_quickfinder'],
			'style' => $page_data['quickfinder']['quickfinder_style'],
			'connector_color' => $page_data['quickfinder']['quickfinder_connector_color'],
			'effects_enabled' => $page_data['quickfinder']['quickfinder_effects_enabled']
		));
	}
?>

<?php if($page_data['portfolio']['portfolio_position'] == 'above') : ?>
<div class="block-content clearfix<?php echo esc_attr($no_margins_block); ?>">
			<?php scalia_portfolio_slider(array(
												'portfolio' => implode(',', $page_data['portfolio']['portfolio_portfolios']),
												'title' => $page_data['portfolio']['portfolio_title'],
												'layout' => $page_data['portfolio']['portfolio_layout'],
												'no_gaps' => $page_data['portfolio']['portfolio_no_gaps'],
												'display_titles' => $page_data['portfolio']['portfolio_display_titles'],
												'hover' => $page_data['portfolio']['portfolio_hover'],
												'show_info' => $page_data['portfolio']['portfolio_show_info'],
												'disable_socials' => $page_data['portfolio']['portfolio_disable_socials'],
												'fullwidth_columns' => $page_data['portfolio']['portfolio_fullwidth_columns'],
												'effects_enabled' => $page_data['portfolio']['portfolio_effects_enabled'],
												)
										);
			?>
</div>
<?php endif; ?>


<div class="block-content<?php echo esc_attr($no_margins_block); ?>">
	<div class="container">
<?php if($page_data['gallery']['gallery_position'] == 'above') : ?>
	<?php
		if($page_data['gallery']['gallery_type'] == 'slider') {
			scalia_gallery(array(
				'gallery' => $page_data['gallery']['gallery_gallery'],
				'hover' => $page_data['gallery']['gallery_hover'],
			));
		} else{
			scalia_gallery_block(array(
				'gallery' => $page_data['gallery']['gallery_gallery'],
				'type' => $page_data['gallery']['gallery_type'],
				'layout' => $page_data['gallery']['gallery_layout'],
				'style' => $page_data['gallery']['gallery_style'],
				'no_gaps' => $page_data['gallery']['gallery_no_gaps'],
				'hover' => $page_data['gallery']['gallery_hover'],
				'item_style' => $page_data['gallery']['gallery_item_style']
			));
		}
	?>
<?php endif; ?>
		<div class="<?php echo esc_attr(implode(' ', $panel_classes)); ?>">

			<div class="<?php echo esc_attr($center_classes); ?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
						if($page_data['quickfinder']['quickfinder_position'] == 'inside') {
									scalia_quickfinder_block(array(
										'quickfinder' => $page_data['quickfinder']['quickfinder_quickfinder'],
										'style' => $page_data['quickfinder']['quickfinder_style'],
										'connector_color' => $page_data['quickfinder']['quickfinder_connector_color'],
										'effects_enabled' => $page_data['quickfinder']['quickfinder_effects_enabled']
									));
						}
					?>

					<?php if($page_data['portfolio']['portfolio_position'] == 'inside') : ?>
						<?php scalia_portfolio(array(
															'portfolio' => implode(',',$page_data['portfolio']['portfolio_portfolios']),
															'title' => $page_data['portfolio']['portfolio_title'],
															'layout' => $page_data['portfolio']['portfolio_layout'],
															'style' => $page_data['portfolio']['portfolio_style'],
															'no_gaps' => $page_data['portfolio']['portfolio_no_gaps'],
															'display_titles' => $page_data['portfolio']['portfolio_display_titles'],
															'hover' => $page_data['portfolio']['portfolio_hover'],
															'pagination' => $page_data['portfolio']['portfolio_pagination'],
															'items_per_page' => $page_data['portfolio']['portfolio_items_per_page'],
															'with_filter' => $page_data['portfolio']['portfolio_with_filter'],
															'show_info' => $page_data['portfolio']['portfolio_show_info'],
															'disable_socials' => $page_data['portfolio']['portfolio_disable_socials'],
															'fullwidth_columns' => $page_data['portfolio']['portfolio_fullwidth_columns'],
															)
													);
						?>
					<?php endif; ?>

					<div class="entry-content post-content">
						<?php
							$post_data = array();
							if(function_exists('scalia_get_sanitize_post_data')) {
								$post_data = scalia_get_sanitize_post_data(get_the_ID());
							}
							if((get_post_type() == 'post' || get_post_type() == 'scalia_news') && !empty($post_data['show_featured_image']) && has_post_thumbnail()) {
								echo '<div class="blog-post-image centered">';
								scalia_post_thumbnail('scalia-gallery-fullwidth', false, 'img-responsive');
								echo '</div>';
							}
						?>
						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'scalia' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</div><!-- .entry-content -->


					<?php if (get_post_type() == 'post') { scalia_author_info(get_the_ID(), true); } ?>

					<?php if (get_post_type() == 'post' || get_post_type() == 'scalia_pf_item' ) : ?>
						<div class="clearfix scalia_socials_sharing">
							<?php scalia_socials_sharing(); ?>
							<?php scalia_post_tags(); ?>
						</div>
						<div class="block-divider"></div>
						<div class="block-navigation">
							<?php
								$post_nav_labels = array(
									'scalia_pf_item' => array(
										'prev' => __('Previous Project', 'scalia'),
										'next' => __('Next Project', 'scalia')
									),
									'scalia_news' => array(
										'prev' => __('Previous news', 'scalia'),
										'next' => __('Next news', 'scalia')
									),
									'post' => array(
										'prev' => __('Previous post', 'scalia'),
										'next' => __('Next post', 'scalia')
									),
								);
								$post_nav_labels_type = get_post_type();
								if(!isset($post_nav_labels[$post_nav_labels_type])) {
									$post_nav_labels_type = 'post';
								}
							?>
							<div class="block-navigation-prev"><?php previous_post_link('%link', $post_nav_labels[$post_nav_labels_type]['prev'], true, '', get_post_type() == 'scalia_pf_item' ? 'scalia_portfolios' : 'category'); ?></div>
							<div class="block-navigation-next"><?php next_post_link('%link', $post_nav_labels[$post_nav_labels_type]['next'], true, '', get_post_type() == 'scalia_pf_item' ? 'scalia_portfolios' : 'category'); ?></div>
						</div>
					<?php endif; ?>

					<?php if (get_post_type() == 'post') { scalia_related_posts(); } ?>


					<?php
						if ( comments_open() || get_comments_number() ) {
						comments_template();
						}
					?>

				</article><!-- #post-## -->

			</div>

			<?php
				if(is_active_sidebar('page-sidebar') && $page_data['sidebar']['sidebar_position']) {
					echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($sidebar_classes).'" role="complementary">';
					get_sidebar('page');
					echo '</div><!-- .sidebar -->';
				}
			?>

		</div>

<?php if($page_data['gallery']['gallery_position'] == 'below') : ?>
	<?php
		if($page_data['gallery']['gallery_type'] == 'slider') {
			scalia_gallery(array(
				'gallery' => $page_data['gallery']['gallery_gallery'],
				'hover' => $page_data['gallery']['gallery_hover'],
			));
		} else{
			scalia_gallery_block(array(
				'gallery' => $page_data['gallery']['gallery_gallery'],
				'type' => $page_data['gallery']['gallery_type'],
				'layout' => $page_data['gallery']['gallery_layout'],
				'style' => $page_data['gallery']['gallery_style'],
				'no_gaps' => $page_data['gallery']['gallery_no_gaps'],
				'hover' => $page_data['gallery']['gallery_hover'],
				'item_style' => $page_data['gallery']['gallery_item_style']
			));
		}
	?>
<?php endif; ?>

	</div>
</div>

<?php
	if($page_data['quickfinder']['quickfinder_position'] == 'below') {
		scalia_quickfinder_block(array(
			'quickfinder' => $page_data['quickfinder']['quickfinder_quickfinder'],
			'style' => $page_data['quickfinder']['quickfinder_style'],
			'connector_color' => $page_data['quickfinder']['quickfinder_connector_color'],
			'effects_enabled' => $page_data['quickfinder']['quickfinder_effects_enabled']
		));
	}
?>

<?php if($page_data['portfolio']['portfolio_position'] == 'below') : ?>
<div class="block-content clearfix<?php echo esc_attr($no_margins_block); ?>">
			<?php scalia_portfolio_slider(array(
												'portfolio' => implode(',', $page_data['portfolio']['portfolio_portfolios']),
												'title' => $page_data['portfolio']['portfolio_title'],
												'layout' => $page_data['portfolio']['portfolio_layout'],
												'no_gaps' => $page_data['portfolio']['portfolio_no_gaps'],
												'display_titles' => $page_data['portfolio']['portfolio_display_titles'],
												'hover' => $page_data['portfolio']['portfolio_hover'],
												'show_info' => $page_data['portfolio']['portfolio_show_info'],
												'disable_socials' => $page_data['portfolio']['portfolio_disable_socials'],
												'fullwidth_columns' => $page_data['portfolio']['portfolio_fullwidth_columns'],
												'effects_enabled' => $page_data['portfolio']['portfolio_effects_enabled'],
												)
										);
			?>
</div>
<?php endif; ?>
