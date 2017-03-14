<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php echo scalia_page_title(); ?>

<div class="block-content">
	<div class="container">
		<div class="entry-content">
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'scalia' ); ?></p>
			<div class="search-form-block"><?php get_search_form(); ?></div>
		</div><!-- .entry-content -->
	</div>
</div>

</div><!-- #main-content -->

<?php
get_footer();