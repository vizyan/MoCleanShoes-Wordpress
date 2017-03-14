<?php
/* Template Name: Blog */
get_header(); ?>

<div id="content">
    <div class="site-aligner">
        <section class="site-main content-left" id="sitemain">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	            <header><h1 class="entry-title"><?php the_title(); ?></h1></header>
            <?php endwhile; else: endif; ?>
            <div class="blog-post">
				<?php 
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }
				$query = new WP_Query( array( 'paged' => $paged ) ); ?>
                <?php if( $query->have_posts() ) : ?>
					<?php while( $query->have_posts() ) : $query->the_post(); ?>
	                	<?php get_template_part( 'content', get_post_format() ); ?>
	                <?php endwhile; ?>
					<?php skt_bakery_custom_blogpost_pagination( $query ); ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
	                <?php get_template_part( 'no-results', 'index' ); ?>
                <?php endif; ?>
            </div><!-- blog-post -->
        </section>
        <div class="sidebar_right">
        <?php get_sidebar();?>
        </div><!-- sidebar_right -->
        <div class="clear"></div>
    </div><!-- site-aligner -->
</div><!-- content -->
	
<?php get_footer(); ?>