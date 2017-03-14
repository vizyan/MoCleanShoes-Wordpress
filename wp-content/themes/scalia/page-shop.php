<?php
/**
 * Template Name: Woocommerce Shop Page
 *
 * @package Scalia
 */

global $post;
$page_data = get_post_meta($post->ID, 'scalia_page_data', TRUE);
$slideshow_params = array_merge(array('slideshow_type' => '', 'slideshow_slideshow' => '', 'slideshow_layerslider' => ''), $page_data);

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if($slideshow_params['slideshow_type']) {
		echo '<div class="block-slideshow">';
		scalia_slideshow_block(array('slideshow_type' => $slideshow_params['slideshow_type'], 'slideshow' => $slideshow_params['slideshow_slideshow'], 'slider' => $slideshow_params['slideshow_layerslider']));
		echo '</div>';
	}
?>
<?php echo scalia_page_title(); ?>

<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content', 'shop' );
	endwhile;
?>

</div><!-- #main-content -->

<?php
get_footer();
