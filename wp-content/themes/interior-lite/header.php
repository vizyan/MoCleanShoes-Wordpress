<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Interior Lite
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php 
  		$hideslide = get_theme_mod('hide_slides', '1');
	?>  
  <div class="header <?php if ( ! is_front_page() or $hideslide != '' ) { ?>innerpage<?php } ?>">
  <div class="container">
    <div class="logo">
	<?php interior_lite_the_custom_logo(); ?>
    <div class="clear"></div>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <h1><?php bloginfo('name'); ?></h1>
    <span class="tagline"><?php bloginfo( 'description' ); ?></span>                          
    </a>
     </div><!-- logo -->
    <div class="header-right">
    <?php
    $contact_mail = get_theme_mod('contact_mail');
	$contact_no = esc_attr(get_theme_mod('contact_no'));
	?>
     <?php 
		if( !empty($contact_mail) || !empty($contact_no) ){ ?>
     <div class="phoneemail">
     <?php 
		if( !empty($contact_mail) ){ ?>
          <a href="mailto:<?php echo antispambot( sanitize_email( $contact_mail ) ); ?>"><?php echo antispambot( sanitize_email( $contact_mail ) ); ?></a>			
	 <?php } ?>
     <?php
		 if( !empty($contact_no) ){ ?>
          <span><?php echo $contact_no; ?></span>        
	  	 <?php } ?> 

     </div>
     <?php } ?>
    <div class="toggle"> <a class="toggleMenu" href="<?php echo esc_url('#');?>">
      <?php esc_attr_e('Menu','interior-lite'); ?>
      </a> </div> <!-- toggle -->
    <div class="sitenav">
      <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
    </div><!-- site-nav -->
    </div>
    <div class="clear"></div>    
  </div><!-- container -->
</div><!--.header -->
<?php if (is_front_page() && !is_home()) { ?>
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

<?php if($hideslide == ''){ ?>
<?php if(!empty($id_arr)){ ?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
      <?php 
	$i=1;
	foreach($img_arr as $url){ ?>
      <img src="<?php echo esc_url($url);?>" title="#slidecaption<?php echo $i; ?>" />
      <?php $i++; }  ?>
    </div>
		<?php 
        $i=1;
        foreach($id_arr as $id){ 
        $title = get_the_title( $id ); 
        $post = get_post($id); 
        ?>
    <div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
      <div class="slide_info">
        <h2><?php echo $title; ?></h2>
      </div>
    </div>
    <?php $i++; } ?>
  </div>
  <div class="clear"></div>
</section>
<?php } } } ?>