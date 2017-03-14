<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SKT Bakery
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(''); ?>>
<div id="wrapper">
<?php if ( is_front_page() && is_home() ) { ?>
<!-- Slider Section -->
<?php for($sld=7; $sld<10; $sld++) { ?>
<?php if( get_theme_mod('page-setting'.$sld)) { ?>
<?php $slidequery = new WP_query('page_id='.get_theme_mod('page-setting'.$sld,true)); ?>
<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
$img_arr[] = $image;
$id_arr[] = $post->ID;
endwhile;
}
}
?>
<?php if(!empty($id_arr)){ ?>
<section id="home_slider">
<div class="slider-wrapper theme-default">
<div id="slider" class="nivoSlider">
	<?php 
	$i=1;
	foreach($img_arr as $url){ ?>
    <img src="<?php echo $url; ?>" title="#slidecaption<?php echo $i; ?>" />
    <?php $i++; }  ?>
</div>   
<?php 
$i=1;
foreach($id_arr as $id){ 
$title = get_the_title( $id ); 
$post = get_post($id); 
$content = apply_filters('the_content', substr(strip_tags($post->post_content), 0, 380)); 
?>                 
<div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
<div class="slide_info">
<h1><?php echo $title; ?></h1>
<p><?php echo $content; ?></p>
<div class="clear"></div>
<div class="slide_more"><a href="<?php the_permalink(); ?>">Discover More</a></div>
</div>
</div>      
<?php $i++; } ?>       
 </div>
<div class="clear"></div>        
</section>
<?php } else { ?>
<section id="home_slider">
<div class="slider-wrapper theme-default"><div id="slider" class="nivoSlider">
<img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider1.jpg" alt="We Create Delicious Memories " title="#slidecaption1" /><img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider2.jpg" alt="Candle Ready Cakes " title="#slidecaption2" /><img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider3.jpg" alt="Delicious Cookies " title="#slidecaption3" /></div>                    
                <div id="slidecaption1" class="nivo-html-caption">
                    <div class="slide_info">
                            <h1><?php echo 'We Create Delicious Memories';?></h1>
                            <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis malesuada ex non magna convallis aliquam. Nulla ullamcorper elit a ante ullamcorper, nec malesuada massa commodo. In ut nisi nisl. Nullam porta fringilla purus, quis mollis enim tincidunt ut. Praesent vitae lacus ligula.'; ?> </p>
                            <div class="clear"></div>
                            <div class="slide_more"><a href="#link1"><?php echo 'Discover More'; ?></a></div>
                    </div>
                    </div><div id="slidecaption2" class="nivo-html-caption">
                    <div class="slide_info">
                            <h1><?php echo 'Candle Ready Cakes'; ?></h1>
                            <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';?></p>
                            <div class="clear"></div>
                            <div class="slide_more"><a href="#link2"><?php echo 'Discover More'; ?></a></div>
                    </div>
                    </div><div id="slidecaption3" class="nivo-html-caption">
                    <div class="slide_info">
                            <h1><?php echo 'Delicious Cookies';?></h1>
                            <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'; ?> </p>
                            <div class="clear"></div>
                            <div class="slide_more"><a href="#link3"><?php echo 'Discover More'; ?></a></div>
                    </div>
                    </div>
</div>
<div class="clear"></div>
</section>
<!-- Slider Section -->
<?php 
} 
  }
  elseif ( is_front_page() ) { 
?>
<!-- Slider Section -->
<?php for($sld=7; $sld<10; $sld++) { ?>
<?php if( get_theme_mod('page-setting'.$sld)) { ?>
<?php $slidequery = new WP_query('page_id='.get_theme_mod('page-setting'.$sld,true)); ?>
<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
$img_arr[] = $image;
$id_arr[] = $post->ID;
endwhile;
}
}
?>
<?php if(!empty($id_arr)){ ?>
<section id="home_slider">
<div class="slider-wrapper theme-default">
<div id="slider" class="nivoSlider">
	<?php 
	$i=1;
	foreach($img_arr as $url){ ?>
    <img src="<?php echo $url; ?>" title="#slidecaption<?php echo $i; ?>" />
    <?php $i++; }  ?>
</div>   
<?php 
$i=1;
foreach($id_arr as $id){ 
$title = get_the_title( $id ); 
$post = get_post($id); 
$content = apply_filters('the_content', substr(strip_tags($post->post_content), 0, 380)); 
?>                 
<div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
<div class="slide_info">
<h1><?php echo $title; ?></h1>
<p><?php echo $content; ?></p>
<div class="clear"></div>
<div class="slide_more"><a href="<?php the_permalink(); ?>">Discover More</a></div>
</div>
</div>      
<?php $i++; } ?>       
 </div>
<div class="clear"></div>        
</section>
<?php } else { ?>
<section id="home_slider">
<div class="slider-wrapper theme-default"><div id="slider" class="nivoSlider">
<img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider1.jpg" alt="We Create Delicious Memories " title="#slidecaption1" /><img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider2.jpg" alt="Candle Ready Cakes " title="#slidecaption2" /><img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider3.jpg" alt="Delicious Cookies " title="#slidecaption3" /></div>                    
                <div id="slidecaption1" class="nivo-html-caption">
                    <div class="slide_info">
                            <h1><?php echo 'We Create Delicious Memories';?></h1>
                            <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis malesuada ex non magna convallis aliquam. Nulla ullamcorper elit a ante ullamcorper, nec malesuada massa commodo. In ut nisi nisl. Nullam porta fringilla purus, quis mollis enim tincidunt ut. Praesent vitae lacus ligula.'; ?> </p>
                            <div class="clear"></div>
                            <div class="slide_more"><a href="#link1"><?php echo 'Discover More'; ?></a></div>
                    </div>
                    </div><div id="slidecaption2" class="nivo-html-caption">
                    <div class="slide_info">
                            <h1><?php echo 'Candle Ready Cakes'; ?></h1>
                            <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';?></p>
                            <div class="clear"></div>
                            <div class="slide_more"><a href="#link2"><?php echo 'Discover More'; ?></a></div>
                    </div>
                    </div><div id="slidecaption3" class="nivo-html-caption">
                    <div class="slide_info">
                            <h1><?php echo 'Delicious Cookies';?></h1>
                            <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'; ?> </p>
                            <div class="clear"></div>
                            <div class="slide_more"><a href="#link3"><?php echo 'Discover More'; ?></a></div>
                    </div>
                    </div>
</div>
<div class="clear"></div>
</section>
<!-- Slider Section -->
<?php }  } elseif ( is_home() ) { ?>
<?php /*?>        <div class="spacer40"></div>
        <div class="spacer80"></div><?php */?>
        <section id="home_slider" style="display:none;"></section>
        <?php } ?>
        <?php if ( is_front_page() && is_home() ) { ?>
		<div class="headerhome">
        <?php }elseif ( is_front_page() ) { ?>
        <div class="headerhome">
        <?php }else{?>
        <div class="header">
        <?php
		}?>
        <div class="site-aligner">
            <div class="logo">
                        <h2><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h2>
                        <p><?php bloginfo('description'); ?></p>
            </div><!-- logo -->
            <div class="mobile_nav"><a href="#"><?php _e('Go To...','skt_bakery'); ?></a></div>
            <div class="site-nav">
                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
            </div><!-- site-nav --><div class="clear"></div>
        </div><!-- site-aligner -->
        </div>
