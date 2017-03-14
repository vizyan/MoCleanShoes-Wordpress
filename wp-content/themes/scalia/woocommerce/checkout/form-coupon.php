<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>


<form class="checkout_coupon rounded-corners shadow-box shop_table cart clearfix" method="post">
	<div class="promo-code-heading alignleft styled-subtitle"><?php _e( 'Have A Promotional Code?', 'woocommerce' ) ?></div>

	<div class="coupon-contents coupon alignright">
		<input type="text" name="coupon_code" class="input-text coupon-code" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
		<button type="submit" class="sc-button" name="apply_coupon"><?php _e( 'Apply Coupon', 'woocommerce' ); ?></button>
	</div>
</form>
