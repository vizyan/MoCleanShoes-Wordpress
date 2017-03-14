<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Interior Lite
 */
get_header(); ?>
<?php if (is_front_page() && !is_home()) { ?>
<?php
$hideboxes = get_theme_mod('hide_boxes', '1');
if( $hideboxes == ''){
?>
<section id="wrapfirst">
  <div class="container"> 
       <?php
		$section_title = get_theme_mod('section_title');
		 if( !empty($section_title) ){ ?>
                <h2 class="section_title"><?php echo $section_title; ?></h2>              
		<?php } ?>
      <?php for($p=1; $p<5; $p++) { ?>
      <?php if( get_theme_mod('page-column'.$p,false)) { ?>
      <?php $queryxxx = new WP_query('page_id='.get_theme_mod('page-column'.$p,true)); ?>
      <?php while( $queryxxx->have_posts() ) : $queryxxx->the_post(); ?>
      <div class="fourbox <?php if($p % 4 == 0) { echo "last_column"; } ?>"> 
        <a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail();?>
            <h3><?php the_title(); ?></h3>
        </a> 
		<p><?php the_excerpt(); ?></p> 
        <a class="MoreLink" href="<?php the_permalink(); ?>">
        <?php esc_attr_e('Read More','interior-lite'); ?>
        </a> </div>
      <?php endwhile;
      wp_reset_postdata(); ?>
      <?php } } ?>
    <div class="clear"></div>
  </div><!-- container -->
</section><!-- #wrapfirst -->
<?php } ?>
<?php  } ?>
<div class="container">
     <div class="page_content">
        <section class="site-main">
        	 <div class="blog-post">
					<?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                    
                        endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => __( 'Back', 'interior-lite' ),
							'next_text' => __( 'Next', 'interior-lite' ),
						) );
                    
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    
                    endif;
                    ?>
                    </div><!-- blog-post -->
             </section>
      
        <?php get_sidebar();?>     
        <div class="clear"></div>
    </div><!--.page_content -->
</div><!-- .container -->
<?php get_footer(); ?>