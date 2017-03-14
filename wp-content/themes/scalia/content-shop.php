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
	$item_data = scalia_get_post_data($item_data, 'page', $post->ID);
	$sidebar_position = scalia_check_array_value(array('', 'left', 'right'), $item_data['sidebar_position'], '');
	$sidebar_stiky = $item_data['sidebar_sticky'] ? 1 : 0;
	$panel_classes = array('panel', 'row');
	$center_classes = 'panel-center';
	$sidebar_classes = '';
	if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
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
				if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
					echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($sidebar_classes).'" role="complementary">';
					get_sidebar('shop');
					echo '</div><!-- .sidebar -->';
				}
			?>
		</div>
		<div class="fullwidth-block products-page-separator"><div class="sc-divider sc-divider-style-6"></div></div>
		<?php get_sidebar('shop-bottom'); ?>
	</div>
</div>
