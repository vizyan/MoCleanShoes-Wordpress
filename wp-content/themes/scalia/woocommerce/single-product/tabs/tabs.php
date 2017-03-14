<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="sc-woocommerce-tabs">
		<div class="sc-tabs sc-tabs-style-1 sc_content_element" id="woocommerce-tabs">
			<div class="sc_wrapper sc_tour_tabs_wrapper ui-tabs clearfix">
				<ul class="sc_tabs_nav ui-tabs-nav resp-tabs-list clearfix">
					<?php foreach ( $tabs as $key => $tab ) : ?>

						<li class="<?php echo esc_attr($key); ?>_tab">
							<?php echo apply_filters( 'woocommerce_product_' . esc_attr($key) . '_tab_title', $tab['title'], $key ) ?>
						</li>

					<?php endforeach; ?>
				</ul>
				<div class="resp-tabs-container">
					<?php foreach ( $tabs as $key => $tab ) : ?>

						<div class="sc_tab ui-tabs-panel sc_ui-tabs-hide clearfix" id="tab-<?php echo esc_attr($key); ?>">
							<?php call_user_func( $tab['callback'], esc_attr($key), $tab ) ?>
						</div>

					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>