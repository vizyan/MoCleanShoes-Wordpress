<?php
/**
 * Template Name: Woocommerce
 * The Woocommerce template file
 * @package Scalia
 */

	$item_data = array(
		'sidebar_position' => '',
		'sidebar_sticky' => '',
	);
	$page_id = wc_get_page_id('shop');
	if(is_product()) {
		$page_id = get_the_ID();
	}
	$item_data = scalia_get_post_data($item_data, 'page', $page_id);

	$sidebar_stiky = $item_data['sidebar_sticky'] ? 1 : 0;
	$sidebar_position = scalia_check_array_value(array('', 'left', 'right'), $item_data['sidebar_position'], '');
	$panel_classes = array('panel', 'row');
	$center_classes = 'panel-center';
	$sidebar_classes = '';

	if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
		$panel_classes[] = 'panel-sidebar-position-'.$sidebar_position;
		$panel_classes[] = 'with-sidebar';
		$center_classes .= ' col-lg-9 col-md-9 col-sm-12';
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

get_header();

?>

<div id="main-content" class="main-content">

<?php echo scalia_page_title(); ?>
	<div class="block-content">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $panel_classes)); ?>">
				<div class="<?php echo esc_attr($center_classes); ?>">
					<?php woocommerce_content(); ?>
				</div>

				<?php
					if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
						echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($sidebar_classes).' '.esc_attr($sidebar_position).'" role="complementary">';
						get_sidebar('shop');
						echo '</div><!-- .sidebar -->';
					}
				?>
			</div>
			<?php if(is_shop() || is_product_category() || is_product_tag()) : ?>
				<div class="fullwidth-block products-page-separator"><div class="sc-divider sc-divider-style-6"></div></div>
			<?php endif; ?>
			<?php if(is_product()) {
				echo '<div class="fullwidth-block"><div class="block-divider"></div></div>';
				do_action('scalia_woocommerce_after_single_product');
			} ?>
			<?php get_sidebar('shop-bottom'); ?>
		</div>
	</div>
</div><!-- #main-content -->

<?php
get_footer();