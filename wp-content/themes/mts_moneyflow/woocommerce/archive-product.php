<?php
$options = get_option(MTS_THEME_NAME);
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header('shop'); ?>
<div id="banner-bottom">
    <div class="container clearfix">
        <?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
			<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php mts_the_breadcrumb(); ?></div>
		<?php } ?>

        <?php if($mts_options['mts_lower_menu_search']){ ?>
            <div class="searchTop"><?php echo get_search_form() ?></div>
        <?php } ?>

        <?php if ( !empty($mts_options['mts_header_social']) && is_array($mts_options['mts_header_social'])) { ?>
        <div class="header-social">
            <?php foreach( $mts_options['mts_header_social'] as $header_icons ) : ?>
                <?php if( ! empty( $header_icons['mts_header_icon'] ) && isset( $header_icons['mts_header_icon'] ) ) : ?>
                    <a href="<?php echo $header_icons['mts_header_icon_link'] ?>" class="header-<?php echo $header_icons['mts_header_icon'] ?>"><span class="fa fa-<?php echo $header_icons['mts_header_icon'] ?>"></span></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php } ?>
    </div>
</div>
<div id="page" class="clearfix">
	<article class="<?php mts_article_class(); ?>">
		<div id="content_box" >
			<?php do_action('woocommerce_before_main_content'); ?>
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>
				<?php do_action( 'woocommerce_archive_description' ); ?>
				<?php if ( have_posts() ) : ?>
					<?php do_action( 'woocommerce_before_shop_loop' ); ?>
					<?php woocommerce_product_loop_start(); ?>
						<?php woocommerce_product_subcategories(); ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php woocommerce_get_template_part( 'content', 'product' ); ?>
						<?php endwhile; // end of the loop. ?>
					<?php woocommerce_product_loop_end(); ?>
					<?php do_action( 'woocommerce_after_shop_loop' ); ?>
				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
					<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
				<?php endif; ?>
			<?php do_action('woocommerce_after_main_content'); ?>
		</div>
	</article>
	<?php /*do_action('woocommerce_sidebar');*/ ?>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>