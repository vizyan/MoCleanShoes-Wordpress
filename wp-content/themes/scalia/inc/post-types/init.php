<?php

function scalia_get_post_data($default = array(), $post_data_name = '', $post_id = 0) {
	$post_data = get_post_meta($post_id, 'scalia_'.$post_data_name.'_data', true);

	if(!is_array($default)) {
		return array();
	}
	if(!is_array($post_data)) {
		return $default;
	}
	return array_merge($default, $post_data);
}

/* PAGE OPTIONS */

/* Additional page options */
add_action('add_meta_boxes', 'scalia_add_page_settings_boxes');
function scalia_add_page_settings_boxes() {
	$post_types = array('post', 'page', 'scalia_pf_item', 'scalia_news');
	foreach($post_types as $post_type) {
		add_meta_box('scalia_page_title', __('Page Title', 'scalia'), 'scalia_page_title_settings_box', $post_type, 'normal', 'high');
		add_meta_box('scalia_page_sidebar', __('Page Sidebar', 'scalia'), 'scalia_page_sidebar_settings_box', $post_type, 'normal', 'high');
		if($post_type == 'page') {
			add_meta_box('scalia_page_blog', __('Page Blog', 'scalia'), 'scalia_page_blog_settings_box', $post_type, 'normal', 'high');
		}
		if(scalia_is_plugin_active('scalia_elements/scalia_elements.php')) {
			add_meta_box('scalia_page_slideshow', __('Page Slideshow', 'scalia'), 'scalia_page_slideshow_settings_box', $post_type, 'normal', 'high');
			add_meta_box('scalia_page_quickfinder', __('Page Quickfinder', 'scalia'), 'scalia_page_quickfinder_settings_box', $post_type, 'normal', 'high');
			add_meta_box('scalia_page_portfolio', __('Page Portfolio', 'scalia'), 'scalia_page_portfolio_settings_box', $post_type, 'normal', 'high');
			add_meta_box('scalia_page_gallery', __('Page Gallery', 'scalia'), 'scalia_page_gallery_settings_box', $post_type, 'normal', 'high');
		}
		add_meta_box('scalia_page_effects', __('Lazy Loading & Bottom Margin Options', 'scalia'), 'scalia_page_effects_settings_box', $post_type, 'normal', 'high');
	}
	add_meta_box('scalia_page_title', __('Page Title', 'scalia'), 'scalia_page_title_settings_box', 'product', 'normal', 'high');
	add_meta_box('scalia_page_sidebar', __('Page Sidebar', 'scalia'), 'scalia_page_sidebar_settings_box', 'product', 'normal', 'high');
}

