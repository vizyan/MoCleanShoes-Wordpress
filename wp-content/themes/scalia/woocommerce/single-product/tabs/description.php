<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

?>
<?php echo wpautop(do_shortcode(get_post_meta($post->ID, 'scalia_product_description', true))); ?>

