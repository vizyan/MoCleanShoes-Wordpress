<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<?php woocommerce_show_product_loop_sale_flash(); ?>
	<div class="sc-products-image">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>">
		<?php echo $product->get_image(); ?>
		</a>
	</div>
	<div class="sc-products-content">
		<div class="sc-products-title">
			<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
				<?php echo $product->get_title(); ?>
			</a>
		</div>
		<div class="sc-products-rating"><?php echo $product->get_rating_html(); ?></div>
		<div class="sc-products-price styled-subtitle"><?php echo $product->get_price_html(); ?></div>
	</div>
</li>
