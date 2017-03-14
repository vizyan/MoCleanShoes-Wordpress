<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Bakery
 */
?>
<footer id="footer">
	<div class="site-aligner">
    		<div class="widget-column">
            <div class="cols"><h2><?php echo get_theme_mod('contact_title',__('Our Location','skt_bakery')); ?></h2>
                <?php if( get_theme_mod('contact_desc') ) { ?>
                    <p><?php echo get_theme_mod('contact_desc',__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','skt_bakery')); ?></p>
                <?php } ?>
                <div class="spacer40"></div>
                <?php if( get_theme_mod('contact_no')){ ?>
                    <div class="foot-label"><?php _e('Call for Reservation : ','skt_bakery'); ?></div><div class="add-content"><?php echo get_theme_mod('contact_no',__('+9876543210','skt_bakery')); ?></div><div class="clear"></div>
                <?php } ?>
                <?php if( get_theme_mod('contact_mail')){ ?>
                    <div class="foot-label"><?php _e('E-mail : ','skt_bakery'); ?></div><div class="mail-content"><a href="mailto:<?php echo get_theme_mod('contact_mail','contact@company.com'); ?>"><?php echo get_theme_mod('contact_mail','contact@company.com'); ?></a></div><!-- mail-content --><div class="clear"></div>
                <?php } ?>
                <div class="clear"></div>
                <div class="social">
                        <?php if ( get_theme_mod('fb_link') != "") { ?>
                         <a target="_blank" href="<?php echo esc_url(get_theme_mod('fb_link','#facebook')); ?>" title="Facebook" ><div class="fb icon"></div></a>
                         <?php } ?>
                        <?php if ( get_theme_mod('twitt_link') != "") { ?>
                         <a target="_blank" href="<?php echo esc_url(get_theme_mod('twitt_link','#twitter')); ?>" title="Twitter" ><div class="twitt icon"></div></a>
                         <?php } ?>
                         <?php if ( get_theme_mod('gplus_link') != "") { ?>
                         <a target="_blank" href="<?php echo esc_url(get_theme_mod('gplus_link','#gplus')); ?>" title="Google Plus" ><div class="gplus icon"></div></a>
                         <?php } ?>
                         <?php if ( get_theme_mod('linked_link') != "") { ?>
                         <a target="_blank" href="<?php echo esc_url(get_theme_mod('linked_link','#linkedin')); ?>" title="Linkedin" ><div class="linkedin icon"></div></a>
                         <?php } ?>
                         
                </div>
            </div><!-- cols -->
       </div><!-- widget-column -->
       <div class="widget-column">
                <div class="cols"><h2><?php _e('Our Menu','skt_bakery'); ?></h2>
                   <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                </div><!-- cols -->
        </div><!-- widget-column -->
        <div class="widget-column">
            <div class="cols"><h2><?php _e('Latest Posts','skt_bakery'); ?></h2>
	<?php $args = array( 'posts_per_page' => 6, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
			query_posts( $args ); ?>
				<ul class="recent-post">
                	<?php query_posts('post_type=post&posts_per_page=3'); ?>
					<?php if ( have_posts() ) : ?>
                    <?php  while( have_posts() ) : the_post(); ?>
                  	<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(59,51)); ?><?php the_title();?></a><br/><?php echo skt_bakery_content(10); ?></li>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <li><a href="#"><img width="51" height="51" src="<?php echo get_template_directory_uri(); ?>/images/creamy-cake.jpg">Lorem ipsum dolor sit amet</a><br><p>Sed nec pellentesque lacus. Aliqu aliquet leo eget metus</p></li><li><a href="#"><img width="51" height="51" src="<?php echo get_template_directory_uri(); ?>/images/nws1.jpg">Lorem ipsum dolor sit amet</a><br><p>Sed nec pellentesque lacus. Aliqu aliquet leo eget metus</p></li><li><a href="#"><img width="51" height="51" src="<?php echo get_template_directory_uri(); ?>/images/nws3.jpg">Lorem ipsum dolor sit amet</a><br><p>Sed nec pellentesque lacus. Aliqu aliquet leo eget metus</p></li>
                    <?php endif; ?>
                </ul>
                </div><!-- cols -->
        </div><!-- widget-column -->
        <div class="widget-column last">
       		<?php if(!dynamic_sidebar('twitter-wid')) : ?>
                <div class="cols"><h2><?php _e('Twitter Feed','skt_bakery'); ?></h2>
                   <p><?php _e('Use twitter widget for twitter feed.','skt_bakery'); ?></p>
                </div><!-- cols -->
            <?php endif; ?>
        </div><!-- widget-column --><div class="clear"></div>
	</div><!-- site-aligner -->
</footer>
<div id="copyright">
	<div class="site-aligner">
    	<div class="right"><?php echo skt_bakery_by(); ?></div>
        <div class="clear"></div>
    </div>
</div><!-- copyright -->
</div><!-- wrapper -->
<?php wp_footer(); ?>
</body>
</html>