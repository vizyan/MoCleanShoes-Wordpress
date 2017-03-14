<?php get_header(); ?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
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
	<article class="<?php mts_article_class(); ?>">
		<div id="content_box" >
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
					<?php
					// Single post parts ordering
					if ( isset( $mts_options['mts_single_post_layout'] ) && is_array( $mts_options['mts_single_post_layout'] ) && array_key_exists( 'enabled', $mts_options['mts_single_post_layout'] ) ) {
						$single_post_parts = $mts_options['mts_single_post_layout']['enabled'];
					} else {
						$single_post_parts = array( 'content' => 'content', 'author' => 'author' );
					}
					foreach( $single_post_parts as $part => $label ) { 
						switch ($part) {
							case 'content':
								?>
								<div class="single_post">
									<?php $header_animation = mts_get_post_header_effect();
									if ( 'parallax' != $header_animation && 'zoomout' != $header_animation ) {
			                            if(has_post_thumbnail() && !empty($mts_options['mts_single_thumb'])) {
			                            	$thumb = array( 'width' => 770, 'height' => 450, 'crop' => true );
			                                $image_id = get_post_thumbnail_id ();
			                                $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
			                                $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
			                                echo '<div class="featured-thumbnail single-featured"><img src="'.$thumb_src.'" width="'.$thumb['width'].'" height="'.$thumb['height'].'"></div>';
			                            }
				                    } elseif ( 'parallax' === $header_animation ) {?>
										<?php if (mts_get_thumbnail_url()) : ?>
									        <div id="parallax" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div>
									    <?php endif; ?>
									<?php } elseif ( 'zoomout' === $header_animation ) {?>
										 <?php if (mts_get_thumbnail_url()) : ?>
									        <div id="zoom-out-effect"><div id="zoom-out-bg" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div></div>
									    <?php endif; ?>
									<?php } ?>
									<div class="single-post-content">
										<header>
											<h1 class="title single-title entry-title"><?php the_title(); ?></h1>
											<?php mts_the_postinfo( 'single' ); ?>
										</header><!--.headline_area-->
										<div class="post-single-content box mark-links entry-content">
											<?php if ($mts_options['mts_posttop_adcode'] != '') { ?>
												<?php $toptime = $mts_options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
													<div class="topad">
														<?php echo do_shortcode($mts_options['mts_posttop_adcode']); ?>
													</div>
												<?php } ?>
											<?php } ?>
											<?php if (isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] == 'top') mts_social_buttons(); ?>
											<div class="thecontent">
												<?php the_content(); ?>
											</div>
											<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next','mythemeshop'), 'previouspagelink' => __('Previous','mythemeshop'), 'pagelink' => '%','echo' => 1 )); ?>
											<?php if ($mts_options['mts_postend_adcode'] != '') { ?>
												<?php $endtime = $mts_options['mts_postend_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$endtime day")), get_the_time("Y-m-d") ) >= 0) { ?>
													<div class="bottomad">
														<?php echo do_shortcode($mts_options['mts_postend_adcode']); ?>
													</div>
												<?php } ?>
											<?php } ?> 
											<?php if (isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] !== 'top') mts_social_buttons(); ?>
										</div><!--.post-single-content-->
										<?php comments_template( '', true ); ?>
									</div><!--.single_post-->
								</div>
								<?php
							break;

							case 'tags':
								?>
								<?php mts_the_tags('<span class="tagtext">'.__('Tags','mythemeshop').':</span>',', ') ?>
								<?php
							break;

							case 'author':
								?>
								<div class="postauthor">
									<h4><?php _e('About The Author', 'mythemeshop'); ?></h4>
									<div class="postauthor-wrap">
										<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '170' );  } ?>
										<div class="postauthor-content">
											<h5 class="vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="nofollow" class="fn"><?php the_author_meta( 'nickname' ); ?></a></h5>
											<p><?php the_author_meta('description') ?></p>
											<p class="more-author-link"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="nofollow"><?php _e('More from this Author', 'mythemeshop'); ?></a></p>
										</div>
									</div>
								</div>
								<?php
							break;
						}
					} ?>
				</div><!--.g post-->
			<?php endwhile; /* end loop */ ?>
		</div>
	</article>
	<?php get_sidebar(); ?>

	<?php if ( $mts_options['mts_related_posts'] == '1' ) { ?>
		<div class="relatedPost-wrap">
			<?php mts_related_posts(); ?>
		</div>
	<?php } ?>

	<?php //Popular Categories
        if( $mts_options['mts_show_popular_category'] && isset( $mts_options['mts_popular_categories'] ) && !empty($mts_options['mts_popular_categories']) ){ ?>
            <div id="popular-categories">                        
                <h4><?php echo $mts_options['mts_popular_category_title']; ?></h4>
                <ul>
                	<?php $j = 0;
                    foreach ( $mts_options['mts_popular_categories'] as $section ) {
                        $category_id = $section['mts_cc_category'];?>
                       
                       <li class="popular-category home-popular-category-<?php echo $category_id; echo (++$j % 4 == 0) ? ' last' : ''; ?>">
                           <h5 class="title"><a href="<?php echo esc_url( get_category_link( $category_id ) ); ?>" title="<?php echo esc_attr( get_cat_name( $category_id ) ); ?>"><?php echo get_cat_name( $category_id ); ?></a></h5>
                           <?php echo category_description( $category_id ); ?>
                       </li>                              
                        
                	<?php } ?>
                </ul>
            </div>
    <?php } ?>
<?php get_footer(); ?>