<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php if(scalia_get_option('favicon')) : ?>
		<link rel="shortcut icon" href="<?php echo scalia_get_option('favicon'); ?>" />
	<?php endif; ?>
	
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<?php
	$body_classes = array();
	if(is_home() && scalia_get_option('home_content_enabled')) {
		$body_classes[] = 'home-constructor';
	}

	$effects_disabled = false;
	if(is_home()) {
		$effects_disabled = scalia_get_option('home_effects_disabled', false);
	} else {
		global $post;
		if(is_object($post)) {
			$scalia_page_data = get_post_meta($post->ID, 'scalia_page_data', true);
			$effects_disabled = isset($scalia_page_data['effects_disabled']) ? (bool) $scalia_page_data['effects_disabled'] : false;
		}
	}
	if($effects_disabled)
		$body_classes[] = 'lazy-disabled';
?>

<body <?php body_class($body_classes); ?>>

<div id="page" class="layout-<?php echo esc_attr(scalia_get_option('page_layout_style', 'fullwidth')); ?>">

	<?php if(!scalia_get_option('disable_scroll_top_button')) : ?>
		<a href="#page" class="scroll-top-button"></a>
	<?php endif; ?>

	<?php if(scalia_get_option('top_area_style')) : ?>
		<div id="top-area" class="top-area top-area-style-<?php echo esc_attr(scalia_get_option('top_area_style')); ?>">
			<div class="container">
				<div class="top-area-items clearfix">
					<?php if(scalia_get_option('top_area_socials')) : ?>
						<div class="top-area-socials"><?php scalia_print_socials(); ?></div>
					<?php endif; ?>
					<?php if(scalia_get_option('top_area_style') == 1) : ?>
						<?php if(scalia_get_option('top_area_search')) : ?>
							<div class="top-area-search"><?php scalia_toparea_search_form(); ?></div>
						<?php endif; ?>
						<?php if(scalia_get_option('top_area_contacts')) : ?>
							<div class="top-area-contacts"><?php echo scalia_contacts(true); ?></div>
						<?php endif; ?>
					<?php else : ?>
						<?php if(scalia_get_option('top_area_contacts')) : ?>
							<div class="top-area-contacts"><?php echo scalia_contacts(true); ?></div>
						<?php endif; ?>
						<?php if(scalia_get_option('top_area_search')) : ?>
							<div class="top-area-search"><?php scalia_toparea_search_form(); ?></div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<header id="site-header" class="site-header<?php echo scalia_get_option('disable_fixed_header') ? '' : ' animated-header'; ?><?php echo scalia_get_option('header_on_slideshow') ? ' header-on-slideshow' : ''; ?>" role="banner">

		<div class="container">
			<div class="header-main logo-position-<?php echo esc_attr(scalia_get_option('logo_position', 'left')); ?>">
				<?php if(scalia_get_option('logo_position', 'left') != 'right') : ?>
				<div class="site-title">
					<h1>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php if(scalia_get_option('logo')) : ?>
								<span class="logo logo-1x"><img src="<?php echo esc_url(scalia_get_option('logo')); ?>" class="default" alt=""><?php if(scalia_get_option('small_logo')) : ?><img src="<?php echo esc_url(scalia_get_option('small_logo')); ?>" class="small" alt=""><?php endif; ?></span>
								<?php if(scalia_get_option('logo_2x')) : ?>
									<span class="logo logo-2x"><img src="<?php echo esc_url(scalia_get_option('logo_2x')); ?>" class="default" alt=""><?php if(scalia_get_option('small_logo_2x')) : ?><img src="<?php echo esc_url(scalia_get_option('small_logo_2x')); ?>" class="small" alt=""><?php endif; ?></span>
								<?php endif; ?>
								<?php if(scalia_get_option('logo_3x')) : ?>
									<span class="logo logo-3x"><img src="<?php echo esc_url(scalia_get_option('logo_3x')); ?>" class="default" alt=""><?php if(scalia_get_option('small_logo_3x')) : ?><img src="<?php echo esc_url(scalia_get_option('small_logo_3x')); ?>" class="small" alt=""><?php endif; ?></span>
								<?php endif; ?>
							<?php else : ?>
								<?php bloginfo('name'); ?>
							<?php endif; ?>
						</a>
					</h1>
				</div>
				<?php if(has_nav_menu('primary')) : ?>
				<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
					<button class="menu-toggle dl-trigger"><?php _e('Primary Menu', 'scalia'); ?></button>
					<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu dl-menu styled no-responsive', 'container' => false, 'walker' => new Scalia_Mega_Menu_Walker)); ?>
				</nav>
				<?php endif; ?>
				<?php else : ?>
				<?php if(has_nav_menu('primary')) : ?>
				<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
					<button class="menu-toggle dl-trigger"><?php _e('Primary Menu', 'scalia'); ?></button>
					<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu dl-menu styled no-responsive', 'container' => false, 'walker' => new Scalia_Mega_Menu_Walker)); ?>
				</nav>
				<?php endif; ?>
				<div class="site-title">
					<h1>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php if(scalia_get_option('logo')) : ?>
								<span class="logo logo-1x"><img src="<?php echo esc_url(scalia_get_option('logo')); ?>" class="default" alt=""><?php if(scalia_get_option('small_logo')) : ?><img src="<?php echo esc_url(scalia_get_option('small_logo')); ?>" class="small" alt=""><?php endif; ?></span>
								<?php if(scalia_get_option('logo_2x')) : ?>
									<span class="logo logo-2x"><img src="<?php echo esc_url(scalia_get_option('logo_2x')); ?>" class="default" alt=""><?php if(scalia_get_option('small_logo_2x')) : ?><img src="<?php echo esc_url(scalia_get_option('small_logo_2x')); ?>" class="small" alt=""><?php endif; ?></span>
								<?php endif; ?>
								<?php if(scalia_get_option('logo_3x')) : ?>
									<span class="logo logo-3x"><img src="<?php echo esc_url(scalia_get_option('logo_3x')); ?>" class="default" alt=""><?php if(scalia_get_option('small_logo_3x')) : ?><img src="<?php echo esc_url(scalia_get_option('small_logo_3x')); ?>" class="small" alt=""><?php endif; ?></span>
								<?php endif; ?>
							<?php else : ?>
								<?php bloginfo('name'); ?>
							<?php endif; ?>
						</a>
					</h1>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</header><!-- #site-header -->

	<div id="main" class="site-main">
