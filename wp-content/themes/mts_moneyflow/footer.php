<?php $mts_options = get_option(MTS_THEME_NAME);
// default = 3
$first_footer_num  = empty($mts_options['mts_first_footer_num']) ? 3 : $mts_options['mts_first_footer_num'];
?>
	</div><!--#page-->
<footer id="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
	<div class="container">
		<div class="footerTop">
			<div class="footer-logo">
				<?php if ($mts_options['mts_footer_logo'] != '') { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h1 id="footer-logo" class="logo image-logo">
								<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_attr( $mts_options['mts_footer_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="footer-logo" class="logo image-logo">
								<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_attr( $mts_options['mts_footer_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
							</h2><!-- END #logo -->
					<?php } ?>
				<?php } else { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h1 id="footer-logo" class="logo text-logo">
								<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="footer-logo" class="logo text-logo">
								<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
							</h2><!-- END #logo -->
					<?php } ?>
				<?php } ?>			
			</div>
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
		<?php if ($mts_options['mts_first_footer']) : ?>
			<div class="footer-widgets first-footer-widgets widgets-num-<?php echo $first_footer_num; ?>">
			<?php
			for ( $i = 1; $i <= $first_footer_num; $i++ ) {
				$sidebar = ( $i == 1 ) ? 'footer-first' : 'footer-first-'.$i;
				$class = ( $i == $first_footer_num ) ? 'f-widget last f-widget-'.$i : 'f-widget f-widget-'.$i;
				?>
				<div class="<?php echo $class;?>">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) ) : ?><?php endif; ?>
					<?php if($i==1) { 
						mts_copyrights_credit(); 
					} ?>
				</div>
				<?php
			}
			?>
			</div><!--.first-footer-widgets-->
		<?php endif; ?>
	</div><!--.container-->
</footer><!--#site-footer-->
<?php mts_footer(); ?>
</div><!--.main-container-->
<?php wp_footer(); ?>
</body>
</html>
