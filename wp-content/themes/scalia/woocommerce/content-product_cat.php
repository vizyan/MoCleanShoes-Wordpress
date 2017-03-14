<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count
$woocommerce_loop['loop']++;

$classes = array('inline-column');
if($woocommerce_loop['columns'] == 2) {
	$classes[] = 'col-xs-6';
} elseif($woocommerce_loop['columns'] == 3) {
	$classes[] = 'col-sm-4 col-xs-6';
}elseif($woocommerce_loop['columns'] == 4) {
	$classes[] = 'col-sm-3 col-xs-6';
}
if(0 == ($woocommerce_loop['loop'] - 1) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'])
	$classes[] = 'first';
if(0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'])
	$classes[] = 'last';
?>
<div class="products-category-item product <?php echo implode(' ', $classes); ?>">
	<div class="product-inner rounded-corners shadow-box">

		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

		<a  class="product-image" href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>
		</a>

		<div class="product-info clearfix">
			<h4><?php echo $category->name; ?></h4>

			<div class="category-items-coint"><?php
					if ( $category->count == 1 ) {
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">1 '.__('item', 'scalia').'</mark>', $category );
					} elseif ( $category->count > 0 ) {
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . $category->count . ' '.__('items', 'scalia').'</mark>', $category );
					} else {
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">0 '.__('items', 'scalia').'</mark>', $category );
					}
				?></div>
		</div>

			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>

		<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
	</div>
</div>