<?php /*?>        <?php if ( is_home() || is_front_page() ) {?>
		<div class="spacer40"></div>
        <?php } else { ?>
        <div class="spacer80"></div>
        <?php
		}?><?php */?>
<?php if ( is_front_page() && is_home() ) { ?>
<div class="feature-box-main site-aligner">
 		<?php 
		/*Home Section Content*/
		if( get_theme_mod('page-setting1')) { 
		$queryvar = new WP_query('page_id='.get_theme_mod('page-setting1' ,true)); 
		while( $queryvar->have_posts() ) : $queryvar->the_post();
		?> 
		<h2><?php the_title(); ?></h2>
        <?php the_content(); 
		endwhile; } else { ?>
        <h2><?php echo 'Pleasure and Taste in One Place'; ?></h2>
        <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis malesuada ex non magna convallis aliquam. Nulla ullamcorper elit a ante ullamcorper, nec malesuada <br> massa commodo. In ut nisi nisl. Nullam porta fringilla purus, quis mollis enim tincidunt ut. Praesent vitae lacus ligula. Aliquam efficitur pharetra mauris, in molestie arcu<br> efficitur ornare. Vivamus sed finibus felis, nec cursus lorem.';?></p>
        <?php 
		}
		/*Home Section Content*/
		?>		        
        <div class="clear"></div>
		<?php
        /* Home Four Boxes */
        for($bx=2; $bx<6; $bx++) { 
		if( get_theme_mod('page-setting'.$bx)) { 
		$bxquery = new WP_query('page_id='.get_theme_mod('page-setting'.$bx,true)); 
		while( $bxquery->have_posts() ) : $bxquery->the_post(); ?>
        <a href="<?php the_permalink(); ?>"><div class="feature-box">
            <?php the_post_thumbnail(); ?>
            <h2><?php the_title(); ?></h2>
            <?php echo skt_bakery_content(16); ?>
        </div></a>
        <!-- feature-box -->
        <?php if($bx%5==0) { ?>
        <div class="clear"></div>
        <?php } ?>
        <?php endwhile;  
		wp_reset_query(); ?>
        <?php } else { ?>
        <a href="#"><div class="feature-box <?php if($bx%5==0){ ?>last<?php } ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon<?php echo $bx; ?>.jpg" />
            <h2><?php _e('Page Title','skt_bakery'); ?><?php echo $bx-1; ?></h2>
            <p><?php _e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis malesuada ex non magna convallis aliquam','skt_bakery');?></p>
        </div></a>
        <!-- feature-box -->
        <?php if($bx%5==0) { ?>
        <div class="clear"></div>
        <?php
            }  
            } 
            }
        /* Home Four Boxes */	
        ?>
		</div>
<?php
}
elseif ( is_front_page() ) { 
?>
<div class="feature-box-main site-aligner">
 		<?php 
		/*Home Section Content*/
		if( get_theme_mod('page-setting1')) { 
		$queryvar = new WP_query('page_id='.get_theme_mod('page-setting1' ,true)); 
		while( $queryvar->have_posts() ) : $queryvar->the_post();
		?> 
		<h2><?php the_title(); ?></h2>
        <?php the_content(); 
		endwhile; } else { ?>
        <h2><?php echo 'Pleasure and Taste in One Place'; ?></h2>
        <p><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis malesuada ex non magna convallis aliquam. Nulla ullamcorper elit a ante ullamcorper, nec malesuada <br> massa commodo. In ut nisi nisl. Nullam porta fringilla purus, quis mollis enim tincidunt ut. Praesent vitae lacus ligula. Aliquam efficitur pharetra mauris, in molestie arcu<br> efficitur ornare. Vivamus sed finibus felis, nec cursus lorem.';?></p>
        <?php 
		}
		/*Home Section Content*/
		?>		        
        <div class="clear"></div>
		<?php
        /* Home Four Boxes */
        for($bx=2; $bx<6; $bx++) { 
		if( get_theme_mod('page-setting'.$bx)) { 
		$bxquery = new WP_query('page_id='.get_theme_mod('page-setting'.$bx,true)); 
		while( $bxquery->have_posts() ) : $bxquery->the_post(); ?>
        <a href="<?php the_permalink(); ?>"><div class="feature-box">
            <?php the_post_thumbnail(); ?>
            <h2><?php the_title(); ?></h2>
            <?php echo skt_bakery_content(16); ?>
        </div></a>
        <!-- feature-box -->
        <?php if($bx%5==0) { ?>
        <div class="clear"></div>
        <?php } ?>
        <?php endwhile;  
		wp_reset_query(); ?>
        <?php } else { ?>
        <a href="#"><div class="feature-box <?php if($bx%5==0){ ?>last<?php } ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon<?php echo $bx; ?>.jpg" />
            <h2><?php _e('Page Title','skt_bakery'); ?><?php echo $bx-1; ?></h2>
            <p><?php _e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis malesuada ex non magna convallis aliquam','skt_bakery');?></p>
        </div></a>
        <!-- feature-box -->
        <?php if($bx%5==0) { ?>
        <div class="clear"></div>
        <?php
            }  
            } 
            }
        /* Home Four Boxes */	
        ?>
		</div>
<?php
}
elseif ( is_home() ) {
?>
<div class="feature-box-main site-aligner" style="display:none;"></div>
<?php
}
?>