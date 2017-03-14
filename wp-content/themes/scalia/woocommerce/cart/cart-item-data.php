<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="variation">
	<?php foreach ($item_data as $data) : ?>
		<div class="variation-<?php echo sanitize_html_class( $data['key'] ); ?>"><?php echo wp_kses_post( $data['key'] ); ?>: <?php echo wp_kses_post( wpautop( $data['display'] ) ); ?></div>
	<?php endforeach; ?>
</div>
