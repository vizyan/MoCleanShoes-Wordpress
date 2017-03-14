<?php
/**
	Template Name: Contact
 */

get_header(); ?>

	<div id="content">
    		<div class="site-aligner">
            		<?php if( have_posts() ) :
							while( have_posts() ) : the_post(); ?>
                            	<h1 class="entry-title"><?php the_title(); ?></h1>
                                <div class="entry-contact">
                                			<?php the_content(); ?>
                                </div><!-- entry-contact -->
                      		<?php endwhile; else : endif; ?>
            </div><!-- site-aligner -->
    </div><!-- content -->
<?php get_footer(); ?>