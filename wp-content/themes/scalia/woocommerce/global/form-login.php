<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo '<div class="login-message-box rounded-corners">'.wpautop( wptexturize( $message ) ).'</div>'; ?>

	<div class="login-row clearfix">
		<p class="form-row form-row-first">
			<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="username" id="username" />
		</p>
		<p class="form-row form-row-last">
			<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input class="input-text" type="password" name="password" id="password" />
		</p>

		<p class="form-row">
			<input name="rememberme" type="checkbox" id="rememberme" class="sc-checkbox" value="forever" />
			<label for="rememberme" class="inline"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
			<button type="submit" class="sc-button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>"><?php _e( 'Login', 'woocommerce' ); ?></button>
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		</p>
	</div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<p class="lost_password">
		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
