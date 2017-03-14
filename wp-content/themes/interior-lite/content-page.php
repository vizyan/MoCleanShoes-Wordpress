<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package SKT Interior Lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>		
	</div><!-- .entry-content -->
	<?php edit_post_link(); ?>
</article><!-- #post-## -->
