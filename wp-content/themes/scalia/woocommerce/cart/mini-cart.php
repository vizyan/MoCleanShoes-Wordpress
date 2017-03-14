<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					?>
					<li>
					<?php if ( ! $_product->is_visible() ) { ?>
						<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
					<?php } else { ?>
						<a href="<?php echo get_permalink( $product_id ); ?>">
							<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
						</a>
					<?php } ?>

						<div class="cart-item-info">

							<div class="product-title">
								<?php if ( ! $_product->is_visible() ) { ?>
									<?php echo $product_name; ?>
								<?php } else { ?>
									<a href="<?php echo get_permalink( $product_id ); ?>">
										<?php echo $product_name; ?>
									</a>
								<?php } ?>
							</div>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<div class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</div>', $cart_item, $cart_item_key ); ?>
						</div>
					</li>
					<?php
				}
			}
		?>

	<?php else : ?>

		<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<div class="minicart-bottom">

		<div class="total clearfix"><span class="label"><?php _e( 'Subtotal', 'woocommerce' ); ?>:</span> <?php echo WC()->cart->get_cart_subtotal(); ?></div>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<div class="buttons clearfix">
			<a class="sc-button button wc-forward" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
			<a class="sc-button button checkout wc-forward" href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
		</div>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
