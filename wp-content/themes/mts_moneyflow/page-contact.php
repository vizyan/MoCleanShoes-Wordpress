<?php
/**
 * Template Name: Contact Page
 */
?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="banner-bottom">
    <div class="container clearfix">
        <?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
			<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php mts_the_breadcrumb(); ?></div>
		<?php } ?>

        <?php if($mts_options['mts_lower_menu_search']){ ?>
            <div class="searchTop"><?php echo get_search_form() ?></div>
        <?php } ?>

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
</div>

<div id="page" class="<?php mts_single_page_class(); ?> clearfix">
	<?php $header_animation = mts_get_post_header_effect(); ?>
	<?php if ( 'parallax' === $header_animation ) {?>
		<?php if (mts_get_thumbnail_url()) : ?>
	        <div id="parallax" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div>
	    <?php endif; ?>
	<?php } else if ( 'zoomout' === $header_animation ) {?>
		 <?php if (mts_get_thumbnail_url()) : ?>
	        <div id="zoom-out-effect"><div id="zoom-out-bg" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div></div>
	    <?php endif; ?>
	<?php } ?>
	<article class="<?php mts_article_class(); ?>">
		<div id="content_box" >
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
					<div class="single_page single_post">
						<header>
							<h1 class="title entry-title"><?php the_title(); ?></h1>
						</header>
						<div class="post-content box mark-links entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next','mythemeshop'), 'previouspagelink' => __('Previous','mythemeshop'), 'pagelink' => '%','echo' => 1 )); ?>
							<?php mts_contact_form() ?>
						</div><!--.post-content box mark-links-->
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</article>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>