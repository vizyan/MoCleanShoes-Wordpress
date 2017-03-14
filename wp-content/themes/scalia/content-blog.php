<?php
/**
 * The template used for displaying page content in blog
 */

	$item_data = array(
		'sidebar_position' => '',
		'sidebar_sticky' => '',
		'blog_style' => 'default',
		'blog_post_per_page' => '',
		'blog_categories' => '',
		'blog_post_types' => '',
		'blog_pagination' => ''
	);
	$item_data = scalia_get_post_data($item_data, 'page', get_the_ID());
	$sidebar_position = scalia_check_array_value(array('', 'left', 'right'), $item_data['sidebar_position'], '');
	$sidebar_stiky = $item_data['sidebar_sticky'] ? 1 : 0;
	$panel_classes = array('panel', 'row');
	$center_classes = 'panel-center';
	$sidebar_classes = '';
	if(is_active_sidebar('page-sidebar') && $sidebar_position) {
		$panel_classes[] = 'panel-sidebar-position-'.$sidebar_position;
		$panel_classes[] = 'with-sidebar';
		$center_classes.= ' col-lg-9 col-md-9 col-sm-12';
		if($sidebar_position == 'left') {
			$center_classes .= ' col-md-push-3 col-sm-push-0';
			$sidebar_classes .= ' col-md-pull-9 col-sm-pull-0';
		}
	} else {
		$center_classes .= ' col-xs-12';
	}
	if($sidebar_stiky) {
		$panel_classes[] = 'panel-sidebar-sticky';
	}
?>

<div class="block-content">
	<div class="container">
		<div class="<?php echo esc_attr(implode(' ', $panel_classes)); ?>">
			<div class="<?php echo esc_attr($center_classes); ?>">
				<?php scalia_blog(array('blog_style' => $item_data['blog_style'], 'blog_post_per_page' => $item_data['blog_post_per_page'], 'blog_categories' => $item_data['blog_categories'], 'blog_post_types' => $item_data['blog_post_types'], 'blog_pagination' => $item_data['blog_pagination'])); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
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

				</article><!-- #post-## -->

			</div>

			<?php
				if(is_active_sidebar('page-sidebar') && $sidebar_position) {
					echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($sidebar_classes).'" role="complementary">';
					get_sidebar('page');
					echo '</div><!-- .sidebar -->';
				}
			?>

		</div>
	</div>
</div>
