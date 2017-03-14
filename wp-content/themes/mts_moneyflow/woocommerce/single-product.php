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
<div id="page">
	<article class="<?php mts_article_class(); ?>">
		<div class="single_post" id="content_box" >
			<div class="single-post-content">
				<?php //do_action('woocommerce_before_main_content'); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
					<?php endwhile; // end of the loop. ?>
				<?php do_action('woocommerce_after_main_content'); ?>
	</article>
	<?php /*do_action('woocommerce_sidebar');*/ ?>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>