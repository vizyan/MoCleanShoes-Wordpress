<?php

$page_data = get_post_meta(get_the_ID(), 'scalia_page_data', TRUE) ? get_post_meta(get_the_ID(), 'scalia_page_data', TRUE) : array();
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
		if(get_post_type() == 'post' || get_post_type() == 'scalia_pf_item' || get_post_type() == 'scalia_news') {
			get_template_part( 'content', 'page' );
		} else {
			get_template_part( 'content', get_post_format() );
		}
	endwhile;
?>

</div><!-- #main-content -->

<?php
get_footer();
