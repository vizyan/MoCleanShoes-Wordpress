<!DOCTYPE html>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body id="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage"> 
	<?php $home_banner = !empty( $mts_options['mts_custom_slider'] ) ? 'home-banner' : ''; ?>
	<header id="site-header" class="<?php echo $home_banner; ?>" role="banner" itemscope itemtype="http://schema.org/WPHeader">
		<?php if(!empty( $mts_options['mts_custom_slider'] )){ ?>
			<div class="header-con"></div>		
		<?php } ?>
		<?php if( $mts_options['mts_sticky_nav'] == '1' ) { ?>
			<div id="catcher" class="clear" ></div>
			<div class="sticky-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<?php } ?>  
		<div class="container">
			<div id="header">
				<div class="logo-wrap">
					<?php if ($mts_options['mts_logo'] != '') { ?>
						<?php if( is_front_page() || is_home() || is_404() ) { ?>
								<h1 id="logo" class="logo image-logo" itemprop="headline">
									<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_attr( $mts_options['mts_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
								</h1><!-- END #logo -->
						<?php } else { ?>
							  <h2 id="logo" class="logo image-logo" itemprop="headline">
									<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_attr( $mts_options['mts_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
								</h2><!-- END #logo -->
						<?php } ?>
					<?php } else { ?>
						<?php if( is_front_page() || is_home() || is_404() ) { ?>
								<h1 id="logo" class="logo text-logo" itemprop="headline">
									<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
								</h1><!-- END #logo -->
						<?php } else { ?>
							  <h2 id="logo" class="logo text-logo" itemprop="headline">
									<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
								</h2><!-- END #logo -->
						<?php } ?>
					<?php } ?>
				</div>
				<?php if ( $mts_options['mts_show_secondary_nav'] == '1' ) { ?>
				<div id="secondary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<a href="#" id="pull" class="toggle-mobile-menu"><?php _e('Menu','mythemeshop'); ?></a>
					<nav class="navigation clearfix mobile-menu-wrapper">
						<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
						<?php } else { ?>
							<ul class="menu clearfix">
								<?php wp_list_categories('title_li='); ?>
							</ul>
						<?php } ?>
					</nav>
				</div>  
				<?php } ?>            
			</div><!--#header-->
		</div><!--.container-->

		<?php if( $mts_options['mts_sticky_nav'] == '1' ) { ?>
			</div>
		<?php } ?>  

        <?php if ( !is_paged() ) {
            $bg_cover_class = $style = '';
            $style = 'style="';
            $style .=  !empty ( $mts_options['mts_homepage_slider_background_color'] ) ? 'background-color: '. $mts_options['mts_homepage_slider_background_color'] . ';' : '';
            $style .= '"';

            $arrow_hide_class = '';

            if(!empty($mts_options['mts_custom_slider'])){
            	$arrow_hide_class = (count($mts_options['mts_custom_slider']) == 1) ? 'hide-arrow' : '';
            }

			if ( is_home() && !empty( $mts_options['mts_custom_slider'] ) ) { ?>
            	<div id="home-slider" class="<?php echo $arrow_hide_class; ?> bg-slider<?php echo $bg_cover_class; ?>  slider-container loading has-<?php echo count($mts_options['mts_custom_slider']); ?>-slides" <?php echo $style; ?>>

	                <?php if(!empty($mts_options['mts_custom_slider'])){
	                	foreach( $mts_options['mts_custom_slider'] as $slide ) :
			                $image_url    = $slide['mts_custom_slider_image'];
			                $slide_title  = $slide['mts_custom_slider_title'];
			                $slider_text  = $slide['mts_custom_slider_text'];
			                $button_text  = $slide['mts_custom_button_text']; 
			                $button_url  = isset($slide['mts_custom_button_url']) ? $slide['mts_custom_button_url'] : '';
			                $bg_css = 'style="';

			                if(!empty($image_url)){
			                	$bg_css .= 'background-image: url('.$image_url.');';
			                }

			                $bg_css .= '"'; ?>
			                <div class="home-slide slide bg-slide clearfix " <?php echo $bg_css; ?> >
			                    <div class="home-slide-content">
			                        <?php if ( !empty( $slide_title ) ) { ?>
				                        <h2 class="home-slide-title">
				                            <?php echo $slide_title; ?>
				                        </h2>
			                        <?php }

			                        if ( !empty( $slider_text ) ) { ?>
			                        	<p><?php echo $slider_text; ?></p>
			                        <?php }

			                        if ( !empty( $button_text ) ) {
			                        	if(!empty($button_url)){
			                        		echo '<a href="'.$button_url.'" class="slide-button">'.$button_text.'</a>';
			                        	}
			                        } ?>
			                    </div><!-- .home-slide-content -->
			                </div><!-- .home-slide -->
	                	<?php endforeach;
	                } ?>
	            </div><!-- #home-slider -->
	            <span class="arrow-scroll"><a href="#main-container" title"<?php esc_attr(_e('Scroll down','mythemeshop')); ?>"><i class="fa fa-angle-double-down"></i></a></span>

            <?php }
        }

        if(is_page_template('page-blog.php') && !is_paged()){ ?>
			<div class="blog-banner">
				<div class="container">
					<?php if(!empty($mts_options['mts_blog_banner_heading']) || !empty($mts_options['mts_blog_banner_subtitle'])) { ?>
						<div class="blog-content">
							<h2 class="title"><?php echo $mts_options['mts_blog_banner_heading']; ?></h2>
							<p><?php echo $mts_options['mts_blog_banner_subtitle']; ?></p>
						</div>
					<?php } 

		            $slider_cat = isset($mts_options['mts_blog_slider_cat']) ? $mts_options['mts_blog_slider_cat'] : '';

		            //Slider query arguement, if you won't select any categories it loads latest posts
		            if(!empty($slider_cat)){
		                $cat = implode(', ', $slider_cat);
		                $query = new WP_Query('cat='.$cat.'&posts_per_page=5');
		            }
		            else{
		                $query = new WP_Query('orderby=date&order=desc&posts_per_page=5');
		            }

		            echo '<div class="slider-nav loading slider-container">';
		                if ( $query->have_posts() ) :
		                    while ( $query->have_posts() ) : $query->the_post();

		                        $thumb = array( 'width' => 66, 'height' => 50, 'crop' => true );
		                        $full = array( 'width' => 730, 'height' => 355, 'crop' => true );

		                        if(has_post_thumbnail()){
		                            $image_id = get_post_thumbnail_id ();
		                            $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
		                            $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
		                            $full_src = bfi_thumb($image_thumb_url[0], $full );
		                        }
		                        else{
		                            $thumb_src = get_template_directory_uri().'/images/nothumb-widgetthumb.png';
		                            $full_src = get_template_directory_uri().'/images/nothumb-sliderfull.png';
		                        }

		                        echo '<div class="slide" data-dot="'.$thumb_src.'">';
		                            echo '<div class="slider-img"><a href="'.esc_url( get_the_permalink() ).'" rel="nofollow"><img src="'. $full_src . '"></a></div>';
		                            	echo '<div class="slider-content">';
		                                	echo '<a href="'.esc_url( get_the_permalink() ).'"><h3 class="title">'.short_title('...', 7).'</h3></a>';
	                                		mts_the_postinfo('blog_slider_top');
		                                	echo '<p>'.mts_excerpt(34).'</p>';
		                                	mts_the_postinfo('blog_slider_bottom');
		                                echo '<div class="btn-wrap clearfix"><a class="button" href="'.esc_url( get_the_permalink() ).'" rel="nofollow">'.__('Read Full Article' , 'mythemeshop').'</a></div>';
		                            echo '</div>';
		                        echo '</div>';
		                    endwhile;
		                endif;
		            echo '</div>'; ?>
		        </div>
	        </div>
        <?php } ?>
	</header>  
	<div class="main-container" id="main-container">