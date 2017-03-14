<?php
/**
 * The template for displaying the footer
 */
?>

		</div><!-- #main -->


		<?php if(scalia_get_option('footer_active')) : ?>

		<footer id="footer-nav" class="site-footer">
			<div class="container"><div class="row">

				<div class="col-md-8 col-xs-12">
					<?php if(has_nav_menu('footer')) : ?>
					<nav id="footer-navigation" class="site-navigation footer-navigation sc-list sc-list-color-7" role="navigation">
						<?php wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'nav-menu styled clearfix', 'container' => false, 'walker' => new scalia_walker_footer_nav_menu)); ?>
					</nav>
					<?php endif; ?>
				</div>

				<div class="col-md-4 col-xs-12">
					<?php
						$socials_icons = array('twitter' => scalia_get_option('twitter_active'), 'facebook' => scalia_get_option('facebook_active'), 'linkedin' => scalia_get_option('linkedin_active'), 'googleplus' => scalia_get_option('googleplus_active'), 'stumbleupon' => scalia_get_option('stumbleupon_active'), 'rss' => scalia_get_option('rss_active'));
						if(in_array(1, $socials_icons)) : ?>
						<div id="footer-socials" class="socials">
								<?php foreach($socials_icons as $name => $active) : ?>
									<?php if($active) : ?>
										<div class="footer-socials-item <?php echo esc_attr($name); ?>"><a href="<?php echo esc_url(scalia_get_option($name . '_link')); ?>" target="_blank" title="<?php echo esc_attr($name); ?>"><?php echo $name; ?></a></div>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php do_action('scalia_footer_socials'); ?>
						</div><!-- #footer-socials -->
					<?php endif; ?>
				</div>
			</div></div>

		</footer><!-- #footer-nav -->

		<?php if(is_active_sidebar('footer-widget-area') || scalia_get_option('footer_html')) : ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<?php get_sidebar('footer'); ?>
				<div class="row"><div class="col-md-4 col-xs-12"><div class="footer-site-info"><?php echo do_shortcode(nl2br(strip_tags(stripslashes(scalia_get_option('footer_html'))))); ?></div></div></div>
			</div>
		</footer><!-- #colophon -->
		<?php endif; ?>
		<?php endif; ?>

	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>

</html>