/* Title box */
function scalia_page_title_settings_box($post) {
	wp_nonce_field('scalia_page_title_settings_box', 'scalia_page_title_settings_box_nonce');
	$page_data = scalia_get_sanitize_page_title_data($post->ID);
	$video_background_types = array('' => __('None', 'scalia'), 'youtube' => __('YouTube', 'scalia'), 'vimeo' => __('Vimeo', 'scalia'), 'self' => __('Self-Hosted Video', 'scalia'));
	$title_styles = array('' => __('None', 'scalia'), '1' => __('Style 1', 'scalia'), '2' => __('Style 2', 'scalia'));
	$icon_styles = array('' => __('None', 'scalia'), 'angle-45deg-l' => __('45&deg; Left','scalia'), 'angle-45deg-r' => __('45&deg; Right','scalia'), 'angle-90deg' => __('90&deg;','scalia'));
	$title_background_image_items = array('01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg', '06.jpg', '07.jpg', '08.jpg', '09.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg', '16.jpg', '17.jpg', '18.jpg');
?>
<table class="settings-box-table" width="100%"><tbody><tr>
	<td>

		<label for="page_title_style"><?php _e('Title Style', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($title_styles, $page_data['title_style'], 'scalia_page_data[title_style]', 'page_title_style'); ?><br />
		<br />
		<label for="page_title_background_image"><?php _e('Background Image', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[title_background_image]" id="page_title_background_image" value="<?php echo esc_attr($page_data['title_background_image']); ?>" class="picture-select" /><br />
		<span id="page_title_background_image_select" style="display: block;">
			<?php foreach($title_background_image_items as $item) : ?>
				<a href="<?php echo esc_url(get_template_directory_uri() . '/images/backgrounds/title/' . $item); ?>" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/images/backgrounds/title/' . $item); ?>')"></a>
			<?php endforeach; ?>
		</span>
		<br />
		<label for="page_title_background_color"><?php _e('Background Color', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[title_background_color]" id="page_title_background_color" value="<?php echo esc_attr($page_data['title_background_color']); ?>" class="color-select" /><br />
		<br />
		<label for="page_title_video_type"><?php _e('Video Background Type', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($video_background_types, esc_attr($page_data['title_video_type']), 'scalia_page_data[title_video_type]', 'page_title_video_type'); ?><br />
		<br />
		<label for="page_title_video"><?php _e('Link to video or video ID (for YouTube or Vimeo)', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[title_video_background]" id="page_title_video_background" value="<?php echo esc_attr($page_data['title_video_background']); ?>" class="video-select" /><br />
		<br />
		<label for="page_title_video_aspect_ratio"><?php _e('Video Background Aspect Ratio (16:9, 16:10, 4:3...)', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[title_video_aspect_ratio]" id="page_title_video_aspect_ratio" value="<?php echo esc_attr($page_data['title_video_aspect_ratio']); ?>" /><br />
		<br />
		<label for="page_title_video_overlay_color"><?php _e('Video Overlay Color', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[title_video_overlay_color]" id="page_title_video_overlay_color" value="<?php echo esc_attr($page_data['title_video_overlay_color']); ?>" class="color-select" /><br />
		<br />
		<label for="page_title_video_overlay_opacity"><?php _e('Video Overlay Opacity (0 - 1)', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[title_video_overlay_opacity]" id="page_title_video_overlay_opacity" value="<?php echo esc_attr($page_data['title_video_overlay_opacity']); ?>" /><br />
		<br />
		<input name="scalia_page_data[title_menu_on_video]" type="checkbox" id="page_title_menu_on_video" value="1" <?php checked($page_data['title_menu_on_video'], 1); ?> />
		<label for="page_title_menu_on_video"><?php _e('Menu on Video Title', 'scalia'); ?></label>
		<br /><br />
		<label for="page_title_text_color"><?php _e('Title Text Color', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[title_text_color]" id="page_title_text_color" value="<?php echo esc_attr($page_data['title_text_color']); ?>" class="color-select" /><br />
		<br />
		<label for="page_title_excerpt_text_color"><?php _e('Excerpt Color', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[title_excerpt_text_color]" id="page_title_excerpt_text_color" value="<?php echo esc_attr($page_data['title_excerpt_text_color']); ?>" class="color-select" /><br />
		<br />
		<label for="page_title_excerpt"><?php _e('Excerpt', 'scalia'); ?>:</label><br />
		<textarea name="scalia_page_data[title_excerpt]" id="page_title_excerpt" style="width: 100%;" rows="3"><?php echo esc_textarea($page_data['title_excerpt']); ?></textarea>
	</td>
	<?php if(scalia_is_plugin_active('scalia_elements/scalia_elements.php')) : ?>
	<td>
		<label for="page_title_icon"><?php _e('Icon', 'scalia'); ?>:</label><br />
		<input name="scalia_page_data[title_icon]" type="text" id="page_title_icon" value="<?php echo esc_attr($page_data['title_icon']); ?>" /><br />
		<?php _e('Enter icon code', 'scalia'); ?>. <a href="<?php echo scalia_user_icons_info_link(); ?>" onclick="tb_show('<?php _e('Icons info', 'scalia'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'scalia'); ?></a><br />
		<br />
		<label for="page_title_icon_color"><?php _e('Icon Color', 'scalia'); ?>:</label><br />
		<input name="scalia_page_data[title_icon_color]" type="text" id="page_title_icon_color" value="<?php echo esc_attr($page_data['title_icon_color']); ?>" class="color-select" /><br />
		<br />
		<label for="page_title_icon_color_2"><?php _e('Icon Color 2', 'scalia'); ?>:</label><br />
		<input name="scalia_page_data[title_icon_color_2]" type="text" id="page_title_icon_color_2" value="<?php echo esc_attr($page_data['title_icon_color_2']); ?>" class="color-select" /><br />
		<br />
		<label for="page_title_icon_style"><?php _e('Icon Style', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($icon_styles, esc_attr($page_data['title_icon_style']), 'scalia_page_data[title_icon_style]', 'page_title_icon_style'); ?><br />
		<br />
		<label for="page_title_icon_background_color"><?php _e('Icon Background Color', 'scalia'); ?>:</label><br />
		<input name="scalia_page_data[title_icon_background_color]" type="text" id="page_title_icon_background_color" value="<?php echo esc_attr($page_data['title_icon_background_color']); ?>" class="color-select" /><br />
		<br />
		<label for="page_title_icon_border_color"><?php _e('Icon Border Color', 'scalia'); ?>:</label><br />
		<input name="scalia_page_data[title_icon_border_color]" type="text" id="page_title_icon_border_color" value="<?php echo esc_attr($page_data['title_icon_border_color']); ?>" class="color-select" /><br />
		<br />
		<label for="page_title_icon_shape"><?php _e('Icon Shape', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input(array('circle' => 'Circle', 'square' => 'Square'), $page_data['title_icon_shape'], 'scalia_page_data[title_icon_shape]', 'page_title_icon_shape'); ?><br />
		<br />
		<label for="page_title_icon_size"><?php _e('Icon Size', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input(array('small' => 'Small', 'medium' => 'Medium', 'big' => 'Big'), $page_data['title_icon_size'], 'scalia_page_data[title_icon_size]', 'page_title_icon_size'); ?>
	</td>
	<?php endif; ?>
</tr></tbody></table>
<script type="text/javascript">
(function($) {
	$(function() {
		$('#page_title_background_image_select a[href="'+$('#page_title_background_image').val()+'"]').addClass('active');
		$('#page_title_background_image_select a').click(function(e) {
			$('#page_title_background_image_select a.active').removeClass('active');
			e.preventDefault();
			$('#page_title_background_image').val($(this).attr('href'));
			$(this).addClass('active');
		});
	});
})(jQuery);
</script>
<?php
}

/* Effects box */
function scalia_page_effects_settings_box($post) {
	wp_nonce_field('scalia_page_effects_settings_box', 'scalia_page_effects_settings_box_nonce');
	$page_data = scalia_get_sanitize_page_effects_data($post->ID);
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<input name="scalia_page_data[effects_disabled]" type="checkbox" id="page_effects_disabled" value="1" <?php checked($page_data['effects_disabled'], 1); ?> />
		<label for="page_effects_disabled"><?php _e('Lazy loading disabled', 'scalia'); ?></label>
	</td>
	<td>
		<input name="scalia_page_data[effects_no_bottom_margin]" type="checkbox" id="page_effects_no_bottom_margin" value="1" <?php checked($page_data['effects_no_bottom_margin'], 1); ?> />
		<label for="page_effects_no_bottom_margin"><?php _e('Disable bottom margin', 'scalia'); ?></label>
	</td>
</tr></tbody></table>
<?php
}

/* Slideshows box */
function scalia_page_slideshow_settings_box($post) {
	wp_nonce_field('scalia_page_slideshow_settings_box', 'scalia_page_slideshow_settings_box_nonce');
	$page_data = scalia_get_sanitize_page_slideshow_data($post->ID);
	$slideshow_types = array('' => __('None', 'scalia'), 'NivoSlider' => 'NivoSlider');
	$slideshows_terms = get_terms('scalia_slideshows', array('hide_empty' => false));
	$slideshows = array('' => __('All Slides', 'scalia'));
	foreach($slideshows_terms as $term) {
		$slideshows[$term->slug] = $term->name;
	}
	$layersliders = array();
	if(scalia_is_plugin_active('LayerSlider/layerslider.php')) {
		$slideshow_types['LayerSlider'] = 'LayerSlider';
		global $wpdb;
		$table_name = $wpdb->prefix . "layerslider";
		$query_results = $wpdb->get_results("SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0' ORDER BY id ASC");
		foreach($query_results as $query_result) {
			$layersliders[$query_result->id] = $query_result->name;
		}
	}
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="page_slideshow_type"><?php _e('Slideshow Type', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($slideshow_types, $page_data['slideshow_type'], 'scalia_page_data[slideshow_type]', 'page_slideshow_type'); ?><br />
		<br />
		<div class="slideshow-select NivoSlider">
			<label for="page_slideshow_slideshow"><?php _e('Select Slideshow', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($slideshows, $page_data['slideshow_slideshow'], 'scalia_page_data[slideshow_slideshow]', 'page_slideshow_slideshow'); ?><br />
		</div>
		<br />
		<?php if(scalia_is_plugin_active('LayerSlider/layerslider.php')) : ?>
			<div class="slideshow-select LayerSlider">
				<label for="page_slideshow_layerslider"><?php _e('Select LayerSlider', 'scalia'); ?>:</label><br />
				<?php scalia_print_select_input($layersliders, $page_data['slideshow_layerslider'], 'scalia_page_data[slideshow_layerslider]', 'page_slideshow_layerslider'); ?><br />
			</div>
		<?php endif; ?>
	</td>
</tr></tbody></table>
<script type="text/javascript">
	(function($) {
		$(function() {
			$('.slideshow-select').hide();
			if($('#page_slideshow_type').val() != '') {
				$('.slideshow-select.'+$('#page_slideshow_type').val()).show();
			}
			$('#page_slideshow_type').change(function() {
				$('.slideshow-select:not(.'+$('#page_slideshow_type').val()+')').slideUp();
				if($('#page_slideshow_type').val() != '') {
					$('.slideshow-select.'+$('#page_slideshow_type').val()).slideDown();
				}
			});
		});
	})(jQuery)
</script>
<?php
}

/* Quickfinders box */
function scalia_page_quickfinder_settings_box($post) {
	wp_nonce_field('scalia_page_quickfinder_settings_box', 'scalia_page_quickfinder_settings_box_nonce');
	$page_data = scalia_get_sanitize_page_quickfinder_data($post->ID);
	$quickfinders_terms = get_terms('scalia_quickfinders', array('hide_empty' => false));
	$quickfinders = array('' => __('All Items', 'scalia'));
	foreach($quickfinders_terms as $term) {
		$quickfinders[$term->slug] = $term->name;
	}
	$quickfinder_positions = array('' => __('None', 'scalia'), 'above' => __('Quickfinder bar above', 'scalia'), 'inside' => __('Inside content', 'scalia'), 'below' => __('Quickfinder bar below', 'scalia'));
	$quickfinder_styles = array('default' => __('Grid View', 'scalia'), 'vertical-1' => __('Vertical Style 1', 'scalia'), 'vertical-2' => __('Vertical Style 2', 'scalia'));
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="page_quickfinder_position"><?php _e('Quickfinder position', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($quickfinder_positions, $page_data['quickfinder_position'], 'scalia_page_data[quickfinder_position]', 'page_quickfinder_position'); ?><br />
		<br />
		<label for="page_quickfinder_style"><?php _e('Quickfinder style', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($quickfinder_styles, $page_data['quickfinder_style'], 'scalia_page_data[quickfinder_style]', 'page_quickfinder_style'); ?>
		<br /><br />
		<input name="scalia_page_data[quickfinder_effects_enabled]" type="checkbox" id="quickfinder_effects_enabled" value="1" <?php checked($page_data['quickfinder_effects_enabled'], 1); ?> />
		<label for="quickfinder_effects_enabled"><?php _e('Lazy loading enabled', 'scalia'); ?></label>
	</td>
	<td>
		<label for="page_quickfinder_quickfinder"><?php _e('Select Quickfinder', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($quickfinders, $page_data['quickfinder_quickfinder'], 'scalia_page_data[quickfinder_quickfinder]', 'page_quickfinder_quickfinder'); ?><br />
		<br />
		<label for="page_quickfinder_connector_color"><?php _e('Vertical Quickfinder Connector Color', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[quickfinder_connector_color]" id="page_quickfinder_connector_color" value="<?php echo esc_attr($page_data['quickfinder_connector_color']); ?>" class="color-select" />
</tr></tbody></table>
<?php
}

function portoliosets_cmp($term1, $term2) {
	$order1 = get_option('portfoliosets_' . $term1->term_id . '_order', 0);
	$order2 = get_option('portfoliosets_' . $term2->term_id . '_order', 0);
	if ($order1 == $order2)
		return 0;
	return $order1 > $order2;
}

/* Portfolios box */
function scalia_page_portfolio_settings_box($post) {
	wp_nonce_field('scalia_page_portfolio_settings_box', 'scalia_page_portfolio_settings_box_nonce');
	$page_data = scalia_get_sanitize_page_portfolio_data($post->ID);
	$portfolios = array('' => __('All Items', 'scalia'));
	if(taxonomy_exists('scalia_portfolios')) {
		$portfolios_terms = get_terms('scalia_portfolios', array('hide_empty' => false));
		usort($portfolios_terms, 'portoliosets_cmp');
		foreach($portfolios_terms as $term) {
			$portfolios[$term->slug] = $term->name;
		}
	}
	$portfolio_positions = array('' => __('None', 'scalia'), 'above' => __('Slider-bar above', 'scalia'), 'inside' => __('Inside content', 'scalia'), 'below' => __('Slider-bar below', 'scalia'));
	$portfolio_layouts = array('2x' => __('2x columns', 'scalia'), '3x' => __('3x columns', 'scalia'), '4x' => __('4x columns', 'scalia'), '100%' => __('100% width', 'scalia'), '1x' => __('1x column list', 'scalia'));
	$portfolio_styles = array('justified' => __('Justified Grid', 'scalia'), 'masonry' => __('Masonry Grid ', 'scalia'));
	$portfolio_titles = array('page' => __('On Page', 'scalia'), 'hover' => __('On Hover ', 'scalia'));
	$portfolio_hovers = array('default' => __('Default', 'scalia'), 'zooming-blur' => __('Zooming Blur', 'scalia'), 'horizontal-sliding' => __('Horizontal Sliding', 'scalia'), 'vertical-sliding' => __('Vertical Sliding', 'scalia'));
	$portfolio_pagination = array('normal' => __('Normal', 'scalia'), 'more' => __('Load More ', 'scalia'));
	$portfolio_fullwidth_columns = array('4' => __('4 Columns', 'scalia'), '5' => __('5 Columns ', 'scalia'));
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="page_portfolio_position"><?php _e('Position', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($portfolio_positions, $page_data['portfolio_position'], 'scalia_page_data[portfolio_position]', 'page_portfolio_position'); ?>
		<br /><br />

		<label for="page_portfolio_layout"><?php _e('Layout', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($portfolio_layouts, $page_data['portfolio_layout'], 'scalia_page_data[portfolio_layout]', 'page_portfolio_layout'); ?>
		<br /><br />

		<label for="page_portfolio_style"><?php _e('Style', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($portfolio_styles, $page_data['portfolio_style'], 'scalia_page_data[portfolio_style]', 'page_portfolio_style'); ?>
		<br /><br />

		<label for="page_portfolio_fullwidth_columns"><?php _e('Columns 100% Width (1920x Screen)', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($portfolio_fullwidth_columns, $page_data['portfolio_fullwidth_columns'], 'scalia_page_data[portfolio_fullwidth_columns]', 'page_portfolio_fullwidth_columns'); ?>
		<br /><br />

		<input name="scalia_page_data[portfolio_no_gaps]" type="checkbox" id="page_portfolio_no_gaps" value="1" <?php checked($page_data['portfolio_no_gaps'], 1); ?> />
		<label for="page_portfolio_no_gaps"><?php _e('No Gaps', 'scalia'); ?></label>
		<br /><br />

		<label for="page_portfolio_display_titles"><?php _e('Display Titles', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($portfolio_titles, $page_data['portfolio_display_titles'], 'scalia_page_data[portfolio_display_titles]', 'page_portfolio_display_titles'); ?>
		<br /><br />

		<label for="page_portfolio_hover"><?php _e('Hover Type', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($portfolio_hovers, $page_data['portfolio_hover'], 'scalia_page_data[portfolio_hover]', 'page_portfolio_hover'); ?>
		<br /><br />

		<label for="page_portfolio_pagination"><?php _e('Pagination', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($portfolio_pagination, $page_data['portfolio_pagination'], 'scalia_page_data[portfolio_pagination]', 'page_portfolio_pagination'); ?>
		<br /><br />

		<label for="page_portfolio_items_per_page"><?php _e('Items per page', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[portfolio_items_per_page]" id="page_portfolio_items_per_page" value="<?php echo esc_attr($page_data['portfolio_items_per_page']); ?>" />
		<br /><br />

		<label for="page_portfolio_title"><?php _e('Title', 'scalia'); ?>:</label><br />
		<input type="text" name="scalia_page_data[portfolio_title]" id="page_portfolio_title" value="<?php echo esc_attr($page_data['portfolio_title']); ?>" />
		<br /><br />

		<input name="scalia_page_data[portfolio_show_info]" type="checkbox" id="page_portfolio_show_info" value="1" <?php checked($page_data['portfolio_show_info'], 1); ?> />
		<label for="page_portfolio_show_info"><?php _e('Show Date & Sets', 'scalia'); ?></label>
		<br />

		<input name="scalia_page_data[portfolio_disable_socials]" type="checkbox" id="page_portfolio_disable_socials" value="1" <?php checked($page_data['portfolio_disable_socials'], 1); ?> />
		<label for="page_portfolio_disable_socials"><?php _e('Disable sharing buttons', 'scalia'); ?></label>
		<br />

		<div id="portfolio_slider_effects_enabled">
			<input name="scalia_page_data[portfolio_effects_enabled]" type="checkbox" id="page_portfolio_effects_enabled" value="1" <?php checked($page_data['portfolio_effects_enabled'], 1); ?> />
			<label for="page_portfolio_effects_enabled"><?php _e('Lazy loading enabled', 'scalia'); ?></label>
		<div>
	</td>
	<td>
		<label for="portfolio_select"><?php _e('Select Portfolios', 'scalia') ?>:</label><br />
		<?php scalia_print_checkboxes($portfolios, $page_data['portfolio_portfolios'], 'scalia_page_data[portfolio_portfolios][]', 'page_portfolio_portfolios', '<br/>'); ?><br />
		<br />

		<input name="scalia_page_data[portfolio_with_filter]" type="checkbox" id="page_portfolio_filter" value="1" <?php checked($page_data['portfolio_with_filter'], 1); ?> />
		<label for="page_portfolio_filter"><?php _e('Activate Filter', 'scalia'); ?></label>
	</td>
</tr></tbody></table>
<script type='text/javascript'>
	init_portfolio_page_settings();
</script>
<?php
}

/* Galleries box */
function scalia_page_gallery_settings_box($post) {
	wp_nonce_field('scalia_page_gallery_settings_box', 'scalia_page_gallery_settings_box_nonce');
	$page_data = scalia_get_sanitize_page_gallery_data($post->ID);
	$galleries_posts = get_posts(array('post_type' => 'scalia_gallery', 'posts_per_page' => -1, 'suppress_filters' => false));
	$galleries = array();
	foreach($galleries_posts as $gallery_post) {
		$galleries[$gallery_post->ID] = $gallery_post->post_title;
	}
	$gallery_positions = array('' => __('None', 'scalia'), 'above' => __('Gallery above', 'scalia'), 'below' => __('Gallery below', 'scalia'));
	$gallery_types = array('slider' => __('Slider', 'scalia'), 'grid' => __('Grid', 'scalia'));
	$gallery_layouts = array(
		'3x' => __('3x columns', 'scalia'),
		'4x' => __('4x columns', 'scalia'),
		'100%' => __('100% width', 'scalia'),
	);
	$gallery_styles = array(
		'justified' => __('Justified Grid', 'scalia'),
		'masonry' => __('Masonry Grid', 'scalia'),
		'metro' => __('Metro Style', 'scalia'),
	);
	$gallery_hovers = array('default' => __('Default', 'scalia'), 'zooming-blur' => __('Zooming Blur', 'scalia'));

	$gallery_item_styles = array(
		'' => '',
		'1' => __('1px & shadow', 'scalia'),
		'2' => __('4px', 'scalia'),
		'3' => __('10px', 'scalia'),
		'4' => __('10px outlined', 'scalia'),
		'5' => __('20px outlined & flat shadow', 'scalia'),
		'6' => __('20px outlined & soft shadow', 'scalia'),
		'7' => __('30px combined & flat shadow', 'scalia'),
		'8' => __('30px combined', 'scalia'),
		'9' => __('30px combined inverted', 'scalia'),
		'10' => __('dashed', 'scalia'),
		'11' => __('round image', 'scalia'),
		'12' => __('soft corner', 'scalia')
	);

?>
<table class="settings-box-table"><tbody>
	<tr>
		<td>
			<label for="page_gallery_gallery"><?php _e('Gallery', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($galleries, $page_data['gallery_gallery'], 'scalia_page_data[gallery_gallery]', 'page_gallery_gallery'); ?><br /><br />

			<label for="page_gallery_position"><?php _e('Gallery position', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($gallery_positions, $page_data['gallery_position'], 'scalia_page_data[gallery_position]', 'page_gallery_position'); ?><br/><br/>

			<label for="page_gallery_type"><?php _e('Gallery Type', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($gallery_types, $page_data['gallery_type'], 'scalia_page_data[gallery_type]', 'page_gallery_type'); ?><br/><br/>

			<label for="page_gallery_layout"><?php _e('Layout', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($gallery_layouts, $page_data['gallery_layout'], 'scalia_page_data[gallery_layout]', 'page_gallery_layout'); ?><br/><br/>
		</td>
		<td>
			<label for="page_gallery_style"><?php _e('Style', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($gallery_styles, $page_data['gallery_style'], 'scalia_page_data[gallery_style]', 'page_gallery_style'); ?><br /><br/>

			<input name="scalia_page_data[gallery_no_gaps]" type="checkbox" id="page_gallery_no_gaps" value="1" <?php checked($page_data['gallery_no_gaps'], 1); ?> />
			<label for="page_gallery_no_gaps"><?php _e('No Gaps', 'scalia'); ?></label>
			<br /><br />

			<label for="page_gallery_hover"><?php _e('Hover Type', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($gallery_hovers, $page_data['gallery_hover'], 'scalia_page_data[gallery_hover]', 'page_gallery_hover'); ?>
			<br /><br />

			<label for="page_gallery_item_style"><?php _e('Border Style', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($gallery_item_styles, $page_data['gallery_item_style'], 'scalia_page_data[gallery_item_style]', 'page_gallery_item_style'); ?>
		</td>
	</tr>
</tbody></table>
<script type='text/javascript'>
	init_gallery_page_settings();
</script>
<?php
}

/* Sidebar box */
function scalia_page_sidebar_settings_box($post) {
	wp_nonce_field('scalia_page_sidebar_settings_box', 'scalia_page_sidebar_settings_box_nonce');
	$page_data = scalia_get_sanitize_page_sidebar_data($post->ID);
	$sidebar_positions = array('' => __('None', 'scalia'), 'left' => __('Left', 'scalia'), 'right' => __('Right', 'scalia'));
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="page_sidebar_position"><?php _e('Sidebar Position', 'scalia'); ?>:</label><br />
		<?php scalia_print_select_input($sidebar_positions, $page_data['sidebar_position'], 'scalia_page_data[sidebar_position]', 'page_sidebar_position'); ?><br />
	</td>
	<td>
		<input name="scalia_page_data[sidebar_sticky]" type="checkbox" id="page_sidebar_sticky" value="1" <?php checked($page_data['sidebar_sticky'], 1); ?> />
		<label for="page_sidebar_sticky"><?php _e('Sticky sidebar', 'scalia'); ?></label>
	</td>
</tr></tbody></table>
<?php
}

/* Blog box */
function scalia_page_blog_settings_box($post) {
	wp_nonce_field('scalia_page_blog_settings_box', 'scalia_page_blog_settings_box_nonce');
	$page_data = scalia_get_sanitize_page_blog_data($post->ID);
	$blog_styles = array('default' => __('Default', 'scalia'), 'timeline' => __('Timeline', 'scalia'), '3x' => __('Masonry 3x', 'scalia'), '4x' => __('Masonry 4x', 'scalia'), '100%' => __('100% width', 'scalia'), 'grid_carousel' => __('News Grid Carousel', 'scalia'), 'styled_list1' => __('Styled List 1', 'scalia'), 'styled_list2' => __('Styled List 2', 'scalia'));
	$blog_pagination = array('normal' => __('Normal', 'scalia'), 'more' => __('Load More', 'scalia'), 'disable' => __('Disable pagination ', 'scalia'));

	$category_terms = get_categories(array('hide_empty' => false));
	$categories = array('--all--' => __('All Items', 'scalia'));
	foreach($category_terms as $term) {
		$categories[$term->slug] = $term->name;
	}
	if(taxonomy_exists('scalia_news_sets')) {
		$category_terms = get_categories(array('hide_empty' => false, 'taxonomy' => 'scalia_news_sets'));
		foreach($category_terms as $term) {
			$categories[$term->slug] = $term->name;
		}
	}
?>
<table class="settings-box-table"><tbody>
	<tr>
		<td>
			<label for="page_blog_style"><?php _e('Blog style', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($blog_styles, $page_data['blog_style'], 'scalia_page_data[blog_style]', 'page_blog_style'); ?>
			<br /><br />

			<label for="page_blog_post_per_page"><?php _e('Post per page', 'scalia'); ?>:</label><br />
			<input type="text" name="scalia_page_data[blog_post_per_page]" id="page_blog_post_per_page" value="<?php echo esc_attr($page_data['blog_post_per_page']); ?>" />
			<br /><br />

			<label for="page_blog_pagination"><?php _e('Pagination', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($blog_pagination, $page_data['blog_pagination'], 'scalia_page_data[blog_pagination]', 'page_blog_pagination'); ?>
			<br /><br />

		</td>
		<td>
			<label for="page_blog_categories"><?php _e('Select Categories', 'scalia') ?>:</label><br />
			<?php scalia_print_checkboxes($categories, $page_data['blog_categories'], 'scalia_page_data[blog_categories][]', 'page_blog_categories', '<br/>'); ?><br />
			<br />
			<label for="blog_post_types"><?php _e('Post types', 'scalia') ?>:</label><br />
			<?php scalia_print_checkboxes(array('post' => __('Post', 'scalia'), 'scalia_news' => __('News', 'scalia')), $page_data['blog_post_types'], 'scalia_page_data[blog_post_types][]', 'page_blog_post_types', '<br/>'); ?>

		</td>
	</tr>
</tbody></table>
<?php
}

function scalia_save_page_data($post_id) {
	if(
		!isset($_POST['scalia_page_title_settings_box_nonce']) ||
		!isset($_POST['scalia_page_effects_settings_box_nonce']) ||
		!isset($_POST['scalia_page_slideshow_settings_box_nonce']) ||
		!isset($_POST['scalia_page_quickfinder_settings_box_nonce']) ||
		!isset($_POST['scalia_page_portfolio_settings_box_nonce']) ||
		!isset($_POST['scalia_page_gallery_settings_box_nonce']) ||
		!isset($_POST['scalia_page_sidebar_settings_box_nonce'])
	) {
		return;
	}
	if(
		!wp_verify_nonce($_POST['scalia_page_title_settings_box_nonce'], 'scalia_page_title_settings_box') ||
		!wp_verify_nonce($_POST['scalia_page_effects_settings_box_nonce'], 'scalia_page_effects_settings_box') ||
		!wp_verify_nonce($_POST['scalia_page_slideshow_settings_box_nonce'], 'scalia_page_slideshow_settings_box') ||
		!wp_verify_nonce($_POST['scalia_page_quickfinder_settings_box_nonce'], 'scalia_page_quickfinder_settings_box') ||
		!wp_verify_nonce($_POST['scalia_page_portfolio_settings_box_nonce'], 'scalia_page_portfolio_settings_box') ||
		!wp_verify_nonce($_POST['scalia_page_gallery_settings_box_nonce'], 'scalia_page_gallery_settings_box') ||
		!wp_verify_nonce($_POST['scalia_page_sidebar_settings_box_nonce'], 'scalia_page_sidebar_settings_box')
	) {
		return;
	}

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && in_array($_POST['post_type'], array('post', 'page', 'scalia_pf_item', 'scalia_news'))) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['scalia_page_data']) || !is_array($_POST['scalia_page_data'])) {
		return;
	}

	$page_data = array_merge(
		scalia_get_sanitize_page_title_data(0, $_POST['scalia_page_data']),
		scalia_get_sanitize_page_effects_data(0, $_POST['scalia_page_data']),
		scalia_get_sanitize_page_slideshow_data(0, $_POST['scalia_page_data']),
		scalia_get_sanitize_page_quickfinder_data(0, $_POST['scalia_page_data']),
		scalia_get_sanitize_page_portfolio_data(0, $_POST['scalia_page_data']),
		scalia_get_sanitize_page_gallery_data(0, $_POST['scalia_page_data']),
		scalia_get_sanitize_page_sidebar_data(0, $_POST['scalia_page_data'])
	);
	if($_POST['post_type'] == 'page') {
		$page_data = array_merge($page_data, scalia_get_sanitize_page_blog_data(0, $_POST['scalia_page_data']));
	}
	update_post_meta($post_id, 'scalia_page_data', $page_data);
}
add_action('save_post', 'scalia_save_page_data');

function scalia_get_sanitize_page_title_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'title_style' => '1',
		'title_background_image' => '',
		'title_background_color' => '',
		'title_video_type' => '',
		'title_video_background' => '',
		'title_video_aspect_ratio' => '',
		'title_video_overlay_color' => '',
		'title_video_overlay_opacity' => '',
		'title_menu_on_video' => '',
		'title_text_color' => '',
		'title_excerpt_text_color' => '',
		'title_excerpt' => '',
		'title_icon' => '',
		'title_icon_color' => '',
		'title_icon_color_2' => '',
		'title_icon_background_color' => '',
		'title_icon_shape' => '',
		'title_icon_border_color' => '',
		'title_icon_size' => '',
		'title_icon_style' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = scalia_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['title_style'] = scalia_check_array_value(array('', '1', '2'), $page_data['title_style'], '1');
	$page_data['title_background_image'] = esc_url($page_data['title_background_image']);
	$page_data['title_background_color'] = sanitize_text_field($page_data['title_background_color']);
	$page_data['title_video_type'] = scalia_check_array_value(array('', 'youtube', 'vimeo', 'self'), $page_data['title_video_type'], '');
	$page_data['title_video_background'] = sanitize_text_field($page_data['title_video_background']);
	$page_data['title_video_aspect_ratio'] = sanitize_text_field($page_data['title_video_aspect_ratio']);
	$page_data['title_video_overlay_color'] = sanitize_text_field($page_data['title_video_overlay_color']);
	$page_data['title_video_overlay_opacity'] = sanitize_text_field($page_data['title_video_overlay_opacity']);
	$page_data['title_menu_on_video'] = $page_data['title_menu_on_video'] ? 1 : 0;
	$page_data['title_text_color'] = sanitize_text_field($page_data['title_text_color']);
	$page_data['title_excerpt_text_color'] = sanitize_text_field($page_data['title_excerpt_text_color']);
	$page_data['title_excerpt'] = implode("\n", array_map('sanitize_text_field', explode("\n", $page_data['title_excerpt'])));
	$page_data['title_icon'] = sanitize_text_field($page_data['title_icon']);
	$page_data['title_icon_color'] = sanitize_text_field($page_data['title_icon_color']);
	$page_data['title_icon_color_2'] = sanitize_text_field($page_data['title_icon_color_2']);
	$page_data['title_icon_background_color'] = sanitize_text_field($page_data['title_icon_background_color']);
	$page_data['title_icon_border_color'] = sanitize_text_field($page_data['title_icon_border_color']);
	$page_data['title_icon_shape'] = scalia_check_array_value(array('circle', 'square'), $page_data['title_icon_shape'], 'circle');
	$page_data['title_icon_size'] = scalia_check_array_value(array('small', 'medium', 'big'), $page_data['title_icon_size'], 'big');
	$page_data['title_icon_style'] = scalia_check_array_value(array('', 'angle-45deg-r', 'angle-45deg-l', 'angle-90deg'), $page_data['title_icon_style'], '');
	return $page_data;
}

function scalia_get_sanitize_page_effects_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'effects_disabled' => false,
		'effects_no_bottom_margin' => false,
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = scalia_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['effects_disabled'] = $page_data['effects_disabled'] ? 1 : 0;
	$page_data['effects_no_bottom_margin'] = $page_data['effects_no_bottom_margin'] ? 1 : 0;
	return $page_data;
}

function scalia_get_sanitize_page_slideshow_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'slideshow_type' => '',
		'slideshow_slideshow' => '',
		'slideshow_layerslider' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = scalia_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['slideshow_type'] = scalia_check_array_value(array('', 'NivoSlider', 'LayerSlider'), $page_data['slideshow_type'], '');
	$page_data['slideshow_slideshow'] = sanitize_text_field($page_data['slideshow_slideshow']);
	$page_data['slideshow_layerslider'] = sanitize_text_field($page_data['slideshow_layerslider']);
	return $page_data;
}

function scalia_get_sanitize_page_quickfinder_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'quickfinder_quickfinder' => '',
		'quickfinder_position' => '',
		'quickfinder_style' => '',
		'quickfinder_connector_color' => '',
		'quickfinder_effects_enabled' => false
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = scalia_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['quickfinder_quickfinder'] = sanitize_text_field($page_data['quickfinder_quickfinder']);
	$page_data['quickfinder_position'] = scalia_check_array_value(array('', 'above', 'inside', 'below'), $page_data['quickfinder_position'], '');
	$page_data['quickfinder_style'] = scalia_check_array_value(array('default', 'vertical-1', 'vertical-2'), $page_data['quickfinder_style'], '');
	$page_data['quickfinder_connector_color'] = sanitize_text_field($page_data['quickfinder_connector_color']);
	$page_data['quickfinder_effects_enabled'] = $page_data['quickfinder_effects_enabled'] ? 1 : 0;

	return $page_data;
}

function scalia_get_sanitize_page_portfolio_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'portfolio_portfolios' => array(),
		'portfolio_position' => '',
		'portfolio_with_filter' => false,
		'portfolio_title' => '',
		'portfolio_layout' => '',
		'portfolio_style' => '',
		'portfolio_no_gaps' => false,
		'portfolio_display_titles' => '',
		'portfolio_hover' => '',
		'portfolio_pagination' => '',
		'portfolio_items_per_page' => '',
		'portfolio_show_info' => false,
		'portfolio_disable_socials' => false,
		'portfolio_fullwidth_columns' => '',
		'portfolio_effects_enabled' => false
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = scalia_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['portfolio_portfolios'] = is_array($page_data['portfolio_portfolios']) ? $page_data['portfolio_portfolios'] : array();
	$page_data['portfolio_position'] = scalia_check_array_value(array('', 'above', 'inside', 'below'), $page_data['portfolio_position'], '');
	$page_data['portfolio_with_filter'] = $page_data['portfolio_with_filter'] ? 1 : 0;
	$page_data['portfolio_title'] = sanitize_text_field($page_data['portfolio_title']);
	$page_data['portfolio_layout'] = scalia_check_array_value(array('2x', '3x', '4x', '100%', '1x'), $page_data['portfolio_layout'], '2x');
	$page_data['portfolio_style'] = scalia_check_array_value(array('justified', 'masonry'), $page_data['portfolio_style'], 'justified');
	$page_data['portfolio_no_gaps'] = $page_data['portfolio_no_gaps'] ? 1 : 0;
	$page_data['portfolio_display_titles'] = scalia_check_array_value(array('page', 'hover'), $page_data['portfolio_display_titles'], 'page');
	$page_data['portfolio_hover'] = scalia_check_array_value(array('default', 'zooming-blur', 'horizontal-sliding', 'vertical-sliding'), $page_data['portfolio_hover'], 'default');
	$page_data['portfolio_pagination'] = scalia_check_array_value(array('normal', 'more'), $page_data['portfolio_pagination'], 'normal');
	$page_data['portfolio_items_per_page'] = sanitize_text_field($page_data['portfolio_items_per_page']);
	$page_data['portfolio_show_info'] = $page_data['portfolio_show_info'] ? 1 : 0;
	$page_data['portfolio_disable_socials'] = $page_data['portfolio_disable_socials'] ? 1 : 0;
	$page_data['portfolio_fullwidth_columns'] = scalia_check_array_value(array('4', '5'), $page_data['portfolio_fullwidth_columns'], '5');
	$page_data['portfolio_effects_enabled'] = $page_data['portfolio_effects_enabled'] ? 1 : 0;
	return $page_data;
}

function scalia_get_sanitize_page_gallery_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'gallery_gallery' => '',
		'gallery_position' => '',
		'gallery_type' => '',
		'gallery_style' => '',
		'gallery_layout' => '',
		'gallery_no_gaps' => '',
		'gallery_hover' => '',
		'gallery_item_style' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = scalia_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['gallery_gallery'] = sanitize_text_field($page_data['gallery_gallery']);
	$page_data['gallery_position'] = scalia_check_array_value(array('', 'above', 'below'), $page_data['gallery_position'], '');
	$page_data['gallery_type'] = scalia_check_array_value(array('slider', 'grid'), $page_data['gallery_type'], 'slider');
	$page_data['gallery_style'] = scalia_check_array_value(array('justified', 'masonry', 'metro'), $page_data['gallery_style'], 'justified');
	$page_data['gallery_layout'] = scalia_check_array_value(array('3x', '4x', '100%'), $page_data['gallery_layout'], '3x');
	$page_data['gallery_no_gaps'] = $page_data['gallery_no_gaps'] ? 1 : 0;
	$page_data['gallery_hover'] = scalia_check_array_value(array('default', 'zooming-blur'), $page_data['gallery_hover'], 'default');
	$page_data['gallery_item_style'] = scalia_check_array_value(array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'), $page_data['gallery_item_style'], '');
	return $page_data;
}

function scalia_get_sanitize_page_sidebar_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'sidebar_position' => '',
		'sidebar_sticky' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = scalia_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['sidebar_position'] = scalia_check_array_value(array('', 'left', 'right'), $page_data['sidebar_position'], '');
	$page_data['sidebar_sticky'] = $page_data['sidebar_sticky'] ? 1 : 0;
	return $page_data;
}

function scalia_get_sanitize_page_blog_data($post_id = 0, $item_data = array()) {
	$page_data = array(
			'blog_style' => '',
			'blog_post_per_page' => '',
			'blog_categories' => '',
			'blog_post_types' => '',
			'blog_pagination' => ''
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = scalia_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['blog_style'] = scalia_check_array_value(array('default', 'timeline', '3x', '4x', '100%', 'grid_carousel', 'styled_list1', 'styled_list2'), $page_data['blog_style'], 'default');
	$page_data['blog_post_per_page'] = intval($page_data['blog_post_per_page']) > 0 ? intval($page_data['blog_post_per_page']) : 5;
	$page_data['blog_categories'] = is_array($page_data['blog_categories']) ? $page_data['blog_categories'] : array();
	$page_data['blog_post_types'] = is_array($page_data['blog_post_types']) ? $page_data['blog_post_types'] : array();
	$blog_pagination = array('normal', 'more', 'disable');
	$page_data['blog_pagination'] = scalia_check_array_value($blog_pagination, $page_data['blog_pagination'], 'normal');
	return $page_data;
}



function scalia_add_post_item_settings_box() {
	add_meta_box('scalia_post_item_settings', __('Blog Item Settings', 'scalia'), 'scalia_post_item_settings_box', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'scalia_add_post_item_settings_box');

function scalia_post_item_settings_box($post) {
	global $POST_TYPE_OPTIONS;

	wp_nonce_field('scalia_post_item_settings_box', 'scalia_post_item_settings_box_nonce');

	$post_item_data = scalia_get_sanitize_post_data($post->ID);
?>

<table class="settings-box-table"><tbody><tr>
	<td>
		<div id="post_item_media_type_wrapper">
			<label for="post_item_media_type_wrapper"><?php _e('Type of post item', 'scalia'); ?>:</label><br />
			<?php scalia_print_select_input($POST_TYPE_OPTIONS, $post_item_data['media_type'], 'scalia_post_item_data[media_type]', 'post_item_media_type'); ?>
		</div>
		<br/>
		<div id="post_item_link_wrapper">
			<label for="post_item_link"><?php _e('Link to Self-Hosted Video or Video ID (for YouTube or Vimeo)', 'scalia'); ?>:</label><br />
			<input name="scalia_post_item_data[link]" type="text" id="post_item_link" value="<?php echo esc_attr($post_item_data['link']); ?>" size="60" />
		</div>
	</td>
	<td>
		<input name="scalia_post_item_data[show_featured_image]" type="checkbox" id="post_item_show_featured_image" value="1" <?php checked($post_item_data['show_featured_image'], 1); ?> />
		<label for="post_item_show_featured_image"><?php _e('Show Featured Image', 'scalia'); ?></label>
	</td>
</tr></tbody></table>
</p>

<script type='text/javascript'>
	init_post_item_settings();
</script>
<?php
}

function scalia_post_item_save_meta_box_data($post_id) {
	if(!isset($_POST['scalia_post_item_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['scalia_post_item_settings_box_nonce'], 'scalia_post_item_settings_box')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && ('scalia_news' == $_POST['post_type'] || 'post' == $_POST['post_type'])) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['scalia_post_item_data']) || !is_array($_POST['scalia_post_item_data'])) {
		return;
	}

	$post_item_data = scalia_get_sanitize_post_data(0, $_POST['scalia_post_item_data']);
	update_post_meta($post_id, 'scalia_post_general_item_data', $post_item_data);
}
add_action('save_post', 'scalia_post_item_save_meta_box_data');

$POST_TYPE_OPTIONS = array('default' => __('Default', 'scalia'), 'youtube' => __('YouTube Video', 'scalia'), 'vimeo' => __('Vimeo Video', 'scalia'), 'self_video' => __('Self-Hosted Video', 'scalia'));

function scalia_get_sanitize_post_data($post_id = 0, $item_data = array()) {
	global $POST_TYPE_OPTIONS;

	$post_item_data = array(
		'media_type' => '',
		'link' => '',
		'show_featured_image' => ''
	);
	if(is_array($item_data) && !empty($item_data)) {
		$post_item_data = array_merge($item_data);
	} elseif($post_id != 0) {
		$post_item_data = scalia_get_post_data($post_item_data, 'post_general_item', $post_id);
	}

	$post_type_options = array_keys($POST_TYPE_OPTIONS);
	$post_item_data['media_type'] = scalia_check_array_value($post_type_options, $post_item_data['media_type'], 'default');
	if(!in_array($post_item_data['media_type'], array('youtube', 'vimeo'))) {
		$post_item_data['link'] = esc_url($post_item_data['link']);
	}
	$post_item_data['show_featured_image'] = $post_item_data['show_featured_image'] ? 1 : 0;

	return $post_item_data;
}
