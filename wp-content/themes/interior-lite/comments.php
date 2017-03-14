<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to interior_lite_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package SKT Interior Lite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title"><?php _e('Comments', 'interior-lite'); ?> <?php comments_number('0', '1', '%' );?></h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_attr_e( 'Comment navigation', 'interior-lite' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_attr_e( '&larr; Older Comments', 'interior-lite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_attr_e( 'Newer Comments &rarr;', 'interior-lite' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use interior_lite_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define interior_lite_comment() and that will be used instead.
				 * See interior_lite_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'interior_lite_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_attr_e( 'Comment navigation', 'interior-lite' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_attr_e( '&larr; Older Comments', 'interior-lite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_attr_e( 'Newer Comments &rarr;', 'interior-lite' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php echo esc_attr_e( 'Comments are closed.', 'interior-lite' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->