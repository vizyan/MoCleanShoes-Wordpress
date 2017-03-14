<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_script('scalia-woocommerce');

wc_print_notices(); ?>

<div class="woocommerce-before-cart clearfix"><?php do_action( 'woocommerce_before_cart' ); ?></div>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post" class="woocommerce-cart-form">

<?php do_action( 'woocommerce_before_cart_table' ); ?>


<div class="sc-table"><table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
			<th class="product-remove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() )
								echo $thumbnail;
							else
								printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
						?>
					</td>

					<td class="product-name">
						<div class="product-title"><?php
							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink($cart_item), $_product->get_title() ), $cart_item, $cart_item_key );
							?></div>
						<div class="product-meta"><?php
							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
								echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
						?></div>
					</td>

					<td class="product-price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>

					<td class="product-subtotal">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&#xe619;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
						?>
					</td>

				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<input type="text" name="coupon_code" class="input-text coupon-code" value="" placeholder="<?php _e( 'Coupon code', 'scalia' ); ?>" /> <button type="submit" class="button sc-button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>"><?php _e( 'Apply Coupon', 'woocommerce' ); ?></button>

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

				<div class="submit-buttons"><button type="submit" class="button sc-button" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>"><?php _e( 'Update Cart', 'woocommerce' ); ?></button><button type="submit" class="checkout-button button alt wc-forward sc-button" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>"><?php _e( 'Checkout', 'woocommerce' ); ?></button></div>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table></div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post" class="woocommerce-cart-form responsive">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<?php
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
	$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
		?>

		<div class="cart-item rounded-corners shadow-box">
			<table class="shop_table cart"><tbody><tr>
				<td class="product-thumbnail">
					<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $_product->is_visible() )
							echo $thumbnail;
						else
							printf( '<a href="%s">%s</a>', $_product->get_permalink($cart_item), $thumbnail );
					?>
				</td>

				<td class="product-name">
					<div class="product-title"><?php
						if ( ! $_product->is_visible() )
							echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						else
							echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
						?></div>
					<div class="product-meta"><?php
						// Meta data
						echo WC()->cart->get_item_data( $cart_item );

						// Backorder notification
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
							echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
					?></div>
				</td>
			</tr></tbody></table>
			<div class="sc-table"><table class="shop_table cart">
				<thead>
					<tr>
						<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
						<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
						<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
						<th class="product-remove">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="product-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
										'min_value'   => '0'
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&#xe619;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
							?>
						</td>
					</tr>
				</tbody>
			</table></div>
		</div>
		<?php
	}
}

?>

<div class="actions">
	<?php if ( WC()->cart->coupons_enabled() ) { ?>
		<div class="coupon shadow-box rounded-corners centered-box">

			<input type="text" name="coupon_code" class="input-text coupon-code" value="" placeholder="<?php _e( 'Coupon', 'scalia' ); ?>" /> <button type="submit" class="button sc-button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>"><?php _e( 'Apply Coupon', 'woocommerce' ); ?></button>

			<?php do_action('woocommerce_cart_coupon'); ?>

		</div>
	<?php } ?>

		<div class="submit-buttons centered-box"><button type="submit" class="button sc-button" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>"><?php _e( 'Update Cart', 'woocommerce' ); ?></button><button type="submit" class="checkout-button button alt wc-forward sc-button" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>"><?php _e( 'Checkout', 'woocommerce' ); ?></button></div>
		<?php wp_nonce_field( 'woocommerce-cart' ); ?>

</div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<?php woocommerce_shipping_calculator(); ?>
		</div>
		<div class="col-sm-6 col-xs-12">
			<?php woocommerce_cart_totals(); ?>
		</div>
	</div>
	<div class="cart-cross-cells">
		<?php woocommerce_cross_sell_display();?>
	</div>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
