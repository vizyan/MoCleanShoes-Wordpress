<?php
/**
 * Review order table
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>


	<div class="order_review_shop_table_wrapper">
		<table class="shop_table order-details">
			<thead>
				<tr>
					<th class="product-thumbnail"></th>
					<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
					<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr class="checkout-cart-info cart_totals">
					<td colspan="3">
						<table class="checkout-cart-info-table">
							<tr class="cart-subtotal">
								<th><?php _e( 'Cart Subtotal', 'scalia' ); ?></th>
								<td><?php wc_cart_totals_subtotal_html(); ?></td>
							</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
									<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
									<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
								</tr>
							<?php endforeach; ?>

							<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

								<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

								<?php wc_cart_totals_shipping_html(); ?>

								<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

							<?php endif; ?>

							<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
								<tr class="fee">
									<th><?php echo esc_html( $fee->name ); ?></th>
									<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
								</tr>
							<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && WC()->cart->tax_display_cart === 'excl' ) : ?>
								<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
									<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
										<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
											<th><?php echo esc_html( $tax->label ); ?></th>
											<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
										</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr class="tax-total">
										<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
										<td><?php wc_cart_totals_taxes_total_html(); ?></td>
									</tr>
								<?php endif; ?>
							<?php endif; ?>

							<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
								<tr class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
									<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
									<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
								</tr>
							<?php endforeach; ?>

							<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

							<tr class="order-total">
								<th><?php _e( 'Order Total', 'woocommerce' ); ?></th>
								<td><?php wc_cart_totals_order_total_html(); ?></td>
							</tr>

							<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
						</table>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php
					do_action( 'woocommerce_review_order_before_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							?>
							<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
								<td class="product-thumbnail">
									<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

										if ( ! $_product->is_visible() )
											echo $thumbnail;
										else
											printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
									?>
								</td>
								<td class="product-name">
									<div class="product-info">
										<?php
											if ( ! $_product->is_visible() )
												echo apply_filters( 'woocommerce_cart_item_name', sprintf('<div class="styled-subtitle">%s</div>', $_product->get_title()), $cart_item, $cart_item_key );
											else
												echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<div class="styled-subtitle"><a href="%s">%s</a></div>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
										?>
										<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <div class="product-quantity">' . sprintf(__( 'Quantity: %s', 'woocommerce' ), $cart_item['quantity']). '</div>', $cart_item, $cart_item_key ); ?>
										<?php echo WC()->cart->get_item_data( $cart_item ); ?>
									</div>
								</td>
								<td class="product-total">
									<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
								</td>
							</tr>
							<?php
						}
					}

					do_action( 'woocommerce_review_order_after_cart_contents' );
				?>
			</tbody>
		</table>
	</div>


