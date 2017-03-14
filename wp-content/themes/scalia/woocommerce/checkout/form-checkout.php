<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

wp_enqueue_script('scalia-checkout');
wp_enqueue_script('scalia-woocommerce');

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div id="woo-checkout" class="sc-tabs sc-tabs-style-1 sc_content_element">
			<div class="sc_wrapper sc_tour_tabs_wrapper ui-tabs clearfix">
				<ul class="sc_tabs_nav ui-tabs-nav resp-tabs-list clearfix">
					<li class="checkout_billing_tab">
						<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
							<?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?>
						<?php else : ?>
							<?php _e( 'Billing Details', 'woocommerce' ); ?>
						<?php endif; ?>
					</li>
					<li class="checkout_shipping_tab">
						<?php _e( 'Shipping Address', 'woocommerce' ); ?>
					</li>
					<li class="checkout_order_review_tab">
						<?php _e( 'Review & Payment', 'scalia' ); ?>
					</li>
				</ul>
				<div class="resp-tabs-container">
					<div class="sc_tab ui-tabs-panel sc_ui-tabs-hide clearfix" id="tab-checkout_billing">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<div class="sc_tab ui-tabs-panel sc_ui-tabs-hide clearfix" id="tab-checkout_shipping">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>

					<div class="sc_tab ui-tabs-panel sc_ui-tabs-hide clearfix" id="tab-checkout_order_review">
						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

						<div id="order_review" class="woocommerce-checkout-review-order">
							<?php do_action( 'woocommerce_checkout_order_review' ); ?>
						</div>

						<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
					</div>
				</div>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
	<?php endif; ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
