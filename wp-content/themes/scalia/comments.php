<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

	<h3 class="comments-title">
		<?php
			printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'scalia' ), number_format_i18n( get_comments_number() ));
		?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'scalia' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'scalia' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'scalia' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<div class="comment-list">
		<?php if(shortcode_exists('sc_divider')) { echo do_shortcode('[sc_divider style="1" color="'.esc_attr(scalia_get_option('divider_default_color') ? scalia_get_option('divider_default_color') : '').'"]'); } ?>
		<?php
			wp_list_comments( array(
				'style'      => 'div',
				'short_ping' => true,
				'avatar_size'=> 50,
				'callback' => 'scalia_comment'
			) );
		?>
	</div><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'scalia' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'scalia' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'scalia' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'scalia' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

<?php
	$comments_form_args = array(
		'fields' => array(
			'author' => '<p><input type="text" name="author" id="comment-author" value="'.esc_attr($comment_author).'" size="22" tabindex="1"'.($req ? ' aria-required="true"' : '').' /> <label for="comment-author">'.__('Name', 'scalia').($req ? __(' <em>(required)</em>', 'scalia') : '').'</label></p>',
			'email' => '<p><input type="text" name="email" id="comment-email" value="'.esc_attr($comment_author_email).'" size="22" tabindex="2"'.($req ? ' aria-required="true"' : '').' /> <label for="comment-email">'.__('Mail', 'scalia').($req ? __(' <em>(required)</em>', 'scalia') : '').'</label></p>',
			'url' => '<p><input type="text" name="url" id="comment-url" value="'.esc_attr($comment_author_url).'" size="22" tabindex="3" /> <label for="comment-url"> '.__('Website', 'scalia').'</label></p>'
		),
		'comment_notes_after' => '',
		'comment_notes_before' => '',
		'comment_field' => '<p><label for="comment">'.__('Your Message', 'scalia').'</label><br/><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>',
		'must_log_in' => '<p>'.sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )).'</p>',
		'logged_in_as' => '<p>'.sprintf(__('Logged in as <a href="%1$s">%2$s</a>.', 'scalia'), get_edit_user_link(), $user_identity).' <a href="'.wp_logout_url(get_permalink()).'" title="'.esc_attr__('Log out of this account', 'scalia').'">'.__('Log out &raquo;', 'scalia').'</a></p>',
		'label_submit' => __('Send Comment', 'scalia'),
		'title_reply' => __('Leave a reply', 'scalia'),
		'title_reply_to' => __('Comment to %s', 'scalia'),
		'must_log_in' => sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )),
	);
	comment_form($comments_form_args);
?>

</div><!-- #comments -->
