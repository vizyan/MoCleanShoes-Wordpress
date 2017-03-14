<?php
/**
 * Template Name: Blog Page
 *
 * @package Scalia
 */

$slideshow_params = scalia_get_sanitize_page_slideshow_data(get_the_ID());

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
		get_template_part( 'content', 'blog' );
	endwhile;
?>

</div><!-- #main-content -->

<?php
get_footer();
