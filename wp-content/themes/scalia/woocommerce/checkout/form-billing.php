<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */
?>
<div class="woocommerce-billing-fields">
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php
		$collumns = 2;
		$fields_per_collumn = ceil(count($checkout->checkout_fields['billing']) / $collumns);
		$index = 0;
		$index_collumns = 1;
	?>

	<div class="woocommerce-billing-collumns">
		<div class="woocommerce-billing-collumn odd clearfix">
			<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>
				<?php if ($index >= $fields_per_collumn && $index_collumns < $collumns): ?>
					<?php
						$index_collumns++;
					?>
					</div><div class="woocommerce-billing-collumn <?php echo ($index_collumns % 2 == 0 ? 'even' : 'odd'); ?> clearfix">
				<?php endif; ?>

				<?php
					if (!empty($field['type']) && $field['type'] == 'checkbox')
						$field['input_class'] = 'sc-checkbox';
					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
					$index++;
				?>

			<?php endforeach; ?>

			<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

			<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

				<?php if ( $checkout->enable_guest_checkout ) : ?>

					<p class="form-row form-row-wide create-account">
						<input class="input-checkbox sc-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
					</p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

				<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

					<div class="create-account">

						<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p>

						<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

							<?php
								if (!empty($field['type']) && $field['type'] == 'checkbox')
									$field['input_class'] = 'sc-checkbox';
								woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
							?>

						<?php endforeach; ?>

						<div class="clear"></div>

					</div>

				<?php endif; ?>

				<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

			<?php endif; ?>
			<div class="shiping-address-continue"><a class="button sc-button woocommerce-button-next-step"><?php _e( 'Continue', 'scalia' ); ?></a></div>
		</div>
	</div>
</div>
