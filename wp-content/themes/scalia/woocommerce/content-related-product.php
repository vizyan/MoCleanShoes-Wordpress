<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

if (empty($woocommerce_loop['loop']))
	$woocommerce_loop['loop'] = 0;

if (! $product || ! $product->is_visible())
	return;

$woocommerce_loop['loop']++;

?>
<div <?php post_class(); ?>>
	<div class="product-inner rounded-corners shadow-box">

		<?php do_action('woocommerce_before_shop_loop_item'); ?>

		<a href="<?php the_permalink(); ?>" class="product-image">
			<?php do_action('woocommerce_before_shop_loop_item_title'); ?>
		</a>

		<div class="product-info clearfix">
			<div class="product-title"><?php the_title(); ?></div>
			<?php the_terms(get_the_ID(), 'product_cat', '<div class="product-categories">', ' | ', '</div>'); ?>
			<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
		</div>

		<div class="product-bottom clearfix">
			<?php do_action('woocommerce_after_shop_loop_item'); ?>
		</div>

	</div>
</div>