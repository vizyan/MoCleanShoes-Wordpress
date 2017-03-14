<?php

$panel_classes = array('panel', 'row');

if(is_active_sidebar('page-sidebar')) {
	$panel_classes[] = 'panel-sidebar-position-right';
	$panel_classes[] = 'with-sidebar';
	$center_classes = 'col-lg-9 col-md-9 col-sm-12';
} else {
	$center_classes = 'col-xs-12';
}

get_header(); ?>

<div id="main-content" class="main-content">

<?php echo scalia_page_title(); ?>

	<div class="block-content">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $panel_classes)); ?>">
				<div class="<?php echo esc_attr($center_classes); ?>">
				<?php
					if ( have_posts() ) {

						if(!is_singular()) { wp_enqueue_style('scalia-blog'); echo '<div class="blog blog-style-default">'; }

						while ( have_posts() ) : the_post();

							get_template_part( 'content', 'blog-item' );

						endwhile;

						if(!is_singular()) { scalia_pagination(); echo '</div>'; }

					} else {
						get_template_part( 'content', 'none' );
					}
				?>
				</div>
				<?php
					if(is_active_sidebar('page-sidebar')) {
						echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12" role="complementary">';
						get_sidebar('page');
						echo '</div><!-- .sidebar -->';
					}
				?>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->
</div><!-- #main-content -->

<?php
get_footer();
